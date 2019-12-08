$(document).ready(function() {

ListaSedes("");
LlenarSelectCodigoRegister("");
LlenarSelectCodigoUpdate("");
LlenarSelectConsulCentro("");

$("#RegistrarSede").collapse('hide');

$("#ConsultarNombre").collapse('hide');

$("#ConsultarCentro").collapse('hide');

$("#ConsultarAcronimo").collapse('hide');

$("#ConsultarDireccion").collapse('hide');

$("#ConsultarEstado").collapse('hide');

$("#btnRegistrarSede").click(function(){
		RegistrarSede();		
	});
$("#btnConsultarTodos").click(function(e){
		e.preventDefault();
		ListaSedes("");
	});
$("#btnUpdateSede").click(function(e){
		e.preventDefault();
		ActualizarSede();
	});
$("#btnConsultaNombre").click(function(e){
		e.preventDefault();
		ConsultarSedeNombre();
	});
$("#btnConsultaCentro").click(function(e){
		e.preventDefault();
		ConsultarSedeCentro();
	});
$("#btnConsultaDireccion").click(function(e){
		e.preventDefault();
		ConsultarSedeDireccion();
	});
$("#btnConsultarEstado").click(function(e){
		e.preventDefault();
		ConsultarSedeEstado();
	});
});

