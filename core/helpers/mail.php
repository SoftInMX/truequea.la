<?php
	require_once ('core/vendor/class.phpmailer.php');
	
	class Mail{
			
		public function __construct(){
			
		}
		
		public static function rpass($m){
			$asunto = "Recuperar contraseña ProfactureMX";
			$url = "http://app.profacture.mx/user/recuperarcontrasena";
			$correo = urlencode(helper::encriptarURL($m,"http://app.profacture.mx/rpass"));
			$url .= '?q='.$correo;
			$msg = '<p>Has solocitado recuperar tu contraseña</p>
					<p>Haz click <a href="'.$url.'">aquí</a> para recuperar tu contraseña.</p>
					<p>Si no has sido tu quien solicito este servicio, ignora este correo.</p>';
					
			$html = $msg;
			
			$mail = new PHPMailer();
			$mail->SetFrom('no-reply@profacture.mx', 'ProfactureMX');
			$mail->AddAddress($m);
			$mail->Subject = $asunto;
			$mail->MsgHTML($html);
			
			return $mail->Send();
		}
	}
?>