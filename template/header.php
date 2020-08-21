<?php  require_once 'config.php';?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Federassantas</title>
	<link rel="icon" href="assets/images/icons/ico.png">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script src="assets/js/jquery.js" type="text/javascript" ></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript" ></script>
	<script src="assets/js/jquery.mask.js" type="text/javascript" ></script>
	<script src="assets/js/script.js" type="text/javascript" ></script>
</head>
<body>
   <nav class="navbar navbar-inverse">
   	  <div class="container-fluid">
   	  	 <div class="navbar-header">
   	  	 	<a href="./" class="navbar-brand">Federassantas</a>
   	  	 </div>
   	  	 <ul class=" nav navbar-nav navbar-right">
   	  	 	<?php if(isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])):?>
				<li><a href="my_cars.php">Meus Carros</a></li>
				<li><a href="logout.php">Sair</a></li>
			 <?php else:?>
			 	<li><a href="register_me.php">Cadastre-se</a></li>
				<li><a href="login.php">Login</a></li>
		   <?php endif;?>
   	  	 </ul>
   	  </div>
   </nav>




   