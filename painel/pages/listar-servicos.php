<?php 

    if(isset($_GET['excluir'])){
        $idExcluir = intval($_GET['excluir']);
        Painel::Deletar('tb_site_servicos', $idExcluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'listar-servicos');
    }else if(isset($_GET['order']) && isset($_GET['id'] )){
        Painel::orderItem('tb_site_servicos',$_GET['order'],$_GET['id']);
    }

    $PaginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $TotalPorPagina = 4;

    $servicos = Painel::TableAll('tb_site_servicos', ($PaginaAtual-1) * $TotalPorPagina, $TotalPorPagina);
?>

<!DOCTYPE html>

<html>
    
    <head>
        <link href="<?php echo INCLUDE_PATH_PAINEL?>css/listar-servicos.css" rel="stylesheet">
    </head>

<body>

    <div class="listar_container large">

        <h2 style="margin: 10px 0 20px 10px">Listar Serviços</h2>

            <div class="row large">
                <div class="only_flex">
                    <div class="only_single">
                        <h3>nome</h3>
                    </div><!--single-->

                    <div class="only_single">
                        <h3>editar</h3>
                    </div><!--single-->
                    <div class="only_single">
                        <h3>excluir</h3>
                    </div><!--single-->
                    <div class="only_single">
                        <h3>up</h3>
                    </div><!--single-->
                    <div class="only_single">
                        <h3>down</h3>
                    </div><!--single-->
                </div><!--only_flex-->
            </div><!--row-->

            <?php 
            foreach($servicos as $key => $value) {
            ?>

            <div class="row large">

                <div class="only_flex large t_center">

                    <div class="only_single">
                        <textarea><?php echo $value['servico'] ?></textarea>
                    </div><!--single-->

                    <div class="only_single">
                        <a href="<?php echo INCLUDE_PATH_PAINEL?>editar-servicos?id=<?php echo $value['id'] ?>"><i class="fa-solid fa-pen-to-square"></i>Editar</a>
                    </div><!--single-->
                    <!-- <?php echo INCLUDE_PATH_PAINEL ?> -->

                    <div class="only_single">
                        <a href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?excluir=<?php echo $value['id']?>"><i class="fa-solid fa-circle-xmark" actionBtn="excluir"></i>excluir</a>
                    </div><!--single-->

                    <div class="only_single ">
                        <a href="<?php echo INCLUDE_PATH_PAINEL?>listar-servicos?order=up&id=<?php echo $value['id']?>" class="orderUp"><i class="fa-solid fa-angle-up arrow"></i></a>
                    </div><!--single-->

                    <div class="only_single ">
                        <a href="<?php echo INCLUDE_PATH_PAINEL?>listar-servicos?order=down&id=<?php echo $value['id']?>" class="orderDown"><i class="fa-solid fa-angle-down arrow"></i></a>
                    </div><!--single-->

                </div><!--only_flex-->


            </div><!--single_flex-->

            <?php }?>

            <div class="paginacao t_center">
                <?php
                    $TotalPorPagina = ceil(count(Painel::TableAll('tb_site_depoimentos')) / $TotalPorPagina);

                    for ($i=1; $i <= $TotalPorPagina; $i++) { 
                        if($i == $PaginaAtual)
                            echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-servicos?pagina='.$i.'" class="page_atc">'.$i.'</a>';
                        else
                        echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-servicos?pagina='.$i.'">'.$i.'</a>';
                    }
                ?>
            </div>

        </div><!--cont_single-->

</body>

</html>

