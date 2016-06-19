<?php include "templates/include/header.php" ?>

    <div id="adminHeader">
          <span class="section-back-container">
              <a href="admin.php?action=listSoci">
                  <img src="images/left-arrow.png">
                  <span>back</span>
              </a>
          </span>
        <span class="section-logout-container">You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></span>
    </div>


<?php if ($results['socio']->id == null) { ?>
    <h1 class="section-title">Nuovo Socio</h1> <?php 
} else { ?>
    <h1 class="section-title">Modifica Socio</h1> <?php  
}
?>



    <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
        <input type="hidden" name="id" value="<?php echo $results['socio']->id ?>"/>

        <?php if ( isset( $results['errorMessage'] ) ) { ?>
            <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
        <?php } ?>

        <ul>

            <li>
                <label for="title">Numero Socio</label>
                <input type="text" name="personal_id" id="personal_id" placeholder="Numero socio" maxlength="255" value="<?php echo htmlspecialchars( $results['socio']->personal_id )?>" />
            </li>

            <li>
                <label for="firstname">Nome</label>
                <input type="text" name="firstname" id="firstname" placeholder="Nome" required maxlength="255" value="<?php echo htmlspecialchars( $results['socio']->firstname )?>"/>
            </li>

            <li>
                <label for="lastname">Cognome</label>
                <input type="text" name="lastname" id="lastname" placeholder="Cognome" required maxlength="255" value="<?php echo htmlspecialchars( $results['socio']->lastname )?>"/>
            </li>

            <li>
                <label for="date_of_birth">Data di nascita</label>
                <input type="text" name="date_of_birth" id="date_of_birth" placeholder="Data di nascita" required maxlength="255" value="<?php echo htmlspecialchars( $results['socio']->date_of_birth )?>"/>
            </li>

            <li>
                <label for="nationality">Nazionalità</label>
                <input type="text" name="nationality" id="nationality" placeholder="Nazionalità" required maxlength="255" value="<?php echo htmlspecialchars( $results['socio']->nationality )?>"/>
            </li>

            <li>
                <label for="address">Indirizzo</label>
                <input type="text" name="address" id="address" placeholder="Indirizzo" required maxlength="255" value="<?php echo htmlspecialchars( $results['socio']->address )?>"/>
            </li>

            <li>
                <label for="cap">CAP</label>
                <input type="text" name="cap" id="cap" placeholder="CAP" required maxlength="255" value="<?php echo htmlspecialchars( $results['socio']->cap )?>"/>
            </li>

            <li>
                <label for="city">Città</label>
                <input type="text" name="city" id="city" placeholder="Città" required maxlength="255" value="<?php echo htmlspecialchars( $results['socio']->city )?>"/>
            </li>

            <li>
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" placeholder="Telefono" required maxlength="255" value="<?php echo htmlspecialchars( $results['socio']->phone )?>"/>
            </li>

            <li>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" required maxlength="255" value="<?php echo htmlspecialchars( $results['socio']->email )?>"/>
            </li>

            <li>
                <label for="positionId">Posizione</label>
                <input type="radio" id="positionId" name="positionId" value="0" <?php if($results['socio']->positionId==0) echo "checked"?>/> INTERNO
                <input style="margin-left: 24px" type="radio" id="positionId" name="positionId" value="1" <?php if($results['socio']->positionId==1) echo "checked"?>/> ESTERNO

            </li>

            <li>
                <label for="state">Stato</label>
                <input type="radio" id="state" name="state" value="0" <?php if($results['socio']->state==0) echo "checked"?>/> APPROVATO
                <input style="margin-left: 24px" type="radio" id="state" name="state" value="1" <?php if($results['socio']->state==1) echo "checked"?>/> IN APPROVAZIONE
            </li>



        </ul>

        <div class="buttons">
            <input type="submit" name="saveChanges" value="SALVA" />
            <input type="submit" formnovalidate name="cancel" value="Annulla" />
        </div>

    </form>

<?php if ( $results['socio']->id ) { ?>
    <p><a href="admin.php?action=deleteSocio&amp;socioId=<?php echo $results['socio']->id ?>" onclick="return confirm('Eliminare il socio dal sistema?')">Delete This Socio</a></p>
<?php } ?>


<?php include "templates/include/footer.php" ?>