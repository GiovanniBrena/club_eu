<?php include "templates/include/header.php";

$month = date('m', time());
if($month<9) {$year = date('Y', time());}
else {$year = date('Y', time())+1;}
?>




<img src="images/logo.png">
<div class="container header-container" ><h1 class="section-title">Amministrazione</h1></div>


<div style="text-align: center">
<button class="btn-orange dashboard-btn" onclick="location='admin.php?action=listSoci&year=<?php echo $year?>'"><i class="fa fa-user fa-icon-big"></i></br>Gestione SOCI</button>
<button class="btn-orange dashboard-btn" onclick="location='admin.php?action=listActivities'"><i class="fa fa-calendar fa-icon-big"></i></br>Gestione EVENTI</button>
<button class="btn-orange dashboard-btn" onclick="location='admin.php?action=listCorsi'" ><i class="fa fa-book fa-icon-big"></i></br>Gestione CORSI</button>
<button class="btn-orange dashboard-btn" onclick="location='admin.php?action=listNewsletter'"><i class="fa fa-envelope-o fa-icon-big"></i></br>NEWSLETTER</button>
</div>

<?php include "templates/include/footer.php" ?>