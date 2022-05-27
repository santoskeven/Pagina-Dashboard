<?php   

session_start();

    date_default_timezone_set('America/Sao_Paulo');

    $autoload = function($class){
        if($class == 'Email'){
            require 'lib/vendor/autoload.php';
		}
        include('classes/'.$class.'.php');
    };

    spl_autoload_register($autoload);

    define('INCLUDE_PATH', 'http://localhost/Keven/dashboard/');

    define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');

    //conectar no banco de dados
    define('HOST','localhost');
    define('USER', 'root');
    define('PASSWORD', '');
    define('DATABASE', 'projeto_01');

    //constantes para o painel de controle

    define('BASE_DIR_PAINEL',__DIR__.'/painel');

    define('NOME_EMPRESA', 'WLC' );

    //funções

    function getCargo($ind){
        return Painel::$cargos[$ind];
    }

    function SelectMenu($par){
        $url = explode('/',@$_GET['url'])[0];
        if($url == $par){
            echo 'class = "link_act"';
        }else{
            return false;
        }
    }

    function ValidPermision($permision){
        if($_SESSION['cargo'] == $permision){
            return;
        }else{
            echo 'style="display:none"';
        }
    }

    function PagePermition($permissao){
        if($_SESSION['cargo'] == $permissao){
            return;
        }else{
           include('painel/pages/permissao_negada.php');
           die();
        }
    }
    

?>