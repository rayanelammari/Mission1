
<?php
/** @var PdoGsb $pdo */
include 'views/v_sommaire.php';
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];
$mois="";
$idF="";
        switch($action){
            case 'montant':
            {   
                
               
                $lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
                $lesTypes =$pdo->getCumul();
                // Afin de sélectionner par défaut le dernier mois dans la zone de liste,
                // on demande toutes les clés, et on prend la première,
                // les mois étant triés décroissants
                include("views/v_periode_frais.php");
                
                break;
            }

            case 'voirMontant':
            {   
                $lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
                $lesTypes =$pdo->getCumul();
                // Afin de sélectionner par défaut le dernier mois dans la zone de liste,
                // on demande toutes les clés, et on prend la première,
                // les mois étant triés décroissants
                include("views/v_periode_frais.php");

                $Cumuls=$pdo->getCumulFrais($idVisiteur,$mois,$idF);
                //$dateModif =  dateAnglaisVersFrancais($dateModif);
                //include("views/v_periode_frais.php");
                include("views/v_Etatperiode.php");
            }

}