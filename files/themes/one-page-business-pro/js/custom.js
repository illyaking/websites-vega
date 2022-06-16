jQuery(document).ready(function(){
jQuery('#cont_sub').click(function(e){
		e.preventDefault();
	        var un=jQuery('#name').val();
	        var em=jQuery('#email').val();
	        var meesg=jQuery('#message').val();
	         jQuery.ajax({
	                type: "POST",
	                url: ajax_url,
	                data: {
	                    'action':'ajax_contact_mail',
	                    'username':un,
	                    'useremail':em,
	                    'mesg':meesg,
	                    },
	                success: function(res) {
	                    var result = res;
	                    var message = result.substr(0, result.length - 1);
	                    switch(message) {
	                        case "mail_sent":
	                                jQuery('#name').val("Your Name");
	                                jQuery('#email').val("Your Email");
	                                jQuery('#message').val("Your message");
	                             document.getElementById('success').innerHTML="Thank you for contacting us. We will get back to you within 48 business hours.";
	                             break;

	                         case "mail_error":
	                             jQuery('#name').val(un);
	                                jQuery('#email').val(em);
	                                jQuery('#message').val(meesg);
	                             document.getElementById('success').innerHTML="We're sorry, but your message was not successfully delivered. Please call and leave us a message.";
	                             break;


	                         default:
	                             document.getElementById('success').innerHTML="Something is wrong. Please try again.";
	                    }
	                }
	            });
	    });
})
