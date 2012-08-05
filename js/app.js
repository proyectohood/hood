$(document).ready(function() {
    upload_file();
    $('#formRegister').bind('submit', function(e) {
        e.preventDefault();
        if (validateRegister()) {
            var formData = {
                first_name: $('#first_name').val(),
                last_name: $('#last_name').val(),
                username: $('#username').val(),
                email_address: $('#email_address').val(),
                job_position: $('select[name=job_position] option:selected').val(),
                password: $('#password').val(),
                password2: $('#password2').val(),
                is_ajax: true
            }

            var path = $('#formRegister').attr('action');
            $.ajax({
                url: path,
                type: 'POST',
                data: formData,
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.accountCreated) {
                        $('#errorRegistro').html('Se ha creado su cuenta, por favor revise su correo para activarla');
                        $('#signup-error').modal();
                        setTimeout(function() {
                            var prot = window.location.protocol;
                            var host = window.location.host;
                            window.location.href = prot + '//' + host;
                        }, 4000);
                    }
                    else if (data.errorMail && data.errorUsername) {
                        $('#errorRegistro').html(data.errorMail + '<br>' + data.errorUsername);
                        $('#signup-error').modal();
                    }
                    else {
                        if (data.errorMail) {
                            $('#errorRegistro').html(data.errorMail);
                            $('#signup-error').modal();
                        }
                        else if (data.errorUsername) {
                            $('#errorRegistro').html(data.errorMail);
                            $('#signup-error').modal();
                        }
                        
                    }
                }
            });
        }
    });
    $('#formLogin').bind('submit', function(e) {
        e.preventDefault();
        if (validateLogin()) {
            var formData = {
                username: $('#username').val(),
                password: $('#password').val(),
                is_ajax: true
            }

            var path = $("#formLogin").attr("action");
            $.ajax({
                url: path,
                type: 'POST',
                data: formData,
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.error == true) {
                        var prot = window.location.protocol;
                        var host = window.location.host;
                        window.location.href = prot + '//' + host + '/index.php/poste/';
                    }
                    else{
                        if(data.inactive == true){
                            $('#errorInactive').html(data.error);
                            $('#inactive-error').modal();
                        }
                        else{
                            $('#errorIniciarSesion').html(data.error);
                            $('#login-error').modal();    
                        }
                    }
                }
            });
        }
    });
    $('#formEditar').bind('submit', function(e) {
        e.preventDefault();
        if (validateEdit()) {
            var formData = {
                username: $('#username').val(),
                password: $('#password').val(),
                password2: $('#password2').val(),
                is_ajax: true
            }

            var path = $('#formEditar').attr('action');
            $.ajax({
                url: path,
                type: 'POST',
                data: formData,
                success: function(data) {
                    var data = JSON.parse(data);

                    if (data.errorUsername) {
                        $('#errorEdit').html(data.errorUsername);
                        $('#edit-error').modal();
                    }
                }
            });
        }
    });

    $('#formDesactivar').bind('submit', function(e){
        e.preventDefault();
        var path = $('#formDesactivar').attr('action');
        $.ajax({
            url: path,
            type: 'POST',
            success: function(data){
                var data=JSON.parse(data);
                if (data.errorUsername) {
                    $('#edit-error .modal-body').html(data.errorUsername);
                    $("#modal-desactivarCuenta .close").click();
                    $('#edit-error').modal();
                    setTimeout(function(){
                        window.location="http://www.proyectohood.com";
                    },3000);
                }
            }
        });
    });
});
var currentHoodId = null;

//
// ### upload_file() ###
//
// Replace the upload files ugly iframe 
// to our nice buttons, then retrieves the last hood id
//
//
function upload_file() {
    $("#upload_frame").addClass("hide");
    $("#upload_button").click(function() {

        var url_encoded = window.location.protocol + "//" + window.location.host + "/" + (window.location.pathname).split("/")[1] + "/hood/getLastHood";

        $('iframe').contents().find('input[name="userfile"]').click();


        $.ajax({
            type: 'POST',
            url: url_encoded,
            success: function(response) {

                id = JSON.parse(response);
                currentHoodId = parseFloat(id[0].idhood);
                $('iframe').contents().find('input[type="hidden"]').val(currentHoodId);
            },
        });



        function checkFileName() {
            if ($('iframe').contents().find('input[name="userfile"]').val() != "") {
                var filepath = $('iframe').contents().find('input[name="userfile"]').val();
                var filename = filepath.match(/\w+\.\w+/g)[0];
                $('.content_top form fieldset span').html(filename);
            }
            else setTimeout(checkFileName, 500);
        }

        checkFileName();

    });
}

