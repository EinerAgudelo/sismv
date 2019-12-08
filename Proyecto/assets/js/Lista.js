$(document).ready(function(){

	obtener_usuarios("");

  $("#RegistrarUsuarios").collapse('hide');

	$("#ConsultarApellido").collapse('hide');

	$("#ConsultarCorreo").collapse('hide');

	$("#ConsultarEstado").collapse('hide');

	$("#ConsultarNombre").collapse('hide');

	$("#ConsultarRol").collapse('hide');


	$("#inputCorreoUpdate").prop('disabled', true);
	

	$("#btnRegistrarUsuarios").click(function(){
    var inputCorreo = $("#inputCorreo").val();
    validarEmailReg(inputCorreo);
		obtener_usuarios("");
	});

	$("#btnConsultarNombre").click(function(){
		consultar_nombre();
	});

	$("#btnConsultarTodos").click(function(){
		obtener_usuarios("");
	});

	$("#btnConsultarApellido").click(function(){
		consultar_apellido();
	});

	$("#btnConsultarCorreo").click(function(){   
    var inputConsultaCorreo = $("#inputConsultaCorreo").val();
    validarEmail(inputConsultaCorreo); 		
	});

	$("#btnConsultarEstado").click(function(){
		ConsultarEstado();
	});
	$("#btnConsultarRol").click(function(){
		ConsultarRol();
	});

	$("#btnUpdateUser").click(function(){
		updateUser();
		obtener_usuarios("");
	});


	

});
function validarEmail(valor) {
  if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor)){
   ConsultarCorreo();
   //alert("La dirección de email " + valor + " es correcta.");
  } else {
   //alert("La dirección de email es incorrecta.");
   var data = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><h3>¡Error!</h3><hr>"+
   "Debe digitar una direccion de correo electronico valida <button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
   " <span aria-hidden='true'>&times;</span></button></div>";
   $('#mensaje').html(data);

  }
}
function validarEmailReg(valor) {
  if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor)){
   requestMensaje();
   obtener_usuarios("");
   //alert("La dirección de email " + valor + " es correcta.");
 } else {
   //alert("La dirección de email es incorrecta.");
   var data = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><h3>¡Error!</h3><hr>"+
   "Debe digitar una direccion de correo electronico valida <button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
   " <span aria-hidden='true'>&times;</span></button></div>";
   $('#mensaje').html(data);

 }
}

function obtener_usuarios(data){

	$.ajax({
		url: "../Controllers/Lista_Usuarios.php",
		type: "POST",
		data: data
		//dataType: "JSON"
	})
	.done(function (data, textStatus, jqXHR) {

		console.log(data);
		var tabla = JSON.parse(data);
		
		var html = "";
      
      for (var i in tabla.data) {
      	//console.log(tabla.data[i]);
      	html += `<tr>
      	<td>${tabla.data[i].idUsuario}</td>
      	<td>${tabla.data[i].tipo_documento}</td>
      	<td>${tabla.data[i].numero_documento}</td>
      	<td>${tabla.data[i].nombreUsuario}</td>
      	<td>${tabla.data[i].apellidoUsuario}</td>
      	<td>${tabla.data[i].correoUsuario}</td>
      	<td>${tabla.data[i].estadoUsuario}</td>`;
      	if (tabla.data[i].rol == 1) {
      		html+=`<td>Administrador</td>`;
      	}else{
      		html+=`<td>Cliente</td>`;
      	}
      	html+=`<td>
      	<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateUser" name='btnActualizar' onclick="consultaUsuarioId(${tabla.data[i].idUsuario})">
      	<i class='fas fa-user-edit'></i></button>
      	<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='eliminar(${tabla.data[i].idUsuario})'>
      	<i class='fas fa-trash'></i></button>
      	</td>
      	</tr>`;
      }
      $('#tbodyUsers').html(html);
      $('#tableUser').DataTable({
    //para cambiar el lenguaje a español
        "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
           },
           "sProcessing":"Procesando...",
            }
    });
  })
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}

