$(document).ready(function () {
         
  $("#datepicker-group").datepicker({
    format: 'dd/mm/yyyy',
    todayBtn: true,
    language: "pt-BR",
    todayHighlight: true,
    autoclose: true,
    
    dayNames: ["Domingo", "Segunda", "Terça", "Quarte", "Quinta", "Sexta", "Sábado"],
    dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro']
  })
  
});