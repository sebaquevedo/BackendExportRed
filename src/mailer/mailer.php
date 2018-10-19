<?php 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	//Load Composer's autoloader
	require './vendor/autoload.php';

	class mailer{

	private static $instancia;

	 private function __construct()
    	{
        	
        	
    	}

    	
    	public static function singleton()
    	{
	        if (!isset(self::$instancia)) {
	            $miclase = __CLASS__;
	            self::$instancia = new $miclase;
	        } 
	        return self::$instancia;
    	}

	    	// Evita que el objeto se pueda clonar
	    public function __clone()
	    {
	        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
	    }
		
	

		public function sendRegisterMail($to ){
			$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
			try {
			    //Server settings
			    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
			    $mail->isSMTP();                                      // Set mailer to use SMTP
			    $mail->Host = 'secure354.sgcpanel.com';  // Specify main and backup SMTP servers
			    $mail->SMTPAuth = true;                               // Enable SMTP authentication
			    $mail->Username = 'sebastian.quevedo@ai-ware.cl';                 // SMTP username
			    $mail->Password = 'aiware2018';                           // SMTP password
			    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			    $mail->Port = 25;                                    // TCP port to connect to

			    //Recipients
			    $mail->setFrom('sebastian.quevedo@ai-ware.cl', 'Entel Export de Red');
			    $mail->addAddress($to);     // Add a recipient
			    // $mail->addAddress('ellen@example.com');               // Name is optional
			   // $mail->addReplyTo('info@example.com', 'Information');
			   // $mail->addCC('cc@example.com');
			    //$mail->addBCC('bcc@example.com');

			    //Attachments
			    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

			    //Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'Registro de usuario en EntelExportRed';
			    $mail->Body    = '<h1> Registro exitoso</h1><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam accusantium, ipsam minus adipisci ipsum quos totam eaque reprehenderit, magni at sed, incidunt ut dignissimos. Repellat dolores sed sequi harum assumenda. </p> <b>negrita!</b> <br> <p>Para acceder haz click </p><a href="http://localhost:4200/login">aqui</a> <a href="http://www.google.cl">google</a> ';
			    $mail->AltBody = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa provident error iusto, voluptate delectus odit modi quibusdam ipsum eos, laborum dignissimos cum doloribus ullam nisi aperiam expedita! Ea, blanditiis, nisi.';

			    $mail->send();
			    //echo 'Mensaje enviado';
				} catch (Exception $e) {
			  	  echo 'Mensaje no pudo ser enviado. Mailer Error: ', $mail->ErrorInfo;
				}
		}

		public function sendRecoverMail($to ,$pass){
			$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
			try {
			    //Server settings
			    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
			    $mail->isSMTP();                                      // Set mailer to use SMTP
			    $mail->Host = 'secure354.sgcpanel.com';  // Specify main and backup SMTP servers
			    $mail->SMTPAuth = true;                               // Enable SMTP authentication
			    $mail->Username = 'sebastian.quevedo@ai-ware.cl';                 // SMTP username
			    $mail->Password = 'aiware2018';                           // SMTP password
			    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			    $mail->Port = 25;                                    // TCP port to connect to

			    //Recipients
			    $mail->setFrom('sebastian.quevedo@ai-ware.cl', 'Entel Export de Red');
			    $mail->addAddress($to);     // Add a recipient
			    // $mail->addAddress('ellen@example.com');               // Name is optional
			   // $mail->addReplyTo('info@example.com', 'Information');
			   // $mail->addCC('cc@example.com');
			    //$mail->addBCC('bcc@example.com');

			    //Attachments
			    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

			    //Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'Recuperacion de contraseña en EntelExportRed';
			    $mail->Body    = '<h1> Su contraseña ha sido reestablecida</h1><p>Su contraseña ha sido reestablecida, por favor ingrese nuevamente con el usuario/correo que uso para registrarse. </p><p>Ingrese con la siguiente password : '. $pass .'</p> <b>negrita!</b> <br> <p>Para acceder haz click </p><a href="http://localhost:4200/login">aqui</a> ';
			    $mail->AltBody = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa provident error iusto, voluptate delectus odit modi quibusdam ipsum eos, laborum dignissimos cum doloribus ullam nisi aperiam expedita! Ea, blanditiis, nisi.';

			    $mail->send();
			    //echo 'Mensaje enviado';
				} catch (Exception $e) {
			  	  echo 'Mensaje no pudo ser enviado. Mailer Error: ', $mail->ErrorInfo;
				}
		}
	}
?>