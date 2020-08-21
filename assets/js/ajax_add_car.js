$(function(){
		$('#price').mask('000.000.000.000.000,00',{reverse: true});
		$('#year').mask('0000');	
	});

$('.brands').on('change', function(){
	var brand = $(this).val();
	
	$.ajax({
			url: 'models_cars.php',
			data: {brand:brand},
			type: 'POST',
			dataType: 'json',
			beforeSend: function(data){
				$('.models').html('<option value="" selected="">Carregando modelo...</option>');
			},
			success: function(data){
				$('.models').html('<option value="" selected="">Selecione o modelo </option>');
			
				if(data.models){
					$.each(data.models, function(key, value){
						$('.models').append("<option value='"+value['id_model']+"'>"+value['model_name']+" </option>");
					});
				}
			}
		});
});
		
		