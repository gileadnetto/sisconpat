$(document).ready(function () {

	$("#datepicker-group").datepicker({
		format: 'dd/mm/yyyy',
		todayBtn: true,
		language: "pt-BR",
		todayHighlight: true,
		autoclose: true,
	})

	// $('body').on('shown.bs.modal', '.modal', function () {
    // 	$(this).find('select').each(function () {
	// 	var dropdownParent = $(document.body);
	// 	if ($(this).parents('.modal.in:first').length !== 0)
	// 		dropdownParent = $(this).parents('.modal.in:first');
	// 		$(this).select2({
	// 			dropdownParent: dropdownParent,
	// 		});
	// 	});
 	//  });

});