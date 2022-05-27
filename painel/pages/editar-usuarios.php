<!DOCTYPE html>

<html>

<head>
    <link href="<?php echo INCLUDE_PATH_PAINEL?>css/editar-usuario.css" rel="stylesheet">
</head>

<body>

<section class="user_container">

<h2>Editar usuário</h2>

<form method="post" enctype="multipart/form-data">

<?php 
    if(isset($_POST['acao'])){

        $usuario = new Usuario();
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];
        $imagem = $_FILES['imagem'];
        $imagem_atual = $_POST['imagem_atual'];
        $usuario = new Usuario();

        if($imagem['name'] !=  ''){
            //aqui foi feito um upload de uma imagem
            if(Painel::ImagemValida($imagem)){
                Painel::deleteFile($imagem_atual);
               
                $imagem = Painel::uploadFile($imagem);
                
                if($usuario->AtualizarUsuario($nome, $senha, $imagem)){
                    $_SESSION['img'] = $imagem;
                    Painel::AlertMens('sucesso','Cadastro realizado com sucesso junto com a imagem');
                }else{
                    Painel::AlertMens('error','Ocorreu um erro ao atualizar com a imagem...');
                }
            }else{
                echo $imagem['name'];
                echo $imagem['type'];
                Painel::AlertMens('error', 'O Formato da imagem não é valido');
            }

        }else{
            $imagem = $imagem_atual;
            if($usuario->AtualizarUsuario($nome, $senha, $imagem)){
                Painel::AlertMens('sucesso','Cadastro realizado com sucesso');
            }else{
                Painel::AlertMens('error','Ocorreu um erro ao atualizar');
            }
        }

    }
?>

    <div class="form_row">
        <h3>Usuário:</h3>
        <input type="text" name="nome" placeholder="Usuário" value="<?php echo $_SESSION['nome'] ?>">
    </div><!--form_row-->

    <div class="form_row">
        <h3>Senha:</h3>
        <input type="password" name="senha" placeholder="Senha" value="<?php echo $_SESSION['password']?>">
    </div><!--form_row-->

    <div class="form_row">
        <h3>Imagem</h3>
        <input type="file" name="imagem" placeholder="Escolher uma imagem">
        <input type="hidden" name="imagem_atual" value="<?php echo $_SESSION['img']?>">
    </div><!--form_row-->

    <div class="form_row">
        <input type="submit" name="acao" value="Atualizar" >
    </div><!--form_row-->

</form>

</section><!--container-->

</body>

</html>

