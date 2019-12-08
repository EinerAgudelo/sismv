$(document).ready(function(){
  $('#btnRegistrar').click(function(){
    sendRequest();
  });

  $('#btnInicio').click(function(){
    login();
  });

  $("#collapseExample").collapse('toggle');
  $("#collapseExample2").collapse('toggle');

  $("#btnFormLogear").click(function(){
    $("#collapseExample2").collapse('hide');
    $("#collapseExample").collapse('hide');
  });

  $("#btnFormRegistrar").click(function(){
    $("#collapseExample").collapse('hide');
    $("#collapseExample2").collapse('hide');
  });
});




function login(){
      var inputUsuario = $('#inputUsuario').val();
      var inputPassword = $('#inputPassword').val();

      $.ajax({
  // En data puedes utilizar un objeto JSON, un array o un query string
  data: {
    inputUsuario,
    inputPassword // all variables i want to pass. In this case, only one.
  },
  //Cambiar a type: POST si necesario
  type: "POST",
  // Formato de datos que se espera en la respuesta
  dataType: "text",
  // URL a la que se enviará la solicitud Ajax
  url: "app/Controllers/Login_Controller.php"
})
      .done(function (data, textStatus, jqXHR) {
      if (data == "1") {
      window.location.replace("http://localhost/sismv_MVC/Proyecto/app/");
      }else{
        $('#mensaje').html(data);
      }
    })
      .fail(function (jqXHR, textStatus, errorThrown) {
        alert("La solicitud ha fallado: " + textStatus);
      });
    };




function sendRequest(){

      var inputNombre = $('#inputNombre').val();
      var inputApellidos = $('#inputApellidos').val();
      var inputTipoDocumento = $('#inputTipoDocumento').val();
      var inputNumeroDocumento = $('#inputNumeroDocumento').val();
      var inputCorreo = $('#inputCorreo').val();
      var inputContrasena = $('#inputContrasena').val();
      var inputValidarContrasena = $('#inputValidarContrasena').val();

      $.ajax({
  // En data puedes utilizar un objeto JSON, un array o un query string
  data: {
    inputNombre,
    inputApellidos,
    inputTipoDocumento,
    inputNumeroDocumento,
    inputCorreo,
    inputContrasena,
    inputValidarContrasena // all variables i want to pass. In this case, only one.
  },
  //Cambiar a type: POST si necesario
  type: "POST",
  // Formato de datos que se espera en la respuesta
  dataType: "text",
  // URL a la que se enviará la solicitud Ajax
  url: "app/Controllers/Register_Controller.php"
})
      .done(function (data, textStatus, jqXHR) {
      //alert(data);
      $('#mensaje').html(data);
    })
      .fail(function (jqXHR, textStatus, errorThrown) {
        alert("La solicitud ha fallado: " + textStatus);
      });
    };

   