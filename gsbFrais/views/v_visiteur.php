<div id="contenu">
      <h2>Visiteur</h2>
      <form action="index.php?uc=fraisVisiteur&action=voirVisiteur" method="post">
      <div class="corpsForm">
          <p>
      
            <label for="lstVisiteur" accesskey="n">Numéro : </label>
            <select name="lstVisiteur" style="width:100px;" id="lstVisiteur">
                <?php
          foreach ($lesNumero as $unVisiteur)
          {  
            $idV = $unVisiteur['id'];
            if($idV == $visiteurASelectionner){
            ?>
            <option selected  value="<?php echo $idV ?>"><?php echo $idV ?></option>
            <?php 
            }
            else{ ?>
            <option value="<?php echo $idV?>"><?php echo  $idV ?> </option>
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