$(document).ready(function() {
	$('#profile').click(function() {
		requestData("");
	});
	$('#btnActualizarMisDatos').click(function(){
		ActualizarMisDatos();
		//obtener_usuarios("");
	});
	$('#btnConfirmacion').click(function(){
		ConfirmacionPass();
	});
	$('#btnCambiarContrasena').click(function(){
		PasswordUpdate();
	});
});


function requestData(data){
	$.ajax({
		url: "../Controllers/ConsultarMisDatos.php",
		type: "POST",
		data: data
	})
	.done(function (data, textStatus, jqXHR) {
		var consulta = JSON.parse( data );
		console.log(consulta);
		
		/*var apellido;
		var tipo_documento;
		var numero_documento;
		var correo;*/
		
		for (var i  in consulta.data) {
			var nombre = consulta.data[0][0].nombreUsuario;
			var apellido = consulta.data[0][0].apellidoUsuario;
			var tipo_documento = consulta.data[0][0].tipo_documento;
			var numero_documento = consulta.data[0][0].numero_documento;
			var correo = consulta.data[0][0].correoUsuario;
		}

		$('#inputMiNombre').val(nombre);
		$('#inputMiApellidos').val(apellido);
		if (tipo_documento == 'CC') {$('#inputMiTipoDocumento').val(1);}
		if (tipo_documento == 'TI') {$('#inputMiTipoDocumento').val(2);}
		if (tipo_documento == 'CE') {$('#inputMiTipoDocumento').val(3);}
		if (tipo_documento == 'TP') {$('#inputMiTipoDocumento').val(4);}
		if (tipo_documento == 'Otro'){$('#inputMiTipoDocumento').val(5);}
		$('#inputMiNumeroDocumento').val(numero_documento);
		$('#inputMiCorreo').val(correo);
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}



function ActualizarMisDatos(){
		var correoUsuario = $('#inputMiCorreo').val();
	    var tipo_documento = $('#inputMiTipoDocumento').val();
      	var numero_documento = $('#inputMiNumeroDocumento').val();
      	var nombreUsuario = $('#inputMiNombre').val();
      	var apellidoUsuario = $('#inputMiApellidos').val();

      	if (correoUsuario == "" || correoUsuario == 0 ||
      		tipo_documento == "" || tipo_documento == 0 ||
      		numero_documento == "" || numero_documento == 0 ||
      		nombreUsuario == "" || nombreUsuario == 0 ||
      		apellidoUsuario == "" || apellidoUsuario == 0 
      		) {
      		var html = `<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>Debe llenar todos los campos con sus datos
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			<span aria-hidden='true'>&times;</span></button></div>`;
			$('#mensajeMisDatos').html(html);
      	}
      	else{
		$.ajax({
			url: "../Controllers/ActualizarMisDatos.php",
			type: "POST",
			data: {
				correoUsuario,
				tipo_documento,
				numero_documento,
				nombreUsuario,
				apellidoUsuario,
			}
		})
		.done(function (data, textStatus, jqXHR) {
			console.log(data);
			$('#mensajeMisDatos').html(data);
	  })
		.fail(function (jqXHR, textStatus, errorThrown) {
			alert("La solicitud ha fallado: " + textStatus);
		});
	}
}


function ConfirmacionPass(){
		var user = $('#user').val();
	    var inputConfirmacion = $('#inputConfirmacion').val();
	    if (inputConfirmacion == "") {
	    	var mensajeError = `<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>Debe ingresar su contraseña
		<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		<span aria-hidden='true'>&times;</span></button></div>`;

		$('#mensaje').html(mensajeError);
	    }
	    else{
		$.ajax({
			url: "../Controllers/PasswordUpdate.php",
			type: "POST",
			data: {
				"opcion": 1,
				"user" : user,
				"inputConfirmacion" : inputConfirmacion
			}
		})
		.done(function (data, textStatus, jqXHR) {
			console.log(data);
			if (data == 1) {
				window.location.replace("http://localhost/sismv_MVC/Proyecto/app/Views/PasswordUpdateView.php");
			}
			if(data == 2){
				var mensajeError = `<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>Contraseña incorrecta
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			<span aria-hidden='true'>&times;</span></button></div>`;
			}
			$('#mensaje').html(mensajeError);
	  })
		.fail(function (jqXHR, textStatus, errorThrown) {
			alert("La solicitud ha fallado: " + textStatus);
		});
	}
}

function PasswordUpdate() {
      var idUsuario = $("#idUsuario").val();
      var inputContrasena = $("#inputContrasena").val();
      var inputValidarContrasena = $("#inputValidarContrasena").val();
      $.ajax({
        data: {
          "opcion":1,
          "idUsuario": idUsuario,
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





window.addEventListener("load", function() {
      formUpdate.inputMiNumeroDocumento.addEventListener("keypress", soloNumeros, false);
      formUpdate.inputMiNombre.addEventListener("keypress", soloLetras, false);
      formUpdate.inputMiApellidos.addEventListener("keypress", soloLetras, false);
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