function consultar_nombre(){
	var inputNombre = $('#inputConsultaNombre').val();
	$.ajax({
		url: "../Controllers/ConsultaUsuarioNombre.php",
		type: "POST",
		data: {
			"inputNombre" : inputNombre
		}
	})
	.done(function (data, textStatus, jqXHR) {
		console.log(data);
		var html = "";

    var mensaje = "";

    if(data == "error1"){
      mensaje = `<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>Debe llenar el campo
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span></button></div>`;

            $('#mensaje').html(mensaje);
    }
    if(data == "error2"){
      mensaje = `<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>No hay ningun usuario con este apellido
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span></button></div>`;

            $('#mensaje').html(mensaje);

    }
    else{
      var tabla = JSON.parse( data );
        //console.log(data);
        for (var i in tabla.data) {
        	//console.log(tabla.data[i]);
        	html += `<tr>
        	<td>${tabla.data[i].idUsuario}</td>
        	<td>${tabla.data[i].tipo_documento}</td>
        	<td>${tabla.data[i].numero_documento}</td>
        	<td>${tabla.data[i].nombreUsuario}</td>
        	<td>${tabla.data[i].apellidoUsuario}</td>
        	<td>${tabla.data[i].correoUsuario}</td>
        	<td>${tabla.data[i].estadoUsuario}</td>`;
        	if (tabla.data[i].rol == 1) {
        		html+=`<td>Administrador</td>`;
        	}else{
        		html+=`<td>Cliente</td>`;
        	}
        	html+=`<td>
        	<button class='btn btn-primary btn-sm' name='btnActualizar' data-toggle="modal" data-target="#ModalUpdateUser" onclick="consultaUsuarioId(${tabla.data[i].idUsuario})">
        	<i class='fas fa-user-edit'></i></button>
        	<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='eliminar(${tabla.data[i].idUsuario})'>
        	<i class='fas fa-trash'></i></button>
        	</td>
        	</tr>`;
        }
        $('#tbodyUsers').html(html);
        $('#tableUser').DataTable({
    //para cambiar el lenguaje a español
        "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
           },
           "sProcessing":"Procesando...",
            }
    });
    }
  })
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}



function consultar_apellido(){
	var inputApellido = $('#inputConsultaApellido').val();
	$.ajax({
		url: "../Controllers/ConsultaUsuarioApellido.php",
		type: "POST",
		data: {
			inputApellido
		}
	})
	.done(function (data, textStatus, jqXHR) {
		console.log(data);
    var mensaje = "";

    if(data == "error1"){
      mensaje = `<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>Debe llenar el campo
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span></button></div>`;

            $('#mensaje').html(mensaje);
    }
    if(data == "error2"){
      mensaje = `<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>No hay ningun usuario con este apellido
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span></button></div>`;

            $('#mensaje').html(mensaje);

    }
    else{
  		var tabla = JSON.parse( data );
  		var html = "";
        //console.log(data);
        for (var i in tabla.data) {
        	//console.log(tabla.data[i]);
        	html += `<tr>
        	<td>${tabla.data[i].idUsuario}</td>
        	<td>${tabla.data[i].tipo_documento}</td>
        	<td>${tabla.data[i].numero_documento}</td>
        	<td>${tabla.data[i].nombreUsuario}</td>
        	<td>${tabla.data[i].apellidoUsuario}</td>
        	<td>${tabla.data[i].correoUsuario}</td>
        	<td>${tabla.data[i].estadoUsuario}</td>`;
        	if (tabla.data[i].rol == 1) {
        		html+=`<td>Administrador</td>`;
        	}else{
        		html+=`<td>Cliente</td>`;
        	}
        	html+=`<td>
        	<button class='btn btn-primary btn-sm consultar' data-toggle="modal" data-target='#ModalUpdateUser'  name='btnActualizar' onclick="consultaUsuarioId(${tabla.data[i].idUsuario})">
        	<i class='fas fa-user-edit'></i></button>
        	<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='eliminar(
        	${tabla.data[i].idUsuario})'>
        	<i class='fas fa-trash'></i></button>
        	</td>
        	</tr>
        	`;
        }
        $('#tbodyUsers').html(html);
        $('#tableUser').DataTable({
    //para cambiar el lenguaje a español
        "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
           },
           "sProcessing":"Procesando...",
            }
    });
      }

  })
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}

