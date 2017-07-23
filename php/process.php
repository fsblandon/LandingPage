<?php
if(isset($_POST['nombre']) ) {

	//&& !empty($_POST['correo'])
	//campos a enviar en el correo
	$name = $_POST['nombre'];
	$email = $_POST['correo'];
	$mensaje = $_POST['mensaje'];

	$EmailTo = "santiblandon@outlook.com";
	$Subject = "Mensaje web de: $name";

	if (!isset($name) || !isset($email) || !isset($mensaje)){
		echo json_encode(array('status' => 'Ocurrió un error, no ha sido enviado su mensaje'));
		echo json_encode(array('status' => 'Por favor verifique la información ingresada'));
		die();
	}

	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

	//validar expresion regular correo
	if(!preg_match($email_exp, $email)){
		echo json_encode(array('status' => 'El correo ingresado no es correcto'));
		die();
	}

	$string_exp = "/^[A-Za-z .'-]+$/";

	//validar expresion regular nombre
	if(!preg_match($string_exp, $name)){
		echo json_encode(array('status' => 'El nombre no es valido'));
		die();
	}

	//$msj_exp =  "/^[A-Za-z0-9 .'-]+$/";

	//validar expresion regular mensaje
	/*if (!preg_match($msj_exp, $mensaje)) {
		echo json_encode(array('status' => 'El mensaje no es valido'));
		die();
	}*/

	if (strlen($mensaje) < 2) {
		echo json_encode(array('status' => 'El mensaje es muy corto, ingresa un mensaje adecuado'));
		die();
	}


	$Body  = "De: $name,\n Correo: $email,\n Mensaje:\n $mensaje";


	$headers = "MIME-Version: 1.0\r\n"; 
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	$headers = "From: $email \r\n";
	$headers .= "Reply-To: $email \r\n";

	$success = mail($EmailTo, $Subject, $Body, $headers);

	if($success){
		echo json_encode(array('status' => 'success'));
		echo "enviado a $EmailTo";
		echo "Mensaje de $Subject";
	}
	else{
		echo json_encode(array('status' => 'error'));
		echo "error";
	}
}
?>