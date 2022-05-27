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

    </head>
     <link href="<?php echo INCLUDE_PATH_PAINEL?>css/painel-main.css" rel="stylesheet">
    <body>

    <div class="cont_single">

<h2>Painel de controle - <?php echo NOME_EMPRESA ?></h2>

<div class="sing_flex">

    <div class="single">
        <h3>Usuários Online</h3>
        <h2><?php echo count($usuarioOnline) ?></h2>
    </div><!--single-->

    <div class="single">
        <h3>Total de visitas</h3>
        <h2><?php echo $pegarVisitasTotais ?></h2>
    </div><!--single-->

    <div class="single">
        <h3>Visitas hoje</h3>
        <h2><?php echo $pegarVisitasHoje ?></h2>
    </div><!--single-->

</div><!--single_flex-->

</div><!--cont_single-->

<div class="cont_single">

<h2>Usuários online</h2>

<div class="row">
    <div class="only_flex">
        <div class="only_single">
            <h2>ip</h2>
        </div><!--single-->
        <div class="only_single">
            <h2>Última ação</h2>
        </div><!--single-->
    </div><!--only_flex-->
</div><!--row-->

<?php 

foreach ($usuarioOnline as $key => $value) {
?>

<div class="row">

    <div class="only_flex">

        <div class="only_single">
          
            <p><?php echo $value['ip'] ?></p>
        </div><!--single-->

        <div class="only_single">
            <p><?php echo date('d/m/Y H:i:s',strtotime($value['ult_acao'])) ?></p>
        </div><!--single-->

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
            <h2>nome</h2>
        </div><!--single-->
        <div class="only_single">
            <h2>cargo</h2>
        </div><!--single-->
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
        </div><!--single-->

        <div class="only_single">
            <p><?php echo Painel::$cargos[$value["cargo"]]; echo "_($value[cargo])" ?></p>
        </div><!--single-->

    </div><!--only_flex-->

</div><!--single_flex-->

<?php }?>

</div><!--cont_single-->

    </body>

</html>

