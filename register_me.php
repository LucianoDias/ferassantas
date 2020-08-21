<?php  require_once 'template/header.php'; ?>


<div class="container">
	<h1>Cadastre-se</h1>
<?php 
require_once 'classes/user.class.php';
$user = new User();
if(isset($_POST['name']) && !empty($_POST['name'])){
	$name = addslashes($_POST['name']);
	$email = addslashes($_POST['email']);
	$phone = addslashes($_POST['phone']);
	$password = $_POST['password'];

	if(!empty($name) && !empty($email) && !empty($password)){
		if($user->register($name, $email, $password, $phone)){ ?>
			<div class="alert alert-success"> <strong>Parabéns</strong> Cadastrado com sucesso.
				<a href="login.php" class="alert-link">Faça o login na home agora </a>
			</div>
<?php   }else { ?> <div class="alert alert-warning"> 
					Este usuário já existe! <a href="login.php" class="alert-link">Faça o login</a>
				  </div> <?php }

	}else{ ?>
 		 <div class="alert alert-danger"> Preencha todos os campos!</div>
	<?php
	}
}
?>
	<form method="POST">
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group">
					<label for="nome">Nome:</label><br/>
					<input type="text" name="name" id="name" class="form-control"/>
				</div>
			 </div>
			 <div class="col-sm-5">
				<div class="form-group">
					<label for="email">Email:</label><br/>
					<input type="email" name="email" id="email" class="form-control"/>
				</div>
		   </div>
			 <div class="col-sm-3">
				<div class="form-group">
					<label for="phone">Telefone:</label><br/>
					<input type="tel" name="phone" id="phone" class="form-control"/>
				</div>
			</div>
			
		    <div class="col-sm-4">
			<div class="form-group">
				<label for="password">Senha:</label><br/>
				<input type="password" name="password" id="password" class="form-control"/><br/>
				<input type="submit" value="Cadastrar" class="btn btn-success"/>
			</div>
		   </div>
		</div>
	</form>
</div>
</div>



<script>
	$(function(){
		$('#phone').mask('(000) 0000-0000');	
	});
</script>
<?php require_once 'template/footer.php'; ?>