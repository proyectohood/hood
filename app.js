$(document).ready(function(){
	upload_file();
	$('#formRegister').bind('submit',function(e){
    	e.preventDefault();
  		if(validateRegister()){
  			var formData = {
  				first_name : $('#first_name').val(),
  				last_name : $('#last_name').val(),
  				username : $('#username').val(),
  				email_address : $('#email_address').val(),
  				job_position : $('select[name=job_position] option:selected').val(),
  				password : $('#password').val(),
  				password2 : $('#password2').val(),
  				is_ajax:true
  			}
  			
  			var path = $('#formRegister').attr('action');
  			$.ajax({
  				url : path,
  				type : 'POST',
  				data : formData,
  				success : function(data){
  					var data = JSON.parse(data);
  					if(data.accountCreated){
	  					$('#signup-error').html('Se ha creado su cuenta, por favor revise su correo para activarla');
	  					$('#signup-error').modal();
	  					setTimeout(function(){
  							var prot = window.location.protocol;
  							var host = window.location.host;
  							window.location.href = prot + '//' + host;
						}, 4000);
  					}
  					else if(data.errorMail && data.errorUsername){
		  				$('#signup-error').html(data.errorMail + '<br>' + data.errorUsername);
		  				$('#signup-error').modal();
  					}
  					else{
  						if(data.errorMail){
		  					$('#signup-error').html(data.errorMail);
		  					$('#signup-error').modal();
		  				}
  						else if(data.errorUsername){
		  					$('#signup-error').html(data.errorMail);
		  					$('#signup-error').modal();
		  				}
  					}
  				}
  			});
  		}
 	});
	$('#formLogin').bind('submit',function(e){
		e.preventDefault();
  		if(validateLogin()){
  			var formData = {
  				username : $('#username').val(),
  				password : $('#password').val(),
  				is_ajax:true
  			}
  			
  			var path = $("#formLogin").attr("action");
  			$.ajax({
  				url: path,
  				type:'POST',
  				data:formData,
  				success: function(data){
  					var data = JSON.parse(data);
  					if(data.error == true){
  						var prot = window.location.protocol;
  						var host = window.location.host;
  						window.location.href = prot + '//' + host + '/index.php/poste/';
  					}
  					$('#login-error').html(data.error);
  					$('#login-error').modal();
  				}
  			});
  		}
 	});
 	$('#formEditar').bind('submit',function(e){
		e.preventDefault();
		if(validateEdit()){
			var formData = {
				username : $('#username').val(),
				password : $('#password').val(),
				password2 : $('#password2').val(),
				is_ajax:true
			}
			
			var path = $('#formEditar').attr('action');
			$.ajax({
				url : path,
				type : 'POST',
				data : formData,
				success : function(data){
					var data = JSON.parse(data);
					
					if(data.errorUsername){
	  					$('#edit-error').html(data.errorUsername);
	  					$('#edit-error').modal();
					}
				}
			});
		}
	});
});
var currentHoodId = null;
function upload_file(){
	$("#upload_frame").addClass("hide");
	$("#upload_button").click(function(){

		var url_encoded = window.location.protocol +"//"+ window.location.host +"/"+ (window.location.pathname).split("/")[1] +"/hood/getLastHood";		
		
		$('iframe').contents().find('input[name="userfile"]').click();


		$.ajax({
			type: 'POST',
			url : url_encoded,
			success : function(response){
						
				id = JSON.parse(response);
				currentHoodId = parseFloat(id[0].idhood);
				$('iframe').contents().find('input[type="hidden"]').val(currentHoodId);
			},
		});

		
		
		function checkFileName(){
			if($('iframe').contents().find('input[name="userfile"]').val() != ""){
				var filepath = $('iframe').contents().find('input[name="userfile"]').val();
				var filename = filepath.match(/\w+\.\w+/g)[0];
				$('<span>'+filename+'</span>').appendTo('.content_top');
			}
			else
				setTimeout(checkFileName,500);
			}

			checkFileName();

	});
}
//
// ### validate() ###
//
// Group the validate functions and submit the form if
// if the field is validated
//
//
function validateRegister(){
	$('.errorReg').remove();
	var first_name = validateOnlyLetters('#first_name',{'req':'El campo es requerido', 'val':'Ingrese solo caracteres v&aacute;lidos'},34);
	var last_name = validateOnlyLetters('#last_name',{'req':'El campo es requerido', 'val':'Ingrese solo caracteres v&aacute;lidos'},34);
	var username = validateLettersNumbersSpecials('#username',{'req':'El campo es requerido', 'val':'Ingrese solo caracteres v&aacute;lidos'},15,8);
	var email = validateMail('#email_address',{'req':'El campo es requerido', 'val':'Ingrese un correo v&aacute;lido'});
	var pass = validateLettersNumbers('#password',{'req':'El campo es requerido', 'val':'Ingrese solo caracteres v&aacute;lidos'},15,8);
	var pass2 = validateEquals('#password','#password2',{'equal':'La contrase&ntilde;a debe ser id&eacute;ntica'})
	if(first_name && last_name && username && email && pass && pass2){
		return true;
	}
	return false;
}

