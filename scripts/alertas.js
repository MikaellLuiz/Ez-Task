function mostrarMensagemErro() {
    var mensagemErro = document.getElementById("alert");
    mensagemErro.style.display = "block";
    
    setTimeout(function() {
      mensagemErro.style.display = "none";
    }, 5000);
  }

  function exibirMensagemErro() {
    mostrarMensagemErro("Ocorreu um erro!");
  }
   
  document.addEventListener("DOMContentLoaded", exibirMensagemErro);