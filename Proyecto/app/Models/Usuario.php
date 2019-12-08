<?php 
//include "../../config.php";
require_once 'Conexion.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class Usuario extends Conexion
{
	private $idUser;
	private $nombre;
	private $apellido;
	private $correo;
	private $password;
	private $rol;
	private $tipoDocumento;
	private $documento;

	// ***** Array Usuarios ***** //
	private $usuarios;
	private $session_usuario;


	// ***** Funtions ***** // 


	public function userExist($user, $pass)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT * FROM usuarios WHERE correoUsuario = ? AND passwordUsuario = BINARY ?";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$user, $pass]);
		if ($resultado->fetchColumn() > 0) {
			return true;
		}else{
			return false;
		}
		$con = null;
		//
	}



	public function ActivarCuenta($idUsuario, $token)
	{
		$con = Conexion::conectar();
		$consulta = "CALL sp_Activar_Cuenta(?, ?)";
		$resultado = $con->prepare($consulta);
		if ($resultado->execute([$idUsuario, $token])) {
			return true;
		}else{
			return false;
		}
		$con = null;
	}




	public function rolUser($user)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT rol FROM usuarios WHERE correoUsuario = ?";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$user]);
		$array=$resultado->fetchAll(PDO::FETCH_COLUMN);
		if ($array[0] == 1) {
			return true;
		} else{
			return false;
		}
		$con = null;
	}

	

	public function registrarUsuario($tipo_documento,
		$numero_documento,
		$nombre, 
		$apellido, 
		$correo, 
		$pass,
		$estado, 
		$rol)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT * FROM usuarios WHERE correoUsuario = ? OR tipo_documento = ? AND numero_documento = ?";
		$token = md5(uniqid(mt_rand(), false));
		$insert = "INSERT INTO usuarios VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$correo,$tipo_documento,$numero_documento]);
		$array=$resultado->fetchAll();
		//if ($numeroFilas > 0) {
		if($resultado->fetchColumn() > 0){
			return false;
		}else{
			$resultInsert = $con->prepare($insert);
			if($resultInsert->execute([$tipo_documento, 
				$numero_documento,
				$nombre, 
				$apellido, 
				$correo, 
				$pass,
				$token,
				$estado,
				$rol])){
				return true;
			}else{
				return false;
			}						
		}
		$con = null;			
	}

	public function GenerarContrasena($tamaño)
	{
		$cadena_base = "ABCDEFGHIJKLMOPQRSTUVWXYZabcdefghijklmopqrstuvwxyz";
		$cadena_base .= "0123456789";

		$password = "";
		$limite = strlen($cadena_base) - 1;
		for ($i=0; $i < $tamaño; $i++) { 
			$password .= $cadena_base[rand(0, $limite)];
		}
		return $password;
	}

	public function registro($tipo_documento,
		$numero_documento,
		$nombre, 
		$apellido, 
		$correo, 
		$pass)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT * FROM usuarios WHERE correoUsuario = ? OR tipo_documento = ? AND numero_documento = ?";
		$token = md5(uniqid(mt_rand(), false));
		$insert = "INSERT INTO usuarios VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, 2, 2)";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$correo,$tipo_documento,$numero_documento]);
		if($resultado->fetchColumn() > 0){
			return false;
		}else{
			$resultInsert = $con->prepare($insert);
			if(
				$resultInsert->execute([$tipo_documento, 
				$numero_documento,
				$nombre, 
				$apellido, 
				$correo, 
				$pass,
				$token])){
				return true;
			}else{
				return false;
			}						
		}
		$con = null;		
	}

	public function inhabilitarUsuario($id)
	{
		$con = Conexion::conectar();
		$update = "UPDATE usuarios SET estadoUsuario = 2 WHERE idUsuario = ?";
		if ($result = $con->prepare($update)->execute([$id])) {
			return true;
		}else{
			return false;
		}	
		$con=null;
	}


	public function UpdateUser($nombre, 
		$apellido,
		$tipo_documento,
		$numero_documento,
		$correo,
		$estado,
		$rol)
	{
		$con = Conexion::conectar();
		$update = "UPDATE usuarios SET nombreUsuario = ?, apellidoUsuario = ?, tipo_documento = ?, numero_documento = ?, estadoUsuario = ?, rol = ? WHERE correoUsuario = ?";
		if ($result = $con->prepare($update)->execute([$nombre, $apellido, $tipo_documento, $numero_documento, $estado, $rol, $correo])) {
			return true;
		}else{
			return false;
		}	
		$con=null;
	}

	public function ActualizarMisDatos($nombre, 
		$apellido,
		$tipo_documento,
		$numero_documento,
		$correo)
	{
		$con = Conexion::conectar();
		$update = "UPDATE usuarios SET nombreUsuario = ?, apellidoUsuario = ?, tipo_documento = ?, numero_documento = ? WHERE correoUsuario = ?";
		if ($result = $con->prepare($update)->execute([$nombre, $apellido, $tipo_documento, $numero_documento, $correo])) {
			return true;
		}else{
			return false;
		}	
		$con=null;		
	}

	public function CambiarContrasena($idUsuario,
		$password)
	{
		$con = Conexion::conectar();
		$update = "UPDATE usuarios SET passwordUsuario = ? WHERE idUsuario = ?";
		if ($result = $con->prepare($update)->execute([$password, $idUsuario])) {
			return true;
		}else{
			return false;
		}	
		$con=null;		
	}




	public function validarEstado($user)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT estadoUsuario FROM usuarios WHERE correoUsuario = ?";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$user]);
		$array=$resultado->fetchAll(PDO::FETCH_ASSOC);
		if ($array['estadoUsuario'] == 2) {
			return true;
		} else{
			return false;
		}
		$con = null;
	}

	public function estadoUsuario($user)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT estadoUsuario FROM usuarios WHERE correoUsuario = ?";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$user]);
		//$array=$resultado->fetchAll(PDO::FETCH_ASSOC);
		$array = $resultado->fetch();
		if ($array[0] == "activo") {
			return true;
		} else{
			return false;
		}
		$con = null;
	}

	public function queryIdToken($user){
		$con = Conexion::conectar();
		$consulta = "SELECT idUsuario, nombreUsuario, apellidoUsuario, correoUsuario, token FROM usuarios WHERE correoUsuario = ?";
		$resultado = $con->prepare($consulta);
		$resultado->execute([$user]);
		$this->usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return $this->usuarios;
		$con = null;
	}

	public function QueryCorreoToken($correo){
		$con = Conexion::conectar();
		$consulta = "SELECT idUsuario, nombreUsuario, apellidoUsuario, correoUsuario, token, estadoUsuario FROM usuarios WHERE correoUsuario=?";
		//$resultado = $con->query($consulta);
		$resultado = $con->prepare($consulta);
		$resultado->execute([$correo]);
		$this->usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return $this->usuarios;
		$con = null;
	}

	public function queryUsers()
	{
		$con = Conexion::conectar();
		$consulta = "SELECT idUsuario, tipo_documento, numero_documento, nombreUsuario, apellidoUsuario, correoUsuario, estadoUsuario, rol FROM usuarios";
		$resultado = $con->query($consulta);
		$this->usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($this->usuarios);
		$con = null;
	}

	public function queryUsers_Id($id)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT idUsuario, tipo_documento, numero_documento, nombreUsuario, apellidoUsuario, correoUsuario, estadoUsuario, rol FROM usuarios WHERE idUsuario = ?";
		//$resultado = $con->query($consulta);
		$resultado = $con->prepare($consulta);
		$resultado->execute([$id]);
		$this->usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return $this->usuarios;
		$con = null;
	}

	public function queryUsers_tipo($tipo_documento)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT idUsuario, tipo_documento, numero_documento, nombreUsuario, apellidoUsuario, correoUsuario, estadoUsuario, rol FROM usuarios WHERE tipo_documento = $tipo_documento";
		$resultado = $con->query($consulta);
		$this->usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return $this->usuarios;
		$con = null;
	}

	public function queryUsers_documento($numero_documento)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT idUsuario, tipo_documento, numero_documento, nombreUsuario, apellidoUsuario, correoUsuario, estadoUsuario, rol FROM usuarios WHERE numero_documento = $numero_documento";
		$resultado = $con->query($consulta);
		$this->usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return $this->usuarios;
		$con = null;
	}

	public function queryUsers_nombre($nombre)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT idUsuario, tipo_documento, numero_documento, nombreUsuario, apellidoUsuario, correoUsuario, estadoUsuario, rol FROM usuarios WHERE nombreUsuario = '$nombre'";
		$resultado = $con->query($consulta);
		$this->usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return $this->usuarios;
		$con = null;
	}

	public function queryUsers_apellido($apellido)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT idUsuario, tipo_documento, numero_documento, nombreUsuario, apellidoUsuario, correoUsuario, estadoUsuario, rol FROM usuarios WHERE apellidoUsuario = '$apellido'";
		$resultado = $con->query($consulta);
		$this->usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return $this->usuarios;
		$con = null;
	}

	public function queryUsers_correo($correo)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT idUsuario, tipo_documento, numero_documento, nombreUsuario, apellidoUsuario, correoUsuario, estadoUsuario, rol FROM usuarios WHERE correoUsuario = '$correo'";
		$resultado = $con->query($consulta);
		$this->usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return $this->usuarios;
		$con = null;
	}

	public function queryUsers_estado($estado)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT idUsuario, tipo_documento, numero_documento, nombreUsuario, apellidoUsuario, correoUsuario, estadoUsuario, rol FROM usuarios WHERE estadoUsuario = ?";
		//$resultado = $con->query($consulta);
		$stm = $con->prepare($consulta)->execute([$estado]);
		$this->usuarios = $stm->fetch(PDO::FETCH_ASSOC);
		return $this->usuarios;
		$con = null;
	}

	public function queryUsers_rol($rol)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT idUsuario, tipo_documento, numero_documento, nombreUsuario, apellidoUsuario, correoUsuario, estadoUsuario, rol FROM usuarios WHERE rol = $rol";
		$resultado = $con->query($consulta);
		$this->usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return $this->usuarios;
		$con = null;
	}

	public function ConsultarMisDatos($user)
	{
		$con = Conexion::conectar();
		$consulta = "SELECT nombreUsuario, apellidoUsuario, tipo_documento, numero_documento, correoUsuario FROM usuarios WHERE correoUsuario = ?";
		$stm = $con->prepare($consulta);
		$stm->execute([$user]);
		$datosUser = $stm->fetchAll(PDO::FETCH_ASSOC);
		return $datosUser;
		$con = null;
	}

	public function enviarEmail($email, $nombre, $asunto, $cuerpo){

		require_once  '../../assets/PHPMailer/src/Exception.php';
		require_once  '../../assets/PHPMailer/src/PHPMailer.php';
		require_once  '../../assets/PHPMailer/src/SMTP.php';


		$mail = new PHPMailer(true);
		try {
			$mail->CharSet = 'UTF-8';
			$mail->isSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 587;

			$mail->Username = 'sismvSuomaya@gmail.com';
			$mail->Password = 'Sismv1839467';

			$mail->setFrom('winzlowxdxd@gmail.com','SISMV');
			$mail->addAddress($email, $nombre);
			
			$mail->Subject = $asunto;
			$mail->Body = $cuerpo;
			$mail->IsHTML(true);
			if ($mail->send()) {
				return true;
			}
			else{
				return false;
			}
		} catch (Exception $e) {
			$errorPHPExecption = "Error en el envio del correo electronico ". $e . " <br>
			Mirar informacion {$mail->ErrorInfo}";
			echo $errorPHPExecption;
		}
		
	}
}




?>