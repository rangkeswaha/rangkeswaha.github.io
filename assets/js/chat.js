var loginId;
var intervalRefreshChat;
var scrollan = 0;
var notif_chat = 0;
$(document).ready(function() {	
	$.ajax({
		url: "/PTRutan/LEAPHRIS/kerjaan/ajax/getdatalogin.php",
		type: "GET",
		async: false,
		success:function(res){
			loginId = res;
		},
		error: function(a, err){
			//lakukan sesuatu untuk handle error
			console.log(err);
		}
	})
	
	$("#search-list-pegawai").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$(".list-pegawai-details-wrapper").filter(function() {
		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});

	$("#search-list-chat").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$(".list-chat-details-wrapper").filter(function() {
		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});

	$('#addNewChat').click(function(){
		getAllPegawai();
		var el = $('#list-pegawai-wrapper').parent('.scroll-content').show();
		if(el.length > 0){
			$('#chat-users').parent().hide(); 
			$('#list-pegawai-wrapper').parent('.scroll-content').show();  
		}
		else{
			$('#chat-users').hide();
		}
		$('#list-pegawai-wrapper').show(); 
	});
	
	$('.user-details-wrapper').click(function(){
		set_user_details($(this).attr('data-user-name'),$(this).attr('data-chat-status'));
		var el = $('#messages-wrapper').parent('.scroll-content').show();
		if(el.length > 0){
			$('#chat-users').parent().hide(); 
			$('#list-pegawai-wrapper').parent().hide(); 
			$('#messages-wrapper').parent('.scroll-content').show();  
		}
		else{
			$('#chat-users').hide();
			$('#list-pegawai-wrapper').hide(); 
		}
		$('#messages-wrapper').show(); 
		$('.chat-input-wrapper').show();
	});

	$('.list-pegawai-back').click(function(){
		var el = $('#list-pegawai-wrapper').parent('.scroll-content').show();
		if(el.length > 0){
			$('#chat-users').parent().show(); 
			$('#list-pegawai-wrapper').parent('.scroll-content').hide();  
		}
		else{
			$('#chat-users').show();
		}
		$('#list-pegawai-wrapper').hide(); 
	})
	$('.chat-back').click(function(){
		$('#messages-wrapper .chat-messages-header .status').removeClass('online');
		$('#messages-wrapper .chat-messages-header .status').removeClass('busy');
		var el = $('#messages-wrapper').parent('.scroll-content').show();
		if(el.length > 0){
			$('#chat-users').parent().show(); 
			$('#messages-wrapper').parent('.scroll-content').hide();  
		}
		else{
			$('#chat-users').show();
		}
		$('#messages-wrapper').hide(); 
		$('.chat-input-wrapper').hide();
		clearInterval(intervalRefreshChat);
		scrollan = 0;
	})
	$('.bubble').click(function(){
		$(this).parent().parent('.user-details-wrapper').children('.sent_time').slideToggle();
	})
	$('#chat-message-input').keypress(function(e){
		if(e.keyCode == 13)
		{		
			send_message($(this).val());
			$(this).val("");
			$(this).focus();
			e.preventDefault();
		}
	})
	$('#chat-users').scrollbar({
		ignoreMobile:true
	});
	$('.chat-messages').scrollbar({
		ignoreMobile:true
	});  

	//image upload
	$('#OpenImgUploadChat').click(function(){ 
		$('#imgupload').trigger('click'); 
	});
	$('#imgupload').change(function () {
		var file_data = $("#imgupload").prop('files')[0];

		var form_dataLatest = new FormData();
		form_dataLatest.append("file", file_data);
		form_dataLatest.append("latest_message_fromId", loginId);
		form_dataLatest.append("latest_message_toId", $('#pegawaiToId').html());
		form_dataLatest.append("latest_message_type", "image");

		var form_dataUser = new FormData();
		form_dataUser.append("file", file_data);
		form_dataUser.append("user_message_fromId", loginId);
		form_dataUser.append("user_message_toId", $('#pegawaiToId').html());
		form_dataUser.append("user_message_type", "image");

		$.ajax({
			url:"/PTRutan/LEAPHRIS/kerjaan/ajax/chat/addimagelatestchat.php",
			type:"post",
			data:form_dataLatest,
			contentType: false,
			processData: false,
			success:function(res){

			},
			error:function(err){
				alert(err);
			}
		});

		$.ajax({
			url:"/PTRutan/LEAPHRIS/kerjaan/ajax/chat/addimageuserchat.php",
			type:"post",
			data:form_dataUser,
			contentType: false,
			processData: false,
			success:function(res){
				scrollan = 0;
				getallUserMessage($('#pegawaiToId').html());
				updateReadMessage($('#pegawaiToId').html());
			},
			error:function(err){
				alert(err);
			}
		});
	});
	 
	getAllLatestMessage();
	setInterval(getAllLatestMessage,2500);
});

	function updateReadMessage(pasangan){
		$.ajax({
			url: "/PTRutan/LEAPHRIS/kerjaan/ajax/chat/updateread.php",
			type: "POST",
			dataType: "json",
			data: {
				pasanganId:pasangan,
				loginId:loginId,
			},
			success:function(res){

			},
			error: function(a, err){
				// console.log(err);
			}
		});
	}
	function getallUserMessage(pasangan){
		$.ajax({
			url: "/PTRutan/LEAPHRIS/kerjaan/ajax/chat/getallusermessage.php",
			type: "GET",
			dataType: "json",
			data: {
				pasanganId:pasangan,
				loginId:loginId,
			},
			success:function(res){
				var data = res; /// kalau pakek json
				var str = "";
				for(var i=0;i<data.length;i++){
					var d = data[i];
					if(d.user_message_fromId == loginId){
						if(d.user_message_type == 'text'){
							str += '<div class="user-details-wrapper pull-right"> <div class="user-details"> <div class="bubble sender"> '+d.user_message_text+' </div> </div> <div class="clearfix"></div> <div class="sent_time off">'+d.user_message_time+'</div> </div>';
						}
						else{
							str += '<div class="user-details-wrapper pull-right"> <div class="user-details"> <div class="bubble sender"> <a href="/PTRutan/LEAPHRIS/kerjaan/ajax/chat/'+d.user_message_text+'" target="_blank"><img style="width:140px" src="/PTRutan/LEAPHRIS/kerjaan/ajax/chat/'+d.user_message_text+'"> </a> </div> </div> <div class="clearfix"></div> <div class="sent_time off">'+d.user_message_time+'</div> </div>';
						}
					}
					else{
						if(d.user_message_type == 'text'){
							str += '<div class="user-details-wrapper "> <div class="user-profile"> <img src="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" alt="" data-src="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" data-src-retina="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" width="35" height="35"> </div> <div class="user-details"> <div class="bubble"> '+d.user_message_text+' </div> </div> <div class="clearfix"></div> <div class="sent_time off">'+d.user_message_time+'</div> </div>';
						}
						else{
							str += '<div class="user-details-wrapper "> <div class="user-profile"> <img src="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" alt="" data-src="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" data-src-retina="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" width="35" height="35"> </div> <div class="user-details"> <div class="bubble"> <a href="/PTRutan/LEAPHRIS/kerjaan/ajax/chat/'+d.user_message_text+'" target="_blank"><img style="width:140px" src="/PTRutan/LEAPHRIS/kerjaan/ajax/chat/'+d.user_message_text+'"> </a> </div> </div> <div class="clearfix"></div> <div class="sent_time off">'+d.user_message_time+'</div> </div>';
						}
					}
				}
				$("#tempat_chat").html(str);
				$('.bubble').click(function(){
					$(this).parent().parent('.user-details-wrapper').children('.sent_time').slideToggle();
				})
				
				if(scrollan == 0){
					//scroll to bottom
					$(".chat-messages").scrollTop($(document).height());
				}
				scrollan = 1;
			},
			error: function(a, err){
				//lakukan sesuatu untuk handle error
				console.log(err);
			}
		});
	}
	
	function getAllLatestMessage(){
		notif_chat = 0;
		$.ajax({
			url: "/PTRutan/LEAPHRIS/kerjaan/ajax/chat/getalllatestmessage.php",
			type: "GET",
			dataType: "json",
			data: {
				loginId:loginId,
			},
			async: false,
			success:function(res_latest){
				var data = res_latest; /// kalau pakek json
				var str = "";
				for(var i=0;i<data.length;i++){
					var d = data[i];
					$.ajax({
						url: "/PTRutan/LEAPHRIS/kerjaan/ajax/chat/getallunread.php",
						type: "GET",
						dataType: "json",
						data: {
							loginId:loginId,
							latest_message_toId: d.latest_message_toId,
						},
						async: false,
						success:function(res_unread){
							notif_chat = notif_chat + res_unread[0].itungan;
							if(res_unread[0].itungan > 0){
								str += '<div class="user-details-wrapper list-chat-details-wrapper" data-chat-status="online" data-chat-user-pic="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" data-chat-user-pic-retina="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" data-user-name="'+d.latest_message_toId+'"> <div class="user-profile"> <img src="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" alt="" data-src="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" data-src-retina="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" width="35" height="35"> </div> <div class="user-details"> <div class="user-name"> '+d.latest_message_toId+' </div> <div class="user-more"> '+d.latest_message_text+' </div> </div> <div class="user-details-status-wrapper"> <span class="badge badge-important">'+res_unread[0].itungan+'</span> </div> <div class="user-details-count-wrapper"> <div class="status-icon green"></div> </div> <div class="clearfix"></div> </div>';
							}
							else{
								str += '<div class="user-details-wrapper list-chat-details-wrapper" data-chat-status="online" data-chat-user-pic="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" data-chat-user-pic-retina="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" data-user-name="'+d.latest_message_toId+'"> <div class="user-profile"> <img src="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" alt="" data-src="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" data-src-retina="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" width="35" height="35"> </div> <div class="user-details"> <div class="user-name"> '+d.latest_message_toId+' </div> <div class="user-more"> '+d.latest_message_text+' </div> </div> <div class="user-details-status-wrapper"> </div> <div class="user-details-count-wrapper"> <div class="status-icon green"></div> </div> <div class="clearfix"></div> </div>';
							}
						},
						error: function(a, err){
							//lakukan sesuatu untuk handle error
							console.log(err);
						}
					});
				}
				if(notif_chat==0){
					$("#notif-chat").hide();
				}
				else{
					$("#notif-chat").show();
					$("#notif-chat").text(notif_chat);
				}
				$("#latest_message_list").html(str);
				$('.user-details-wrapper').click(function(){
					set_user_details($(this).attr('data-user-name'),$(this).attr('data-chat-status'));
					var el = $('#messages-wrapper').parent('.scroll-content').show();
					if(el.length > 0){
						$('#chat-users').parent().hide(); 
						$('#list-pegawai-wrapper').parent().hide(); 
						$('#messages-wrapper').parent('.scroll-content').show();  
					}
					else{
						$('#chat-users').hide();
						$('#list-pegawai-wrapper').hide(); 
					}
					$('#messages-wrapper').show(); 
					$('.chat-input-wrapper').show();

					getallUserMessage($('#pegawaiToId').html());
					updateReadMessage($('#pegawaiToId').html());
					intervalRefreshChat = setInterval(function() {getallUserMessage($('#pegawaiToId').html())},5000);
				});
			},
			error: function(a, err){
				//lakukan sesuatu untuk handle error
				console.log(err);
			}
		});
	}

	function getAllPegawai(){
		$.ajax({
			url: "/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/getmasterpegawaichat.php",
			type: "GET",
			dataType: "json",
			data: {
				loginId:loginId,
			},
			success:function(res){
				var data = res; /// kalau pakek json
				var str = "";
				for(var i=0;i<data.length;i++){
					var d = data[i];
					str += '<div class="user-details-wrapper list-pegawai-details-wrapper" data-chat-status="online" data-chat-user-pic="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" data-chat-user-pic-retina="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" data-user-name="'+d.emp_no+'"> <div class="user-profile"> <img src="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" alt="" data-src="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" data-src-retina="/PTRutan/LEAPHRIS/kerjaan/ajax/masterpegawai/'+d.profile_picture+'" width="35" height="35"> </div> <div class="user-details"> <div class="user-name"> '+d.emp_no+' </div> <div class="user-more"> '+d.full_name+'</div> </div> <div class="clearfix"></div> </div>';
				}
				$("#pegawai-list-content").html(str);
				$('.user-details-wrapper').click(function(){
					set_user_details($(this).attr('data-user-name'),$(this).attr('data-chat-status'));
					var el = $('#messages-wrapper').parent('.scroll-content').show();
					if(el.length > 0){
						$('#chat-users').parent().hide(); 
						$('#list-pegawai-wrapper').parent().hide(); 
						$('#messages-wrapper').parent('.scroll-content').show();  
					}
					else{
						$('#chat-users').hide();
						$('#list-pegawai-wrapper').hide(); 
					}
					$('#messages-wrapper').show(); 
					$('.chat-input-wrapper').show();

					getallUserMessage($('#pegawaiToId').html());
					updateReadMessage($('#pegawaiToId').html());
					intervalRefreshChat = setInterval(function() {getallUserMessage($('#pegawaiToId').html())},5000);
				});
			},
			error: function(a, err){
				//lakukan sesuatu untuk handle error
				console.log(err);
			}
		});
	}

	function set_user_details(username,status){
		$('#messages-wrapper .chat-messages-header .status').addClass(status);
		$('#messages-wrapper .chat-messages-header span').text(username);
	}	
	function build_conversation(msg,isOpponent,img,retina){
		if(isOpponent==1){
			$('.chat-messages').append('<div class="user-details-wrapper">'+
				'<div class="user-details">'+
					'<div class="user-profile">'+
					'<img src="'+ img +'"  alt="" data-src="'+ img +'" data-src-retina="'+ retina +'" width="35" height="35">'+
					'</div>'+
				'<div class="bubble old sender">'+	
						msg+
				'</div>'+
				'</div>'+				
				'<div class="clearfix"></div>'+
			'</div>');
		}
		else{
		$('.chat-messages').append('<div class="user-details-wrapper pull-right">'+
			'<div class="user-details">'+
			'<div class="bubble old sender">'+	
					msg+
			'</div>'+
			'</div>'+				
			'<div class="clearfix"></div>'+
		'</div>')
		}
	}
	function send_message(msg){
		$.ajax({
			url:"/PTRutan/LEAPHRIS/kerjaan/ajax/chat/addlatestchat.php",
			type:"post",
			data:{
				latest_message_fromId:loginId,
				latest_message_toId: $('#pegawaiToId').html(),
				latest_message_text: msg,
				latest_message_type: "text"
			},
			success:function(res){
				scrollan = 0;
				getallUserMessage($('#pegawaiToId').html());
				updateReadMessage($('#pegawaiToId').html());
			},
			error:function(err){
				alert(err);
			}
		});

		$.ajax({
			url:"/PTRutan/LEAPHRIS/kerjaan/ajax/chat/adduserchat.php",
			type:"post",
			data:{
				user_message_fromId:loginId,
				user_message_toId: $('#pegawaiToId').html(),
				user_message_text: msg,
				user_message_type: "text"
			},
			success:function(res){
				scrollan = 0;
				getallUserMessage($('#pegawaiToId').html());
				updateReadMessage($('#pegawaiToId').html());

			},
			error:function(err){
				alert(err);
			}
		});

		$('.bubble').click(function(){
			$(this).parent().parent('.user-details-wrapper').children('.sent_time').slideToggle();
		})
	}	