function consultaUsuarioId(id) {
	$.ajax({
		url: "../Controllers/ConsultaUsuarioId.php",
		type: "POST",
		data: {
			id
		}
	})
	.done(function (data, textStatus, jqXHR) {
		console.log(data);
		var tabla = JSON.parse( data );
		//var html = "";
      //console.log(data);
      for (var i in tabla.data) {
      	//var idUsuario = tabla.data[i].idUsuario;
      	var tipo_documento = tabla.data[i].tipo_documento;
      	var numero_documento = tabla.data[i].numero_documento;
      	var nombreUsuario = tabla.data[i].nombreUsuario;
      	var apellidoUsuario = tabla.data[i].apellidoUsuario;
      	var correoUsuario = tabla.data[i].correoUsuario;
      	var estadoUsuario = tabla.data[i].estadoUsuario;
      	var rol = tabla.data[i].rol;
      }
      $('#inputNombreUpdate').val(nombreUsuario);
      $('#inputApellidosUpdate').val(apellidoUsuario);
      if (tipo_documento == 'CC') {$('#inputTipoDocumentoUpdate').val(1);}
      if (tipo_documento == 'TI') {$('#inputTipoDocumentoUpdate').val(2);}
      if (tipo_documento == 'CE') {$('#inputTipoDocumentoUpdate').val(3);}
      if (tipo_documento == 'TP') {$('#inputTipoDocumentoUpdate').val(4);}
      if (tipo_documento == 'Otro'){$('#inputTipoDocumentoUpdate').val(5);}
      $('#inputNumeroDocumentoUpdate').val(numero_documento);
      $('#inputCorreoUpdate').val(correoUsuario);
      if (estadoUsuario == 'Administrador') {$('#inputEstadoUpdate').val(1);}
      else{$('#inputEstadoUpdate').val(2);}
      $('#inputRolUpdate').val(rol);
  })
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}

function updateUser(){
		var correoUsuario = $('#inputCorreoUpdate').val();
	    var tipo_documento = $('#inputTipoDocumentoUpdate').val();
      	var numero_documento = $('#inputNumeroDocumentoUpdate').val();
      	var nombreUsuario = $('#inputNombreUpdate').val();
      	var apellidoUsuario = $('#inputApellidosUpdate').val();
      	var estadoUsuario = $('#inputEstadoUpdate').val();
      	var rol = $('#inputRolUpdate').val();

        if ( correoUsuario == "" || correoUsuario == 0 ||
          tipo_documento == "" || tipo_documento == 0 ||
          numero_documento == "" || numero_documento == 0 ||
          nombreUsuario == "" || nombreUsuario == 0 ||
          apellidoUsuario == "" || apellidoUsuario == 0 ||
          estadoUsuario == "" || estadoUsuario == 0 ||
          rol == "" || rol == 0 ) {
          var mensaje = `<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>Debe llenar todos los campos
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span></button></div>`;

          $("#mensaje").html(mensaje);
        }
        else{
        	$.ajax({
        		url: "../Controllers/ActualizarUsuario.php",
        		type: "POST",
        		data: {
        			correoUsuario,
        			tipo_documento,
        			numero_documento,
        			nombreUsuario,
        			apellidoUsuario,
        			estadoUsuario,
        			rol,
        		}
        	})
        	.done(function (data, textStatus, jqXHR) {
        		console.log(data);
        		//alert(data);

          		$('#mensaje').html(data);
          		obtener_usuarios("");
            
          })
        	.fail(function (jqXHR, textStatus, errorThrown) {
        		alert("La solicitud ha fallado: " + textStatus);
        	});
        }


}


function ConsultarCorreo(){
	var inputCorreo = $('#inputConsultaCorreo').val();
	$.ajax({
		url: "../Controllers/ConsultaUsuarioCorreo.php",
		type: "POST",
		data: {
			"inputCorreo" : inputCorreo
		}
	})
	.done(function (data, textStatus, jqXHR) {
		console.log(data);

    var mensaje = "";

    if(data == "error1"){
      mensaje = `<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>Debe llenar el campo
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span></button></div>`;

            $('#mensaje').html(mensaje);
    }
    if(data == "error2"){
      mensaje = `<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>No hay ningun usuario con este apellido
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span></button></div>`;

            $('#mensaje').html(mensaje);

    }
    else{

  		var tabla = JSON.parse( data );
  		var html = "";
        //console.log(data);
        for (var i in tabla.data) {
        	//console.log(tabla.data[i]);
        	html += `<tr>
        	<td>${tabla.data[i].idUsuario}</td>
        	<td>${tabla.data[i].tipo_documento}</td>
        	<td>${tabla.data[i].numero_documento}</td>
        	<td>${tabla.data[i].nombreUsuario}</td>
        	<td>${tabla.data[i].apellidoUsuario}</td>
        	<td>${tabla.data[i].correoUsuario}</td>
        	<td>${tabla.data[i].estadoUsuario}</td>`;
        	if (tabla.data[i].rol == 1) {
        		html+=`<td>Administrador</td>`;
        	}else{
        		html+=`<td>Cliente</td>`;
        	}
        	html+=`<td>
        	<button class='btn btn-primary btn-sm' name='btnActualizar' data-toggle="modal" data-target="#ModalUpdateUser" onclick="consultaUsuarioId(${tabla.data[i].idUsuario})">
        	<i class='fas fa-user-edit'></i></button>
        	<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='eliminar(
        	${tabla.data[i].idUsuario})'>
        	<i class='fas fa-trash'></i></button>
        	</td>
        	</tr>`;
        }
        $('#tbodyUsers').html(html);
        $('#tableUser').DataTable({
    //para cambiar el lenguaje a español
        "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
           },
           "sProcessing":"Procesando...",
            }
    });
      }
  })
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}


