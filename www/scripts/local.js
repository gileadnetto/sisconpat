   // código javascript  
   $(document).ready( function (){


    carregarConteudo(); //chamando a funcao para carregar o conteudo na div conteudo


           function carregarConteudo(){                          
                            
                          
                 $.ajax({
                 url:'getLocalidade', 

                          success: function(data){
                    $('#conteudo').html(data); 



                            //botoes CRUD da tabela
                                  $('.btn_deletar').click(function(){
                                    var id_local = $(this).data('id_local'); //id passada ao criar o botao 
                                          //alert(id_local);

                                       
                                            $.ajax({

                                              url:'deletLocal',
                                              method:'post',
                                              data: {id_local : id_local},//mandar a var id_local para outra pagina com o nome da variavel id_local
                                                                             

                                              success: function(data){ 


                                                var result = $.trim(data);//converter em string a resposta do webservice

                                                   if(result==='true'){

                                                     
                                                    //  $('#erro_delet').css({display:"none"});
                                                      $('#alert_msg').html('deletada');//setar a msg de sucesso
                                                   
                                                     $('#alerta').show('fade');

                                                    setTimeout(function () {
                                                      $('#alerta').hide('fade');
                                                      }, 2000); 
                                                     
                                                    carregarConteudo(); //atualizar a pagina apos deletado   
                                                
                                                 
                                                  }else{
                                                   
                                                     $('#erro_delet').css({display:"block"});

                                                      $('#alert_msg_erro').html('<strong> contem produtos cadastrados </strong>');//setar a msg de erro
                                                  
                                                      $('#alerta_erro').show('fade');

                                                    setTimeout(function () {
                                                      $('#alerta_erro').hide('fade');
                                                      }, 2900); 

                                                    //document.location = "produto.php?error=1";;
                                                   
                                                      } 


                                              }


                                            });
                                                  }); 
                                                                         
                                                         },

                                              
                                            beforeSend: function (){
                                              $('#loader').css({display:"block"});


                                            },

                                            complete: function(){
                                              $('#loader').css({display:"none"});

                                            }
                                            });    

             
              }//fim da função carregar conteudo

              
                
              });




              function cadastrar(){

                             $.ajax({
                            url:'cadastrarLocal', 
                            method:'post',
                            data:$('#form_cadastrar').serialize(), //essa função manda os dados dos formularios q estao dentro do form

                        success: function(data){
                          var result = JSON.parse(data);


                            if(!result.erro){                    
                                  $('#alert_msg').html('Adicionada');//setar a msg de sucesso
                                 $('#alerta').show('fade');
                                setTimeout(function () {
                                  $('#alerta').hide('fade');
                                 // document.location = "escola.php";
                                     }, 2000); 
                               
                    
                            carregarConteudoFora();


                              }else{
                               
                                
                                  $('#alert_msg_erro').html('Nao foi possivel adicionar');//setar a msg de erro
                              
                                  $('#alerta_erro').show('fade');

                                setTimeout(function () {
                                  $('#alerta_erro').hide('fade');
                                  }, 2000); 

                                //document.location = "produto.php?error=1";;
                               
                                  } 

                                                                                   
                        }
                      

                      
                      });


              }//fim funcao cadastrar
              
              function atualizarlocal(){
                var form = $("#modal_atualizacao")[0];
                 //var dados = new FormData(form);
                form = $(form).serialize()
               
                //alert(dados +"/"+form);
            
                //var dados = $('#modal_atualizacao').serialize();
                //alert(dados);
                $.ajax({
                    url:'updateLocal', 
                    method:'post',
                    data:form,
                    success: function(data){
                      
                        var result = JSON.parse(data);
                        
                        if(!result.erro){
                            $('#alert_msg').html('Atualizado');//setar a msg de sucesso
                            $('#alerta').show('fade');
                            setTimeout(function () {
                            $('#alerta').hide('fade');
                            }, 2000);
                            $('[data-dismiss="modal"]').trigger('click');
            
                            carregarConteudoFora() 
                        }
                        else{
            
                            $('#erro_tombamento').css({display:"block"});
            
                            $('#alert_msg_erro').html('Nao foi Atualizado');//setar a msg de erro
            
                            $('#alerta_erro').show('fade');
            
                            setTimeout(function () {
                                $('#alerta_erro').hide('fade');
                            }, 2000); 
            
                            //document.location = "produto.php?error=1";;
                        } 
                    },
                    beforeSend: function (){
                        document.getElementById("btn_atualizar").innerHTML = '<i class="fa fa-spinner fa-pulse"></i> ATUALIZANDO';
            
                    },
                    complete: function(){
                        let x = $("#modal_atualizacao")[0];
                        let input =$(x).find('input');
                        input.each(function() {
                          $(this).val('');
                        });
                        document.getElementById("btn_atualizar").innerHTML = "ATUALIZAR";
                    }
                });
            }//FIM DA FUNÇÃO ATUALIZAR
            

                function carregarConteudoFora(){                          
                            
                          
                 $.ajax({
                 url:'getLocalidade', 

                          success: function(data){
                    $('#conteudo').html(data); 



                            //botoes CRUD da tabela
                                  $('.btn_deletar').click(function(){
                                    var id_local = $(this).data('id_local'); //id passada ao criar o botao 
                                          //alert(id_local);

                                       
                                            $.ajax({

                                              url:'deletLocal',
                                              method:'post',
                                              data: {id_local : id_local},//mandar a var id_local para outra pagina com o nome da variavel id_local
                                                                             

                                              success: function(data){ 
                                              
                                                data = JSON.parse(data)
                         
                                                   if(!data.erro){

                                                     
                                                    //  $('#erro_delet').css({display:"none"});
                                                      $('#alert_msg').html('deletada');//setar a msg de sucesso
                                                   
                                                     $('#alerta').show('fade');

                                                    setTimeout(function () {
                                                      $('#alerta').hide('fade');
                                                      }, 2000); 
                                                     
                                                    carregarConteudoFora(); //atualizar a pagina apos deletado   
                                                
                                                 
                                                  }else{
                                                   
                                                     $('#erro_delet').css({display:"block"});

                                                      $('#alert_msg_erro').html('<strong> contem produtos cadastrados </strong>');//setar a msg de erro
                                                  
                                                      $('#alerta_erro').show('fade');

                                                    setTimeout(function () {
                                                      $('#alerta_erro').hide('fade');
                                                      }, 2900); 

                                                    //document.location = "produto.php?error=1";;
                                                   
                                                      } 


                                              }


                                            });
                                                  }); 
                                                                         
                                                         },

                                              
                                            beforeSend: function (){
                                              $('#loader').css({display:"block"});


                                            },

                                            complete: function(){
                                              $('#loader').css({display:"none"});

                                            }
                                            });    

             
              }//fim da função carregar conteudofora