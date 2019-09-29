jQuery(document).ready(function($) {
	$('.lambert_mailchimp-form').each(function(){
		var sub_form = $(this);
		sub_form.submit(function(e){
			e.preventDefault();

			sub_form.find('.sub-output').removeClass('error').fadeIn('slow').text(_lambert_sub.pl_w);

			var dataString = sub_form.serialize();
	            dataString += '&action=lambert_mailchimp';

	        var noredirect = true;
			$.ajax({
	            type: "POST",
	            data: dataString,
	            url: _lambert_sub.url,
	            // cache: false,
	            success: function(d) {
	            	//console.log(d.last_response);
	                if(d.success){
	                	if (d.success === 'yes') {
		                    if (noredirect) {
		                    	sub_form.find('.sub-output').removeClass('error').fadeIn('slow').text(d.message);//.delay(3000).fadeOut('slow');
		                    } 
		                    else {
		                        window.location.href = redirect;
		                    }
		                } else {
		                	sub_form.find('.sub-output').addClass('error').fadeIn('slow').text(d.message);//.delay(3000).fadeOut('slow');
		                }
	                }
	            }
	        });

		});
	});

});