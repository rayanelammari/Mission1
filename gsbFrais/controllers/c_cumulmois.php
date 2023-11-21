
<?php
/** @var PdoGsb $pdo */
include 'views/v_sommaire.php';
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];
$mois="";

        switch($action){
            case 'mois':
            {   
                $lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
                include("views/v_cumulMois.php");  
                break;
            }

            case 'voirMois':
            {   
                $lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
                include("views/v_cumulMois.php");  
                $Mois=$pdo->getCumulMois($mois);
                include("views/v_EtatMois.php");
                break;
            }

}