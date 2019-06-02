
 // código javascript  
 $(document).ready( function (){


  $('#local_opcoes_busca').change( function(){

   //var local_inicial = document.getElementById('local_id_inicial').value;
   var local_inicial = document.getElementsByName("local_inicial")[0].value ;
    //alert(local_inicial[0].value );
    
        //controle do dropdown                    
   // var selecionado_inicio = $("select option[value='" + local_inicial +"']");
  //  selecionado_inicio.prop('disabled', true); //disable local inicio select
   // $('select[name ="local_inicial"]').change(function () {
   // selecionado_inicio.prop('disabled', false); //enable when value do local inicial select is changed
            
//  });
        carregarConteudo(local_inicial);
  

   });


  
  carregarConteudo(1);//carrega os produtos do galpao id 1 



function carregarConteudo(local_inicial){

     $.ajax({
  url:'getProdutoTransferencia', 
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

} // fim da funcao carregar conteudo

// chamada das opçoes de locais no dropdown
$.ajax({
  url:'getOptionTransferencia', 
  //url:'getOptionLocal', 

success: function(data){
$('#local_opcoes_busca').html(data);

                              
}              
});

$.ajax({
  url:'getOptionDestino', 
 // url:'getOptionLocal', 

success: function(data){
$('#local_opcoes_destino').html(data);

                              
}              
});

    
});

        
   
    
function tramitar(){                  

 $.ajax({
  //url:'escolhasTransferencias.php', 
  url:'cadastrarTransferencia',
  method:'post',
  //data: {texto_tweet : $('#texto_tweet').val() },
  //ou assim 
  data:$('#tramitar_id_form').serialize(), //essa função manda os dados dos formularios q estao dentro do form

success: function(data){
//alert(data);
  
var result = $.trim(data);//converter em string a resposta do webservice

if(result==='erro locais'){                     
     
      $('#alert_msg_erro').html('impossivel realizar transação para o mesmo estabelecimento');//setar a msg de sucesso
   
     $('#alerta_erro').show('fade');

    setTimeout(function () {
      $('#alerta_erro').hide('fade');
      }, 2500);
                                                                        
}
        
else if(result==='erro vazio'){                   
    
      $('#alert_msg_erro').html('Nenhum Produto foi selecionado para transferencia');//setar a msg de sucesso
   
     $('#alerta_erro').show('fade');

    setTimeout(function () {
      $('#alerta_erro').hide('fade');
      }, 2500);
  }

else if(result==='inicial incorreto'){                   
    
      $('#alert_msg_erro').html('Local Inicial Incorreto');//setar a msg de sucesso
   
     $('#alerta_erro').show('fade');

    setTimeout(function () {
      $('#alerta_erro').hide('fade');
      }, 2500);
  }
       
else if(result==='destino incorreto'){                   
    
      $('#alert_msg_erro').html('Destino incorreto ');//setar a msg de sucesso
   
     $('#alerta_erro').show('fade');

    setTimeout(function () {
      $('#alerta_erro').hide('fade');
      }, 2500);
       
      
     

                                                         
}
else{
 $('#alert_msg').html('Transferencia realizada com sucesso');//setar a msg de sucesso
   
     $('#alerta').show('fade');
      carregarConteudoFora(document.getElementsByName("local_inicial")[0].value);

    setTimeout(function () {
      $('#alerta').hide('fade');
      window.open('gerarPDFTransferencia?idTransferencia='+data, '_blank');//gerar pdf para imprimir
      }, 2000);
      
      //window.open('gerarPDFTransferencia.php?idTransferencia='+data, '_blank'); //abrir em um nova aba
      // window.location.href = 'gerarPDFTransferencia.php?idTransferencia='+data;
       
}
}


});
}//fim funcao tramitar


function carregarConteudoFora(local_inicial){

     $.ajax({
  url:'getProdutoTransferencia', 
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

} // fim da funcao carregar conteudofora





