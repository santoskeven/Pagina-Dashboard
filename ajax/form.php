<?php 

    include('../config.php');

    $data = array();

    $assunto = 'Novo email no site';
    $corpo = '';

    foreach($_POST as $key => $value) {
        $corpo .= ucfirst($key).": ".$value;
        $corpo .= "<hr>";
    }

    $mail = new Email('smtp.mailtrap.io', '2e07ce310e945a', 'fb7ad7cf2e2ca9', 'Ronaldo');

    $mail->address('r.kevensantos7@gmail.com','keven santos');

    $info = array('titulo'=>$assunto, 'corpo'=>$corpo);

    $mail->formatEmail($info);

    if($mail->sendMail()){
       $data['sucesso'] = true;
       $data['sendTrue'] = 'Email enviado com sucesso';
    }else{
        $data['erro'] = true;
        $data['sendFalse'] = 'Falha ao enviar o email';
    };
    
    // $data['retorno'] = 'sucesso'; // somente para debug

    die(json_encode($data))

?>