function validateEdit(){
	$('.errorReg').remove();
	var username = validateLettersNumbersSpecials('#username',{'req':'El campo es requerido', 'val':'Ingrese solo caracteres v&aacute;lidos'},15,8);
	var pass = validateLettersNumbers('#password',{'req':'El campo es requerido', 'val':'Ingrese solo caracteres v&aacute;lidos'},15,8);
	var pass2 = validateEquals('#password','#password2',{'equal':'La contrase&ntilde;a debe ser id&eacute;ntica'})
	if(username && pass && pass2){
		return true;
	}
	return false;
}

//
// ### validate() ###
//
// Group the validate functions and submit the form if
// if the field is validated
//
//
function validateLogin(){
	$('.errorReg').remove();
	var username = validateLettersNumbersSpecials('#username',{'req':'El campo es requerido', 'val':'Ingrese solo caracteres v&aacute;lidos'},15,8);
	var pass = validateLettersNumbers('#password',{'req':'El campo es requerido', 'val':'Ingrese solo caracteres v&aacute;lidos'},15,8);
	if(username && pass){
		return true;
	}
	return false;
}

//
// ### validateOnlyLetters() ###
//
// Make an API cal through the Service Interface.
// and define the required callbacks for status
// responses.
//
//     @param {string} [templateContainer] the HTML template container ID
//     @param {string} [templateId] the HTML template script ID.
//
function validateOnlyLetters(sel,err,max){
	var val = $(sel).val();
	var regex = /^[a-zA-Z ]+$/;
	var matched = val.match(regex);
	if(val == ""){
		var error = '<p class="errorReg">'+err.req+'</p>';
		if($(sel).next().length == 0){
			$(error).insertAfter(sel).fadeIn();
			return false;
		}
	}
	else{
		if(!val.match(regex)){
			var error = '<p class="errorReg">'+err.val+'</p>';
			if($(sel).next().length == 0){
				$(error).insertAfter(sel).fadeIn();
				return false;
			}
		}
		else {
			if(max){
				if(val.length > max){
					var error = '<p class="errorReg">Ingrese como m&aacute;ximo '+max+' caracteres</p>';
					if($(sel).next().length == 0){
						$(error).insertAfter(sel).fadeIn();
						return false;
					}
				}
				else{
					return true;
				}
			}
		}
	}
}

