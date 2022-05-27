<?php

    class Painel
    {

        public static $cargos = [
                '0' => 'Normal',
                '1' => 'Sub Administrador',
                '2' => 'Administrador'
            ];
        
        public static function logado(){
            return isset($_SESSION['login']) ? true : false;
        }

        public static function logout(){
            setcookie('lembrar', true, time()-1, '/');
            session_destroy();
            header('Location: '.INCLUDE_PATH_PAINEL);
            die();
        }

        public static function carregarPagina(){
            if(isset($_GET['url'])){
                $url = explode('/',$_GET['url']);
                    if(file_exists('pages/'.$url[0].'.php')){
                         include('pages/'.$url[0].'.php');
                    }else{
                       header('Location:' .INCLUDE_PATH_PAINEL);
                    }
            }else{
                include('pages/home.php');
            }
        }

        public static function ListarPainel(){
            self::LimparUsuárioOnline();
            $sql = Mysql::conectar()->prepare('SELECT * FROM `tb_admin_online`');
            $sql->execute();
            return $sql->fetchAll();
        }

        public static function LimparUsuárioOnline(){
            $date = date('Y-m-d H:i:s');
            $sql = Mysql::conectar()->exec("DELETE FROM `tb_admin_online` WHERE ult_acao < '$date' - INTERVAL 1 MINUTE");
        }

        public static function AlertMens($tipo, $mensagem){
            if($tipo == "sucesso"){
                echo '<div class="alert_sucesso">'.$mensagem.'</div>';
            }else  if($tipo == "error"){
                echo '<div class="alert_error">'.$mensagem.'</div>';
            }
        }

        public static function imagemValida($imagem){
			if($imagem['type'] == 'image/jpeg' ||
				$imagem['type'] == 'imagem/jpg' ||
				$imagem['type'] == 'imagem/png'){

				$tamanho = intval($imagem['size']/1024);
				if($tamanho < 300)
					return true;
				else
                echo 'excedeu o tamanho';
					return false;
			}else{
                echo 'formato inválido';
				return false;
			}
		}   

        public static function uploadFile($file){
            $formatoArquivo = explode('.',$file['name']);
            $imagemNome = uniqid().'.'.$formatoArquivo[count($formatoArquivo) - 1];
          if(move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'/uploads/'.$imagemNome))
            return $imagemNome;
          else
            return false;
        }

        public static function deleteFile($file){
            @unlink('uploads/'.$file);
        }

        public static function insert($arr){
			$certo = true;
			$nome_tabela = $arr['nome_tabela'];
			$query = "INSERT INTO `$nome_tabela` VALUES (null";
			foreach ($arr as $key => $value) {
				$nome = $key;
				$valor = $value;
				if($nome == 'acao' || $nome == 'nome_tabela')
					continue;
				if($value == ''){
					$certo = false;
					break;
				}
				$query.=",?";
				$parametros[] = $value;
			}

			$query.=")";
			if($certo == true){
				$sql = MySql::conectar()->prepare($query);
				$sql->execute($parametros);
				$lastId = MySql::conectar()->lastInsertId();
				$sql = MySql::conectar()->prepare("UPDATE `$nome_tabela` SET order_id = ? WHERE id = $lastId");
				$sql->execute(array($lastId));
			}
			return $certo;
		}

        public static function update($arr, $single = false){
			$certo = true;
			$first = false;
			$nome_tabela = $arr['nome_tabela'];

			$query = "UPDATE `$nome_tabela` SET ";
			foreach ($arr as $key => $value) {
				$nome = $key;
				$valor = $value;
				if($nome == 'acao' || $nome == 'nome_tabela' || $nome == 'id')
					continue;
				if($value == ''){
					$certo = false;
					break;
				}
				
				if($first == false){
					$first = true;
					$query.="$nome=?";
				}
				else{
					$query.=",$nome=?";
				}

				$parametros[] = $value;
			}

			if($certo == true){
                if($single == false){
                    $parametros[] = $arr['id'];
					$sql = MySql::conectar()->prepare($query.' WHERE id=?');
					$sql->execute($parametros);
                }else{
					$sql = MySql::conectar()->prepare($query);
                    $sql->execute($parametros);
                }	
			}
			return $certo;
		}

        public static function TableAll($table, $start = null,$end = null){
            if($start == null && $end == null)
                $sql = Mysql::conectar()->prepare("SELECT * FROM `$table` ORDER BY order_id ASC");
            else
                $sql = Mysql::conectar()->prepare("SELECT * FROM `$table` ORDER BY order_id ASC LIMIT $start,$end");

            $sql->execute();

            return $sql->fetchAll();
        }

        public static function Deletar($table, $id=false){
            if($id == false){
                $sql = Mysql::conectar()->prepare("DELETE FROM `$table` ");
            }else{
                $sql = Mysql::conectar()->prepare("DELETE FROM `$table` WHERE id = $id ");
            }
            $sql->execute();
        }   

        public static function redirect($url){
            echo '<script>location.href="'.$url.'"</script>';
            die();
        }

        public static function select($table, $query = '', $arr = ''){
            if($query != false){
                $sql = Mysql::conectar()->prepare("SELECT * FROM `$table` WHERE $query");
                $sql->execute($arr);
             }else{
                $sql = Mysql::conectar()->prepare("SELECT * FROM `$table`");
                $sql->execute();
             }
            return $sql->fetch();
        }

        public static function orderItem($table, $orderType, $idItem){
            if($orderType == 'up'){
                $infoItemAtual = Painel::select($table, 'id=?', array($idItem));
                $order_id = $infoItemAtual['order_id'];
                $ItemBefore = MySql::conectar()->prepare("SELECT * FROM `$table` WHERE order_id < $order_id ORDER BY order_id DESC LIMIT 1");
                $ItemBefore->execute();
                if($ItemBefore->rowCount() == 0)
                    return;
                $ItemBefore = $ItemBefore->fetch();
                Painel::update(array('nome_tabela'=>$table,'id'=>$ItemBefore['id'],'order_id'=>$infoItemAtual['order_id']));
				Painel::update(array('nome_tabela'=>$table,'id'=>$infoItemAtual['id'],'order_id'=>$ItemBefore['order_id']));

            }else if($orderType == 'down'){
                $infoItemAtual = Painel::select($table, 'id=?', array($idItem));
                $order_id = $infoItemAtual['order_id'];
                $ItemBefore = MySql::conectar()->prepare("SELECT * FROM `$table` WHERE order_id > $order_id ORDER BY order_id ASC LIMIT 1");
                $ItemBefore->execute();
                if($ItemBefore->rowCount() == 0)
                    return;
                $ItemBefore = $ItemBefore->fetch();
                Painel::update(array('nome_tabela'=>$table,'id'=>$ItemBefore['id'],'order_id'=>$infoItemAtual['order_id']));
				Painel::update(array('nome_tabela'=>$table,'id'=>$infoItemAtual['id'],'order_id'=>$ItemBefore['order_id']));
            }
        }

    }   
    
    

?>