function ConsultarEstado(){
	var inputEstado = $('#inputConsultarEstado').val();
	$.ajax({
		url: "../Controllers/ConsultaUsuarioEstado.php",
		type: "POST",
		data: {
			"inputEstado" : inputEstado
		}
	})
	.done(function (data, textStatus, jqXHR) {
		console.log(data);
            if(data == "error"){
              var mensaje = `<div class='alert alert-warning alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>No hay ningun usuario con este tipo de estado
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span></button></div>`;

            $('#mensaje').html(mensaje);
            }
            else{
          		var tabla = JSON.parse( data );
          		var html = "";
                //console.log(data);
                for (var i in tabla.data) {
                	//console.log(tabla.data[i]);
                	html += `<tr>
                	<td>${tabla.data[i].idUsuario}</td>
                	<td>${tabla.data[i].tipo_documento}</td>
                	<td>${tabla.data[i].numero_documento}</td>
                	<td>${tabla.data[i].nombreUsuario}</td>
                	<td>${tabla.data[i].apellidoUsuario}</td>
                	<td>${tabla.data[i].correoUsuario}</td>
                	<td>${tabla.data[i].estadoUsuario}</td>`;
                	if (tabla.data[i].rol == 1) {
                		html+=`<td>Administrador</td>`;
                	}else{
                		html+=`<td>Cliente</td>`;
                	}
                	html+=`<td>
                	<button class='btn btn-primary btn-sm' name='btnActualizar' data-toggle="modal" data-target="#ModalUpdateUser" onclick="consultaUsuarioId(${tabla.data[i].idUsuario})">
                	<i class='fas fa-user-edit'></i></button>
                	<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='eliminar(
                	${tabla.data[i].idUsuario})'>
                	<i class='fas fa-trash'></i></button>
                	</td>
                	</tr>`;
                }
                $('#tbodyUsers').html(html);
                $('#tableUser').DataTable({
                //para cambiar el lenguaje a español
                    "language": {
                            "lengthMenu": "Mostrar _MENU_ registros",
                            "zeroRecords": "No se encontraron resultados",
                            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                            "sSearch": "Buscar:",
                            "oPaginate": {
                                "sFirst": "Primero",
                                "sLast":"Último",
                                "sNext":"Siguiente",
                                "sPrevious": "Anterior"
                       },
                       "sProcessing":"Procesando...",
                        }
                });
    }
  })
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}






