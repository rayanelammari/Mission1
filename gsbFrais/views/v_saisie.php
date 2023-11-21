<div id="contenu">
      <form action="index.php?uc=saisie&action=ajout" method="post">
      <div class="corpsForm">
          <p>
          <h2>Saisie</h2>
                    <label for="lstVisiteur" accesskey="n"><span style="margin-right: 150px;">VISITEUR :</span> Numéro :</label>
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
                <div>
                <label for="p" style="display: inline-block; width: 150px;">Période d'engagement </label><br><br>
                <label for="mois">Mois :</label>
                <input type="number" name="mois" id="mois" required>
                <label for="annee">Année :</label>
                <input type="number" name="annee" id="annee" required>
           
               
                </div>

                     
            </p>

            <p> 
                    <div style="margin-bottom: 10px;">
                        <label for="rep">Repas midi :</label>
                        <input style="width: 50px;" type="number" name="rep" id="rep" required><br>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="nui">Nuitée :</label>
                        <input style="width: 50px;" type="number" name="nui" id="nui" required><br>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="etp">Etape :</label>
                        <input style="width: 50px;" type="number" name="etp" id="etp" required><br>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label for="km">Km  :</label>
                        <input style="width: 50px;" type="number" name="km" id="km" required><br>
                    </div>


            </p>
           

          
      </div>
      <div class="piedForm">
      <div style="text-align: right;">
        <input type="submit" value="Valider">
     </div>
        
    </form>
</div>