
// This function make the transitions animation to register or login
$(function() {

    $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
         $("#register-form").fadeOut(100);
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#register-form-link').click(function(e) {
        $("#register-form").delay(100).fadeIn(100);
         $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    
});

//-------------------------------------------------------------------------------------------------------------------------------------//
//This function verify if the passwords matchs or not

function validaSenha() {
  var campo1 = document.getElementById('password').value;
  var campo2 = document.getElementById('c_password').value;
  var confirmPassElement = document.getElementById('confirmPass');
  var registerBtElement = document.getElementById("registerBt");
  
  // Verificar se os campos estão vazios
  if (campo1 === '' || campo2 === '') {
    confirmPassElement.innerHTML = "";
    confirmPassElement.style.color = "white";
    registerBtElement.disabled = true;
    return;
  }
  
  if (campo1 === campo2) {
    confirmPassElement.innerHTML = "Senhas são iguais!";
    confirmPassElement.style.color = "green";
    registerBtElement.disabled = false;
  } else {
    confirmPassElement.innerHTML = "As senhas são diferentes.";
    confirmPassElement.style.color = "red";
    registerBtElement.disabled = true;
  }
}

//-------------------------------------------------------------------------------------------------------------------------------------//
// Está função verifica se o registro de usuario ocorreu corretamente e assim retorna uma mensagem para ser exibida na mesma pagina.
$(document).ready(function() {
  // Verificar se o cadastro foi bem-sucedido ao carregar a página de registro
  if ($('#register-form').is(':visible') && localStorage.getItem('cadastroSucesso')) {
      $('#sucesso').removeAttr('hidden'); // Exibe a div com ID 'sucesso'
      localStorage.removeItem('cadastroSucesso'); // Remove o indicador de cadastro bem-sucedido
  }

  $('#register-form').submit(function(event) {
    event.preventDefault();

    // Desabilita o botão de registro e atualiza o texto e o estilo
    var registerButton = $('#registerBt');
    registerButton.prop('disabled', true);
    registerButton.html(`
      <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status">Register</span>
    `);

    var formData = $(this).serialize();

    $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      data: formData,
      success: function(response) {
        // Verifica o conteúdo da resposta do servidor
        response = response.trim();
        if (response === 'success') {
          localStorage.setItem('cadastroSucesso', 'true'); // Salva o indicador de cadastro bem-sucedido
          location.reload();
        } else if (response === 'userErro') {
          $('#erroEmail').attr('hidden', true);
          $('#erroUser').removeAttr('hidden');
          $('#erroData').attr('hidden', true);
        } else if (response === 'emailErro') {
          $('#erroUser').attr('hidden', true);
          $('#erroEmail').removeAttr('hidden');
          $('#erroData').attr('hidden', true);
        } else if (response === 'dataErro') {
          $('#erroEmail').attr('hidden', true);
          $('#erroUser').attr('hidden', true);
          $('#erroData').removeAttr('hidden');
        }

        // Reabilita o botão de registro e restaura o texto e o estilo originais
        registerButton.prop('disabled', false);
        registerButton.html('Register');
      },
      error: function(xhr, status, error) {
        // Manipula erros de requisição
        console.error(error);
        alert('Verifique as informações e tente novamente.');

        // Reabilita o botão de registro e restaura o texto e o estilo originais
        registerButton.prop('disabled', false);
        registerButton.html('Register');
      }
    });
  });
});

//-------------------------------------------------------------------------------------------------------------------------------------//
//processa of FormLogin

$(document).ready(function() {
  $('#login-form').submit(function(event) {
    event.preventDefault();

    // Desabilita o botão de login e atualiza o texto e o estilo
    var loginButton = $('#login-button');
    loginButton.prop('disabled', true);
    loginButton.html(`
      <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status">Login</span>
    `);

    var formData = $(this).serialize();

    $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      data: formData,
      success: function(response) {
        // Verifica o conteúdo da resposta do servidor
        response = response.trim();
        if(response === 'success'){
          window.location.href = "home.php";
        }else if(response === 'errorBlock'){
          alert('Usuário bloqueado, contate um Administrador do sistema!');
        }else if(response === 'errorBan'){
          alert('Usuário está banido!');
        }else{
          alert('Usuário ou Senha inválidos!');
        }

        // Reabilita o botão de login e restaura o texto e o estilo originais
        loginButton.prop('disabled', false);
        loginButton.html('Login');
      },
      error: function(xhr, status, error) {
        // Manipula erros de requisição
        console.error(error);
        alert('Usuário ou Senha inválidos!');

        // Reabilita o botão de login e restaura o texto e o estilo originais
        loginButton.prop('disabled', false);
        loginButton.html('Login');
      }
    });
  });
});

