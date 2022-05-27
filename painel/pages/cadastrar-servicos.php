<!DOCTYPE html>

<html>

    <head>
    <link href="<?php echo INCLUDE_PATH_PAINEL?>css/cadastrar-servico.css" rel="stylesheet">
    </head>

    <body></body>

</html>

<section class="user_container">

    <h2>Adicionar servicos</h2>

    <form method="post" enctype="multipart/form-data">

        <?php 
            if(isset($_POST['acao'])){
              

                if(Painel::Insert($_POST)){
                    Painel::AlertMens('sucesso', 'serviço cadastrado com sucesso');
                }else{
                    Painel::AlertMens('error', 'Campos vazio');
                }
             
               
            }
        ?>

            <div class="form_row">
                <h3>Serviço:</h3>
                <textarea name="depoimento" placeholder="Digite o serviço "></textarea>
            </div><!--form_row-->

            <div class="form_row">
                <input type="hidden" name="order_id" value="0">
                <input type="hidden" name="nome_tabela" value="tb_site_servicos">
                <input type="submit" name="acao" value="Cadastrar serviço" >
            </div><!--form_row-->

    </form>

</section><!--container-->