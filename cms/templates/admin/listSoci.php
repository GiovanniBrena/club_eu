<?php include "templates/include/header.php" ?>

<?php
$state = isset( $_GET['state'] ) ? $_GET['state'] : "";
if($state=="duplicated") {echo "<script type='text/javascript'>alert('Il socio risulta già REGISTRATO');</script>";}
else if($state=="existingEmail") {echo "<script type='text/javascript'>alert('La email inserita risulta già PRESENTE');</script>";}
?>

    <div id="adminHeader">
          <span class="section-back-container">
              <a href="admin.php?action=dashboard">
                  <i class="fa fa-arrow-left" style="top: 0; color: white; width: auto; padding: 4px"></i>
                  <span>back</span>
              </a>
          </span>
          <span class="section-logout-container">You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></span>
      </div>


<h1 class="section-title">Gestione soci</h1>

<div style="position: relative;">
    <button id="add-socio-btn" class="btn-orange" onclick="location='admin.php?action=newSocio'"><span><img id="new-socio-icon" src="images/add.png" height="12px">   NUOVO SOCIO</span></button>
    <span style="position: absolute; right: 0">
            <div class='dropdown' id='year-dropdown'>
                <div class='dropdown-button'><?php $year = isset( $_GET['year'] ) ? $_GET['year'] : "2016"; echo (($year-1) . "/" . $year); ?></div>
                <span class='triangle'>&#9660;</span>
                <ul class='dropdown-selection'>
                    <li class="year-selector" ><?php $date = date('Y', time()); echo (($date-1) . "/" . $date);?></li>
                    <li class="year-selector"><?php $date = date('Y', time()); echo ($date-2 . "/" . ($date-1));?></li>
                    <li class="year-selector"><?php $date = date('Y', time()); echo ($date-3 . "/" . ($date-2));?></li>
                </ul>
            </div>
        <button id="requests-btn" class="btn-orange" onclick="location='admin.php?action=showRequests'">GESTISCI RICHIESTE <span class="badge"><?php echo $results["requestsTotalRows"]+$results["renewsTotalRows"] ?> </span></button>
    </span>
</div>

<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>


<?php if ( isset( $results['statusMessage'] ) ) { ?>
        <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>

      <table id="soci-table" class="sortable">
        <tr>
          <th>Numero socio <input id="soci-id-field" class="inline-input"></th>
          <th>Nome <input id="soci-firstname-field" class="inline-input"></th>
          <th>Cognome <input id="soci-lastname-field" class="inline-input"></th>
          <th>Data creazione<input id="soci-date-field" class="inline-input"></th>
        </tr>

<?php foreach ( $results['soci'] as $socio ) { ?>

        <tr class="socio-row">
          <td><?php echo $socio->personal_id?></td>
          <td><?php echo $socio->firstname?></td>
          <td><?php echo $socio->lastname?></td>
          <td style="display: none"><?php echo $socio->id?></td>
          <td><?php $dateCreate = new DateTime($socio->date_create); echo $dateCreate->format('d-m-Y')?></td>
        </tr>

<?php }
?>
      </table>

<script type="text/javascript" src="templates/admin/js/list-soci.js"></script>
<script src="templates/admin/js/sorttable.js"></script>