<div class="encadre">
   <table class="listeLegere">
      <tr>
         <th class="id">N°Visiteur</th>
         <th class="idFraisForfait">Type de frais</th>
         <th class='mois'> mois </th>   
         <th class='somme'>Montant</th>             
      </tr>
     
      <?php  foreach ($Cumuls as $unFraisHorsForfait) { ?>
      <tr>
         <td><?php  echo $unFraisHorsForfait['idVisiteur']; ?></td>
         <td><?php  echo $unFraisHorsForfait['idFraisForfait']; ?></td>
         <td><?php  echo $unFraisHorsForfait['mois']; ?></td>
         <td><?php  echo $unFraisHorsForfait['somme']; ?></td>
      </tr>
      <?php } ?>
   </table>
</div>
