<?php 

    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $servicos = Painel::select('tb_site_servicos', ' id=? ', array($id));
    }else{
        Painel::AlertMens('error','Você precisa passar pelo parâmetro ID.');
        die();
    }

?>

<!DOCTYPE html>

<html>

    <head>
        <link href="<?php echo INCLUDE_PATH_PAINEL?>css/editar-servico.css" rel="stylesheet">
    </head>

    <body>

    <section class="user_container">

    <h2>Editar Serviços</h2>

    <form method="post" enctype="multipart/form-data">

        <?php 
            if(isset($_POST['acao'])){
              

                if(Painel::update($_POST)){
                    Painel::AlertMens('sucesso', 'Serviço cadastrado com sucesso');
                    $servicos = Painel::select('tb_site_servicos', ' id=? ', array($id));
                }else{
                    Painel::AlertMens('error', 'Campos vazio');
                }
             
               
            }
        ?>

<div class="form_row">

            <div class="form_row">
                <h3>Serviço:</h3>
                <textarea name="servico"><?php echo $servicos['servico']?></textarea>
            </div><!--form_row-->

            <div class="form_row">
                <input type="hidden" name="id" value="<?php echo $id?>">
                <input type="hidden" name="nome_tabela" value="tb_site_servicos">
                <input type="submit" name="acao" value="Cadastrar serviço" >
            </div><!--form_row-->

    </form>

</section><!--container-->

    </body>

</html>