function LlenarSelectCodigoRegister(data){
	$.ajax({
		url: "../Controllers/ConsultarSedeCentroController.php",
		type: "POST",
		data: {
			"data":data
		}
		//dataType: "JSON"
	})
	.done(function (data, textStatus, jqXHR) {

		console.log(data);

		var html = "<select class='form-control' id='selectIdCentro' >";
		for(var i in data){
			
			//console.log(data[i].idCentro);
			html += `<option value=${data[i].idCentro}>${data[i].idCentro}. ${data[i].nombreCentro}</option>`;
		}
		html +=`</select>`;
		$('#selectCodigoCen1').html(html);

	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}

function LlenarSelectCodigoUpdate(data){
	$.ajax({
		url: "../Controllers/ConsultarSedeCentroController.php",
		type: "POST",
		data: {
			"data":data
		}
		//dataType: "JSON"
	})
	.done(function (data, textStatus, jqXHR) {

		console.log(data);

		var html = "<select class='form-control' id='selectIdCentroUpdate' >";
		for(var i in data){
			
			//console.log(data[i].idCentro);
			html += `<option value=${data[i].idCentro}>${data[i].idCentro}. ${data[i].nombreCentro}</option>`;
		}
		html +=`</select>`;
		$('#selectCodigoCen').html(html);

	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}

function LlenarSelectConsulCentro(data){
	$.ajax({
		url: "../Controllers/ConsultarSedeCentroController.php",
		type: "POST",
		data: {
			"data":data
		}
		//dataType: "JSON"
	})
	.done(function (data, textStatus, jqXHR) {

		console.log(data);

		var html = "<select class='form-control' id='inputConsultaCentro' >";
		html += "<option value=0></option>";
		for(var i in data){
			
			//console.log(data[i].idCentro);
			html += `<option value=${data[i].idCentro}>${data[i].nombreCentro}</option>`;
		}
		html +=`</select>`;
		$('#selectNombreCen').html(html);

	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}


function ListaSedes(data) {
	
	$.ajax({
		url: "../Controllers/ConsultarSedeController.php",
		type: "POST",
		data: {
			"data":data
		}
		//dataType: "JSON"
	})
	.done(function (data, textStatus, jqXHR) {

		//console.log(data);
		
		var html = "";
		for(var i in data){
			//console.log(data[i]);
			html += `<tr>
			<td>${data[i].idSede}</td>
			<td>${data[i].nombreSede}</td>
			<td>${data[i].nombreCentro}</td>
			<td>${data[i].direccion}</td>
			<td>${data[i].telefono}</td>
			<td>${data[i].estadoSede}</td>
			<td>
      	<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateSede" id="btnActualizarSede" name='btnActualizarSede' onclick="consultaSedeId(${data[i].idSede})">
      	<i class='fas fa-user-edit'></i></button>
      	<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarSede(${data[i].idSede})'>
      	<i class='fas fa-trash'></i></button>
      	</td>
      	</tr>`;
		}

		$('#tbodySede').html(html);
		$('#tableSede').DataTable({
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


function RegistrarSede() {
	var nombreSede = $("#inputNombreSede").val();
	var idCentro = $("#selectIdCentro").val();
	var direccion = $("#inputDireccionSede").val();	
	var telefono = $("#inputTelefonoSede").val();	
	var estadoSede = $("#inputEstado").val();	
	//var estadoSensor = document.getElementById('inputEstado').val();
	$.ajax({
  // En data puedes utilizar un objeto JSON, un array o un query string
  data: {

    "idCentro": idCentro,
    "nombreSede": nombreSede, // all variables i want to pass. In this case, only one.
    "direccion": direccion,
    "telefono": telefono,
    "estadoSede": estadoSede
  },
  //Cambiar a type: POST si necesario
  type: "POST",
  // Formato de datos que se espera en la respuesta
  dataType: "text",
  // URL a la que se enviará la solicitud Ajax
  url: "../Controllers/RegistrarSede.php"
})
      .done(function (data, textStatus, jqXHR) {
      $('#mensajeSede').html(data);
      ListaSedes("");
    })
      .fail(function (jqXHR, textStatus, errorThrown) {
        alert("La solicitud ha fallado: " + textStatus);
      });
}

function ConsultarSedeNombre(){

var nombreSede = $("#inputConsultaNombre").val();

	$.ajax({
  // En data puedes utilizar un objeto JSON, un array o un query string
  data: {
  	"nombreSede": nombreSede	 // all variables i want to pass. In this case, only one.
	},
  	//Cambiar a type: POST si necesario
  type: "POST",
  	// Formato de datos que se espera en la respuesta
  //dataType: "text",
  	// URL a la que se enviará la solicitud Ajax
  url: "../Controllers/ConsultarSedeNombre.php"
})
	.done(function (data, textStatus, jqXHR) {
		console.log(data);
		var html = "";
		var html = "";
		for(var i in data){
			//console.log(data[i]);
			html += `<tr>
			<td>${data[i].idSede}</td>
			<td>${data[i].nombreSede}</td>
			<td>${data[i].nombreCentro}</td>
			<td>${data[i].direccion}</td>
			<td>${data[i].telefono}</td>
			<td>${data[i].estadoSede}</td>
			<td>
      	<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateSede" id="btnActualizarSede" name='btnActualizarSede' onclick="consultaSedeId(${data[i].idSede})">
      	<i class='fas fa-user-edit'></i></button>
      	<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarSede(${data[i].idSede})'>
      	<i class='fas fa-trash'></i></button>
      	</td>
      	</tr>`;
		}

		$('#tbodySede').html(html);
		$('#tableSede').DataTable({
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

function ConsultarSedeCentro(){

var idCentro = $("#inputConsultaCentro").val();

	$.ajax({
  // En data puedes utilizar un objeto JSON, un array o un query string
  data: {
  	"idCentro": idCentro	 // all variables i want to pass. In this case, only one.
	},
  	//Cambiar a type: POST si necesario
  type: "POST",
  	// Formato de datos que se espera en la respuesta
  //dataType: "text",
  	// URL a la que se enviará la solicitud Ajax
  url: "../Controllers/ConsultarSedeCentro.php"
})
	.done(function (data, textStatus, jqXHR) {
		console.log(data);
		var html = "";
		var html = "";
		for(var i in data){
			//console.log(data[i]);
			html += `<tr>
			<td>${data[i].idSede}</td>
			<td>${data[i].nombreSede}</td>
			<td>${data[i].nombreCentro}</td>
			<td>${data[i].direccion}</td>
			<td>${data[i].telefono}</td>
			<td>${data[i].estadoSede}</td>
			<td>
      	<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateSede" id="btnActualizarSede" name='btnActualizarSede' onclick="consultaSedeId(${data[i].idSede})">
      	<i class='fas fa-user-edit'></i></button>
      	<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarSede(${data[i].idSede})'>
      	<i class='fas fa-trash'></i></button>
      	</td>
      	</tr>`;
		}

		$('#tbodySede').html(html);
		$('#tableSede').DataTable({
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

function ConsultarSedeDireccion(){

var direccion = $("#inputConsultaDireccion").val();

	$.ajax({
  // En data puedes utilizar un objeto JSON, un array o un query string
  data: {
  	"direccion": direccion	 // all variables i want to pass. In this case, only one.
	},
  	//Cambiar a type: POST si necesario
  type: "POST",
  	// Formato de datos que se espera en la respuesta
  //dataType: "text",
  	// URL a la que se enviará la solicitud Ajax
  url: "../Controllers/ConsultarSedeDireccion.php"
})
	.done(function (data, textStatus, jqXHR) {
		console.log(data);
		var html = "";
		var html = "";
		for(var i in data){
			//console.log(data[i]);
			html += `<tr>
			<td>${data[i].idSede}</td>
			<td>${data[i].nombreSede}</td>
			<td>${data[i].nombreCentro}</td>
			<td>${data[i].direccion}</td>
			<td>${data[i].telefono}</td>
			<td>${data[i].estadoSede}</td>
			<td>
      	<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateSede" id="btnActualizarSede" name='btnActualizarSede' onclick="consultaSedeId(${data[i].idSede})">
      	<i class='fas fa-user-edit'></i></button>
      	<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarSede(${data[i].idSede})'>
      	<i class='fas fa-trash'></i></button>
      	</td>
      	</tr>`;
		}

		$('#tbodySede').html(html);
		$('#tableSede').DataTable({
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

function ConsultarSedeEstado(){

var estado = $("#inputConsultarEstado").val();

	$.ajax({
  // En data puedes utilizar un objeto JSON, un array o un query string
  data: {
  	"estado": estado	 // all variables i want to pass. In this case, only one.
	},
  	//Cambiar a type: POST si necesario
  type: "POST",
  	// Formato de datos que se espera en la respuesta
  //dataType: "text",
  	// URL a la que se enviará la solicitud Ajax
  url: "../Controllers/ConsultarSedeEstado.php"
})
	.done(function (data, textStatus, jqXHR) {
		console.log(data);
		var html = "";
		var html = "";
		for(var i in data){
			//console.log(data[i]);
			html += `<tr>
			<td>${data[i].idSede}</td>
			<td>${data[i].nombreSede}</td>
			<td>${data[i].nombreCentro}</td>
			<td>${data[i].direccion}</td>
			<td>${data[i].telefono}</td>
			<td>${data[i].estadoSede}</td>
			<td>
      	<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateSede" id="btnActualizarSede" name='btnActualizarSede' onclick="consultaSedeId(${data[i].idSede})">
      	<i class='fas fa-user-edit'></i></button>
      	<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarSede(${data[i].idSede})'>
      	<i class='fas fa-trash'></i></button>
      	</td>
      	</tr>`;
		}

		$('#tbodySede').html(html);
		$('#tableSede').DataTable({
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

function consultaSedeId(idSede) {
	
	$.ajax({
		url: "../Controllers/ConsultarSedeId.php",
		type: "POST",
		data: {
			idSede
		} 
		//dataType: "JSON"
	})
	.done(function (data, textStatus, jqXHR) {

		console.log(data);

		for (var i in data) {

      	var id = data[i].idSede;
      	var nombre = data[i].nombreSede;
      	var direccion = data[i].direccion;
      	var centro = data[i].idCentro;
      	var telefono = data[i].telefono;
      	var estadoSede = data[i].estadoSede;
      	
      }
      console.log(id);
      console.log(nombre);
      console.log(direccion);
      console.log(centro);
      console.log(estadoSede);
		$('#inputIdSedeUpdate').val(id);
		$('#inputNombreSedeUpdate').val(nombre);
		$('#inputDireccionSedeUpdate').val(direccion);
		$('#selectIdCentroUpdate').val(centro);
		$('#inputTelefonoSedeUpdate').val(telefono);
		$('#inputEstadoUpdate').val(estadoSede);
  })
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}


function ActualizarSede() {
	var idSede = $("#inputIdSedeUpdate").val();
	var nombreSede = $("#inputNombreSedeUpdate").val();
	var direccion = $("#inputDireccionSedeUpdate").val();
	var idCentro = $("#selectIdCentroUpdate").val();
	var telefono = $("#inputTelefonoSedeUpdate").val();
	var estadoSede = $("#inputEstadoUpdate").val();
	$.ajax({
  // En data puedes utilizar un objeto JSON, un array o un query string
  data: {
  	idSede,
    nombreSede,
    direccion,
    idCentro,
    telefono,
    estadoSede // all variables i want to pass. In this case, only one.
  },
  //Cambiar a type: POST si necesario
  type: "POST",
  // Formato de datos que se espera en la respuesta
  dataType: "text",
  // URL a la que se enviará la solicitud Ajax
  url: "../Controllers/ActualizarSede_Controller.php"
})
      .done(function (data, textStatus, jqXHR) {
      	ListaSedes("");
      $('#mensajeSede').html(data);      
    })
      .fail(function (jqXHR, textStatus, errorThrown) {
        alert("La solicitud ha fallado: " + textStatus);
      });
}


function InhabilitarSede(idSede) {
	$.ajax({
  // En data puedes utilizar un objeto JSON, un array o un query string
  data: {
  	idSede // all variables i want to pass. In this case, only one.
  },
  //Cambiar a type: POST si necesario
  type: "POST",
  // Formato de datos que se espera en la respuesta
  dataType: "text",
  // URL a la que se enviará la solicitud Ajax
  url: "../Controllers/InhabilitarSede_Controller.php"
})
      .done(function (data, textStatus, jqXHR) {
      //console.log(data);
      ListaSedes("");
      $('#mensajeSede').html(data);
    })
      .fail(function (jqXHR, textStatus, errorThrown) {
        alert("La solicitud ha fallado: " + textStatus);
      });
}




/*function ListaSensoresReferencia() {
	var referencia = $("#inputConsultaReferencia").val();
	$.ajax({
		url: "../Controllers/ConsultarSensoresReferencia.php",
		type: "POST",
		data: {
			"referencia": referencia
		}
		//dataType: "JSON"
	})
	.done(function (data, textStatus, jqXHR) {

		console.log(data);
		//var tabla = data;
		var html = "";
		for(var i in data){
			//console.log(data[i]);
			html += `<tr>
			<td>${data[i].idSensor}</td>
			<td>${data[i].referencia}</td>
			<td>${data[i].estadoSensor}</td>
			<td>
      	<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateSensor" id="btnActualizarSensor" name='btnActualizarSensor' onclick="consultaSedeId(${data[i].idSede})">
      	<i class='fas fa-user-edit'></i></button>
      	<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarSede(${data[i].idSede})'>
      	<i class='fas fa-trash'></i></button>
      	</td>
      	</tr>`;
		}

		$('#tbodySensores').html(html);
		$('#tableSede').DataTable({
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



function ListaSensoresEstado() {
	var estado = $("#inputConsultarEstado").val();
	$.ajax({
		url: "../Controllers/ConsultarSensoresEstado.php",
		type: "POST",
		data: {
			"estado": estado
		}
		//dataType: "JSON"
	})
	.done(function (data, textStatus, jqXHR) {

		console.log(data);
		//var tabla = data;
		var html = "";
		for(var i in data){
			//console.log(data[i]);
			html += `<tr>
			<td>${data[i].idSensor}</td>
			<td>${data[i].referencia}</td>
			<td>${data[i].estadoSensor}</td>
			<td>
      	<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateSensor" id="btnActualizarSensor" name='btnActualizarSensor' onclick="consultaSedeId(${data[i].idSede})">
      	<i class='fas fa-user-edit'></i></button>
      	<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarSede(${data[i].idSede})'>
      	<i class='fas fa-trash'></i></button>
      	</td>
      	</tr>`;
		}

		$('#tbodySensores').html(html);

  })
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}*/



