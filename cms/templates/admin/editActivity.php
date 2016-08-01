<?php include "templates/include/header.php" ?>

    <div id="adminHeader">
          <span class="section-back-container">
              <a href="admin.php?action=listActivities">
                  <i class="fa fa-arrow-left" style="top: 0; color: white; width: auto; padding: 4px"></i>
                  <span>back</span>
              </a>
          </span>
        <span class="section-logout-container">You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></span>
    </div>

<?php $activity=$results['attivita'];
if ($activity->id == null) {
    ?>
    <h1 class="section-title">Nuova Attività</h1> <?php
} else {
    ?>
    <h1 class="section-title">Modifica Attività </h1><?php
}
?>


<?php if ( isset( $results['errorMessage'] ) ) { ?>
    <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>


    <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">

        <input type="hidden" name="id" value="<?php echo $activity->id ?>"/>
        <input type="hidden" name="state" value="<?php echo $activity->state ?>"/>
        <input type="hidden" name="icon_url" value="<?php echo $activity->icon_url ?>"/>
        <input type="hidden" name="attach_url" value="<?php echo $activity->attach_url ?>"/>
        <input type="hidden" name="place_available" value="<?php echo $activity->place_available ?>"/>
        
        <ul>
            <li>
                <label for="title_it">Titolo ITA</label>
                <input type="text" name="title_it" id="title_it" placeholder="Titolo ITA" maxlength="255" value="<?php echo htmlspecialchars($activity->title_it, ENT_COMPAT, 'ISO-8859-1')?>"/>
            </li>

            <li>
                <label for="title_en">Titolo ENG</label>
                <input type="text" name="title_en" id="title_en" placeholder="Titlolo EN" required maxlength="255" value="<?php echo htmlspecialchars( $activity->title_en )?>"/>
            </li>

            <li>
                <label for="desc_it">Descrizione ITA</label>
                <textarea name="desc_it" id="desc_it" placeholder="Descrizione ITA" required rows="10"><?php echo htmlspecialchars( $activity->desc_it, ENT_COMPAT, 'ISO-8859-1')?></textarea>
            </li>

            <li>
                <label for="desc_en">Descrizione ENG</label>
                <textarea name="desc_en" id="desc_en" placeholder="Descrizione ENG" required rows="10"><?php echo htmlspecialchars( $activity->desc_en )?></textarea>
            </li>

            <li>
                <label for="date_act">Data Attività</label>
                <input type="date" id="date_act" name="date_act" value="<?php $dateAct = new DateTime($activity->date_act); echo $dateAct->format('Y-m-d')?>">
            </li>

            <li>
                <label for="deadline">Deadline Iscrizioni</label>
                <input type="date" id="deadline" name="deadline" value="<?php $deadline = new DateTime($activity->deadline); echo $deadline->format('Y-m-d')?>">
            </li>

            <li>
                <label for="price_socio">Prezzo Soci</label>
                <input type="number" name="price_socio" id="price_socio" placeholder="Prezzo Soci" required maxlength="255" value="<?php echo htmlspecialchars( $activity->price_socio )?>"/>
            </li>

            <li>
                <label for="price_ext">Prezzo Esterni</label>
                <input type="number" name="price_ext" id="price_ext" placeholder="Prezzo Esterni" required maxlength="255" value="<?php echo htmlspecialchars( $activity->price_ext )?>"/>
            </li>

            <li>
                <label for="place_total">Posti Totali</label>
                <input type="number" name="place_total" id="place_total" placeholder="Numero Posti Totali" required maxlength="255" value="<?php echo htmlspecialchars( $activity->place_total )?>"/>
            </li>

            <li>
                <label for="icon">Event Image</label>
                <input type="file" name="icon" id="icon" accept="image/*">
            </li>

        </ul>

        <div class="buttons">
            <input type="submit" name="saveChanges" value="SALVA"/>
        </div>

    </form>

<?php if ( $results['attivita']->id ) { ?>
    <p><a href="admin.php?action=deleteActivity&amp;activityId=<?php echo $activity->id ?>" onclick="return confirm('Eliminare definitivamente la attività?')">Elimina Attività</a></p>
<?php } ?>


    <script type="text/javascript" src="templates/admin/js/editActivity.js"></script>

<?php include "templates/include/footer.php" ?>