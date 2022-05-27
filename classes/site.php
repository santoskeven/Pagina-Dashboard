<?php 

    class Site{

        public static function UpUserOnly(){

             try{
                if(isset($_SESSION['online'])){
                    $token = $_SESSION['online'];
                    $data = date('Y-m-d H:i:s');

                    $check = Mysql::conectar()->prepare("SELECT `id` FROM `tb_admin_online` WHERE token = ?");
                    $check->execute(array($_SESSION['online']));

                    if($check->rowCount() == 1){
                        $sql = Mysql::conectar()->prepare('UPDATE `tb_admin_online` SET ult_acao = ? WHERE token = ?');
                        $sql->execute(array($data, $token));
                    }else {
                        $ip = $_SERVER['REMOTE_ADDR'];
                        $token = $_SESSION['online'];
                        $data = date('Y-m-d H:i:s');
                        $sql = Mysql::conectar()->prepare('INSERT INTO `tb_admin_online` VALUES (null,?,?,?)');
                        $sql->execute(array($ip,$data,$token));
                    }

                   
                }else{
                    $_SESSION['online'] = uniqid();
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $token = $_SESSION['online'];
                    $data = date('Y-m-d H:i:s');
                    $sql = Mysql::conectar()->prepare('INSERT INTO `tb_admin_online` VALUES (null,?,?,?)');
                    $sql->execute(array($ip,$data,$token));
                }
             }catch( Exception $e ){
                echo 'error ao conectar:'. $e;
           }

        }

        public static function contador(){
            if(!isset($_COOKIE['visita'])){
                setcookie('visita', 'true', time() + (60*60*7));
                $sql = Mysql::conectar()->prepare("INSERT INTO `tb_admin_visitas` VALUES(null, ?,?)");
                $sql->execute(array($_SERVER['REMOTE_ADDR'], date('Y-m-d')));
            }
       }

    }

?>