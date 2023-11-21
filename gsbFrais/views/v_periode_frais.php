<div id="contenu">
      <h2>Période</h2>
      <form action="index.php?uc=cumulfrais&action=voirMontant" method="post">
      <div class="corpsForm">
          <p>
      
            <label for="lstMois" accesskey="n">Année/Mois : </label>
            <select id="lstMois" name="lstMois">
                <?php
          foreach ($lesMois as $unMois)
          {
              $mois = $unMois['mois'];
            $numAnnee =  $unMois['numAnnee'];
            $numMois =  $unMois['numMois'];
            if($mois == $moisASelectionner){
            ?>
            <option selected  value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
            <?php 
            }
            else{ ?>
            <option value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
            <?php 
            }
          
          }
              
          ?>    
                
            </select>

            
          </p>

          <p>
      
              <label for="lstType" accesskey="n">Type de frais : </label>
                <select id="lstType" name="lstType">
                  <?php
                    foreach ($lesTypes as $unType)
                    {
                        $type = $unType['id'];
                      if($type == $typeASelectionner){
                      ?>
                      <option selected value="<?php echo $type ?>"><?php echo $type ?></option>
                      <?php 
                      }
                      else{ ?>
                      <option value="<?php echo $type ?>"><?php echo  $type ?> </option>
                      <?php 
                      }
                    
                    }
                  
                  ?>    
                </select>

          </p>
      </div>
      <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
        
    </form>
</div>