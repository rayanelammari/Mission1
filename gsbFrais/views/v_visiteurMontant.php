<div class="encadre">
   <table class="listeLegere">
      <tr>
         <th class='mois'> mois </th>   

         <th class='montant'>Montant</th>             
      </tr>
     
      <?php  foreach ($Montant as $unVisiteur) { ?>
      <tr>
         <td><?php  echo $unVisiteur['mois']; ?></td>
         <td><?php  echo $unVisiteur['montant']; ?></td>
      </tr>
      <?php } ?>
   </table>
</div>