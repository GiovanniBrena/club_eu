<?php include "templates/include/header.php";
$activityIconPath = "../cms/resources/activity_icon/"?>

<div id="adminHeader">
          <span class="section-back-container">
              <a href="admin.php?action=dashboard">
                  <i class="fa fa-arrow-left" style="top: 0; color: white; width: auto; padding: 4px"></i>
                  <span>back</span>
              </a>
          </span>
    <span class="section-logout-container">You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></span>
</div>


<h1 class="section-title">Gestione Newsletter</h1>

<div style="position: relative;">
    <button id="add-socio-btn" class="btn-orange" onclick="location='admin.php?action=newNewsletter'"><span><img id="new-socio-icon" src="images/add.png" height="12px">NUOVO</span></button>

</div>

<?php if ( isset( $results['errorMessage'] ) ) { ?>
    <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>


<?php if ( isset( $results['statusMessage'] ) ) { ?>
    <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>

<table id="activity-table" class="sortable">
    <tr>
        <th>Titolo Newsletter<!--<input id="act-title-field" class="inline-input">--></th>
        <th>Data creazione<!--<input id="act-create-field" class="inline-input">--></th>
    </tr>

    <?php foreach ($results['newsletter'] as $newsletter ) { ?>
        <tr class="activity-row">
            <td style="display: none"><?php echo $newsletter->id ?></td>
            <td><?php echo htmlspecialchars($newsletter->title_it, ENT_COMPAT, 'ISO-8859-1')?></td>
            <td><?php $dateCreate = new DateTime($newsletter->date_create); echo $dateCreate->format('d-m-Y')?></td>
        </tr>

    <?php }
    ?>
</table>

<script src="templates/admin/js/sorttable.js"></script>
<script src="templates/admin/js/listNewsletter.js"></script>