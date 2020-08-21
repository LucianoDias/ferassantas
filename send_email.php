<?php 
if(isset($_POST['emailcliente']) && !empty($_POST['emailcliente'])){
	$namecliente = addslashes($_POST['namecliente']);
	$emailcliente = addslashes($_POST['emailcliente']);
	$msg = addslashes($_POST['msg']);

	$for = "lucianoloopDias@gmail.com";
	$subjec = "Proposta de compra";
	$body = "Nome: ".$namecliente." - E-mail: ".$emailcliente." -Mensagem: ".$msg;

	$header = "From: hospedagem@com"."\r\n"."Reply-To: ".$emailcliente."\r\n".
			  "X-Mailer: PHP/".phpversion();
	mail($for, $subjec, $body, $header);
	echo "Yes"; exit;
}else{
	echo "No"; exit;
}