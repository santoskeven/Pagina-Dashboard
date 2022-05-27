function statusMail(){
    $('.content').css({'margin-top': '1rem','opacity': '1' });
     setTimeout( () => {
        $('.content').css({'margin-top': '-5rem','opacity': '0' });
     }, 3000)
}

$(function(){

    $('body').on('submit','form', function(){
        var form = $(this);

        $.ajax({

            beforeSend:function(){
                $('.loader_ajax').fadeIn();
            },

            url:  include_path+'ajax/form.php',
            method: 'post',
            dataType: 'json',
            data:form.serialize()
        }).done(function(data){
            if(data.sucesso){
                $('.loader_ajax').fadeOut();

                // PARA MOSTRAR STATUS DE ENVIO DO EMAIL
                $('.content').html(data.sendTrue);
                statusMail()      

            }
            if(data.erro){
               $('.content').html(data.sendFalse);
               console.log('Falha ao enviar Email');
            }
        });
    
  
        
        return false;

    })

})