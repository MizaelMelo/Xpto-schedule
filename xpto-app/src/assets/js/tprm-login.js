$(function(){
    
    var email     = $('.form input[type=text]');
    var filtro    = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2,3}/;
    var password  = $(".form input[type=password]");
    var button    = $('#button');
    var msg_email = $('#msg_email span');
    var msg_pass  = $('#msg_pass span');
    var form      = $('.form');   
    var recupera  = $('.recupera');   
    var link_rec  = $('.forget');   
    
    email.focus();

    email.keyup(function(){
        validationEmail(email, msg_email);        
    });

    password.keyup(function() {
        validationSenha(password, msg_pass);
    });

    form.click(function(e){
        validationEmail(email, msg_email, e);
        validationSenha(password, msg_pass, e);
    });

    // Validação de email
    function validationEmail(email, message, e)
    {
        if (email.val() =='' || !filtro.test(email.val())) {
            
            msg_email.addClass('treme');
            
            if (typeof e != 'undefined')
            {
                e.preventDefault();
            }

            msg_email.html("* E-mail inválido");
            email.css("border", "1px solid red");

        } else {
            msg_email.removeClass("treme");
            msg_email.html("");
            email.css("border", "1px solid rgb(105, 105, 105)");
        }
    }

    function validationSenha(password, message, e)
    {
        if (password.val() == "") {

            msg_pass.addClass("treme");
 
            if (typeof e != "undefined") {
               e.preventDefault();
            }

            msg_pass.html("* Campo obrigatório");
            password.css("border", "1px solid red");
        }
        else {
            msg_pass.removeClass("treme");
            msg_pass.html("");
            password.css("border", "1px solid rgb(105, 105, 105)");
        }
    }
});

