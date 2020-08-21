<?php  require_once 'template/header.php'; ?>

<div  class="container ">
<?php 
require_once 'classes/user.class.php';
$user = new User();
if(isset($_POST['email']) && !empty($_POST['email'])){
	$email = addslashes($_POST['email']);
	$password = $_POST['password'];

	if($user->login($email, $password)){ ?>
		<script type="text/javascript" >window.location.href="my_cars.php";</script>
<?php
	}else{ ?>
		<div class="alert alert-danger">Usuário e/ouSenha errados !</div>
<?php		
	}
}
?>



<div class="login">
	<fieldset><legend>Login</legend>
		<form method="POST">
	        	<div class="row">
				 <div class="col-sm-10">
					<div class="form-group">
						<label for="email">Email:</label><br/>
						<input type="email" name="email" id="email" class="form-control"/>
					</div>
			   </div>
			    <div class="col-sm-10">
				<div class="form-group">
					<label for="password">Senha:</label><br/>
					<input type="password" name="password" id="password" class="form-control"/><br/>
					<input type="submit" value="Fazer login" class="btn btn-success"/>
				</div>
			   </div>
			</div>
		</form>
  </fieldset>     	
</div>
</div>
</div>



<?php require_once 'template/footer.php'; ?>