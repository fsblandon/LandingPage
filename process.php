<?php
if(isset($_POST['submit'])) {

	$EmailTo = "fsblandon@gmail.com";
	$Subject = "Nuevo Mensaje web";

	$name = $_POST['nombre'];
	$email = $_POST['correo'];
	$mensaje = $_POST['mensaje'];

	if (!isset($name)) || !isset($email) || !isset($mensaje)){
		echo "<b>Ocurrió un error, no ha sido enviado su mensaje</b><br>";
		echo "Por favor verifique la información ingresada<br>";
		die();
	}

	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

	if(!preg_match($email_exp, $email)){
		echo "El correo ingresado no es correcto";
	}

	$string_exp = "/^[A-Za-z .'-]+$/";

	if(!preg_match($string_exp, $name)){
		echo "El nombre no es valido";
	}

	if (!preg_match($string_exp, $mensaje)) {
		echo "El mensaje no es valido";
	}

	if (strlen($mensaje) < 2) {
		echo "El mensaje es muy corto, ingresa un mensaje adecuado";
	}

	$Body  = "De: $name\n Correo: $email\n Mensaje:\n $mensaje";

	/*$Body .= "Nombre: ";
	$Body .= $name;
	$Body .= "\n";

	$Body .= "Correo: ";
	$Body .= $email;
	$Body .= "\n";

	$Body .= "Mensaje: ";
	$Body .= $mensaje;
	$Body .= "\n";*/

	$headers = "MIME-Version: 1.0\r\n"; 
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	$headers = "From: $email \r\n";
	$headers .= "Reply-To: $email \r\n";

	$success = mail($EmailTo, $Subject, $Body, $headers);

	if($success){
		echo "El mensaje se ha enviado con éxito";
	}
	else{
		echo "El mensaje no ha sido enviado";
	}
}
?>