<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo htmlspecialchars( $results['pageTitle'] )?></title>
<!--<link href="bootstrap.min.css" rel="stylesheet">-->
<link rel="stylesheet" type="text/css" href="admin-style.css" />
<link rel="stylesheet" type="text/css" href="navbar-style.css" />
<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<script src="templates/admin/js/jquery-3.0.0.min.js"></script>
</head>
<body>

<!---------------------->
<nav class="main-menu">



    <div>
        <a class="logo" href="http://startific.com">
        </a>
    </div>
    <div class="settings"></div>
    <div class="scrollbar" id="style-1">

        <ul>

            <li>
                <a href="admin.php">
                    <i class="fa fa-home fa-lg"></i>
                    <span class="nav-text">HOME</span>
                </a>
            </li>

            <li>
                <a href="admin.php?action=listSoci&year=2016">
                    <i class="fa fa-user fa-lg"></i>
                    <span class="nav-text">GESTIONE SOCI</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-calendar fa-lg"></i>
                    <span class="nav-text">EVENTI</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span class="nav-text">CORSI</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-envelope-o fa-lg"></i>
                    <span class="nav-text">NEWSLETTER</span>
                </a>
            </li>


        <ul class="logout">
            <li>
                <a href="admin.php?action=logout">
                    <i class="fa fa-sign-out"></i>
                        <span class="nav-text">
                            Logout
                        </span>

                </a>
            </li>
        </ul>
</nav>
<!---------------------->




<div id="container">

