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


<h1 class="section-title">Gestione Richieste</h1>



<?php if ( isset( $results['errorMessage'] ) ) { ?>
    <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>


<?php if ( isset( $results['statusMessage'] ) ) { ?>
    <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>

<h3 class="section-title">Nuovi Soci</h3>
<table id="requests-table">
    <tr>
        <th>Nome</th>
        <th>Cognome</th>
        <th>email</th>
        <th></th>
    </tr>

    <?php foreach ( $results['requests'] as $socio ) { ?>

        <tr class="request-row">
            <td><?php echo $socio->firstname?></td>
            <td><?php echo $socio->lastname?></td>
            <td><?php echo $socio->email?></td>
            <td class="row-action-field"><img class="row-action-approve" src="images/approve.png"><img class="row-action-cancel" src="images/delete.png"></td>
            <td style="display: none"><?php echo $socio->id?></td>
        </tr>

    <?php }
    ?>
</table>

</br>

<h3 class="section-title">Richieste Rinnovo</h3>
<table id="renew-table">
    <tr>
        <th>Numero Socio (Old)</th>
        <th>Nome</th>
        <th>Cognome</th>
        <th></th>
    </tr>

    <?php foreach ( $results['renewRequests'] as $socio ) { ?>

        <tr class="renew-row">
            <td><?php echo $socio->personal_id?></td>
            <td><?php echo $socio->firstname?></td>
            <td><?php echo $socio->lastname?></td>
            <td class="row-action-field"><img class="row-action-approve" src="images/approve.png"><img class="row-action-cancel" src="images/delete.png"></td>
            <td style="display: none"><?php echo $socio->id?></td>
        </tr>

    <?php }
    ?>
</table>

<script type="text/javascript" src="templates/admin/js/show-requests.js"></script>