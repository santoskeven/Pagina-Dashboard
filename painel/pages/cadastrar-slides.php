<!DOCTYPE html>

<html>

    <head>
         <link href="<?php echo INCLUDE_PATH_PAINEL?>css/cadastrar-slide.css" rel="stylesheet">
    </head>

    <body>

        
        <section class="user_container">

            <h2>Cadastrar Slide</h2>

            <form method="post" enctype="multipart/form-data">

                <?php 
                    if(isset($_POST['acao'])){

                        $nome = $_POST['nome'];
                        $imagem = $_FILES['imagem'];


                        if($nome == ''){
                            Painel::AlertMens('error','Campo de usuário vazio!!!');
                        }else if($imagem['name'] == ''){
                            Painel::AlertMens('error','Campo de imagem vazio!!!');
                        }else{  
                            if(Painel::ImagemValida($imagem) == false){
                                Painel::AlertMens('error','Selecione um formato de imagem válido');
                            }else{
                                $imagem = Painel::uploadFile($imagem);
                                $arr = ['nome'=>$nome,'slide'=>$imagem,'order_id'=>'0','nome_tabela'=>'tb_admin_slides'];
                                Painel::Insert($arr);
                                Painel::AlertMens("sucesso","slide cadastrado com sucesso");
                            }
                        }

                    }
                ?>


                <div class="form_row">
                    <h3>Nome do slide</h3>
                    <input type="text" name="nome" placeholder="Nome" >
                </div><!--form_row-->

                <div class="form_row">
                    <h3>Imagem</h3>
                    <input type="file" name="imagem" placeholder="Escolher uma imagem" >
                </div><!--form_row-->

                <div class="form_row">
                    <input type="submit" name="acao" value="Adicionar novo usuário" >
                </div><!--form_row-->

            </form>

        </section><!--container-->

    </body>

</html>

