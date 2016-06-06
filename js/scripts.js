$(document).ready(function(){

	if ( $('#gallery').length ) {

		$('#gallery').unitegallery({
			gallery_theme: "tiles"	
		});

	}

});

$('.contact-form').validate({

	rules: {
     // no quoting necessary
	    name: {
	    	required: true,
	    },
	    email: {
	    	required: true,
	    	email: true
	    },
	    message: {
	    	required: true
	    }
	},

	messages: {
		name: "Please enter your name",
		email: {
			required: "Please enter your email address",
			email: "Please enter a valid email address (e.g., name@example.com)"
		},
		message: "Please enter a message"
	},

    submitHandler: function(form) {
        $.ajax({
        	type: 'POST',
            url: '/rileyboyd2015/wp-content/themes/rileyboyd-wptheme-2016/forms/contactform.php',
            data: $(form).serialize(),
            success: function(response) {
				console.log('Ajaxed');            
			}            
        });
    }

});

// Avoid spam
var datCom = 'LmNvbQ=='
var datWord = 'RW1haWw=';
var datDomane = 'cmlsZXlib3lk'
var userReachout = 'Y29udGFjdA==';
var datSymb = 'QA==';
var datSned = atob(userReachout)+atob(datSymb)+atob(datDomane)+atob(datCom);
 
var reachoutBox = '<div class="row reachouttext"><div class="col-sm-10 col-sm-push-1"><p>'+atob(datWord)+': <a href="mailto:'+datSned+'" target="_blank">'+datSned+'</a></p><p>Or, use this form. It all goes to the same place.</p></div></div>';
$('.contact-content').prepend(reachoutBox);

//console.log('.com'); // Outputs: "SGVsbG8gV29ybGQh"

// Decode the String
//var decodedString = atob('SGVsbG8gV29ybGQh');
//console.log(decodedString); // Outputs: "Hello World!"