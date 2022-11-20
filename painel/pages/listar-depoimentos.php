<?php 

    if(isset($_GET['excluir'])){
        $idExcluir = intval($_GET['excluir']);
        Painel::Deletar('tb_site_depoimentos', $idExcluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'listar-depoimentos');
    }else if(isset($_GET['order']) && isset($_GET['id'] )){
        Painel::orderItem('tb_site_depoimentos',$_GET['order'],$_GET['id']);
    }

    $PaginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

    echo 'pagina atual :' . $PaginaAtual;
    $TotalPorPagina = 4;

    $depoimentos = Painel::TableAll('tb_site_depoimentos', ($PaginaAtual-1) * $TotalPorPagina, $TotalPorPagina);

?>

<!DOCTYPE html>

<html>

    <head>
    <link href="<?php echo INCLUDE_PATH_PAINEL?>css/listar-depoimentos.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    </head>

<body>

    <div class="listar_container large">

        <h2 style="padding: 20px 0 20px 20px">Listar Depoimentos</h2>

            <div class="row large">
                <div class="only_flex">
                    <div class="only_single">
                        <h3>Nome</h3>
                    </div><!--single-->
                    <div class="only_single">
                        <h3>Depoimento</h3>
                    </div><!--single-->
                    <div class="only_single">
                        <h3>Data</h3>
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
            foreach($depoimentos as $key => $value) {
            ?>

            <div class="row large">

                <div class="only_flex large t_center">

                    <div class="only_single">
                        <p><?php echo $value['nome'] ?></p>
                    </div><!--single-->

                    <div class="only_single">
                        <p><?php echo $value['data'] ?></p>
                    </div><!--single-->

                    <div class="only_single">
                        <p><?php echo $value['depoimento'] ?></p>
                    </div><!--single-->

                    <div class="only_single">
                        <a href="<?php echo INCLUDE_PATH_PAINEL?>editar-depoimentos?id=<?php echo $value['id'] ?>"><i class="fa-solid fa-pen-to-square"></i>Editar</a>
                    </div><!--single-->
                    <!-- <?php echo INCLUDE_PATH_PAINEL ?> -->

                    <div class="only_single">
                        <a href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos?excluir=<?php echo $value['id']?>"><i class="fa-solid fa-circle-xmark" actionBtn="excluir"></i>excluir</a>
                    </div><!--single-->

                    <div class="only_single ">
                        <a href="<?php echo INCLUDE_PATH_PAINEL?>listar-depoimentos?order=up&id=<?php echo $value['id']?>" class="orderUp"><i class="fa-solid fa-angle-up arrow"></i></a>
                    </div><!--single-->

                    <div class="only_single ">
                        <a href="<?php echo INCLUDE_PATH_PAINEL?>listar-depoimentos?order=down&id=<?php echo $value['id']?>" class="orderDown"><i class="fa-solid fa-angle-down arrow"></i></a>
                    </div><!--single-->

                </div><!--only_flex-->


            </div><!--row-->

            <?php }?>

            <div class="paginacao t_center">
                <?php
                    $TotalPorPagina = ceil(count(Painel::TableAll('tb_site_depoimentos')) / $TotalPorPagina);

                //    echo ceil(count(Painel::TableAll('tb_site_depoimentos')));

                    // echo $TotalPorPagina;
                    
                    for ($i=1; $i <= $TotalPorPagina; $i++) { 
                        if($i == $PaginaAtual)
                            echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-depoimentos?pagina='.$i.'" class="page_atc">'.$i.'</a>';
                        else
                            echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-depoimentos?pagina='.$i.'">'.$i.'</a>';
                    }
                ?>
            </div>

    </div><!--cont_single-->

</body>

</html>

