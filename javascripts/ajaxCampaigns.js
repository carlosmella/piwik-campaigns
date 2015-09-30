
(function (require,$) {
  	
    $( document ).ajaxComplete(function(){ 
	
	$( "#submitCampaña" ).click( function() {
		var flag = true;
		$('.required').each(function(){
			$(this).removeClass("empty");
			if($(this).val() == ''){
				$(this).addClass("empty");
				flag = false;
			}
		});
		if(flag == true){
		var parametros = {};
		parametros.url = encodeURIComponent($('#url').val());
		parametros.nombre = encodeURIComponent($('#nombre').val());
		parametros.module = 'Campaigns';
		parametros.action = 'insertarCampanha';
		
		var ajax = new ajaxHelper();
		ajax.addParams(parametros,'get');
   		ajax.setUrl('index.php?module=Campaigns&action=insertarCampanha');
    		ajax.setCallback(function (response) {
	        	$('#content').html(response);
		});
		ajax.setFormat('html'); // the expected response format
    		ajax.send();
		}
	});	
 
	$( '[id^=eliminarCampaña]' ).click(function(){
		
		if(confirm("Desea eliminar la campaña?") == true){
		var id = $(this).attr('value');
		
		var parameters = {};
		parameters.module = 'API';
		parameters.action = 'eliminarCamapanha';
		parameters.id = id;

		var ajax = new ajaxHelper();
		ajax.addParams(parameters,'get');
   		ajax.setUrl('index.php?module=Campaigns&action=eliminarCampanha');
    		ajax.setCallback(function (response) {
	        	$('#content').html(response);
		});
		ajax.setFormat('html'); // the expected response format
    		ajax.send();
		}		
	});
 
    })
   })(require, jQuery); 
