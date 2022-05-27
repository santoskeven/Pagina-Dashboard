<?php 

    if(isset($_COOKIE['lembrar'])){
        $USER = $_COOKIE['user'];
        $PASS = $_COOKIE['pass'];
        $sql = Mysql::conectar()->prepare("SELECT * FROM `projeto_01` WHERE user = ? AND password = ? ");
        $sql->execute(array($USER, $PASS));

        if($sql->rowCount() == 1){

              $info = $sql->fetch();
                $_SESSION['login'] = true; 
                $_SESSION['user'] = $USER;
                $_SESSION['password'] = $PASS;
                $_SESSION['nome'] = $info['nome'];
                $_SESSION['cargo'] = $info['cargo'];
                $_SESSION['img'] = $info['img'];

                header('Location: '.INCLUDE_PATH_PAINEL);
                die();

        }
    }

?>

<!DOCTYPE html>

<html>

    <head>
        <title>Painel de login</title>
        <link href="<?php echo INCLUDE_PATH_PAINEL?>css/login.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>


    <body>

    <?php 
        //para fazer a verificação de user PARA LOGIN
        if(isset($_POST['acao'])){
            $USER = $_POST['user'];
            $PASS = $_POST['pass'];
            $sql = Mysql::conectar()->prepare("SELECT * FROM `projeto_01` WHERE user = ? AND password = ? ");
            $sql->execute(array($USER, $PASS));
            if($sql->rowCount() == 1){
                //login feito sucesso
                $info = $sql->fetch();
                $_SESSION['login'] = true; 
                $_SESSION['user'] = $USER;
                $_SESSION['password'] = $PASS;
                $_SESSION['nome'] = $info['nome'];
                $_SESSION['cargo'] = $info['cargo'];
                $_SESSION['img'] = $info['img'];
                
                if(isset($_POST['lembrar'])){
                    setcookie('lembrar', true, time()+(60*60*24), '/'); // 1 dia
                    setcookie('user', $USER, time()+(60*60*24), '/');
                    setcookie('pass', $PASS, time()+(60*60*24), '/');
                }

                header('Location: '.INCLUDE_PATH_PAINEL);
                die();
            }else{
                //falha ao realizar login
                $error = true;
            }
        }

    ?>

        <section class="container">

            <div class="cont_form_log">

                <h2 style="padding-bottom: 1.4rem;">Efetuar login</h2>

                <p class="alert" style="
                <?php
                    if($error == true){
                        echo 'display: block';
                    }
                ?>">Falha ao fazer login</p>
                
                <form method="post" action="">

                    <input type="text" name="user" require placeholder="Digite seu user">
                    <input type="password" name="pass" require placeholder="Digite sua senha">
                    <div class="group_login">
                        <input type="submit" name="acao" require value="Login">
                       <div class="lembrar">
                          <span>Lembrar-me</span>
                           <input style="margin-left: 5px;
                           width: 14px;
                           height: 14px;" 
                           type="checkbox" name="lembrar">
                       </div>
                    </div><!--group_login-->
                   

                </form>

            </div><!--cont_form-->

        </section><!--container-->

<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/jquery.js"></script>

    </body>

</html>