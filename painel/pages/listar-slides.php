<?php 

    if(isset($_GET['excluir'])){
        $idExcluir = intval($_GET['excluir']);

        $selectImagem = Mysql::conectar()->prepare("SELECT slide FROM `tb_admin_slides` WHERE id = ?");
        $selectImagem->execute(array($_GET['excluir']));

        Painel::Deletar('tb_admin_slides', $idExcluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'listar-slides');
    }else if(isset($_GET['order']) && isset($_GET['id'] )){
        Painel::orderItem('tb_admin_slides',$_GET['order'],$_GET['id']);
    }

    $PaginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $TotalPorPagina = 4;

    $slides = Painel::TableAll('tb_admin_slides', ($PaginaAtual-1) * $TotalPorPagina, $TotalPorPagina);
?>

<!DOCTYPE html>



<html>

<head>
    <link href="<?php echo INCLUDE_PATH_PAINEL?>css/listar-slide.css" rel="stylesheet">
</head>

<body>
    
<div class="listar_container large">

<h2 style="padding: 20px 0 20px 20px">Listar slides</h2>

<div class="row large">
    <div class="only_flex">
        <div class="only_single">
            <h3>Nome</h3>
        </div><!--single-->
        <div class="only_single">
            <h3>Slide</h3>
        </div><!--single-->
        <div class="only_single">
            <h3>Editar</h3>
        </div><!--single-->
        <div class="only_single">
            <h3>Excluir</h3>
        </div><!--single-->
        <div class="only_single">
            <h3>Cima</h3>
        </div><!--single-->
        <div class="only_single">
            <h3>Baixo</h3>
        </div><!--single-->
    </div><!--only_flex-->
</div><!--row-->

<?php 
foreach($slides as $key => $value) {
?>

<div class="row large">

    <div class="only_flex large t_center">

        <div class="only_single">
            <p><?php echo $value['nome'] ?></p>
        </div><!--single-->

        <div class="only_single"> 
            <img style="width: 50px; height: 50px" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['slide']?>">
        </div><!--single-->


        <div class="only_single">
            <a href="<?php echo INCLUDE_PATH_PAINEL?>editar-slides?id=<?php echo $value['id'] ?>"><i class="fa-solid fa-pen-to-square"></i>Editar</a>
        </div><!--single-->
        <!-- <?php echo INCLUDE_PATH_PAINEL ?> -->

        <div class="only_single">
            <a href="<?php echo INCLUDE_PATH_PAINEL ?>listar-slides?excluir=<?php echo $value['id']?>"><i class="fa-solid fa-circle-xmark" actionBtn="excluir"></i>excluir</a>
        </div><!--single-->

        <div class="only_single ">
            <a href="<?php echo INCLUDE_PATH_PAINEL?>listar-slides?order=up&id=<?php echo $value['id']?>" class="orderUp"><i class="fa-solid fa-angle-up arrow"></i></a>
        </div><!--single-->

        <div class="only_single ">
             <a href="<?php echo INCLUDE_PATH_PAINEL?>listar-slides?order=down&id=<?php echo $value['id']?>" class="orderDown"><i class="fa-solid fa-angle-down arrow"></i></a>
        </div><!--single-->

    </div><!--only_flex-->


</div><!--single_flex-->

<?php }?>

<div class="paginacao t_center">
    <?php
        $TotalPorPagina = ceil(count(Painel::TableAll('tb_admin_slides')) / $TotalPorPagina);

        for ($i=1; $i <= $TotalPorPagina; $i++) { 
            if($i == $PaginaAtual)
                echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-slides?pagina='.$i.'" class="page_atc">'.$i.'</a>';
            else
            echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-slides?pagina='.$i.'">'.$i.'</a>';
        }
    ?>
</div>

</div><!--cont_single-->

</body>


</html>

