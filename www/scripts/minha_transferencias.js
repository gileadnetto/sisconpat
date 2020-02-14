// código javascript  
$(document).ready(function () {

  carregarConteudo(); //chamando a funcao para carregar o conteudo na div conteudo


  function carregarConteudo() {

    $.ajax({
      url: 'getOptionLocal',

      success: function (data) {
        $('#local_opcoes').html(data);

        $('#local_opcoes_modal').html(data);

      }
    });



    $.ajax({
      url: 'getMinhasTransferencias',

      success: function (data) {
        $('#conteudo').html(data);
      },



      beforeSend: function () {
        $('#loader').css({ display: "block" });


      },

      complete: function () {
        $('#loader').css({ display: "none" });

      }
    });


  }//fim da função carregar conteudo



});

function abrir($id) {
  alert("id da transferencia " + $id);

}

function gerarPDF($id) {
  // alert("Futuramente ira gerar pdf " + $id + 'gerarPDF.php?idTransferencia='+$id+"'");

  // header('Location: gerarPDF.php'); 
  // header('Location: index.php?error=1');
  window.location.href = 'gerarPDF.php?idTransferencia=' + $id;
}

