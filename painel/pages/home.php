<?php 
    $usuarioOnline = Painel::ListarPainel();
    
    $pegarVisitasTotais = Mysql::conectar()->prepare("SELECT * FROM `tb_admin_visitas`");
    $pegarVisitasTotais->execute();

    $pegarVisitasTotais = $pegarVisitasTotais->rowCount();

    $pegarVisitasHoje = Mysql::conectar()->prepare("SELECT * FROM `tb_admin_visitas` WHERE dia = ?");
    $pegarVisitasHoje->execute(array(date('Y-m-d')));

    $pegarVisitasHoje = $pegarVisitasHoje->rowCount();

?>

<!DOCTYPE html>

<html>

    <head>
        <link href="<?php echo INCLUDE_PATH_PAINEL?>css/painel-main.css" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
        
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    </head>
        
<body>

    <div class="cont_single">

        <h2>Painel de controle - <?php echo NOME_EMPRESA ?></h2>

        <div class="sing_flex">

            <div class="single">
                <h3>Usuários online</h3>
                <p><?php echo count($usuarioOnline) ?></p>
            </div><!--single-->

            <div class="single">
                <h3>Total de visitas</h3>
                <p><?php echo $pegarVisitasTotais ?></p>
            </div><!--single-->

            <div class="single">
                <h3>Visitas hoje</h3>
                <p><?php echo $pegarVisitasHoje ?></p>
            </div><!--single-->

        </div><!--single_flex-->

    </div><!--cont_single-->

    <div class="cont_single">

        <h2>Usuários online</h2>

        <div class="row">
            <div class="only_flex">
                <div class="only_single">
                    <h3>Ip</h3>
                </div><!--only_single-->

                <div class="only_single">
                    <h3>Última ação</h3>
                </div><!--only_single-->
            </div><!--only_flex-->
        </div><!--row-->

 <?php 

 foreach ($usuarioOnline as $key => $value) {
 ?>

    <div class="row">

        <div class="only_flex">

            <div class="only_single">
                
                <p><?php echo $value['ip'] ?></p>
            </div><!--only_single-->

            <div class="only_single">
                <p><?php echo date('d/m/Y - H:i:s',strtotime($value['ult_acao'])) ?></p>
            </div><!--only_single-->

        </div><!--only_flex-->

    </div><!--single_flex-->

 <?php }?>

    </div><!--cont_single-->

    <!--  -->

    <div class="cont_single">

        <h2>Usuários do painel</h2>

        <div class="row">
            <div class="only_flex">
                <div class="only_single">
                    <h3>Nome</h3>
                </div><!--only_single-->

                <div class="only_single">
                    <h3>Cargo</h3>
                </div><!--only_single-->
            </div><!--only_flex-->
        </div><!--row-->

        <?php 

        $usuariosPainel = Mysql::conectar()->prepare("SELECT * FROM `projeto_01`");
        $usuariosPainel->execute();
        $usuariosPainel = $usuariosPainel->fetchAll();


        foreach ($usuariosPainel as $key => $value) {
        ?>

        <div class="row">

            <div class="only_flex">

                <div class="only_single">
                    <p><?php echo $value['user'] ?></p>
                </div><!--only_single-->

                <div class="only_single">
                    <p><?php echo Painel::$cargos[$value["cargo"]]; echo "_($value[cargo])" ?></p>
                </div><!--only_single-->

            </div><!--only_flex-->

        </div><!--row-->

        <?php }?>

    </div><!--cont_single-->

</body>

</html>

