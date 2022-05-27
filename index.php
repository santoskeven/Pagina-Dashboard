<?php include('config.php'); ?>
<?php Site::UpUserOnly(); ?>
<?php Site::contador(); ?>

<?php 

    $infosite = Mysql::conectar()->prepare('SELECT * FROM `tb_site_config`');
    $infosite->execute();
    $infosite = $infosite->fetch();


?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $infosite['titulo']?></title>
    <link  href="<?php echo INCLUDE_PATH; ?>css/style.css" rel="stylesheet">
    <link  href="<?php echo INCLUDE_PATH; ?>css/dashbord-main.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- open sans -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">

    <!-- roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

    <!-- source  sans pro -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    
</head>

<body>

<base base="<?php echo INCLUDE_PATH; ?>" />

    <?php
        $url = isset($_GET['url']) ? $_GET['url'] : 'home';

        switch($url){
            case 'Sobre':
                echo '<target target="Sobre" />';
                break;

            case 'Servicos':
                echo '<target target="Servicos" />';
                break;
        }
    ?>

    <!-- git loader ajax -->
    <div class="loader_ajax">
        <img src="<?php echo INCLUDE_PATH;?>gifs/double.gif">
    </div><!--loader_ajax-->

    <!-- Box de confirmação de Email -->
    <div class="box_email">
       <div class='content'></div>
    </div><!--box_email-->

    <header class="header" style="position:relative"> 

        <div>
            <!-- <img src=""> -->
            <h2>Logo</h2>
        </div>

        <nav class="desktop">
            <ul>
                <li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
                <li><a href="<?php echo INCLUDE_PATH; ?>Sobre">Sobre</a></li>
                <li><a href="<?php echo INCLUDE_PATH; ?>Servicos">Serviços</a></li>
                <li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>   
            </ul>
        </nav>

        <nav class=" mobile">
        <i class="fa-solid fa-bars icon"></i>
            <ul>
                <li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
                <li><a href="<?php echo INCLUDE_PATH; ?>Sobre">Sobre</a></li>
                <li><a href="<?php echo INCLUDE_PATH; ?>Serviços">Serviços</a></li>
                <li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
            </ul>
        </nav>  


        <a class="singIn" href="<?php echo INCLUDE_PATH_PAINEL?>"><i class="fa-solid fa-arrow-right-to-bracket"></i></a>
        
    </header>

    <section class="cont_princ">
        <?php  

        if(file_exists('pages/'.$url.'.php')){
            include('pages/'.$url.'.php');
        }else{
            if($url != 'Sobre' && $url != 'Servicos'){
                $pagina404 = true; 
                include('pages/404.php');
            }else{
                include('pages/home.php');
            }
        }

        ?>
    </section>

    
    <footer <?php if(isset($pagina404) && $pagina404 == true) echo 'class="fixed"'?>>

            <div class="dep_cont">

                <?php
                
                $sql = Mysql::conectar()->prepare('SELECT * FROM `tb_site_depoimentos` ORDER BY order_id ASC LIMIT 3');
                $sql->execute();
                $depoimentos = $sql->fetchAll();

                foreach ($depoimentos as $key => $value) {
                ?>
                    
                <div class="depoi_single">

                <H3><?php echo $value['nome']; ?></H3>
                <p><?php echo $value['depoimento']; ?></p>
                <p><?php echo $value['data']; ?></p>

                </div><!--depoi_single-->

                <?php } ?>

            </div>

            <div class="serv_cont"> 
               
                <?php 
                
                    $sql = Mysql::conectar()->prepare("SELECT * FROM `tb_site_servicos` ORDER BY order_id ASC LIMIT 3");
                    $sql->execute();
                    $servicos = $sql->fetchAll();

                    foreach ($servicos as $key => $value) {
                ?>

                <div class="serv_single">
                <p><?php echo $value['servico']; ?></p>
                </div><!--serv_single-->

                <?php } ?>


            </div>

    </footer>

     
<script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/contains.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/form.js">
<script src="http://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsM0UCAfKbsVjwYjveeWhfcOaELswj7R8&callback=initMap&libraries=&v=weekly"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/map.js"></script>
<script src="https://kit.fontawesome.com/fb43290b99.js" crossorigin="anonymous"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/func.js"></script>


<?php 
    if($url != 'contato'){
?>
    <script src="<?php echo INCLUDE_PATH; ?>js/slide.js"></script> 
<?php }?>
        


</body>


</html>