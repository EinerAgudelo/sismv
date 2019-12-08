$(document).ready(function(){
  $('#btnRegistrar').click(function(){
    var inputCorreo = $("#inputCorreo").val();
    validarEmailReg(inputCorreo);
  });

  $('#btnInicio').click(function(){
    var inputUsuario = $("#inputUsuario").val();
    validarEmail(inputUsuario);
  });

  $('#btnRestablecer').click(function(){
    RestPass();
  });

  $('#btnRestablecerContrasena').click(function(){
    CambiarContrasena(1);
  }); 

  $('#btnAsignarContrasena').click(function(){
    CambiarContrasena(2);
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

function validarEmailReg(valor) {
  if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor)){
   sendRequest();
   //alert("La dirección de email " + valor + " es correcta.");
 } else {
   //alert("La dirección de email es incorrecta.");
   var data = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><h3>¡Error!</h3><hr>"+
   "Debe digitar una direccion de correo electronico valida <button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
   " <span aria-hidden='true'>&times;</span></button></div>";
   $('#mensaje').html(data);

 }
}
function validarEmail(valor) {
  if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor)){
   login();
   //alert("La dirección de email " + valor + " es correcta.");
 } else {
   //alert("La dirección de email es incorrecta.");
   var data = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><h3>¡Error!</h3><hr>"+
   "Debe digitar una direccion de correo electronico valida <button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
   " <span aria-hidden='true'>&times;</span></button></div>";
   $('#mensaje').html(data);

 }
}



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
}


function RestPass() {
  var inputCorreo = $('#inputCorreo').val();
  $.ajax({
    data: {
      "inputCorreo": inputCorreo
    },
    type: "POST",
    dataType: "text",
    url: "../Controllers/RestPassController.php"
  })
  .done(function(data, textStatus, jqXHR){
    $('#mensaje').html(data);
    console.log(data);
  })
  .fail(function(jqXHR, textStatus, errorThrown){
    alert("La solicitud ha fallado: "+ textStatus);
  });
}


function CambiarContrasena(opcion) {
  var idUsuario = $("#idUsuario").val();
  var token = $("#token").val();
  var inputContrasena = $("#inputContrasena").val();
  var inputValidarContrasena = $("#inputValidarContrasena").val();

  if (inputContrasena != inputValidarContrasena) {
    mensaje = `
    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <h3>¡Error!</h3>
    <hr>
    Las contraseñas no coinciden 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span></button></div>`;

    $('#mensaje').html(mensaje);
  }else{
    

    $.ajax({
      data: {
        "opcion":opcion,
        "idUsuario": idUsuario,
        "token": token,
        "inputContrasena": inputContrasena,
        "inputValidarContrasena": inputValidarContrasena
      },
      type: "POST",
      dataType: "text",
      url: "../Controllers/GuardarPassController.php"
    })
    .done(function(data, textStatus, jqXHR){
      var mensaje = "";
      if (data == "error1") {
        mensaje = `
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <h3>¡Error!</h3>
        <hr>
        Debe llenar todos los campos 
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span></button></div>`;
      } 
      if (data == "error2") {
        mensaje = `
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <h3>¡Error!</h3>
        <hr>
        Las contraseñas tienen que coincidir 
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span></button></div>`;
      } 
      if (data == "Exito") {
        mensaje = `
        <div class='alert alert-primary alert-dismissible fade show' role='alert'>
        <h3>¡Listo!</h3>
        <hr>
        La contraseña a sido guardada correctamente
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span></button></div>`;
      } 
      
      $('#mensaje').html(mensaje);
    })
    .fail(function(jqXHR, textStatus, errorThrown){
      alert("La solicitud ha fallado: "+ textStatus);
    });
  }
}

window.addEventListener("load", function() {
  formRegister.inputNumeroDocumento.addEventListener("keypress", soloNumeros, false);
  formRegister.inputNombre.addEventListener("keypress", soloLetras, false);      
  formRegister.inputApellidos.addEventListener("keypress", soloLetras, false);           
});

    //Solo permite introducir numeros.
    function soloNumeros(e){
      var key = window.event ? e.which : e.keyCode;
      if (key < 48 || key > 57) {
        e.preventDefault();
      }
    }

    function soloLetras(e) {
      var key = "which" in e ? e.which : e.keyCode,
      char = String.fromCharCode(key),
      regex = /[a-z\u00C0-\u017F\s]/i;      
      if(!regex.test(char)) e.preventDefault(); return false;
    }
    