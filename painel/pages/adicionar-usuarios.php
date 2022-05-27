<?php 
    PagePermition(2);
?>

<!DOCTYPE html>

<html>

<head>
    <link href="<?php echo INCLUDE_PATH_PAINEL?>css/adicionar-usuario.css" rel="stylesheet">
</head>


<body>

<section class="user_container">

<h2>Adicionar usuário</h2>

<form method="post" enctype="multipart/form-data">

<?php 
    if(isset($_POST['acao'])){

        $login = $_POST['login'];
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];
        $imagem = $_FILES['imagem'];
        $cargo = $_POST['cargo'];

        if($login == ''){
            Painel::AlertMens('error','Campo de login vazio!!!');
        }else if($nome == ''){
            Painel::AlertMens('error','Campo de usuário vazio!!!');
        }else if($senha == ''){
            Painel::AlertMens('error','Campo de senha vazio!!!');
        }else if($imagem['name'] == ''){
            Painel::AlertMens('error','Campo de imagem vazio!!!');
        }else{
            if($cargo >= $_SESSION['cargo']){
                Painel::AlertMens('error','Selecione um cargo menor que o seu!!!');
            }else if(Painel::ImagemValida($imagem) == false){
                Painel::AlertMens('error','Selecione um formato de imagem válido');
            }else if(Usuario::UserExist($login)){
                Painel::AlertMens('error','O login já existe, selecione outro, por favor!!!');
            }else{
                $usuario = new Usuario();
                $imagem = Painel::uploadFile($imagem);
                $usuario->CadastrarUsuario($login, $senha, $imagem, $nome, $cargo);
                Painel::AlertMens("sucesso","Usuário '.$login.' cadastrado com sucesso");
            }
        }

       
       

    }
?>

    <div class="form_row">
        <h3>Login:</h3>
        <input type="text" name="login" placeholder="Usuário" >
    </div><!--form_row-->

    <div class="form_row">
        <h3>Usuário:</h3>
        <input type="text" name="nome" placeholder="Usuário" >
    </div><!--form_row-->

    <div class="form_row">
        <h3>Senha:</h3>
        <input type="password" name="senha" placeholder="Senha" >
    </div><!--form_row-->

    <div class="form_row">
        <h3>cargo:</h3>
        <select name="cargo" style="width: 100%" >
            <?php 
               foreach (Painel::$cargos as $key => $value) {
                   if($key < $_SESSION['cargo']){echo '<option value="'.$key.'">'.$value.'</option>';}
               }
            ?>
        </select>
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

<html>


