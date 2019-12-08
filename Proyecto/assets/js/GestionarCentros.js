$(document).ready(function(){

	ConsultarCentros("");

	$("#RegistrarCentro").collapse('hide');

	$("#ConsultarNombre").collapse('hide');

	$("#ConsultarAcronimo").collapse('hide');

	$("#ConsultarEstado").collapse('hide');

	$("#btnRegistrarCentro").click(function(){
		RegistrarCentro();
	});
	$("#btnConsultarTodos").click(function(e){
		e.preventDefault();
		ConsultarCentros("");
	});
	$("#btnConsultaNombre").click(function(){
		ConsultarCentroNombre();
	});
	$("#btnConsultaAcronimo").click(function(){
		ConsultarCentroAcronimo();
	});
	$("#btnConsultarEstado").click(function(){
		ConsultarCentroEstado();
	});		
	$("#btnUpdateCentro").click(function(e){
		e.preventDefault();
		ActualizarCentro();
	});
});


function ConsultarCentros(data){
	$.ajax({
  // En data puedes utilizar un objeto JSON, un array o un query string
  data: {"data": data},
  	//Cambiar a type: POST si necesario
  type: "POST",
  	// Formato de datos que se espera en la respuesta
  //dataType: "text",
  	// URL a la que se enviará la solicitud Ajax
  url: "../Controllers/ObtenerCentros.php"
})
	.done(function (data, textStatus, jqXHR) {
		console.log(data);
		var html = "";
		for(var row in data){
			//console.log(data[row].idCentro);
			html += `<tr>
				<td>${data[row].idCentro}</td>
				<td>${data[row].nombreCentro}</td>
				<td>${data[row].acronimoCentro}</td>
				<td>${data[row].estadoCentro}</td>
				<td>
      	<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateCentro" name='btnActualizar' onclick="ConsultaCentroId(${data[row].idCentro})">
      	<i class='fas fa-user-edit'></i></button>
      	<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarCentro(${data[row].idCentro})'>
      	<i class='fas fa-trash'></i></button>
      	</td>
			</tr>`;
		}
		$('#tbodyCentro').html(html);
		$('#tableCen').DataTable({
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

function ConsultaCentroId(idCentro){
	$.ajax({
  data: {"idCentro": idCentro},

  type: "POST",

  url: "../Controllers/ObtenerCentroId.php"
})
	.done(function (data, textStatus, jqXHR) {
		console.log(data);

		for (var i  in data) {
			var idCentro = data[i].idCentro;
			var nombreCentro = data[i].nombreCentro;
			var acronimoCentro = data[i].acronimoCentro;
			var estadoCentro = data[i].estadoCentro;
		}

		$('#inputIdCentroUpdate').val(idCentro);
		$('#inputNombreUpdate').val(nombreCentro);
		$('#inputAcronimoUpdate').val(acronimoCentro);
		$('#inputEstadoUpdate').val(estadoCentro);


	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}

function RegistrarCentro() {
	var nombreCentro = $("#inputNombre").val();
	var acronimoCentro = $("#inputAcronimo").val();
	var estadoCentro = $("#inputEstado").val();
	//var estadoSensor = document.getElementById('inputEstado').val();
	$.ajax({
  // En data puedes utilizar un objeto JSON, un array o un query string
  data: {

  	"nombreCentro": nombreCentro,
  	"acronimoCentro": acronimoCentro,
    "estadoCentro": estadoCentro 
},
  //Cambiar a type: POST si necesario
  type: "POST",
  // Formato de datos que se espera en la respuesta
  dataType: "text",
  // URL a la que se enviará la solicitud Ajax
  url: "../Controllers/RegistrarCentro.php"
})
	.done(function (data, textStatus, jqXHR) {
		//ListaSensores("");
		$('#mensajeCentro').html(data);
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}

function ConsultarCentroAcronimo(){

var inputConsultaAcronimo = $("#inputConsultaAcronimo").val();

	$.ajax({
  // En data puedes utilizar un objeto JSON, un array o un query string
  data: {
  	"inputConsultaAcronimo": inputConsultaAcronimo	 // all variables i want to pass. In this case, only one.
	},
  	//Cambiar a type: POST si necesario
  type: "POST",
  	// Formato de datos que se espera en la respuesta
  //dataType: "text",
  	// URL a la que se enviará la solicitud Ajax
  url: "../Controllers/ConsultarCentroAcronimo.php"
})
	.done(function (data, textStatus, jqXHR) {
		console.log(data);
		var html = "";
		for(var row in data){
			html = `<tr>
				<td>${data[row].idCentro}</td>
				<td>${data[row].nombreCentro}</td>
				<td>${data[row].acronimoCentro}</td>
				<td>${data[row].estadoCentro}</td>
				<td>
      	<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateCentro" name='btnActualizar' onclick="ConsultaCentroId(${data[row].idCentro})">
      	<i class='fas fa-user-edit'></i></button>
      	<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarCentro(${data[row].idCentro})'>
      	<i class='fas fa-trash'></i></button>
      	</td>
			</tr>`;
		}
		$('#tbodyCentro').html(html);
		$('#tableCen').DataTable({
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


function ConsultarCentroNombre() {
	var nombreCentro = $("#inputConsultaNombre").val();

	$.ajax({
  // En data puedes utilizar un objeto JSON, un array o un query string
  data: {
  	"nombreCentro": nombreCentro,	 // all variables i want to pass. In this case, only one.
	},
  	//Cambiar a type: POST si necesario
  type: "POST",
  	// Formato de datos que se espera en la respuesta
  //dataType: "text",
  	// URL a la que se enviará la solicitud Ajax
  url: "../Controllers/ConsultarCentroNombre.php"
})
	.done(function (data, textStatus, jqXHR) {
		console.log(data);
		var html = "";
		for(var row in data){
			html = `<tr>
				<td>${data[row].idCentro}</td>
				<td>${data[row].nombreCentro}</td>
				<td>${data[row].acronimoCentro}</td>
				<td>${data[row].estadoCentro}</td>
				<td>
      	<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateCentro" name='btnActualizar' onclick="ConsultaCentroId(${data[row].idCentro})">
      	<i class='fas fa-user-edit'></i></button>
      	<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarCentro(${data[row].idCentro})'>
      	<i class='fas fa-trash'></i></button>
      	</td>
			</tr>`;
		}
		$('#tbodyCentro').html(html);
		$('#tableCen').DataTable({
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




function ConsultarCentroEstado() {
	var estadoCentro = $("#inputConsultarEstado").val();

	$.ajax({
  // En data puedes utilizar un objeto JSON, un array o un query string
  data: {
   	"estadoCentro": estadoCentro,	 // all variables i want to pass. In this case, only one.
	},
  	//Cambiar a type: POST si necesario
  type: "POST",
  	// Formato de datos que se espera en la respuesta
  //dataType: "text",
  	// URL a la que se enviará la solicitud Ajax
  url: "../Controllers/ConsultarCentroEstado.php"
})
	.done(function (data, textStatus, jqXHR) {
		console.log(data);
		var html = "";
		for(var row in data){
			html += `<tr>
				<td>${data[row].idCentro}</td>
				<td>${data[row].nombreCentro}</td>
				<td>${data[row].acronimoCentro}</td>
				<td>${data[row].estadoCentro}</td>
				<td>
      	<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateCentro" name='btnActualizar' onclick="ConsultaCentroId(${data[row].idCentro})">
      	<i class='fas fa-user-edit'></i></button>
      	<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarCentro(${data[row].idCentro})'>
      	<i class='fas fa-trash'></i></button>
      	</td>
			</tr>`;
		}
		$('#tbodyCentro').html(html);
		$('#tableCen').DataTable({
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

function ActualizarCentro(){
		var idCentro = $('#inputIdCentroUpdate').val();
	    var nombreCentro = $('#inputNombreUpdate').val();
      	var acronimoCentro = $('#inputAcronimoUpdate').val();
      	var estadoCentro = $('#inputEstadoUpdate').val();
	$.ajax({
		url: "../Controllers/ActualizarCentro_Controller.php",
		type: "POST",
		data: {
			"idCentro" : idCentro,
			"nombreCentro":nombreCentro,
			"acronimoCentro":acronimoCentro,
			"estadoCentro":estadoCentro,
		},
		dataType:"text"
	})
	.done(function (data, textStatus, jqXHR) {
		console.log(data);
		$('#mensajeCentro').html(data);
		ConsultarCentros("");
  })
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}
function InhabilitarCentro(id){
	$.ajax({
		url: "../Controllers/InhabilitarCentro_Controller.php",
		type: "POST",
		data: {
			"idCentro" : id
		},
		dataType:"text"
	})
	.done(function (data, textStatus, jqXHR) {
		console.log(data);
		$('#mensajeCentro').html(data);
		ConsultarCentros("");
  })
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}






