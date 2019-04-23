$(document).ready(function(){
	chatData();
	fetch();

	document.querySelector("#newmessage").onsubmit = function(event){
		// Stop the browser from submitting the form
		event.preventDefault();

		var urlParams = new URLSearchParams(window.location.search);
		console.log(urlParams.get('id'));

		var message = $('#message').val();
		$.ajax({
			method: 'POST',
			url: 'addMessage.php?id=' + urlParams.get('id'),
			data: {message: message}
		})
		.done(function(msg){
			console.log("data saved: " + msg);
		});
		
	}

});

function fetch(){
	setTimeout(function(){
	chatData();
	fetch();
	}, 500);
}

function chatData(){

	var urlParams = new URLSearchParams(window.location.search);
	console.log(urlParams.get('id'));

	$.ajax({

		url: "chatRoomsXML/chatRoom" + urlParams.get('id') + ".xml" ,
		dataType: "xml",
		success: function(data) {

			$("ul").children().remove();

			$(data).find("message").each(function() {

				if(urlParams.get('user') == $(this).find("from").text()){ // right side
					var info =	'<li id="right" class="right">From: <span class="bold">' + $(this).find("from").text() + '</span></li>' +
								'<div class="clear"></div>' + 
								'<div class="message right" id="mess">' +
									 $(this).find("text").text() + 
									'<div class="date-time">' +
										 'Date: ' + $(this).attr("date") + ' Time: ' + $(this).attr("time") +
									'</div>' +
								'</div>' + 
								'<div class="clear"></div>';

					$("ul").append(info);

				}else{ // left side
						var info =	'<li class="">From: <span class="bold">' + $(this).find("from").text() + '</span></li>' +
								'<div class="clear"></div>' + 
								'<div class="message">' +
									 $(this).find("text").text() + 
									'<div class="date-time">' +
										 'Date: ' + $(this).attr("date") + ' Time: ' + $(this).attr("time") +
									'</div>' +
								'</div>' + 
								'<div class="clear"></div>';

					$("ul").append(info);
				}

			});
		}
	});
}