
$( document ).ready(function() {

    var pagina =$(this); 
    var menu = pagina.find('.menu');
    var subMenu = menu.find('ul li ul') ;
    var bottao = pagina.find('.buttonNav');
        
    //Remover as  classes quando clicar fora do menu 
    $('.conteudo').click(function(evt){
        menu.removeClass('aberto');
        bottao.removeClass("ativo");
        subMenu.slideUp();
    });

    //click no botao hamburger do menu
    pagina.on('click' , '.buttonNav a', function(){
        bottao.toggleClass("ativo");
        
        if( bottao.hasClass("ativo")){
            
            menu.addClass('aberto');
        }
        
        else{
            menu.removeClass('aberto');
            subMenu.slideUp();
                
        }
    
    });
    
    menu.on('click', 'ul li a', function( event ){
       
        //verificar se temos sub lista
        if( $(this).siblings('ul').length >= 1 ){
            event.preventDefault();
            if( subMenu.css('display') == 'none' ){
                subMenu.slideDown();

                bottao.addClass("ativo");
                menu.addClass('aberto');
                
            }
            else{
                subMenu.slideUp();
            }
        }

        
           
    });

    var resolucao = $( window ).width();
    setviewPort(resolucao);

    $( window ).resize(function() {
        resolucao = $( window ).width();
        setviewPort( resolucao )
                    
    });

    pagina.on('click','.sair',function(){
        window.location.href = "sair"; 
    })

    function setviewPort(resolucao){
        if(resolucao <= 630){
            pagina.find('.buttonNav').removeClass("ativo");
            pagina.find('.barraPerfil  img').hide();
            menu.removeClass('aberto');
            menu.addClass('mobile');
            bottao.addClass('mobile');
        
            $('body').css('padding-left', '0');
        }
        else{
            $('body').css('padding-left', '55px');

            pagina.find('.buttonNav').removeClass("ativo");
            menu.removeClass('aberto');
            menu.removeClass('mobile');
            pagina.find('.barraPerfil img').show();
            bottao.removeClass('mobile');
        }
    }

});