function ConsultarRol(){
	var inputRol = $('#inputConsultaRol').val();
	$.ajax({
		url: "../Controllers/ConsultaUsuarioRol.php",
		type: "POST",
		data: {
			"inputRol" : inputRol
		}
	})
	.done(function (data, textStatus, jqXHR) {
		console.log(data);
		var tabla = JSON.parse( data );
		var html = "";
      //console.log(data);
      for (var i in tabla.data) {
      	//console.log(tabla.data[i]);
      	html += `<tr>
      	<td>${tabla.data[i].idUsuario}</td>
      	<td>${tabla.data[i].tipo_documento}</td>
      	<td>${tabla.data[i].numero_documento}</td>
      	<td>${tabla.data[i].nombreUsuario}</td>
      	<td>${tabla.data[i].apellidoUsuario}</td>
      	<td>${tabla.data[i].correoUsuario}</td>
      	<td>${tabla.data[i].estadoUsuario}</td>`;
      	if (tabla.data[i].rol == 1) {
      		html+=`<td>Administrador</td>`;
      	}else{
      		html+=`<td>Cliente</td>`;
      	}
      	html+=`<td>
      	<button class='btn btn-primary btn-sm' name='btnActualizar' data-toggle="modal" data-target="#ModalUpdateUser" onclick="consultaUsuarioId(${tabla.data[i].idUsuario})">
      	<i class='fas fa-user-edit'></i></button>
      	<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='eliminar(
      	${tabla.data[i].idUsuario})'>
      	<i class='fas fa-trash'></i></button>
      	</td>
      	</tr>`;
      }
      $('#tbodyUsers').html(html);
      $('#tableUser').DataTable({
      //para cambiar el lenguaje a español
          "language": {
                  "lengthMenu": "Mostrar _MENU_ registros",
                  "zeroRecords": "No se encontraron resultados",
                  "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                  "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                  "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                  "sSearch": "Buscar:",
                  "oPaginate": {
                      "sFirst": "Primero",
                      "sLast":"Último",
                      "sNext":"Siguiente",
                      "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
              }
        });
  })
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}


function requestMensaje() {
	var inputNombre = $('#inputNombre').val();
	var inputApellidos = $('#inputApellidos').val();
	var inputTipoDocumento = $('#inputTipoDocumento').val();
	var inputNumeroDocumento = $('#inputNumeroDocumento').val();
	var inputCorreo = $('#inputCorreo').val();
	/*var inputContrasena = $('#inputContrasena').val();
	var inputValidarContrasena = $('#inputValidarContrasena').val();*/
	var inputEstado = $('#inputEstado').val();
	var inputRol = $('#inputRol').val();
	$.ajax({
		url: "../Controllers/Usuarios_Controller.php",
		type: "POST",
		dataType: "text",
		data:{
			inputNombre,
			inputApellidos,
			inputTipoDocumento,
			inputNumeroDocumento,
			inputCorreo,
			/*inputContrasena,
			inputValidarContrasena,*/
			inputEstado,
			inputRol
		}
	}).done(function (data, textStatus, jqXHR) {
		console.log(data);
		$('#mensaje').html(data);
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}



function eliminar(id) {
	if (confirm("¿Desea eliminar este usuario?")) {
		//document.location.href= "../Controllers/delete_Usuarios.php?id=" + id;
			$.ajax({
		url: "../Controllers/delete_Usuarios.php",
		type: "GET",
		dataType: "text",
		data:{
			id
		}
	}).done(function (data, textStatus, jqXHR) {
		console.log(data);
		//$('#mensaje').html(data);
		obtener_usuarios(data);

	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}
}

window.addEventListener("load", function() {
      formRegister.inputNumeroDocumento.addEventListener("keypress", soloNumeros, false);
      formUpdateUser.inputNumeroDocumentoUpdate.addEventListener("keypress", soloNumeros, false);      
      formRegister.inputNombre.addEventListener("keypress", soloLetras, false);      
      formRegister.inputApellidos.addEventListener("keypress", soloLetras, false);      
      formUpdateUser.inputNombreUpdate.addEventListener("keypress", soloLetras, false);      
      formUpdateUser.inputApellidosUpdate.addEventListener("keypress", soloLetras, false);      
      formConsultarNombre.inputConsultaNombre.addEventListener("keypress", soloLetras, false);
      formConsultarApellido.inputConsultaApellido.addEventListener("keypress", soloLetras, false);     
      //formConsultarCorreo.inputConsultaCorreo.addEventListener("KeyUp", validarEmail, false);      
    });
/*window.addEventKeyUp("load", function() {
  formConsultarCorreo.inputConsultaCorreo.addEventKeyUp("KeyUp", validarEmail, false);
});*/

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

    function validarEmail(elemento){

      var key = document.getElementById(elemento.id).value;
      /*var key = window.event ? e.length : e.key;
      valueForm=key.value;*/
      //var char = String.fromCharCode(key);
      var regex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
      
      if (!regex.test(key)) {
          var data = "<div class='alert alert-danger alert-dismissible fade show' role='alert'><h3>¡Error!</h3><hr>"+
          "Debe digitar una direccion de correo electronico valida <button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
          " <span aria-hidden='true'>&times;</span></button></div>";
          $('#mensaje').html(data);
      } else {
        var data = "<div class='alert alert-primary alert-dismissible fade show' role='alert'><h3>¡Listo!</h3>"+
        "<hr>Correo valido <button type='button' class='close' data-dismiss='alert' aria-label='Close'>"+
        "<span aria-hidden='true'>&times;</span></button></div>";
        $('#mensaje').html(data);
      }

    }