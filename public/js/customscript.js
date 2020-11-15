$(document).ready(function(){
	$(".block-send-message").hide();
	$(".errorMessage").hide();
	$(".person").click(function(){
		var toUser = $(this).attr('id');
		$("#to-user").val(toUser);
		$(".block-send-message").show();

		$.ajax({
		   	url:"/tchat/chats/conversation?toUser=" + toUser,
		   	method:"GET",
		   	dataType: 'json',
		   	success:function(response){
		    	$(".selected-user").html('');
		    	$(".chatContainerScroll").html('');
		    	if(response.result.length > 0){
		    		$(".selected-user").append("<span>à: <span class='name'>"+response.result[0].email+"</span></span>");
		    		$.each(response.result,function(index,element){
		    			//alert(element.created_at);
		    			var dateMessage = new Date(element.created_at);
		    			if(toUser != element.to_user){
		    				$(".chatContainerScroll").append('<li class="chat-left"><div class="chat-avatar"><img src="../public/img/profile-img.png" ><div class="chat-name">'+element.email.substring(0,6)+'</div></div><div class="chat-text">'+element.message+'</div><div class="chat-hour">'+dateMessage.getHours()+':'+dateMessage.getMinutes()+' <span class="fa fa-check-circle"></span></div></li>');
		    			}
		    			else{
		    				$(".chatContainerScroll").append('<li class="chat-right"><div class="chat-avatar"><img src="../public/img/profile-img.png" ><div class="chat-name">'+element.email.substring(0,6)+'</div></div><div class="chat-text">'+element.message+'</div><div class="chat-hour">'+dateMessage.getHours()+':'+dateMessage.getMinutes()+' <span class="fa fa-check-circle"></span></div></li>');	
		    			}
		    		});
		    	}
		   }
		})

	})

	$( "#message" ).keypress(function() {
	  $(".errorMessage").hide();
	});

	$("#sendMessage").click(function(){
		$(".block-send-message").show();
		var toUser = $("#to-user").val();
		var message = $("#message").val();
		$(".errorMessage").hide();
		if(message == ""){
			$(".errorMessage").show();
			return false;
		}
		$.ajax({
		   	url:"/tchat/chats/sendmessage",
		   	method:"POST",
		   	dataType: 'json',
		   	data:{toUser:toUser,message:message},
		   	success:function(response){
		    	$(".selected-user").html('');
		    	$(".chatContainerScroll").html('');
		    	if(response.result.length > 0){
		    		$(".selected-user").append("<span>à: <span class='name'>"+response.result[0].email+"</span></span>");
		    		$.each(response.result,function(index,element){
		    			//alert(element.created_at);
		    			var dateMessage = new Date(element.created_at);
		    			if(toUser != element.to_user){
		    				$(".chatContainerScroll").append('<li class="chat-left"><div class="chat-avatar"><img src="../public/img/profile-img.png" ><div class="chat-name">'+element.email.substring(0,6)+'</div></div><div class="chat-text">'+element.message+'</div><div class="chat-hour">'+dateMessage.getHours()+':'+dateMessage.getMinutes()+' <span class="fa fa-check-circle"></span></div></li>');
		    			}
		    			else{
		    				$(".chatContainerScroll").append('<li class="chat-right"><div class="chat-avatar"><img src="../public/img/profile-img.png" ><div class="chat-name">'+element.email.substring(0,6)+'</div></div><div class="chat-text">'+element.message+'</div><div class="chat-hour">'+dateMessage.getHours()+':'+dateMessage.getMinutes()+' <span class="fa fa-check-circle"></span></div></li>');	
		    			}
		    		});
		    	}
		    	$("#message").val('');
		   }
		})
	})

});


