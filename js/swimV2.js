$(document).ready(function(){
	if(!$("#js_device").is(':hidden')){
		$('[data-toggle="tooltip"]').tooltip(); 
	}
	$('.timecard_widget_select').trigger('change');
});
$(".timecard_time_input").blur(function(){
	
	var re = new RegExp(/^\d*\.\d*$/);
	var time = $(this).val();
	console.log(String(time));
	if(re.test(String(time))){
		console.log(2);
		time *= 1000;
	    var d=new Date(time);
		$(this).val(minTwoDigits(String(d.getUTCMinutes()))+"."+minTwoDigits(String(d.getUTCSeconds()))+"."+(minTwoDigits(String(d.getUTCMilliseconds())).substring(0,2)));
	}else{
		console.log(3);
	}
});
function add_user(){
	var array = $("#add_widget_name").val().split(",");
	var arrayLength = array.length;
	for (var i = 0; i < arrayLength; i++) {
		if(array[i] == ""){
			continue;
		}
		var a2 = array[i].split(".");
		if(a2.length != 2 && a2.length != 0){
			
			if(confirm("Please make sure all usernames only have one '.' and follow the format of 'FirstName.LastName' Some enteries will not be added, continue?")){
				break;
			}else{
				return;
			}
		}
	}
	$.post( "add.php", $('#add_widget').serialize(),
		function(data){
			if(data==1){
				$('#add_widget_name').val('');
				$("#add_widget_success").show();
				$("#add_widget_success").hide(6000);
				$.get("includes/team_list_widget.php", 
					function(data){
						$("#tlw").html(data);
					}
				);
			}else{
				$("#add_widget_error").show();
				$("#add_widget_error").hide(6000);
			}
		}
	);
}
function change_pass(){
	if($("#confirm_pass").val() != $("#new_pass").val()){
		$("#change_pass_error_msg").text("Your new passwords do not match.");
		$("#change_pass_error").show();
		$("#change_pass_error").slideUp(6000, function(){
				$("#change_pass_error_msg").html("<strong>Error!</strong> Password not changed, please try again later.");
			}	
		);
		return false;
	}
	
	$.post( "change_pass.php", $('#change_pass_widget').serialize(),
		function(data){
			$("#change_pass_widget").removeClass("has-success");
			$("#change_pass_widget").removeClass("has-error");
			if(data==21){
				window.location.replace("/home.php");
			}else if(data==1){
				$('#change_pass_widget').trigger("reset");
				$("#change_pass_success").show();
				$("#change_pass_widget").addClass("has-success");
			}else if(data==11){
				$('#change_pass_widget').trigger("reset");
				$("#change_pass_success").show();
				$("#change_pass_widget").addClass("has-success");
				$("#change_pass_widget").slideUp(6000);
			}else{
				$("#change_pass_error").show();
				$("#change_pass_widget").addClass("has-error");
			}
		}
	);
}
function edit_user(ele){
	var argString = $(ele).serialize();
	argString+="&"+$(ele.form).serialize();
	$.post( "edit.php", argString,
		function(data){
			$(ele.form).removeClass('has-error');
			if(data==1){
				$.get("/includes/team_list_widget.php", 
					function(data){
						$("#tlw").html(data);
					}
				);
			}else{
				console.log(data);
				$(ele.form).addClass('has-error');
			}
		}
	);
}
function delete_user(ele, d_or_a){
	//0 = archive
	//1 = delete
	if (typeof d_or_a === 'undefined') { d_or_a = 0; }
	if(d_or_a == 0){
		var target="archive.php";
	}else{
		var target="delete.php";
	}
	$.post(target, $(ele).serialize(),
		function(data){
			$(ele).removeClass('has-error');
			if(data==1){
				$.get("includes/team_list_widget.php", 
					function(data){
						$("#tlw").html(data);
					}
				);
			}else{
				$(ele).addClass('has-error');
			}
		}
	);
}
function restore_user(ele){
	$.post("restore.php", $(ele).serialize(),
		function(data){
			$(ele).removeClass('has-error');
			if(data==1){
				$.get("includes/archive_widget.php", 
					function(data){
						$("#aw").html(data);
					}
				);
			}else{
				$(ele).addClass('has-error');
			}
		}
	);
}
function add_email(email){
	$.post("new_email.php", $(email).serialize(),
		function(data){
			$(email).removeClass("has-success");
			$(email).removeClass("has-error");
			if(data==21){
				window.location.replace("/home.php");
			}else if(data==1){
				$('#new_email').val('');
				$("#add_email_success").show();
				$(email).addClass("has-success");
			}else if(data==11){
				$('#new_email').val('');
				$("#add_email_success").show();
				$(email).addClass("has-success");
				$("#add_email_widget").slideUp(6000);
			}else{
				$("#change_email_error_msg").text(data);
				$("#add_email_error").show();
				$(email).addClass("has-error");
			}
		}
	);
	return false;
}
function add_meet(meet){
	$("#add_meet_widget_submit").prop('disabled', true);
	$.post("add_meet.php", $(meet).serialize(),
		function(data){
			if(data==1){
				$(meet).trigger('reset');
				$(meet).addClass("has-success");
				$(meet).removeClass("has-error");
				$("#add_meet_widget_submit").prop('disabled', false);
			}else if(data==4){
				$("#add_meet_widget_length").addClass("has-error");
				$("#add_meet_widget_submit").prop('disabled', false);
			}else{
				$(meet).addClass("has-error");
				alert("Error: " +data);
				$("#add_meet_widget_submit").prop('disabled', false);
			}
		}
	);
}
function return_string(current_event_number){
		return	'<div class="row not-original">'+
		'<div class="not-original bottom2 col-lg-2 col-md-2 col-sm-12 col-xs-12">'+
			'<hr class="hidden-lg hidden-md">'+
			'<input class="form-control" type="number" min="0" name="meet['+current_event_number+'][event]" placeholder="Event #">'+
		'</div>'+
		'<div class="not-original bottom2 col-lg-2 col-md-2 col-sm-12 col-xs-12">'+
		'	<select class="form-control" name="meet['+current_event_number+'][length]">'+
		'		<option value="25">25 (m/yd)</option>'+
		'		<option value="50">50 (m/yd)</option>'+
		'		<option value="100">100 (m/yd)</option>'+
		'		<option value="200">200 (m/yd)</option>'+
		'		<option value="400">400 (m/yd)</option>'+
		'	</select>'+
		'</div>'+
		'<div class="not-original bottom2 col-lg-2 col-md-2 col-sm-12 col-xs-12">'+
			'<select class="form-control" name="meet['+current_event_number+'][stroke]">'+
				'<option value="0">Butterfly</option>'+
				'<option value="1">Back</option>'+
				'<option value="2">Breast</option>'+
				'<option value="3">Free</option>'+
				'<option value="4">I.M</option>'+
				'<option value="5">Medley Relay</option>'+
				'<option value="6">Free Relay</option>'+
			'</select>'+
		'</div>'+
		'<div class="not-original bottom2 col-lg-2 col-md-2 col-sm-12 col-xs-12">'+
			'<select class="form-control" name="meet['+current_event_number+'][division]">'+
				'<option value="0">Open</option>'+
				'<option value="1">Junior</option>'+
				'<option value="2">Senior</option>'+
			'</select>'+
		'</div>'+
		'<div class="not-original bottom2 col-lg-2 col-md-2 col-sm-12 col-xs-12">'+
			'<select class="form-control" name="meet['+current_event_number+'][competes_with]">'+
				'<option value="0">Girls</option>'+
				'<option value="1">Boys</option>'+
			'</select>'+
		'</div>'+
		'<div class="bottom2 col-lg-2 col-md-2 col-sm-12 col-xs-12">'+
			'<button style="width:100%" onclick="show_more(this)" type="button" class="btn btn-primary">Show more</button>'+
		'</div>'+
		'<hr class="hidden-lg hidden-md">'+
		'</div>';
}
function add_event(string){
	$(string).append(return_string(($(string+" div.row").length)+Math.floor(Math.random()*90000) + 10000));
}
function add_meet_type(type){
	if(!confirm("Are you sure you would like to submit this data?")){
		return;
	}
	$("#meet_type_widget_submit").prop('disabled', true);
	$.post("add_meet_events.php", $(type).serialize(),
		function(data){
			$(type).removeClass("has-error");
			$(type).removeClass("has-success");
			if(data==1){
				$(type).trigger('reset');
				$(type).addClass("has-success");
				$("#meet_type_widget_submit").prop('disabled', false);
				$(".not-original").remove();
			}else{
				$(type).addClass("has-error");
				$("#meet_type_widget_submit").prop('disabled', false);
			}
		}
	);
}
function reset_password(pass){
	$.post("send_reset.php", $(pass).serialize(),
		function(data){
			$(pass).removeClass("has-success");
			$(pass).removeClass("has-error");
			if(data==1){
				$(pass).trigger('reset');
				$(pass).addClass("has-success");
				$(pass).prepend("<div class='row'><div class='col-lg-10 col-lg-offset-1 col-md-8 col-md-offset-2 col-sm-12 col-xs-12'><div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close alert'><span aria-hidden='true'>&times;</span></button><span class='glyphicon glyphicon-ok' aria-hidden='true'></span><span class='sr-only'>Success:</span>Check your email for further instructions</div></div></div>");
			}else if(data==2){
				$(pass).addClass("has-error");
				$(pass).prepend("<div class='row'><div class='col-lg-10 col-lg-offset-1 col-md-8 col-md-offset-2 col-sm-12 col-xs-12'><div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close alert'><span aria-hidden='true'>&times;</span></button><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span>You must wait a bit more before you can reset your password again</div></div></div>");
			}else if(data==0){
				$(pass).addClass("has-error");
				$(pass).prepend("<div class='row'><div class='col-lg-10 col-lg-offset-1 col-md-8 col-md-offset-2 col-sm-12 col-xs-12'><div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close alert'><span aria-hidden='true'>&times;</span></button><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span>Unfortunately we don't have your email, please contact someone from the swim team to help you.</div></div></div>");
			}
		}
	);
}
function edit_meet_type(type){
	$(".edit_meet_type_widget_submit").prop('disabled', true);
	$.post("edit_meet_events.php", $(type).serialize(),
		function(data){
			$(type).removeClass("has-success");
			$(type).removeClass("has-error");
			if(data==1){
				$(type).addClass("has-success");
				$(".edit_meet_type_widget_submit").prop('disabled', false);
			}else{
				$(type).addClass("has-error");
				$(".edit_meet_type_widget_submit").prop('disabled', false);
			}
		}
	);
}
function show_more(ele){
	if($(ele).text() == "Show more"){
		$(ele).text("Hide Options");
		if($(ele).parent().next().hasClass("info")){
			$(ele).parent().next().show();
		}else{
			$(ele).parent().after("<div class='info col-lg-12 col-md-12 col-sm-12 col-xs-12'><div class='row bottom2'><div class='bottom2 col-lg-6 col-md-6 col-sm-12 col-xs-12'><button style='width:100%' type='button' class='btn btn-warning' onclick='$(this).parent().parent().parent().parent().remove()'>Remove</button></div><div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'><button style='width:100%' type='button' class='btn btn-primary' onclick='$(this).parent().parent().parent().parent().after(return_string($(this).parent().parent().parent().parent().parent().children().length))'>Insert After</button></div></div></div>");
		}
	}else if($(ele).text() == "Hide Options"){
		$(ele).text("Show more");
		$(ele).parent().next().hide();
	}
}
function edit_meet(meet){
	$(".edit_meet_widget_submit").prop('disabled', true);
	$.post("edit_meet.php", $(meet).serialize(),
		function(data){
			if(data==1){
				$(meet).addClass("has-success");
				$(meet).removeClass("has-error");
				$(".edit_meet_widget_submit").prop('disabled', false);
				$(".edit_meet_widget_box").collapse('hide');
				var replace1;
				$.get("/includes/edit_meet_widget.php", function (data2){
					replace1 = data2;
					setTimeout(function(){$("#edit_meet_widget_whole").replaceWith(replace1);}, 500);
				});
				
			}else{
				$(meet).addClass("has-error");
				$(meet).removeClass("has-success");
				$(".edit_meet_widget_submit").prop('disabled', false);
			}
		}
	);
}
function delete_meet(id, button){
	$.post("delete_meet.php", "id="+id,
		function(data){
			$(button.form).removeClass("has-error");
			if(data==1){
				$(".edit_meet_widget_submit").prop('disabled', false);
				$(".edit_meet_widget_box").collapse('hide');
				var replace1;
				$.get("/includes/edit_meet_widget.php", function (data2){
					replace1 = data2;
					setTimeout(function(){$("#edit_meet_widget_whole").replaceWith(replace1);}, 1000);
				});
			}else{
				$(button.form).addClass("has-error");
			}
		}
	);
}
function delete_meet_type(id, button){
	$.post("delete_meet_type.php", "id="+id,
		function(data){
			$(button.form).removeClass("has-error");
			if(data==1){
				$(".edit_meet_type_widget_submit").prop('disabled', false);
				$(".edit_meet_type_widget_box").collapse('hide');
				var replace1;
				$.get("/includes/edit_meet_type_widget.php", function (data2){
					replace1 = data2;
					setTimeout(function(){$("#edit_meet_type_widget_whole").replaceWith(replace1);}, 1000);
				});
			}else{
				$(button.form).addClass("has-error");
			}
		}
	);
}
function add_timecard(form){
	$(form).find(":submit").prop('disabled', true);
	$.post("add_timecard.php", $(form).serialize(),
		function(data){
			$("#add_timecard_widget_error").hide();
			if(data==1){
				$(form).find(":submit").prop('disabled', false);
				$(form).addClass("has-success");
				$(form).removeClass("has-error");
				$("#add_timecard_widget_error span").children(0).text("Success! Timecard submitted.");
				$("#add_timecard_widget_error").show();
				
				$.get("/includes/edit_timecard_widget.php", function (data2){
					setTimeout(function(){$("#edit_timecard_widget_whole").replaceWith(data2);}, 1000);
				});
			}else{
				
				$("#add_timecard_widget_error").hide();
				$(form).removeClass("has-success");
				$(form).addClass("has-error");
				$(form).find(":submit").prop('disabled', false);
				alert(data);
			}
		}
	);
}
function detect_relay(selector, inline = true){
	if(selector){
		if($(selector).find("option:selected").text().indexOf('relay') > -1){
			var cont = $(selector).parent().parent().parent().prev();
			if(cont.children().length==1){
				var stuff = cont.html();
				cont.append(stuff);
				cont.append(stuff);
				cont.append(stuff);
				cont.append(stuff);
				if(inline){
					cont.append('<div class="text-center bottom2 col-lg-12 col-md-12 col-sm-12 col-xs-12"><label class="radio-inline"><input required type="radio" value="0" name="relay_letter">A Relay</label><label class="radio-inline"><input type="radio" value="1" name="relay_letter">B Relay</label><label class="radio-inline"><input type="radio" name="relay_letter" value="2">C Relay</label></div>');
				}else{
					cont.append('<div class="text-center bottom2 col-lg-12 col-md-12 col-sm-12 col-xs-12"><label class="radio"><input required type="radio" value="0" name="relay_letter">A Relay</label><label class="radio"><input type="radio" value="1" name="relay_letter">B Relay</label><label class="radio"><input type="radio" name="relay_letter" value="2">C Relay</label></div>');
				}
			}
		}else{
			var cont = $(selector).parent().parent().parent().prev();
			cont.children().not(':first').remove();
		}
	}
}
function edit_timecard(button){
	$(button).find(":submit").prop('disabled', true);
	$.post("edit_timecard.php", $(button).serialize(),
		function(data){
			$(button).removeClass("has-success");
			$(button).removeClass("has-error");
			if(data==1){
				$(button).find(":submit").prop('disabled', false);
				$(button).addClass("has-success");
			}else{
				
				$(button).addClass("has-error");
				$(button).find(":submit").prop('disabled', false);
				alert(data);
			}
		}
	);
}
function delete_timecard(button){
	$(button.form).find(":submit").prop('disabled', true);
	$.post("delete_timecard.php", $(button.form).serialize(),
		function(data){
			$(button.form).removeClass("has-error");
			if(data==1){
				$(button.form).find(":submit").prop('disabled', false);
				$(button.form).remove();
			}else{
				$(button.form).addClass("has-error");
				$(button.form).find(":submit").prop('disabled', false);
			}
		}
	);
}
function toggle_meet(id, button){
	$.post("toggle_meet.php", "id="+id,
		function(data){
			$(button.form).removeClass("has-error");
			if(data==1){
				$(".edit_meet_widget_submit").prop('disabled', false);
				$(".edit_meet_widget_box").collapse('hide');
				var replace1;
				$.get("/includes/edit_meet_widget.php", function (data2){
					replace1 = data2;
					setTimeout(function(){$("#edit_meet_widget_whole").replaceWith(replace1);}, 1000);
				});
			}else{
				$(button.form).addClass("has-error");
			}
		}
	);
}
function first_login(elem){
	$.post("sconfirm.php", $(elem.form).serialize(),
		function(data){
			$(elem.form).removeClass("has-error");
			if(data==1){
				$(elem.form).addClass("has-success");
			}else{
				$(elem.form).addClass("has-error");
			}
		}
	);
}

//From: http://stackoverflow.com/a/8513064
function minTwoDigits(n) {
  return (n < 10 ? '0' : '') + n;
}