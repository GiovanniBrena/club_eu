<?php include "templates/include/header.php";?>

<div id="adminHeader">
          <span class="section-back-container">
              <a href="admin.php?action=dashboard">
                  <i class="fa fa-arrow-left" style="top: 0; color: white; width: auto; padding: 4px"></i>
                  <span>back</span>
              </a>
          </span>
    <span class="section-logout-container">You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></span>
</div>


<h1 class="section-title">Gestione Corsi</h1>

<div style="position: relative;">
    <button id="add-socio-btn" class="btn-orange" onclick="location='admin.php?action=newCorso'"><span><img id="new-socio-icon" src="images/add.png" height="12px">NUOVO CORSO</span></button>

</div>

<?php if ( isset( $results['errorMessage'] ) ) { ?>
    <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>


<?php if ( isset( $results['statusMessage'] ) ) { ?>
    <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>

<table id="activity-table" class="sortable">
    <tr>
        <th></th>
        <th>Lingua<!--<input id="act-title-field" class="inline-input">--></th>
        <th>Livello<!--<input id="act-date-field" class="inline-input">--></th>
        <th>Insegnante<!--<input id="act-create-field" class="inline-input">--></th>
    </tr>

    <?php foreach ($results['corsi'] as $corso ) { ?>
        <tr class="activity-row">
            <td style="display: none"><?php echo $corso->id ?></td>
            <td><?php echo htmlspecialchars($corso->lang, ENT_COMPAT, 'ISO-8859-1')?></td>
            <td><?php echo htmlspecialchars($corso->level, ENT_COMPAT, 'ISO-8859-1')?></td>
            <td><?php echo htmlspecialchars($corso->teacher, ENT_COMPAT, 'ISO-8859-1')?></td>
        </tr>

    <?php }
    ?>
</table>

<script type="text/javascript" src="templates/admin/js/listCorsi.js"></script>
<script src="templates/admin/js/sorttable.js"></script>