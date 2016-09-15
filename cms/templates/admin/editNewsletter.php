<?php include "templates/include/header.php" ?>

    <div id="adminHeader">
          <span class="section-back-container">
              <a href="admin.php?action=listNewsletter">
                  <i class="fa fa-arrow-left" style="top: 0; color: white; width: auto; padding: 4px"></i>
                  <span>back</span>
              </a>
          </span>
        <span class="section-logout-container">You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></span>
    </div>

<?php $newsletter=$results['newsletter'];
if ($newsletter->id == null) {
    ?>
    <h1 class="section-title">Nuova Newsletter</h1> <?php
} else {
    ?>
    <h1 class="section-title">Modifica Newsletter </h1><?php
}
?>


<?php if ( isset( $results['errorMessage'] ) ) { ?>
    <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>

    <form id="imageform" method="post" enctype="multipart/form-data" action='scripts/upload_newsletter_it.php' style="text-align: center">
        <h4>File ITA</h4>
        <input type="file" name="photoimg" id="photoimg" style="width: 100%" />
        <div id='preview' style="text-align: center">
            <?php if($newsletter->path_it!="") echo "<iframe class='preview-pdf' id='preview-img' src='".$newsletter->path_it."'' style='width:100%;' frameborder='0'></iframe>";?>
        </div>
    </form>

    <form id="imageform_en" method="post" enctype="multipart/form-data" action='scripts/upload_newsletter_en.php' style="text-align: center">
        <h4>File ENG</h4>
        <input type="file" name="photoimg" id="photoimg_en" style="width: 100%" />
        <div id='preview_en' style="text-align: center">
            <?php if($newsletter->path_en!="") echo "<iframe class='preview-pdf' id='preview-img_en' src='".$newsletter->path_en."'' style='width:100%;' frameborder='0'></iframe>";?>
        </div>
    </form>


    <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">

        <input type="hidden" name="id" value="<?php echo $newsletter->id ?>"/>
        <input type="hidden" name="state" value="<?php echo $newsletter->state ?>"/>
        <input type="hidden" id="path_it" name="path_it" value="<?php echo $newsletter->path_it ?>"/>
        <input type="hidden" id="path_en" name="path_en" value="<?php echo $newsletter->path_en ?>"/>

        <ul>
            <li>
                <label for="title_it">Titolo ITA</label>
                <input type="text" name="title_it" id="title_it" placeholder="Titolo ITA" maxlength="255" value="<?php echo htmlspecialchars($newsletter->title_it, ENT_COMPAT, 'ISO-8859-1')?>"/>
            </li>

            <li>
                <label for="title_en">Titolo ENG</label>
                <input type="text" name="title_en" id="title_en" placeholder="Titlolo EN" required maxlength="255" value="<?php echo htmlspecialchars( $newsletter->title_en )?>"/>
            </li>

        </ul>

        <div class="buttons">
            <input type="submit" name="saveChanges" value="SALVA"/>
        </div>

    </form>

<?php if ( $results['newsletter']->id ) { ?>
    <p><a href="admin.php?action=deleteNewsletter&amp;newsletterId=<?php echo $newsletter->id ?>" onclick="return confirm('Eliminare definitivamente la newsletter?')">Elimina Newsletter</a></p>
<?php } ?>

    <script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.form.js"></script>
    <script type="text/javascript" src="templates/admin/js/editNewsletter.js"></script>

<?php include "templates/include/footer.php" ?>