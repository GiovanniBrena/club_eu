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


<h1 class="section-title">Gestione Attività</h1>

<div style="position: relative;">
    <button id="add-socio-btn" class="btn-orange" onclick="location='admin.php?action=newActivity'"><span><img id="new-socio-icon" src="images/add.png" height="12px">NUOVA ATTIVITA'</span></button>
    <!--
    <span style="position: absolute; right: 0">
            <div class='dropdown' id='year-dropdown'>
                <div class='dropdown-button'><?php $year = isset( $_GET['year'] ) ? $_GET['year'] : "2016"; echo ($year . "/" . ($year-1)); ?></div>
                <span class='triangle'>&#9660;</span>
                <ul class='dropdown-selection'>
                    <li class="year-selector" ><?php $date = date('Y', time()); echo ($date . "/" . ($date-1));?></li>
                    <li class="year-selector"><?php $date = date('Y', time()); echo ($date-1 . "/" . ($date-2));?></li>
                    <li class="year-selector"><?php $date = date('Y', time()); echo ($date-2 . "/" . ($date-3));?></li>
                </ul>
            </div>
        <button id="requests-btn" class="btn-orange" onclick="location='admin.php'">TBD</button>
    </span>
    -->
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
        <th>Titolo Attività<!--<input id="act-title-field" class="inline-input">--></th>
        <th>Data<!--<input id="act-date-field" class="inline-input">--></th>
        <th>Data creazione<!--<input id="act-create-field" class="inline-input">--></th>
    </tr>

    <?php foreach ( $results['attivita'] as $activity ) { ?>
        <tr class="activity-row">
            <td style="display: none"><?php echo $activity->id ?></td>
            <td><div class="activity-thumb-sm"><img src="<?php echo $activity->icon_url?>"/></div></td>
            <td><?php echo htmlspecialchars($activity->title_it, ENT_COMPAT, 'ISO-8859-1')?></td>
            <td><?php $dateAct = new DateTime($activity->date_act); echo $dateAct->format('d-m-Y')?></td>
            <td><?php $dateCreate = new DateTime($activity->date_create); echo $dateCreate->format('d-m-Y')?></td>
        </tr>

    <?php }
    ?>
</table>

<script type="text/javascript" src="templates/admin/js/listActivities.js"></script>
<script src="templates/admin/js/sorttable.js"></script>