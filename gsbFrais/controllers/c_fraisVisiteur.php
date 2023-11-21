
<?php
/** @var PdoGsb $pdo */
include 'views/v_sommaire.php';
$action = $_REQUEST['action'];
$idV="";
$t="";

        switch($action){
            case 'visiteur':
            {   
                $lesNumero=$pdo->getVisiteur($idV);
                $lesTypes =$pdo->getCumul();
                include("views/v_visiteur.php");  
                break;
            }

            case 'voirVisiteur':
            {   
                $lesNumero=$pdo->getVisiteur($idV);
                $lesTypes =$pdo->getCumul();
                include("views/v_visiteur.php");  

                $Montant=$pdo->getVisiteurMontant($idV,$t);
          
                include("views/v_visiteurMontant.php");
            }

}