<?php
/**
 * Classe d'accès aux données.

 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO
 * $monPdoGsb qui contiendra l'unique instance de la classe

 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoGsb{
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=gsbfrais';
      	private static $user='root' ;
      	private static $mdp='' ;
		private static $monPdo;
		private static $monPdoGsb=null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */
	private function __construct(){
    	PdoGsb::$monPdo = new PDO(PdoGsb::$serveur.';'.PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp);
		PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoGsb::$monPdo = null;
	}

    /**
     * Fonction statique qui crée l'unique instance de la classe
     * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
     * @return null L'unique objet de la classe PdoGsb
     */
	public  static function getPdoGsb(){
		if(PdoGsb::$monPdoGsb==null){
			PdoGsb::$monPdoGsb= new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;
	}

    /**
     * Retourne les informations d'un visiteur
     * @param $login
     * @param $mdp
     * @return mixed L'id, le nom et le prénom sous la forme d'un tableau associatif
     */
    public function getInfosVisiteur($login, $mdp){
        $stmt = "select id, nom, prenom from visiteur where login='$login' and mdp='$mdp'";
        $rs = PdoGsb::$monPdo->query($stmt);
        $ligne = $rs->fetch();
        return $ligne;
    }

    /**
     * Transforme une date au format français jj/mm/aaaa vers le format anglais aaaa-mm-jj
     
    * @param $madate au format  jj/mm/aaaa
    * @return la date au format anglais aaaa-mm-jj
    */
    public function dateAnglaisVersFrancais($maDate){
        @list($annee,$mois,$jour)=explode('-',$maDate);
        $date="$jour"."/".$mois."/".$annee;
        return $date;
    }

    /**
     * Retourne sous forme d'un tableau associatif toutes les lignes de frais hors forfait
     * concernées par les deux arguments
     * La boucle foreach ne peut être utilisée ici, car on procède
     * à une modification de la structure itérée - transformation du champ date-
     * @param $idVisiteur
     * @param $mois 'sous la forme aaaamm
     * @return array 'Tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif
     */
    public function getLesFraisHorsForfait($idVisiteur,$mois){
        $stmt = "select * from lignefraishorsforfait where idvisiteur ='$idVisiteur' 
		and mois = '$mois' ";
        $res = PdoGsb::$monPdo->query($stmt);
        $lesLignes = $res->fetchAll();
        $nbLignes = count($lesLignes);
        for ($i=0; $i<$nbLignes; $i++){
            $date = $lesLignes[$i]['date'];
            //Gestion des dates
            @list($annee,$mois,$jour) = explode('-',$date);
            $dateStr = "$jour"."/".$mois."/".$annee;
            $lesLignes[$i]['date'] = $dateStr;
        }
        return $lesLignes;
    }


    /**
     * Retourne les mois pour lesquels, un visiteur a une fiche de frais
     * @param $idVisiteur
     * @return array 'Un tableau associatif de clé un mois - aaaamm - et de valeurs l'année et le mois correspondant
     */
    public function getLesMoisDisponibles($idVisiteur){
        $stmt = "select mois from  fichefrais where idvisiteur ='$idVisiteur' order by mois desc ";
        $res = PdoGsb::$monPdo->query($stmt);
        $lesMois =array();
        $laLigne = $res->fetch();
        while($laLigne != null)	{
            $mois = $laLigne['mois'];
            $numAnnee =substr( $mois,0,4);
            $numMois =substr( $mois,4,2);
            $lesMois["$mois"]=array(
                "mois"=>"$mois",
                "numAnnee"  => "$numAnnee",
                "numMois"  => "$numMois"
            );
            $laLigne = $res->fetch();
        }
        return $lesMois;
    }

    /**
     * Retourne les informations d'une fiche de frais d'un visiteur pour un mois donn�
     * @param $idVisiteur
     * @param $mois 'sous la forme aaaamm
     * @return mixed 'Un tableau avec des champs de jointure entre une fiche de frais et la ligne d'�tat
     */
    //Mision 1.a
    public function getLesInfosFicheFrais($idVisiteur,$mois){

        $stmt = "select fichefrais.idEtat as idEtat, fichefrais.dateModif as dateModif, fichefrais.nbJustificatifs as nbJustificatifs, 
			fichefrais.montantValide as montantValide, etat.libelle as libEtat from  fichefrais inner join etat on fichefrais.idEtat = etat.id 
			where fichefrais.idVisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
        $res = PdoGsb::$monPdo->query($stmt);
        $laLigne = $res->fetch();
        return $laLigne;
    }

    public function getCumul()
    {
        $stmt = "select id FROM fraisforfait";
        $res = PdoGsb::$monPdo->query($stmt);
        $laLigne = $res->fetchAll();
        return $laLigne;
    }

    public function getCumulFrais($idVisiteur,$mois,$idF)
    {   
        $mois=$_REQUEST['lstMois'];
        $idF=$_REQUEST['lstType'];
        $stmt="SELECT idVisiteur,mois,idFraisForfait, (quantite*montant) as somme 
        FROM `lignefraisforfait` INNER JOIN fraisforfait 
        ON lignefraisforfait.idFraisForfait=fraisforfait.id 
        WHERE idVisiteur='$idVisiteur' AND mois='$mois' AND idFraisForfait='$idF'";  
        $res = PdoGsb::$monPdo->query($stmt);
        $laLigne = $res->fetchAll();
        return $laLigne;
    }

    public function getVisiteur($idV)
    {   
        $stmt="SELECT id FROM visiteur";
        $res = PdoGsb::$monPdo->query($stmt);
        $laLigne = $res->fetchAll();
        return $laLigne;
    }

    public function getVisiteurMontant($idV,$t)
    {   
        $idV=$_REQUEST['lstVisiteur'];
        $t=$_REQUEST['lstType'];
        $stmt="SELECT idVisiteur,idFraisForfait,li.mois, (li.quantite * f.montant) as montant
        FROM lignefraisforfait li INNER JOIN fraisforfait f ON li.idFraisForfait = f.id
        WHERE li.idVisiteur = '$idV' AND f.id = '$t'";
        $res = PdoGsb::$monPdo->query($stmt);
        $laLigne = $res->fetchAll();
        return $laLigne;
    }


    public function getCumulMois($mois)
    {   
        $mois=$_REQUEST['lstMois'];
        $stmt="SELECT li.idVisiteur,
		SUM(CASE WHEN li.idFraisForfait = 'ETP' THEN (li.quantite*ff.montant) END) AS 'ETP',
        SUM(CASE WHEN li.idFraisForfait = 'KM' THEN (li.quantite*ff.montant) END) AS 'KM',
        SUM(CASE WHEN li.idFraisForfait = 'NUI' THEN (li.quantite*ff.montant) END) AS 'NUI',
        SUM(CASE WHEN li.idFraisForfait = 'REP' THEN (li.quantite*ff.montant) END) AS 'REP'
         FROM lignefraisforfait li INNER JOIN fraisforfait ff ON li.idFraisForfait=ff.id
         WHERE li.mois='$mois'
         GROUP by li.idVisiteur";  
        $res = PdoGsb::$monPdo->query($stmt);
        $laLigne = $res->fetchAll();
        return $laLigne;

    }

    public function getCumulVisiteur($idV)
    {
        $idV=$_REQUEST['lstVisiteur'];
        $stmt="SELECT li.mois,
		SUM(CASE WHEN li.idFraisForfait = 'ETP' THEN (li.quantite*ff.montant) END) AS 'ETP',
        SUM(CASE WHEN li.idFraisForfait = 'KM' THEN (li.quantite*ff.montant) END) AS 'KM',
        SUM(CASE WHEN li.idFraisForfait = 'NUI' THEN (li.quantite*ff.montant) END) AS 'NUI',
        SUM(CASE WHEN li.idFraisForfait = 'REP' THEN (li.quantite*ff.montant) END) AS 'REP'
         FROM lignefraisforfait li INNER JOIN fraisforfait ff ON li.idFraisForfait=ff.id
         WHERE li.idVisiteur='$idV'
         GROUP by li.mois";
        $res = PdoGsb::$monPdo->query($stmt);
        $laLigne = $res->fetchAll();
        return $laLigne;
    }

    public function getFicheFrais($idVisiteur, $date)
    {
        $sql = "INSERT INTO fichefrais (idVisiteur, mois) VALUES (:idVisiteur, :mois) ON DUPLICATE KEY UPDATE idVisiteur = :idVisiteur, mois =:mois";
        $stmt = PdoGsb::$monPdo->prepare($sql);
        $stmt->bindValue(':idVisiteur', $idVisiteur);
        $stmt->bindValue(':mois', $date);
        $stmt->execute();
    
    
    }
    public function getFraisForfait($idVisiteur,$date,$idFraisForfait,$qte)

    {   
            $sql = "INSERT INTO lignefraisforfait (idVisiteur,mois,idFraisForfait,quantite) VALUES (:idVisiteur,:mois,:idFraisForfait,:quantite)";
            $stmt = PdoGsb::$monPdo->prepare($sql);
            $stmt->bindValue(':idVisiteur',$idVisiteur);
            $stmt->bindValue(':mois',$date);
            $stmt->bindValue(':idFraisForfait',$idFraisForfait);
            $stmt->bindValue(':quantite',$qte);
            $stmt->execute();
    }

    public function verifSaisieFrais($idVisiteur, $date)
{
    $sql = "SELECT COUNT(*) FROM fichefrais WHERE idVisiteur = :idVisiteur AND mois = :mois"; // verifie si idvisiteur et mois existe dans fichefrais
    $stmt = PdoGsb::$monPdo->prepare($sql);
    $stmt->bindValue(':idVisiteur', $idVisiteur);
    $stmt->bindValue(':mois', $date);
    $stmt->execute();
    $rowCount = $stmt->fetchColumn();
    return $rowCount > 0;
}    

}

