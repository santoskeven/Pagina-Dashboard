<section class="cont_bg">
        <div class="layer"></div>

        <img class="bg_img" src="img/bg.jpg">
        <img class="bg_img" src="img/bg_2.jpg">
        <img class="bg_img" src="img/bg_3.jpg">

        <div class="bullets"></div>

        <div class="cont_form"> 
            <h3 style="padding: .5rem">Qual seu melhor Email?</h3>
            <form id="input" method="post">
                <input type="email" required placeholder="digite seu email" name="email" style="letter-spacing: 1px">
                 <input type="hidden" name="identificador" value="home_form">
                <input class="sub" type="submit" name='acao' value="Cadastrar">
               
            </form>
        </div>

    </section><!--cont_bg-->

    <section class="data_author" id="Sobre">

        <div class="cont_text">
            <h2 style="padding-bottom: 1rem;"><?php echo $infosite['titulo']?></h2>
            
            <p>
                <?php echo $infosite['descricao']?>
            </p>

            <p>
                <?php echo $infosite['descricao']?>
            </p>

        </div><!--cont_text-->

        <div class="cont_img">
            <img src="img/user.jpg">
        </div><!--cont_img-->

    </section>

    <section class="esp" id="Servicos">

        <h2 style="padding-bottom: 2.5rem">Especialidades</h2>

    <div class="flex">

            <div class="esp_single">
                    <i class="fa-brands fa-css3-alt"></i>
                    <h2>CSS</h2>
                    <p>
                    <?php echo $infosite['descricao1']?>
                    </p>
            </div><!---->

            <div class="esp_single">
            <i class="fa-brands fa-html5"></i>
                    <h2>HTML</h2>
                    <p>
                        <?php echo $infosite['descricao2']?>
                    </p>
            </div><!---->

            <div class="esp_single">
            <i class="fa-brands fa-php"></i>
                    <h2>PHP</h2>
                    <p>
                    <?php echo $infosite['descricao3']?>
                    </p>
            </div><!---->

    </div><!--flex-->

    </section><!--esp-->