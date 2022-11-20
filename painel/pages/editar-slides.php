
<?php 

    if(isset($_GET['id'])){
         $id = (int)$_GET['id'];
         $slide = Painel::select('tb_admin_slides', 'id = ?', array($id));
    }else{ 
        Painel::AlertMens('error', 'você precisa do parâmetro  ID para acessar essa página');
         die();
    }

?>

<!DOCTYPE html>

<html>

    <head>
        <link href="<?php echo INCLUDE_PATH_PAINEL?>css/editar-slide.css" rel="stylesheet">
    </head>

    <body>

    <section class="user_container">

    <h2>Editar slides</h2>

    <form method="post" enctype="multipart/form-data">

    <?php 
          if(isset($_POST['acao'])){

            $nome = $_POST['nome'];
            $imagem = $_FILES['imagem'];
            $imagem_atual = $_POST['imagem_atual'];
   

            if($imagem['name'] !=  ''){
                //aqui foi feito um upload de uma imagem
                    if(Painel::ImagemValida($imagem)){
                        Painel::deleteFile($imagem_atual);
                        $imagem = Painel::uploadFile($imagem);
                        $arr = ['nome'=>$nome, 'slide'=>$imagem,'id'=>$id, 'nome_tabela'=>'tb_admin_slides'];
                        Painel::update($arr);
                        $slide = Painel::select('tb_admin_slides', 'id = ?', array($id));
                        Painel::AlertMens('sucesso', 'O slide com imagem foi editado com sucesso');
                    }else{
                        Painel::AlertMens('error', 'O Formato da imagem não é valido');
                    }

            }else{
                $imagem = $imagem_atual;
                $arr = ['nome'=>$nome, 'slide'=>$imagem, 'id'=>$id, 'nome_tabela'=>'tb_admin_slides'];
                Painel::update($arr);
                $slide = Painel::select('tb_admin_slides', 'id = ?', array($id));
                Painel::AlertMens('error', 'Falha ao atualizar o slide sem imagem');
            }

        }

    ?>

        <div class="form_row">
            <h3>Nome:</h3>
            <input type="text" name="nome" placeholder="Usuário" value="<?php echo $slide['nome'] ?>">
        </div><!--form_row-->

        <div class="form_row">
            <h3>Imagem:</h3>
            <input type="file" name="imagem" placeholder="Escolher uma imagem">
            <input type="hidden" name="imagem_atual" value="<?php echo $slide['slide'] ?>">
        </div><!--form_row-->

        <div class="form_row">
            <input type="submit" name="acao" value="Atualizar" >
        </div><!--form_row-->

    </form>

</section><!--container-->

    </body>

</html>

