

              // código javascript  
              $(document).ready( function (){

                carregarConteudo();
    
           
              
            function carregarConteudo(){

                   $.ajax({
                url:'getUsuario', 

            success: function(data){
             $('#conteudo').html(data); 


            //botoes CRUD da tabela
          $('.btn_deletar').click(function(){
            var id = $(this).data('id'); //id passada ao criar o botao 
                      
                  
                  $.ajax({
                    url: 'deletUsuario',
                    method: 'post',
                    data: { id: id},
                    success:function(data){
                       $('#alert_msg').html('Deletado');//colocar a msg 
                       $('#alerta').show('fade');
                        carregarConteudoFora();

                                      setTimeout(function () {
                                          $('#alerta').hide('fade');
                                      }, 2000);  

                                                   
                    }

                  });

              }); 

                                          
            },
              //continuação do ajax v

                              //exemplo extra 
                            beforeSend: function (){
                              $('#loader').css({display:"block"});


                            },

                            complete: function(){
                              $('#loader').css({display:"none"});

                            }
                            });

      } // fim da funcao carregar conterudo

             
             

            });

            function cadastrar(){
                 

               $.ajax({
                url:'cadastrarUsuario', 
                method:'post',
                data:$('#cadastro_form').serialize(), //essa função manda os dados dos formularios q estao dentro do form

           success: function(data){

              
              
                  var result = $.trim(data);//converter em string a resposta do webservice
                  //alert(data);
                 if(result==='true'){
                   
                   // $('#erro_tombamento').css({display:"none"});
                    $('#alert_msg').html('Adicionado');//setar a msg de sucesso
                 
                   $('#alerta').show('fade');

                  setTimeout(function () {
                    $('#alerta').hide('fade');
                    }, 2000);
                    carregarConteudoFora() 
                   

              
               
                }else{
                 
                  // $('#erro_tombamento').css({display:"block"});

                    $('#alert_msg_erro').html('Nao foi adicionado');//setar a msg de erro
                
                    $('#alerta_erro').show('fade');

                  setTimeout(function () {
                    $('#alerta_erro').hide('fade');
                    }, 2000); 

                  //document.location = "produto.php?error=1";;
                 
                    } 

                                                                       
           }
          

          
          });

              }//FIM DA FUNÇÃO CADASTRAR



                function atualizarUsuario(){
                 

               $.ajax({
                url:'updateUsuario', 
                method:'post',
                //data: {id : $('#texto_tweet').val() },
                //ou assim 
                data:$('#modal_atualizacao').serialize(), //essa função manda os dados dos formularios q estao dentro do form

           success: function(data){
                  var result = JSON.parse(data);
                 if( !result.erro){
                   
                    $('#erro_tombamento').css({display:"none"});
                    $('#alert_msg').html('Atualizado');//setar a msg de sucesso
                 
                   $('#alerta').show('fade');

                  setTimeout(function () {
                    $('#alerta').hide('fade');
                       location.reload();
                     //$('##modal_atualizacao').modal('toggle');
                     // $('#modal_atualizacao').attr({"style":"display: none;"});
                     // $('body').removeClass('modal-open');
                    }, 2000);

                   
                    carregarConteudoFora() 
                   

              
               
                }else{
                 
                   $('#erro_tombamento').css({display:"block"});

                    $('#alert_msg_erro').html('Nao foi Atualizado');//setar a msg de erro
                
                    $('#alerta_erro').show('fade');

                  setTimeout(function () {
                    $('#alerta_erro').hide('fade');
                    }, 2000); 

                  //document.location = "produto.php?error=1";;
                 
                    } 

                                                                       
           }
          

          
          });

              }//FIM DA FUNÇÃO ATUALIZAR









//verificar uma maneira melhor de  atualzar o conteudo cadastrado pois esta funcao é duplicada so que pelo document.reaDY  não é reconhecido

              function carregarConteudoFora(){

                   $.ajax({
                url:'getUsuario', 

            success: function(data){
             $('#conteudo').html(data); 


            //botoes CRUD da tabela
          $('.btn_deletar').click(function(){
            var id = $(this).data('id'); //id passada ao criar o botao 
                      
                  
                  $.ajax({
                    url: 'deletUsuario',
                    method: 'post',
                    data: { id: id},//manda uma variavel data-id do botao do getUsuario  . com o nome de id para ser pego no deletUsuario
                    success:function(data){
                       $('#alert_msg').html('Deletado');//colocar a msg 
                       $('#alerta').show('fade');

                                      setTimeout(function () {
                                          $('#alerta').hide('fade');
                                      }, 2000);  

                                        carregarConteudoFora(); //atualizar a pagina apos deletado            
                    }

                  });

              }); 

                                          
            },
              //continuação do ajax v

                              //exemplo extra 
                            beforeSend: function (){
                              $('#loader').css({display:"block"});


                            },

                            complete: function(){
                              $('#loader').css({display:"none"});

                            }
                            });

      } // fim da funcao carregar conterudo

