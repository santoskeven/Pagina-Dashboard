<!DOCTYPE html>

<html>

    <head>
    <link href="<?php echo INCLUDE_PATH_PAINEL?>css/cadastrar-depoimento.css" rel="stylesheet">
    </head>

    <body>

    <section class="user_container">

        <h2>Adicionar usuário</h2>

            <form method="post" enctype="multipart/form-data">

                <?php 
                    if(isset($_POST['acao'])){
                    
                        if(Painel::Insert($_POST)){
                            Painel::AlertMens('sucesso', 'Depoimento cadastrado com sucesso');
                        }else{
                            Painel::AlertMens('error', 'Campos vazio');
                        }
                    
                    }
                ?>

                    <div class="form_row">
                        <h3>Nome:</h3>
                        <input type="text" name="nome" placeholder="Nome" >
                    </div><!--form_row-->

                    <div class="form_row">
                        <h3>Data:</h3>
                        <input type="date" name="data">
                    </div><!--form_row-->

                    <div class="form_row">
                        <h3>Depoimento:</h3>
                        <textarea name="depoimento" placeholder="Digite o depoimento"></textarea>
                    </div><!--form_row-->

                    <div class="form_row">
                        <input type="hidden" name="order_id" value="0">
                        <input type="hidden" name="nome_tabela" value="tb_site_depoimentos">
                        <input type="submit" name="acao" value="Cadastrar depoimento" >
                    </div><!--form_row-->

            </form>

    </section><!--container-->

    </body>

</html>

