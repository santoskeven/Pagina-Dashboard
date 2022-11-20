$(window).on("load", function(){

        const target = document.getElementsByClassName('tag_left');

    $('.bars').on('click', () => {

        for(let i=0; i < target.length; i++){
            
            if(target[i].classList.contains('left_act')){
                target[i].classList.remove('left_act');
                target[0].style.width = '30%';
                target[1].style.width = '100%';
                target[1].style.padding = '1rem 0 0 0';
                target[2].style.width = '100%';

            }else{
                target[i].classList.add('left_act');
                target[0].style.width = '0%';
                target[2].style.width = '100%';
            }
        }

    })
       
   
        


 });
