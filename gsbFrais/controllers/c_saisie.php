<?php
/** @var PdoGsb $pdo */
include 'views/v_sommaire.php';
$action = $_REQUEST['action'];
$idV="";
$idVisiteur="";
$date="";
$qte="";
$idFraisForfait="";
$rep = ''; 
$etp = ''; 
$nuit = ''; 
$km = '';
        switch($action){
            case 'saisieFrais':
            {   
               $lesNumero=$pdo->getVisiteur($idV);
                include("views/v_saisie.php");  
                break;
            }

            case 'ajout':
            {    

                
                $lesNumero=$pdo->getVisiteur ($idV); 
                include("views/v_saisie.php");
                $idVisiteur=$_REQUEST['lstVisiteur'];//Récupération de valeur 
                $mois=$_REQUEST['mois'];
                $annee=$_REQUEST['annee'];
                $date=$annee.$mois;
                $pdo->getFicheFrais($idVisiteur, $date);
                if (!$pdo->verifSaisieFrais($idVisiteur, $date)) {
                 echo "  idVisiteur et mois n'existe pas, insérez-la d'abord";
                }else
                {
                  $etp=$_REQUEST['etp'];
                  $nuit=$_REQUEST['nui'];
                  $rep=$_REQUEST['rep'];
                  $km=$_REQUEST['km'];
              
                  if (isset($etp)) {
                      $pdo->getFraisForfait($idVisiteur, $date, 'ETP', $etp);
                  }
                  if (isset($nuit)) {
                      $pdo->getFraisForfait($idVisiteur, $date, 'NUI', $nuit);
                  }
                  if (isset($rep)) {
                      $pdo->getFraisForfait($idVisiteur, $date, 'REP', $rep);
                  }
                  if (isset($km)) {
                      $pdo->getFraisForfait($idVisiteur, $date, 'KM', $km);
                  }
                }
                include("views/v_ajoutSaisie.php");
            
                
            }

}