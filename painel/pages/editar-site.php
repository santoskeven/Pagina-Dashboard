<?php 

    $site = Painel::select('tb_site_config', false);
?>

<!DOCTYPE html>

<html>

    <head>
     <link href="<?php echo INCLUDE_PATH_PAINEL?>css/editar-usuario.css" rel="stylesheet">
    </head>

    <body>

    <section class="user_container">

<h2>Editar Site</h2>

<form method="post" enctype="multipart/form-data">

    <?php 
        if(isset($_POST['acao'])){
          
            if(Painel::update($_POST, true)){
                Painel::AlertMens('sucesso', 'Serviço cadastrado com sucesso');
                $site = Painel::select('tb_site_config', false);
            }else{
                Painel::AlertMens('error', 'Campos vazio');
            }
         
           
        }
    ?>

<div class="form_row">

        <div class="form_row">
            <h3>Titulo:</h3>
            <input type="text" name="titulo" value="<?php echo $site['titulo']?>">
        </div><!--form_row-->

        <div class="form_row">
            <h3>Nome do autor:</h3>
            <input type="text" name="nome_autor" value="<?php echo $site['nome_autor']?>">
        </div><!--form_row-->

        <div class="form_row">
            <h3>Descrição:</h3>
            <input type="text" name="descricao" value="<?php echo $site['descricao']?>">
        </div><!--form_row-->

        <?php 
        
            for($i = 1; $i <= 3; $i++){

        ?>

        <div class="form_row">
            <h3>Ícone: <?php echo $i ?></h3>
            <input type="text" name="icone<?php echo $i?>" value="<?php echo $site['icone'.$i]?>">
        </div><!--form_row-->


        <div class="form_row">
            <h3>Descrição: <?php echo $i ?></h3>
            <textarea name="descricao<?php echo $i?>"><?php echo $site['descricao'.$i]?></textarea>
        </div><!--form_row-->


        <?php } ?>

        <div class="form_row">
            <input type="hidden" name="id" value="<?php echo $id?>">
            <input type="hidden" name="nome_tabela" value="tb_site_config">
            <input type="submit" name="acao" value="Salvar configurações" >
        </div><!--form_row-->

</form>

</section><!--container--> 

    </body>

</html>

