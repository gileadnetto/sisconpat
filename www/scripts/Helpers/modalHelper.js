var modalHelper = function(){
	
	var modalCreate = function(id, title, body, footer)
	{
		var modalHtml = [
			'<form class="modal fade " id="' + id + '" method="POST"  action="" enctype="multipart/form-data"  >',
				'<div class="modal-dialog modal-dialog-centered ">',
					'<div class="modal-content">',
						'<div class="modal-header  modal-header-info ">',
						'<center><h3 class="modal-title">' + title + '</h3></center>',
						'<button type="button" class="close"	data-dismiss="modal">',
							'<span>&times;</span>',
						'</button>',
						'</div>',

						'<div class="modal-body"><div class="row">',
							body,
						'</div></div>',
											
						'<div class="modal-footer"><div class="">',
							footer,
						'</div></div>',
					'</div>',
				'</div>',
			'</form>',
		];
		
		var modal = modalHtml.join(''); 
		
		return $(modal); 
	}
	return {
		modalCreate : modalCreate
	};
}

var modalhelper = new modalHelper();

