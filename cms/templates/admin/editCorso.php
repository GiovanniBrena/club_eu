<?php include "templates/include/header.php" ?>

    <div id="adminHeader">
          <span class="section-back-container">
              <a href="admin.php?action=listCorsi">
                  <i class="fa fa-arrow-left" style="top: 0; color: white; width: auto; padding: 4px"></i>
                  <span>back</span>
              </a>
          </span>
        <span class="section-logout-container">You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></span>
    </div>

<?php $corso=$results['corso'];
if ($corso->id == null) {
    ?>
    <h1 class="section-title">Nuovo Corso</h1> <?php
} else {
    ?>
    <h1 class="section-title">Modifica Corso </h1><?php
}
?>


<?php if ( isset( $results['errorMessage'] ) ) { ?>
    <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>


    <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">

        <input type="hidden" name="id" value="<?php echo $corso->id ?>"/>
        <input type="hidden" name="state" value="<?php echo $corso->state ?>"/>
        <input type="hidden" name="data0" value="<?php echo $corso->data0 ?>"/>
        <input type="hidden" name="data1" value="<?php echo $corso->data1 ?>"/>
        <input type="hidden" name="data2" value="<?php echo $corso->data2 ?>"/>
        <input type="hidden" name="date_create" value="<?php echo $corso->date_create ?>"/>

        <ul>
            <li>
                <label for="lang-select">Lingua</label>
                <select id="lang-select" name="lang" >
                    <option value="">-- select one --</option>
                    <option value="italian">Italian</option>
                    <option value="english">English</option>
                    <option value="french">French</option>
                    <option value="german">German</option>
                    <option value="russian">Russian</option>
                    <option value="japanese">Japanese</option>
                </select>
            </li>

            <li>
                <p style="display: none;" id="language-hidden"><?php echo htmlspecialchars( $results['corso']->lang )?></p>
            </li>

            <li>
                <label for="title_it">Livello ITA</label>
                <input type="text" name="level_it" id="level_it" placeholder="Livello ITA" maxlength="255" value="<?php echo htmlspecialchars($corso->level_it, ENT_COMPAT, 'ISO-8859-1')?>"/>
            </li>

            <li>
                <label for="title_en">Livello ENG</label>
                <input type="text" name="level_en" id="level_en" placeholder="Livello EN" required maxlength="255" value="<?php echo htmlspecialchars( $corso->level_en )?>"/>
            </li>

            <li>
                <label for="teacher">Insegnante</label>
                <input name="teacher" id="teacher" placeholder="Insegnante" required value="<?php echo htmlspecialchars( $corso->teacher, ENT_COMPAT, 'ISO-8859-1')?>"/>
            </li>

            <li>
                <label for="when_it">Giorno / Ora ITA</label>
                <textarea name="when_it" id="when_it" placeholder="quando" required rows="4"><?php echo htmlspecialchars( $corso->when_it )?></textarea>
            </li>

            <li>
                <label for="when_en">Giorno / Ora ENG</label>
                <textarea name="when_en" id="when_en" placeholder="when" required rows="4"><?php echo htmlspecialchars( $corso->when_en )?></textarea>
            </li>

            <li>
                <label for="location">Luogo</label>
                <textarea name="location" id="location" placeholder="location" required rows="4"><?php echo htmlspecialchars( $corso->location )?></textarea>
            </li>

            <li>
                <label for="info">Info</label>
                <textarea name="info" id="info" placeholder="info" required rows="6"><?php echo htmlspecialchars( $corso->info )?></textarea>
            </li>

        </ul>

        <div class="buttons">
            <input type="submit" name="saveChanges" value="SALVA"/>
        </div>

    </form>

<?php if ( $results['corso']->id ) { ?>
    <p><a href="admin.php?action=deleteCorso&amp;corsoId=<?php echo $corso->id ?>" onclick="return confirm('Eliminare definitivamente il corso?')">Elimina Corso</a></p>
<?php } ?>

    <script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.form.js"></script>
    <script type="text/javascript" src="templates/admin/js/editCorso.js"></script>

<?php include "templates/include/footer.php" ?>