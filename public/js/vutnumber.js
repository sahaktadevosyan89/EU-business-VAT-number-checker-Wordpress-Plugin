$(document).ready(function(){
	var href = myVutnumber.pluginsUrl;
	  $("#vatnumber").blur(function(){
		var vat = $("#vatnumber").val();
		$.post(href+"/vatnumber/validate.php",
		{
		vatnumber:vat,
		},
		function(response,status){ 
			$('#vatnumber-result').html('');
			var res = $('#vatnumber-result').append(response);
			var isContains = $('.vatnumber-error-message').text().indexOf('some text') > -1;
			if( $( ".vatnumber-error-message" ).length){
				$('#register').prop('disabled', true).css({
					'cursor':'no-drop'
				});
			}else if($( ".vatnumber-success-message" ).length){
				$('#register').prop('disabled', false).css({
					'cursor':'pointer'
				});
			}
		});
		return false;
		
	});
});