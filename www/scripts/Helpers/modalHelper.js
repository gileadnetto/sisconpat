var modalHelper = function(){
	
	var modalCreate = function(title, body, footer)
	{
		var modalHtml = [
			'<form class="modal fade " id="form_' + title + '" method="POST"  action="" enctype="multipart/form-data"  >',
			'<div class="modal-dialog ">',
				'<div class="modal-content">',
					'<div class="modal-header  modal-header-info ">',
						'<button type="button" class="close"	data-dismiss="modal">',
							'<span>&times;</span>',
						'</button>',
						'<center><h3 class="modal-title">' + title + '</h3></center>',
					'</div>',

					'<div class="modal-body">',
						body,
                  	'</div>',
					                    
					'<div class="modal-footer">',
						footer,
					'</div>',
				'</div>',
			'</div>',
		'</form>',
		];
		
		return modalHtml.join('');
	}
	return {
		modalCreate : modalCreate
	};
}

var modalhelper = new modalHelper();

