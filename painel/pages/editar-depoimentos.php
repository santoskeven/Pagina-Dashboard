<?php 

    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $depoimentos = Painel::select('tb_site_depoimentos', ' id=? ', array($id));
    }else{
        Painel::AlertMens('error','Você precisa passar pelo parâmetro ID.');
        die();
    }

?>

<!DOCTYPE html>

<html>

    <head>
        <link href="<?php echo INCLUDE_PATH_PAINEL?>css/editar-depoimento.css" rel="stylesheet">
    </head>

    <body>

    <section class="user_container">

<h2>Editar depoimento</h2>

<form method="post" enctype="multipart/form-data">

    <?php 
        if(isset($_POST['acao'])){
          

            if(Painel::update($_POST)){
                Painel::AlertMens('sucesso', 'Depoimento cadastrado com sucesso');
                $depoimentos = Painel::select('tb_site_depoimentos', ' id=? ', array($id));
            }else{
                Painel::AlertMens('error', 'Campos vazio');
            }
         
           
        }
    ?>

<div class="form_row">
            <h3>Nome:</h3>
            <input type="text" name="nome" value="<?php echo $depoimentos['nome']?>">
        </div><!--form_row-->

        <div class="form_row">
            <h3>Data:</h3>
            <input type="data" name="data" value="<?php echo $depoimentos['data']?>">
        </div><!--form_row-->

        <div class="form_row">
            <h3>Depoimento:</h3>
            <textarea name="depoimento"><?php echo $depoimentos['depoimento']?></textarea>
        </div><!--form_row-->

        <div class="form_row">
            <input type="hidden" name="id" value="<?php echo $id?>">
            <input type="hidden" name="nome_tabela" value="tb_site_depoimentos">
            <input type="submit" name="acao" value="Cadastrar depoimento" >
        </div><!--form_row-->

</form>

</section><!--container-->

    </body>

</html>
