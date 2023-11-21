<div class="encadre">
   <table class="listeLegere">
   <tr>
         <th class='mois'>Mois</th>  
         <th class='etp'>ETP</th>  
         <th class='km'>KM</th>  
         <th class='nui'>NUI</th>  
         <th class='rep'>REP</th>  
        
      </tr>
     
     
      <?php  foreach ($cumulVisiteur as $unVisiteur) { ?>
      <tr>
         <td><?php  echo $unVisiteur['mois']; ?></td>
         <td><?php  echo $unVisiteur['ETP']; ?></td>
         <td><?php  echo $unVisiteur['KM']; ?></td>
         <td><?php  echo $unVisiteur['NUI']; ?></td>
         <td><?php  echo $unVisiteur['REP']; ?></td>


      </tr>
      <?php } ?>
   </table>
</div>
