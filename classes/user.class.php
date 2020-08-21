<?php 

class User {
   
	public function register($name,$email,$password,$phone){
		global $pdo;

		$sql = "SELECT id_user FROM users WHERE email =:email";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(":email",$email);
		$sql->execute();

		if($sql->rowCount() == 0){

			$sql = "INSERT INTO users SET name =:name, email =:email, password =:password, phone =:phone";
			$sql = $pdo->prepare($sql);
			$sql->bindValue(":name", $name);
			$sql->bindValue(":email", $email);
			$sql->bindValue(":password", md5($password));
			$sql->bindValue(":phone", $phone);
			$sql->execute();
			return true;
		}else{
			return false;
		}
	}

	public function login($email, $password){
		
		global $pdo;
		$sql = "SELECT id_user FROM users WHERE email =:email AND password =:pass";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->bindValue(":pass",md5($password));
		$sql->execute();

		if($sql->rowCount() >0){
           $data = $sql->fetch();
           $_SESSION['cLogin'] = $data['id_user'];
           return true;
		}else{
			return false;
		}
	}


}