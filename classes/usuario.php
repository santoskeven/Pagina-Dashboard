<?php 

    //Método para editar usuário; todos os dados 

    class Usuario{

         public function AtualizarUsuario($nome, $senha, $imagem){

            $sql = Mysql::conectar()->prepare("UPDATE `projeto_01` SET nome = ?, password = ?, img = ? WHERE user = ? ");
            if( $sql->execute(array($nome, $senha, $imagem,$_SESSION['user'] ))){
                // header("Refresh:0");
                return true;
            }else{
                return false;
            }

         }

         public  static function UserExist($user){
            $sql = Mysql::conectar()->prepare('SELECT `id` FROM `projeto_01` WHERE user = ?');
            $sql->execute(array($user));
            if($sql->rowCount() == 1)
                return true;
            else
                return false;
        }

        public static function CadastrarUsuario($login, $senha, $imagem, $nome, $cargo){
            $sql = Mysql::conectar()->prepare("INSERT INTO `projeto_01` VALUE (null, ?, ?, ?, ?, ?)");
            $sql->execute(array($login, $senha, $imagem, $nome, $cargo));
        }

    }

?>