//
// ### validate() ###
//
// Make an API cal through the Service Interface.
// and define the required callbacks for status
// responses.
//
//     @param {string} [templateContainer] the HTML template container ID
//     @param {string} [templateId] the HTML template script ID.
//
function validateLettersNumbersSpecials(sel,err,max,min){
	var val = $(sel).val();
	var regex = /^[a-zA-Z0-9\.\-\_]+$/;
	var matched = val.match(regex);
	if(val == ""){
		var error = '<p class="errorReg">'+err.req+'</p>';
		if($(sel).next().length == 0){
			$(error).insertAfter(sel).fadeIn();
			return false;
		}
	}
	else{
		if(!val.match(regex)){
			var error = '<p class="errorReg">'+err.val+'</p>';
			if($(sel).next().length == 0){
				$(error).insertAfter(sel).fadeIn();
				return false;
			}
		}
		else {
			if(max){
				if(val.length > max){
					var error = '<p class="errorReg">Ingrese como m&aacute;ximo '+max+' caracteres</p>';
					if($(sel).next().length == 0){
						$(error).insertAfter(sel).fadeIn();
						return false;
					}
				}
				else if(val.length < min){
					var error = '<p class="errorReg">Ingrese como m&iacute;nimo '+min+' caracteres</p>';
					if($(sel).next().length == 0){
						$(error).insertAfter(sel).fadeIn();
						return false;
					}
				}
				else{
					return true;
				}
			}
		}
	}
}
//
// ### validate() ###
//
// Make an API cal through the Service Interface.
// and define the required callbacks for status
// responses.
//
//     @param {string} [templateContainer] the HTML template container ID
//     @param {string} [templateId] the HTML template script ID.
//
function validateLettersNumbers(sel,err,max,min){
	var val = $(sel).val();
	var regex = /^[a-zA-Z0-9]+$/;
	var matched = val.match(regex);
	if(val == ""){
		var error = '<p class="errorReg">'+err.req+'</p>';
		if($(sel).next().length == 0){
			$(error).insertAfter(sel).fadeIn();
			return false;
		}
	}
	else{
		if(!val.match(regex)){
			var error = '<p class="errorReg">'+err.val+'</p>';
			if($(sel).next().length == 0){
				$(error).insertAfter(sel).fadeIn();
				return false;
			}
		}
		else {
			if(max){
				if(val.length > max){
					var error = '<p class="errorReg">Ingrese como m&aacute;ximo '+max+' caracteres</p>';
					if($(sel).next().length == 0){
						$(error).insertAfter(sel).fadeIn();
						return false;
					}
				}
				else if(val.length < min){
					var error = '<p class="errorReg">Ingrese como m&iacute;nimo '+min+' caracteres</p>';
					if($(sel).next().length == 0){
						$(error).insertAfter(sel).fadeIn();
						return false;
					}
				}
				else{
					return true;
				}
			}
		}
	}
}
//
// ### validate() ###
//
// Make an API cal through the Service Interface.
// and define the required callbacks for status
// responses.
//
//     @param {string} [templateContainer] the HTML template container ID
//     @param {string} [templateId] the HTML template script ID.
//
function validateMail(sel,err){
	var val = $(sel).val();
	var regex = /^[a-zA-Z\d!#$%&'*+/=?^_`{|}~-]+(?:\.[a-zA-Z\d!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-zA-Z\d](?:[a-zA-Z\d-]*[a-zA-Z\d])?\.)+[a-zA-Z\d](?:[a-zA-Z\d-]*[a-zA-Z\d])?$/;
	var matched = val.match(regex);
	if(val == ""){
		var error = '<p class="errorReg">'+err.req+'</p>';
		if($(sel).next().length == 0){
			$(error).insertAfter(sel).fadeIn();
			return false;
		}
	}
	else{
		if(!val.match(regex)){
			var error = '<p class="errorReg">'+err.val+'</p>';
			if($(sel).next().length == 0){
				$(error).insertAfter(sel).fadeIn();
				return false;
			}
		}
		else {
			return true;
		}
	}
}

//
// ### validate() ###
//
// Make an API cal through the Service Interface.
// and define the required callbacks for status
// responses.
//
//     @param {string} [templateContainer] the HTML template container ID
//     @param {string} [templateId] the HTML template script ID.
//
function validateEquals(sel,comp,err){
	var val = $(sel).val();
	var comp = $(comp).val();
	if(val == comp){
		return true;
	}
	else{
		var error = '<p class="errorReg">'+err.equal+'</p>';
		if($(sel).next().length == 0){
			$(error).insertAfter(sel).fadeIn();
			return false;
		}
	}
}