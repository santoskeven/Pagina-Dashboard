<!DOCTYPE html>

        <?php 
            if(isset($_GET['logout'])){
                Painel::logout();
            }
        ?>

<html>

<head>
    <title>Painel de controle(LOGADO)</title>
    <link href="<?php echo INCLUDE_PATH_PAINEL?>css/painel-main.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">

</head>

<body>

    <section class="container_master">

        <div class="flex_left tag_left">
            <section class="list_menu tag_left">

                <div class="user_infos">    

                    <?php 
                        if($_SESSION['img'] == ''){
                    ?>
                        <div class="user_img">
                        <i class="fa-solid fa-user"></i>
                            <img src="../img/user.jpg">
                        </div><!--user_img-->
                    <?php }else{ ?>

                        <div class="user_img">
                            <img src="<?php echo INCLUDE_PATH_PAINEL?>uploads/<?php echo $_SESSION['img'] ?>">
                        </div><!--user_img-->

                    <?php }?>

                    <div class="user_refer">
                        <h3><?php echo $_SESSION['nome'] ?></h3>
                        <p><?php echo getCargo($_SESSION['cargo'])?></p>
                    </div><!--user_refer-->

                </div><!--user_infos-->

                <div class="cont_link">

                    <h2>Cadastro</h2>
                    <a <?php SelectMenu('cadastrar-depoimento'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-depoimento">cadastrar Depoimento</a>
                    <a <?php SelectMenu('cadastrar-servicos'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-servicos">cadastrar Serviço</a>
                    <a <?php SelectMenu('cadastrar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-slides">cadastrar Slides</a>

                    <h2>Gestão</h2>
                    <a <?php SelectMenu('listar-depoimentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos">Listar Depoimento</a>
                    <a <?php SelectMenu('listar-servicos'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>listar-servicos">Listar Serviço</a>
                    <a <?php SelectMenu('listar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-slides">Listar slides</a>
                    

                    <h2>Administração do Painel</h2>
                    <a <?php SelectMenu('editar-usuarios'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-usuarios">Editar usuário</a>
                    <a <?php SelectMenu('adicionar-usuarios'); ?> <?php ValidPermision(2); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>adicionar-usuarios">Adicionar usuário</a>
                
                    <h2>Configuração geral</h2>
                    <a <?php SelectMenu('editar-site'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-site">Editar site</a>
        
                </div><!--cont_links-->


            </section><!--list_menu-->
        </div><!--flex_left-->  

        <!-- separação -->

        <div class="flex_right tag_left">

            <section class="header">
                <div class="icon bars"><i class="fa-solid fa-bars"></i></div>

                <div class="cont_acess">
                    <div class="home_icon"><a href="<?php  echo INCLUDE_PATH_PAINEL ?>"><i class="fa-solid fa-house"></i></a></div>
                    
                    <div class="i_logout"><a href="<?php  echo INCLUDE_PATH_PAINEL ?>?logout"><i class="fa-solid fa-arrow-right-from-bracket"></i></a></div>
                </div>
            </section><!--header-->

            <section class="body">
                <?php Painel::carregarPagina()  ?>
            </section><!--body-->
            
        </div><!--flex_right-->

    </section><!--container_master-->

<script src="<?php echo INCLUDE_PATH?>js/jquery.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL?>js/func.js"></script>
<script src="https://kit.fontawesome.com/fb43290b99.js" crossorigin="anonymous"></script>

</body>

</html>