//Faz o processamento do Form de cadastroProjeto aguardar na mesma pagina
$(document).ready(function(){
  $('#cadastroProjeto').submit(function(event) {
    event.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      data: formData,
      success: function(response) {
        // Verifica o conteúdo da resposta do servidor
        response = response.trim();
        if (response === 'success') {
          alert('Projeto criado com Sucesso!');
          location.reload();
        } else {
          window.location.href = "index.php";
          alert('Houve um problema ao cria o projeto, por favor faça login novamente.');
        }
      },
      error: function(xhr, status, error) {
        // Manipula erros de requisição
        console.error(error);
        window.location.href = "index.php";
        alert('Houve um problema ao cria o projeto, por favor faça login novamente.');
      }
    });
  });
});