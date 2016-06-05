$(document).ready(function(){

	if ( $('#gallery').length ) {

		$('#gallery').unitegallery({
			gallery_theme: "tiles"	
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