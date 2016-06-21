<?php include "templates/include/header.php" ?>

    <div id="adminHeader">
          <span class="section-back-container">
              <a href="admin.php?action=dashboard">
                  <img src="images/left-arrow.png">
                  <span>back</span>
              </a>
          </span>
          <span class="section-logout-container">You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></span>
      </div>


<h1 class="section-title">Gestione Soci</h1>

<div style="position: relative">
    <button id="add-socio-btn" class="btn-orange" onclick="location='admin.php?action=newSocio'"><span><img id="new-socio-icon" src="images/add.png" height="12px">   NUOVO SOCIO</span></button>
    <span style="position: absolute; right: 0">
        <button id="requests-btn" class="btn-orange" onclick="location='admin.php?action=showRequests'">GESTISCI RICHIESTE <span class="badge"><?php echo $results["requestsTotalRows"]+$results["renewsTotalRows"] ?> </span></button>
    </span>
</div>

<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>


<?php if ( isset( $results['statusMessage'] ) ) { ?>
        <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>

      <table id="soci-table">
        <tr>
          <th>Numero socio <input id="soci-id-field" class="inline-input"></th>
          <th>Nome <input id="soci-firstname-field" class="inline-input"></th>
          <th>Cognome <input id="soci-lastname-field" class="inline-input"></th>
        </tr>

<?php foreach ( $results['soci'] as $socio ) { ?>

        <tr class="socio-row">
          <td><?php echo $socio->personal_id?></td>
          <td><?php echo $socio->firstname?></td>
          <td><?php echo $socio->lastname?></td>
          <td style="display: none"><?php echo $socio->id?></td>
        </tr>

<?php }
?>
      </table>

<script type="text/javascript" src="templates/admin/js/list-soci.js"></script>