/* -----------------------------------------------------------------------------
                        VALIDATION FUNCTIONS
------------------------------------------------------------------------------*/

//
// ### validateRegister() ###
//
// Validate the register form
//
//

function validateRegister() {
    $('.errorReg').remove();
    var first_name = validateOnlyLetters('#first_name', {
        'req': 'El campo es requerido',
        'val': 'Ingrese solo caracteres v&aacute;lidos'
    }, 34);
    var last_name = validateOnlyLetters('#last_name', {
        'req': 'El campo es requerido',
        'val': 'Ingrese solo caracteres v&aacute;lidos'
    }, 34);
    var username = validateLettersNumbersSpecials('#username', {
        'req': 'El campo es requerido',
        'val': 'Ingrese solo caracteres v&aacute;lidos'
    }, 15, 8);
    var email = validateMail('#email_address', {
        'req': 'El campo es requerido',
        'val': 'Ingrese un correo v&aacute;lido'
    });
    var pass = validateLettersNumbers('#password', {
        'req': 'El campo es requerido',
        'val': 'Ingrese solo caracteres v&aacute;lidos'
    }, 15, 8);
    var pass2 = validateEquals('#password', '#password2', {
        'equal': 'La contrase&ntilde;a debe ser id&eacute;ntica'
    })
    if (first_name && last_name && username && email && pass && pass2) {
        return true;
    }
    return false;
}

//
// ### validateEdit() ###
//
// Validate the edit form
//
//
function validateEdit() {
    $('.errorReg').remove();
    var username = validateLettersNumbersSpecials('#username', {
        'req': 'El campo es requerido',
        'val': 'Ingrese solo caracteres v&aacute;lidos'
    }, 15, 8);
    var pass = validateLettersNumbers('#password', {
        'req': 'El campo es requerido',
        'val': 'Ingrese solo caracteres v&aacute;lidos'
    }, 15, 8);
    var pass2 = validateEquals('#password', '#password2', {
        'equal': 'La contrase&ntilde;a debe ser id&eacute;ntica'
    })
    if (username && pass && pass2) {
        return true;
    }
    return false;
}

//
// ### validateLogin() ###
//
// Validate the edit form
//
//

function validateLogin() {
    $('.errorReg').remove();
    var username = validateLettersNumbersSpecials('#username', {
        'req': 'El campo es requerido',
        'val': 'Ingrese solo caracteres v&aacute;lidos'
    }, 15, 8);
    var pass = validateLettersNumbers('#password', {
        'req': 'El campo es requerido',
        'val': 'Ingrese solo caracteres v&aacute;lidos'
    }, 15, 8);
    if (username && pass) {
        return true;
    }
    return false;
}

//
// ### validateOnlyLetters() ###
//
// Validate an input to receive only letters
//
//     @param {dom object} [sel] The input to validate
//     @param {object} [err] An object containing the errors
//     @param {number} [max] The maximium characters the input will accept
//
function validateOnlyLetters(sel, err, max) {
    var val = $(sel).val();
    var regex = /^[a-zA-Z ]+$/;
    var matched = val.match(regex);
    if (val == "") {
        var error = '<p class="errorReg">' + err.req + '</p>';
        if ($(sel).next().length == 0) {
            $(error).insertAfter(sel).fadeIn();
            return false;
        }
    }
    else {
        if (!val.match(regex)) {
            var error = '<p class="errorReg">' + err.val + '</p>';
            if ($(sel).next().length == 0) {
                $(error).insertAfter(sel).fadeIn();
                return false;
            }
        }
        else {
            if (max) {
                if (val.length > max) {
                    var error = '<p class="errorReg">Ingrese como m&aacute;ximo ' + max + ' caracteres</p>';
                    if ($(sel).next().length == 0) {
                        $(error).insertAfter(sel).fadeIn();
                        return false;
                    }
                }
                else {
                    return true;
                }
            }
        }
    }
}

