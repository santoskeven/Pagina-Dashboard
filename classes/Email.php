<?php 	

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	class Email {

		private $mailer;

		public function __construct($host,$username,$pass,$user)
		{	

			$this->mailer = new PHPMailer(true);

			$this->mailer->isSMTP();    
			$this->mailer->Host = $host;  // server from smtp
			$this->mailer->SMTPAuth = true;     
			$this->mailer->Username = $username;                 // user from smpt
			$this->mailer->Password = $pass;                           // password from smtp
			$this->mailer->SMTPSecure = 'PHPMailer::ENCRYPTION_STARTTLS';      // tipo de criptografia de segurança 
			$this->mailer->Port = 465;   // porta
			$this->mailer->CharSet = 'UTF-8';

			$this->mailer->setFrom('contato@webwlc.com.br' ,$user); // quem está enviando o email
			$this->mailer->isHTML(true);  

		}

		public function address($email,$nome){
			$this->mailer->addAddress($email,$nome);   // quem vai receber
		}

		public function formatEmail($info){
			$this->mailer->Subject = $info['titulo']; // Titulo do email
			$this->mailer->Body = $info['corpo']; // conteúdo com código html
			$this->mailer->AltBody = strip_tags($info['corpo']); //conteúdo sem código html
		}

		public function sendMail(){
			if($this->mailer->send()){
				return true;	
			}else{
				return false;
			}
		}

	}

?>