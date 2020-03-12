flag = true;
$(window).scroll(function() {
    $('#loader').hide();    
    if($(window).scrollTop() + $(window).height() >= $(document).height()-1200 ){
		first = $('#first').val();
		limit = $('#limit').val();
		no_data = true;
		if(flag && no_data){
		  flag = false;
			$('#loader').show();
			$.ajax({
				//url : 'https://www.autounica.com/it/ricerca-ajax.php',
                url : 'http://autounica.clickitsolutions.it/it/ricerca-ajax.php',
				method: 'post',
				data: {
				   start : first,
				   limit : limit
				},
				success: function( data ) {
					flag = true;
					$('#loader').hide();
					if(data !=''){
						
						first = parseInt($('#first').val());
						limit = parseInt($('#limit').val());
						$('#first').val( first+limit );
						$('#elencoauto').append( data );
						//year--;
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