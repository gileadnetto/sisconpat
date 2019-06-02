
$(document).ready( function (){

    carregarConteudo();

    function carregarConteudo(){

        $.ajax({
            url:'getItens', 

            success: function(data){
                $('#conteudo').html(data);

                //botoes CRUD da tabela
                $('.btn_deletar').click(function(){
                var tombamento = $(this).data('tombamento'); //id passada ao criar o botao 


                $.ajax({
                    url: 'deletProduto',
                    method: 'post',
                    data: { tombamento: tombamento},

                    success:function(data){
                        //alert(data)
                        $('#alert_msg').html('Deletado');//colocar a msg 
                        $('#alerta').show('fade');
                        carregarConteudoFora();

                        setTimeout(function () {
                            $('#alerta').hide('fade');
                        }, 2000);  

                    }
                });
            }); //fim funcao excluir

            },//continuação do ajax principal
    
            beforeSend: function (){
                $('#loader').css({display:"block"});
            },

            complete: function(){
                $('#loader').css({display:"none"});
            }
        });
    } // fim da funcao carregar conteudo

    // chamada das opçoes de locais no dropdown
    $.ajax({
        url:'getOptionLocal', 
            success: function(data){
                $('#local_opcoes').html(data);
                $('#local_opcoes_modal').html(data);  
            }              
        });

        // chamada das opçoes busca no dropdown
        $.ajax({
            url:'dao/localDAO/getOptionBusca.php', 
            success: function(data){              
                $('#local_opcoes_busca').html(data);  
            }              
        });

        //forma de evento para funcionar em mobile
        //funcao para pesquisa por produto
        $(document).on('keyup',"#produto_busca", function(){
            var query = (document.getElementById('produto_busca').value);
            if(query.length >= 0){
                $.ajax({
                    url:'buscaProduto', 
                    method: 'post',
                    data: {query: query},

                    success: function(data){
                        $('#conteudo').html(data);
                        //botoes CRUD da tabela
                        $('.btn_deletar').click(function(){
                        var tombamento = $(this).data('tombamento'); //id passada ao criar o botao 

                        $.ajax({
                            url: 'deletProduto',
                            method: 'post',
                            data: { tombamento: tombamento},//manda uma variavel data-tombamento do botao do getProduto  . com o nome de tombamento para ser pego no deletProduto
                            success:function(data){
                                var result = $.trim(data);

                                if(result==="false"){
                                    $('#alert_msg_erro').html('Nao foi Deletado');//setar a msg de erro
                                    $('#alerta_erro').show('fade');
                                    
                                    setTimeout(function () {
                                        $('#alerta_erro').hide('fade');
                                    }, 3000); 

                                }
                                else{
                                    $('#alert_msg').html('Deletado');//colocar a msg 
                                    $('#alerta').show('fade');

                                    setTimeout(function () {
                                        $('#alerta').hide('fade');
                                    }, 2000);  

                                    carregarConteudoFora(); //atualizar a pagina apos deletado   
                                }
                            }
                        }
                    );
                }); 
            },
            //continuação do ajax v
            beforeSend: function (){
                $('#loader').css({display:"block"});
            },

            complete: function(){
                $('#loader').css({display:"none"});
            }
        });
    }
});// fim evento Buscar 

//acoes para  aba busca{
$('#local_opcoes_busca').change( function(){
    //var local_inicial = document.getElementById('local_id_inicial').value;
    var local_inicial = document.getElementsByName("local_inicial_busca")[0].value ;
    //alert(local_inicial );
    carregarLocalConteudo(local_inicial);
});

carregarConteudo(1);//carrega os produtos do galpao id 1 

function carregarLocalConteudo(local_inicial){

    $.ajax({
        url:'dao/produtoDAO/getProdutoBusca.php', 
        method: 'post',
        data: { local_inicial: local_inicial},
        success: function(data){
            $('#conteudo').html(data); 
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

} // fim da funcao  busca por id dos locais

});//fim load

//FUNÇÂO DE CADASTRO
$(document).on('click',"#btn-cadastrar", function(e){
    e.preventDefault();
    var form = $("#modal_adicionar")[0];
    var formData = new FormData(form);
    //document.getElementById('onbot').value='Aguarde Gravando....';
    $.ajax({  
        type: "POST",                       
        url:'cadastrarProduto', 
        data: formData,
        processData:false,
        contentType:false,

        success: function(data){
            var result = JSON.parse(data);
            //console.log(result);

            if( !result.erro){
                $('#erro_tombamento').css({display:"none"});
                $('#alert_msg').html('Adicionado');//setar a msg de sucesso

                $('#alerta').show('fade');

                setTimeout(function () {
                    $('#alerta').hide('fade');
                }, 2000);
                
                window.location.reload();

                //carregarConteudoFora() 
            }
            else{
                $('#erro_tombamento').css({display:"block"});
                $('#alert_msg_erro').html(result.mensagem);//setar a msg de erro
                $('#alerta_erro').show('fade');

                setTimeout(function () {
                    $('#alerta_erro').hide('fade');
                }, 2000); 
                //document.location = "produto.php?error=1";;
            } 
        },
        beforeSend: function (){
            document.getElementById("btn-cadastrar").innerHTML = '<i class="fa fa-spinner fa-pulse"></i> Cadastrando';

        },
        complete: function(){
            document.getElementById("btn-cadastrar").innerHTML = "CADASTRAR";
            $("#foto-add").attr("src", "imagens/produtos/padrao.png");
            }      
        }); 

    return false;  
}); 

function cadastrar(){            

    var dados = $('#modal_adicionar').serialize();             

    $.ajax({
        url:'dao/produtoDAO/cadastrarProduto.php', 
        method:'post',
        //data:$('#cadastro_form').serialize(), //essa função manda os dados dos formularios q estao dentro do form
        //data:$('#modal_adicionar').serialize(),
        data:dados,

        success: function(data){
            //console.log(data);

            var result = JSON.parse(data);
            console.log(result);

            if( !result.erro){
                $('#erro_tombamento').css({display:"none"});
                $('#alert_msg').html('Adicionado');//setar a msg de sucesso
                $('#alerta').show('fade');

                setTimeout(function () {
                    $('#alerta').hide('fade');
                }, 2000);

                $('[data-dismiss="modal"]').trigger('click');

                carregarConteudoFora() 
            }
            else{

                $('#erro_tombamento').css({display:"block"});

                $('#alert_msg_erro').html('Nao foi adicionado');//setar a msg de erro

                $('#alerta_erro').show('fade');

                setTimeout(function () {
                $('#alerta_erro').hide('fade');
                }, 2000); 
            } 
        }
    });
}//FIM DA FUNÇÃO CADASTRAR

function atualizarProduto(){
    var form = $("#modal_atualizacao")[0];
    var dados = new FormData(form);
    //alert(dados +"/"+form);

    //var dados = $('#modal_atualizacao').serialize();
    //alert(dados);
    $.ajax({
        url:'updateProduto', 
        method:'post',
        processData:false,
        contentType:false,
      
        //data:$('#modal_atualizacao').serialize(), //essa função manda os dados dos formularios q estao dentro do form
        data:dados,
        success: function(data){
            var result = JSON.parse(data);
            
            if(!result.erro){
                $('#erro_tombamento').css({display:"none"});
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
            document.getElementById("btn_atualizar").innerHTML = "ATUALIZAR";
            $("#foto-add").attr("src", "imagens/produtos/padrao.png");
        }
    });
}//FIM DA FUNÇÃO ATUALIZAR

//verificar uma maneira melhor de  atualzar o conteudo cadastrado pois esta funcao é duplicada so que pelo document.reaDY  não é reconhecido

function carregarConteudoFora(){

    $.ajax({
        url:'getItens', 

        success: function(data){
            $('#conteudo').html(data); 

            //botoes CRUD da tabela
            $('.btn_deletar').click(function(){
            var tombamento = $(this).data('tombamento'); //id passada ao criar o botao 


            $.ajax({
                url: 'deletProduto',
                method: 'post',
                data: { tombamento: tombamento},//manda uma variavel data-tombamento do botao do getProduto  . com o nome de tombamento para ser pego no deletProduto
                
                success:function(data){
                    var result = JSON.parse(data);
                    console.log(data);
                    //alert(result);
                    if(result.erro){
                        $('#alert_msg_erro').html('Nao foi Deletado');//setar a msg de erro
                        $('#alerta_erro').show('fade');

                        setTimeout(function () {
                            $('#alerta_erro').hide('fade');
                        }, 3000); 
                    }                           
                    else{
                        $('#alert_msg').html('Deletado');//colocar a msg 
                        $('#alerta').show('fade');

                        setTimeout(function () {
                            $('#alerta').hide('fade');
                        }, 2000);  

                        carregarConteudoFora(); //atualizar a pagina apos deletado   
                    }
                }
            });
        }); 
    },
    //continuação do ajax v
    beforeSend: function (){
        $('#loader').css({display:"block"});
    },

    complete: function(){
        $('#loader').css({display:"none"});
    }
    });
} // fim da funcao carregar conteudo

//pacote  de tombamento 
$(document).on('keyup',"#tombamento_id", function(){
    var minimo = document.getElementById('tombamento_id').value;
    $("#tombamento_pacote").attr("min", minimo);
});

function readURL(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
        $('#'+id).attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}