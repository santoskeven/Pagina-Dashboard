var curI = 0;
var max_i = $('.bg_img').length - 1;

function initSlide () {

    $('.bg_img').hide();  // fazer todos as imagens sumirem
    $('.bg_img').eq(0).show();  // fazer com que a primeira imagem aparece

    for(let i = 0; i < max_i + 1; i++){
        var content = $('.bullets').html();
        if ( i == 0 ) 
        content += '<span class="act_bull"></span>';
        else
        content += '<span></span>'
        $('.bullets').html(content);
    }
}

function timeSlide (){

    setInterval(function (){   
    
            $('.bg_img').eq(curI).stop().fadeOut(1500);
            curI++;
                if(curI > max_i){
                        curI = 0;
                    }

            $('.bg_img').eq(curI).stop().fadeIn(1500);
            $('.bullets span').removeClass('act_bull');
            $('.bullets span').eq(curI).addClass('act_bull')

        }, 3200)
}

$('body').on('click', '.bullets span',  function() {
    var bull_click = $(this)
    $('.bullets span').removeClass('act_bull')
    $('.bg_img').eq(curI).stop().fadeOut(1500)
    curI = bull_click.index();
    bull_click.addClass('act_bull')
    $('.bg_img').eq(curI).stop().fadeIn(1500)
})

initSlide() 
timeSlide()