//
// ### validateLettersNumbersSpecials() ###
//
// Validate an input to receive Letters, numbers, ".", "-", " ", and "_"
//
//     @param {dom object} [sel] The input to validate
//     @param {object} [err] An object containing the errors
//     @param {number} [max] The maximium characters the input will accept
//     @param {number} [min] The minimium characters the input will accept
//
function validateLettersNumbersSpecials(sel, err, max, min) {
    var val = $(sel).val();
    var regex = /^[a-zA-Z0-9\.\-\_]+$/;
    var matched = val.match(regex);
    if (val == "") {
        var error = '<p class="errorReg">' + err.req + '</p>';
        if ($(sel).next().length == 0) {
            $(error).insertAfter(sel).fadeIn();
            return false;
        }
    }
    else {
        if (!val.match(regex)) {
            var error = '<p class="errorReg">' + err.val + '</p>';
            if ($(sel).next().length == 0) {
                $(error).insertAfter(sel).fadeIn();
                return false;
            }
        }
        else {
            if (max) {
                if (val.length > max) {
                    var error = '<p class="errorReg">Ingrese como m&aacute;ximo ' + max + ' caracteres</p>';
                    if ($(sel).next().length == 0) {
                        $(error).insertAfter(sel).fadeIn();
                        return false;
                    }
                }
                else if (val.length < min) {
                    var error = '<p class="errorReg">Ingrese como m&iacute;nimo ' + min + ' caracteres</p>';
                    if ($(sel).next().length == 0) {
                        $(error).insertAfter(sel).fadeIn();
                        return false;
                    }
                }
                else {
                    return true;
                }
            }
        }
    }
}

//
// ### validateLettersNumbers() ###
//
// Validate an input to receive letters and numbers
//
//     @param {dom object} [sel] The input to validate
//     @param {object} [err] An object containing the errors
//     @param {number} [max] The maximium characters the input will accept
//     @param {number} [min] The minimium characters the input will accept
//
function validateLettersNumbers(sel, err, max, min) {
    var val = $(sel).val();
    var regex = /^[a-zA-Z0-9]+$/;
    var matched = val.match(regex);
    if (val == "") {
        var error = '<p class="errorReg">' + err.req + '</p>';
        if ($(sel).next().length == 0) {
            $(error).insertAfter(sel).fadeIn();
            return false;
        }
    }
    else {
        if (!val.match(regex)) {
            var error = '<p class="errorReg">' + err.val + '</p>';
            if ($(sel).next().length == 0) {
                $(error).insertAfter(sel).fadeIn();
                return false;
            }
        }
        else {
            if (max) {
                if (val.length > max) {
                    var error = '<p class="errorReg">Ingrese como m&aacute;ximo ' + max + ' caracteres</p>';
                    if ($(sel).next().length == 0) {
                        $(error).insertAfter(sel).fadeIn();
                        return false;
                    }
                }
                else if (val.length < min) {
                    var error = '<p class="errorReg">Ingrese como m&iacute;nimo ' + min + ' caracteres</p>';
                    if ($(sel).next().length == 0) {
                        $(error).insertAfter(sel).fadeIn();
                        return false;
                    }
                }
                else {
                    return true;
                }
            }
        }
    }
}

//
// ### validateMail() ###
//
// Validate an input to receive a correct email format
//
//     @param {dom object} [sel] The input to validate
//     @param {object} [err] An object containing the errors
//
function validateMail(sel, err) {
    var val = $(sel).val();
    var regex = /^[a-zA-Z\d!#$%&'*+/=?^_`{|}~-]+(?:\.[a-zA-Z\d!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-zA-Z\d](?:[a-zA-Z\d-]*[a-zA-Z\d])?\.)+[a-zA-Z\d](?:[a-zA-Z\d-]*[a-zA-Z\d])?$/;
    var matched = val.match(regex);
    if (val == "") {
        var error = '<p class="errorReg">' + err.req + '</p>';
        if ($(sel).next().length == 0) {
            $(error).insertAfter(sel).fadeIn();
            return false;
        }
    }
    else {
        if (!val.match(regex)) {
            var error = '<p class="errorReg">' + err.val + '</p>';
            if ($(sel).next().length == 0) {
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
// ### validateEquals() ###
//
// Validate an input to be exactly the same to another one
//
//     @param {dom object} [sel] The input to validate
//     @param {dom object} [comp] The input to compare
//     @param {object} [err] An object containing the errors
//
function validateEquals(sel, comp, err) {
    var val = $(sel).val();
    var comp = $(comp).val();
    if (val == comp) {
        return true;
    }
    else {
        var error = '<p class="errorReg">' + err.equal + '</p>';
        if ($(sel).next().length == 0) {
            $(error).insertAfter(sel).fadeIn();
            return false;
        }
    }
}