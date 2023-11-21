<div class="encadre">
   <table class="listeLegere">
      <tr>
         <th class='id'>idVisiteur</th>  
         <th class='etp'>ETP</th>  
         <th class='km'>KM</th>  
         <th class='nui'>NUI</th>  
         <th class='rep'>REP</th>  
        
      </tr>
     
      <?php  foreach ($Mois as $unMois) { ?>
      <tr>
         <td><?php  echo $unMois['idVisiteur']; ?></td>
         <td><?php  echo $unMois['ETP']; ?></td>
         <td><?php  echo $unMois['KM']; ?></td>
         <td><?php  echo $unMois['NUI']; ?></td>
         <td><?php  echo $unMois['REP']; ?></td>


      </tr>
      <?php } ?>
   </table>
</div>
