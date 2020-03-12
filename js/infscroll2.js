flag = true;

$(window).scroll(function() {

    $('#loader').hide();    

    if($(window).scrollTop() + $(window).height() >= $(document).height()-1000 ){

		first = $('#first').val();

		limit = $('#limit').val();

        marca = $('#id_marca').val();

        modello = $('#id_modello').val();

		no_data = true;

		if(flag && no_data){

		  flag = false;

			$('#loader').show();

			$.ajax({

				url : 'http://autounica.clickitsolutions.it/it/ricerca-ajax-urlrw.php',

				method: 'post',

				data: {

				   start : first,

				   limit : limit,

                   marca : marca,

                   modello : modello

				},

				success: function( data ) {

					flag = true;

					$('#loader').hide();

					if(data !=''){

						

						first = parseInt($('#first').val());

						limit = parseInt($('#limit').val());

						$('#first').val( first+limit );

						$('#elencoauto').append( data );

						year--;

					}else{

						alert('No more data to show');

						no_data = false;

					}

				},

				error: function( data ){

					flag = true;

					$('#loader').hide();

					no_data = false;

					alert('Something went wrong, Please contact admin');

				}

			});

		}

		

		

	}

});	