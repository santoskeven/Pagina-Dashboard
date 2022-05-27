const icon = document.getElementsByClassName("icon") 
const target = document.getElementsByClassName('mobile')

icon[0].addEventListener('click', () => {
      
    if(target[0].classList.contains('mobi_atc')){
        target[0].classList.remove('mobi_atc')
    }
    else{
        target[0].classList.add('mobi_atc')
    }
})

// usando jquery daqui pra frente

if ($('target').length > 0) {
    var elemento = '#'+$('target').attr('target');
    var position = $(elemento).offset().top;

    console.log(position)
    $('html,body').animate({'scrollTop': position}, 1500)
}


function loadDinnmic(){

    $('[realtime]').click(function(){

        var page = $(this).attr('realtime');
        $('.cont_princ').hide();
        $('.cont_princ').load(include_path+'pages/'+page+'.php');
   

        setTimeout(function(){  
              initialize();
	          addMarker(-27.609959,-48.576585,'','casa',undefined,true)
        }, 1000)
      
        $('.cont_princ').fadeIn(1000);

        return false
    })

}

loadDinnmic()

