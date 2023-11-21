
<?php
/** @var PdoGsb $pdo */
include 'views/v_sommaire.php';
$action = $_REQUEST['action'];
$idV="";

        switch($action){
            case 'visiteur':
            {   
                $lesNumero=$pdo->getVisiteur($idV);
                include("views/v_cumulvisiteur.php");  
                break;
            }

            case 'cumulVisiteur':
            {   
                $lesNumero=$pdo->getVisiteur($idV);
                include("views/v_cumulvisiteur.php");  

                $cumulVisiteur=$pdo->getCumulVisiteur($idV);
                include("views/v_EtatVisiteur.php");
            }

}