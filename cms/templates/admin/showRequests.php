<?php include "templates/include/header.php" ?>

<div id="adminHeader">
          <span class="section-back-container">
              <a href="admin.php?action=listSoci&year=<?php if($date = date('m', time())>8) {echo date('Y', time())+1;}
              else {echo date('Y', time());}
              ?>">
                  <i class="fa fa-arrow-left" style="top: 0; color: white; width: auto; padding: 4px"></i>
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
            <td class="row-action-field"></td>
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
            <td class="row-action-field"></td>
            <td style="display: none"><?php echo $socio->id?></td>
        </tr>

    <?php }
    ?>
</table>



<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <p>Vuoi approvare il nuovo socio?</p>
        <input type="submit" name="saveChanges" value="SALVA" />
        <input type="submit" formnovalidate name="cancel" id="modal-cancel" value="Annulla" />
    </div>

</div>



<script type="text/javascript" src="templates/admin/js/show-requests.js"></script>