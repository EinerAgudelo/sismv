$(document).ready(function () {


	LlenarSelectCentros("");
	$("#btnConsultarSede").prop("disabled", true);
	$("#btnConsultarArea").prop("disabled", true);


	$("#ConsultarReferencia").collapse('hide');

	$("#ConsultarEstado").collapse('hide');

	$("#ConsultarCentros").collapse('hide');

	$("#ConsultarSedes").collapse('hide');
	
	$("#ConsultarAreas").collapse('hide');

	$("#RegistrarSensor").collapse('hide');

	ListaSensores("");

	$('#btnConsultarTodos').click(function() {
		ListaSensores("");
	});

	$('#btnConsultaReferencia').click(function() {
		ListaSensoresReferencia();
	});

	$('#btnConsultarEstado').click(function() {
		ListaSensoresEstado();
	});

	$('#btnConsultarCentro').click(function() {
		ListaSensoresCentros();
	});

	$("#btnConsultarSede").click(function(){
		ListaSensoresSedes();
	});

	$("#btnConsultarArea").click(function(){
		ListaSensoresAreas();
	});
	

	$("#inputIdSensorUpdate").prop("disabled", true);

	$("#btnUpdateSensor").click(function(){
		ActualizarSensor();
	});

	$("#btnRegistrarSensor").click(function() {
		RegistrarSensor();
		ListaSensores("");
	});

});



function ListaSensores(data) {
	
	$.ajax({
		url: "../Controllers/SensoresController.php",
		type: "POST",
		data: {
			"data": data,
			"opcion": 1
		}
		//dataType: "JSON"
	})
	.done(function (data, textStatus, jqXHR) {

		//console.log(data);
		//var tabla = data;
		var html = "";
		for(var i in data){
			//console.log(data[i]);
			html += `<tr>
			<td>${data[i].nombreCentro}</td>
			<td>${data[i].nombreSede}</td>
			<td>${data[i].piso}</td>
			<td>${data[i].nombreArea}</td>
			<td>${data[i].referencia}</td>
			<td>${data[i].estadoSensor}</td>
			<td>
			<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateSensor" id="btnActualizarSensor" name='btnActualizarSensor' onclick="ConsultaSensorId(${data[i].idSensor})">
			<i class='fas fa-user-edit'></i></button>
			<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarSensor(${data[i].idSensor})'>
			<i class='fas fa-trash'></i></button>
			</td>
			</tr>`;
		}

		$('#tbodySensores').html(html);
		$('#tableSen').DataTable({
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


function RegistrarSensor() {
	var referencia = $("#inputReferencia").val();
	var estadoSensor = $("#inputEstado").val();
	var idArea = $("#selectAreaR").val();
	//var estadoSensor = document.getElementById('inputEstado').val();
	$.ajax({
  	//Cambiar a type: POST si necesario
  	type: "POST",
  	// Formato de datos que se espera en la respuesta
  	dataType: "text",
  	// URL a la que se enviará la solicitud Ajax
  	url: "../Controllers/SensoresController.php",

  	data: {
  		"opcion": 5,
  		"referencia":referencia,
  		"estadoSensor":estadoSensor, 
  		"idArea": idArea
  	}

  })
	.done(function (data, textStatus, jqXHR) {
		ListaSensores("");
		$('#mensajeSensor').html(data);

	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}


function ConsultaSensorId(idSensor) {
	
	$.ajax({
		url: "../Controllers/SensoresController.php",
		type: "POST",
		data: {
			"opcion": 6,
			"idSensor": idSensor
		} 
		//dataType: "JSON"  ConsultarSensoresId
	})
	.done(function (data, textStatus, jqXHR) {

		console.log(data);


		for (var i in data) {

			var idSensor = data[i].idSensor;
			var referencia = data[i].referencia;
			var estadoSensor = data[i].estadoSensor;
			var idArea = data[i].idArea;
			var idSede = data[i].idSede;
			var idCentro = data[i].idCentro;

		}

		LlenarSelectCentrosUpdate(idCentro);

		LlenarSelectSedesUpdate(idCentro);

		LlenarSelectAreasUpdate(idSede);

		$('#inputIdSensorUpdate').val(idSensor);
		$('#inputReferenciaUpdate').val(referencia);
		/*$('#selectCentroU').val(idCentro);
		$('#selectSedeU').val(idSede);
		$('#selectAreaU').val(idArea);*/
		if (estadoSensor == 1) {
			$('#inputEstadoUpdate').val(2);
		}else{
			$('#inputEstadoUpdate').val(1);
		}
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}




function ActualizarSensor() {
	var idSensor = $("#inputIdSensorUpdate").val();
	var referencia = $("#inputReferenciaUpdate").val();
	var estadoSensor = $("#inputEstadoUpdate").val();
	var idArea = $("#selectAreaU").val();
	var idSede = $("#selectSedeU").val();
	var idCentro = $("#selectCentroU").val();
	$.ajax({

  // URL a la que se enviará la solicitud Ajax

  url: "../Controllers/SensoresController.php",
  // En data puedes utilizar un objeto JSON, un array o un query string
  data: {
  	"opcion": 7,
  	"idSensor":idSensor,
  	"referencia":referencia,
  	"estadoSensor":estadoSensor,
  	"idArea": idArea,
  	"idSede": idSede,
  	"idCentro": idCentro
     // all variables i want to pass. In this case, only one.
 },
  //Cambiar a type: POST si necesario
  type: "POST",
  // Formato de datos que se espera en la respuesta
  dataType: "text"

  
})
	.done(function (data, textStatus, jqXHR) {
		//console.log(data)
		ListaSensores("");
		$('#mensajeModalUpdateSensor').html(data);
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}


function InhabilitarSensor(idSensor) {
	$.ajax({
  // En data puedes utilizar un objeto JSON, un array o un query string
  data: {
  	"opcion": 10,
  	"idSensor" :idSensor // all variables i want to pass. In this case, only one.
  },
  //Cambiar a type: POST si necesario
  type: "POST",
  // Formato de datos que se espera en la respuesta
  dataType: "text",
  // URL a la que se enviará la solicitud Ajax
  url: "../Controllers/SensoresController.php"
})
	.done(function (data, textStatus, jqXHR) {
      //console.log(data);
      ListaSensores("");
      $('#mensajeSensor').html(data);
  })
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}



function LlenarSelectCentros(data) {
	$.ajax({
		url: "../Controllers/SensoresController.php",
		type: "POST",
		data: {
			"data":data,
			"opcion": 2
		}
	})
	.done(function (data, textStatus, jqXHR) {
		var option = "";
		var htmlR = ""; 
		var htmlC = ""; 
		var htmlS = ""; 
		var htmlA = ""; 
		htmlR += "<label>Centro de formación</label><select class='form-control' id='selectCentroR' onchange='LlenarSelectSedes(this.value)'>";
		htmlR += "<option value =0></option>";
		htmlC += "<label>Centro de formación</label><select class='form-control' id='selectCentroC' >";
		htmlC += "<option value =0></option>";
		htmlS += "<label>Centro de formación</label><select class='form-control' id='selectCentroS' onchange='LlenarSelectSedes_Sedes(this.value)'>";
		htmlS += "<option value =0></option>";
		htmlA += "<label>Centro de formación</label><select class='form-control' id='selectCentroA' onchange='LlenarSelectSedes_Areas(this.value)'>";
		htmlA += "<option value =0></option>";
		for (var i in data) {
			option = `<option value="${data[i].idCentro}">${data[i].nombreCentro} - ${data[i].acronimoCentro}</option>
			`;
			htmlR += option;		
			htmlC += option;
			htmlS += option;
			htmlA += option;
		}
		htmlR += "</select>";
		htmlC += "</select>";
		htmlS += "</select>";
		htmlA += "</select>";
		$('#divSelectCentrosRegister').html(htmlR);
		$('#divSelectCentrosConsulta').html(htmlC);
		//$('#divSelectSedesConsultaCentros').html(htmlC);
		$('#divSelectSedesConsulta').html(htmlS);
		$('#divSelectAreasConsulta').html(htmlA);
	
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}


function LlenarSelectCentrosUpdate(idCentro) {
	$.ajax({
		url: "../Controllers/SensoresController.php",
		type: "POST",
		data: {
			"idCentro":idCentro,
			"opcion": 2
		}
	})
	.done(function (data, textStatus, jqXHR) {


		var htmlU = "<label>Centro de formación</label>"; 
		htmlU += "<select class='form-control' id='selectCentroU' onchange='LlenarSelectSedesUpdate(this.value)'>";
		htmlU += "<option value =0></option>";
		/*for (var i in data) {
			htmlU += `
			<option value="${data[i].idCentro}">${data[i].nombreCentro} - ${data[i].acronimoCentro}</option>
			`;
		}
		htmlU += "</select>";*/
		
		for (var i in data) {
			if (data[i].idCentro == idCentro) {
				htmlU += `
				<option value=${data[i].idCentro} selected>${data[i].nombreCentro} - ${data[i].acronimoCentro}</option>
				`;
			}else{
				htmlU += `
				<option value=${data[i].idCentro}>${data[i].nombreCentro} - ${data[i].acronimoCentro}</option>
				`;
			}
		}

		
		$('#divSelectCentrosUpdate').html(htmlU);

	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}



function LlenarSelectSedes(idCentro) {
	$.ajax({
		url: "../Controllers/SensoresController.php",
		type: "POST",
		data: {
			"opcion": 3,
			"idCentro" : idCentro
			
		}
	})
	.done(function (data, textStatus, jqXHR) {

		console.log(data);
		var html = ""; 
		if (data == 0) {
			var mensaje = `<div class='alert alert-warning alert-dismissible fade show' role='alert'>
			<h3>Aviso!</h3>
			<hr>
			Debe llenar este campo para continuar
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			<span aria-hidden='true'>
			&times;
			</span>
			</button>
			</div>`;
			$('#mensajeSensor').html(mensaje);
		} else{
			
			html += "<label>Sede</label><select class='form-control' id='selectSedeR' onchange='LlenarSelectAreas(this.value)'>";
			html += "<option value =0></option>";
			for (var i in data) {
				html += `
				<option value=${data[i].idSede}>${data[i].nombreSede} - ${data[i].direccion}</option>
				`;
			}
			html += "</select>";
		}
		$('#divSelectSedesRegister').html(html);
	})

	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});	
}


function LlenarSelectSedes_Sedes(idCentro) {

	$("#btnConsultarSede").prop("disabled", false);

	$.ajax({
		url: "../Controllers/SensoresController.php",
		type: "POST",
		data: {
			"opcion": 3,
			"idCentro" : idCentro
			
		}
	})
	.done(function (data, textStatus, jqXHR) {

		console.log(data);
		var html = ""; 
			html += "<label>Sede</label><select class='form-control' id='selectSede_Centro'>";
			html += "<option value =0></option>";
			for (var i in data) {
				html += `
				<option value=${data[i].idSede}>${data[i].nombreSede} - ${data[i].direccion}</option>
				`;
			}
			html += "</select>";
		
		$('#divSelectSedesConsultaSedes').html(html);
	})

	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});	
}


function LlenarSelectSedes_Areas(idCentro) {


	$.ajax({
		url: "../Controllers/SensoresController.php",
		type: "POST",
		data: {
			"opcion": 3,
			"idCentro" : idCentro
			
		}
	})
	.done(function (data, textStatus, jqXHR) {

		console.log(data);
		var html = ""; 
			html += "<label>Sede</label><select class='form-control' id='selectSede_Area' onchange='LlenarSelectAreas_Areas(this.value)'>";
			html += "<option value =0></option>";
			for (var i in data) {
				html += `
				<option value=${data[i].idSede}>${data[i].nombreSede} - ${data[i].direccion}</option>
				`;
			}
			html += "</select>";
		
		$('#divSelectAreasConsultaSedes').html(html);
	})

	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});	
}


function LlenarSelectAreas_Areas(idSede) {

	$("#btnConsultarArea").prop("disabled", false);

	$.ajax({
		url: "../Controllers/SensoresController.php",
		type: "POST",
		data: {
			"opcion": 4,
			"idSede" : idSede
			
		}
	})
	.done(function (data, textStatus, jqXHR) {

		console.log(data);
		var html = ""; 
			html += "<label>Área</label><select class='form-control' id='selectArea_Area'>";
			html += "<option value =0></option>";
			for (var i in data) {
				html += `
				<option value=${data[i].idArea}>${data[i].nombreArea} - piso ${data[i].piso}</option>
				`;
			}
			html += "</select>";
		
		$('#divSelectAreasConsultaAreas').html(html);
	})

	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});	
}





function LlenarSelectSedesUpdate(idCentro) {
	$.ajax({
		url: "../Controllers/SensoresController.php",
		type: "POST",
		data: {
			"opcion": 3,
			"idCentro" : idCentro
			
		}
	})
	.done(function (data, textStatus, jqXHR) {

		console.log(data);
		var html = ""; 
			
			html += `<label>Sede</label>
			<select class='form-control' id='selectSedeU' onchange='LlenarSelectAreasUpdate(this.value)'>`;
			html += "<option value =0></option>";
			for (var i in data) {
				if (data[i].idCentro == idCentro) {
					html += `
					<option value=${data[i].idSede} selected>${data[i].nombreSede} - ${data[i].direccion}</option>
					`;
				}else{
					html += `
					<option value=${data[i].idSede}>${data[i].nombreSede} - ${data[i].direccion}</option>
					`;
				}
			}
			html += "</select>";
		//}
		$('#divSelectSedesUpdate').html(html);
	})

	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});	
}


function LlenarSelectAreas(idSede) {
	$.ajax({
		url: "../Controllers/SensoresController.php",
		type: "POST",
		data: {
			"idSede" : idSede,
			"opcion": 4
		}
	})
	.done(function (data, textStatus, jqXHR) {

		console.log(data);
		var html = "";
		if (data == 0) {
			var mensaje = `<div class='alert alert-warning alert-dismissible fade show' role='alert'>
			<h3>Aviso!</h3>
			<hr>
			Debe llenar este campo para continuar
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			<span aria-hidden='true'>
			&times;
			</span>
			</button>
			</div>`;
			$('#mensajeSensor').html(mensaje);
		} else{

			html += "<label>Area</label><select class='form-control' id='selectAreaR'>";
			html += "<option value =0></option>";

			for (var i in data) {
				html += `
				<option value="${data[i].idArea}">${data[i].nombreArea} - ${data[i].piso} piso</option>
				`;
			}
			html += "</select>";
		}
		$('#divSelectAreaRegister').html(html);
	})

	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}



function LlenarSelectAreasUpdate(idSede) {
	$.ajax({
		url: "../Controllers/SensoresController.php",
		type: "POST",
		data: {
			"idSede" : idSede,
			"opcion": 4
		}
	})
	.done(function (data, textStatus, jqXHR) {

		console.log(data);
		var html = "";

			html += "<label>Area</label><select class='form-control' id='selectAreaU'>";
			html += "<option value =0></option>";

			for (var i in data) {
				if (data[i].idSede == idSede) {
					html += `
					<option value="${data[i].idArea}" selected>${data[i].nombreArea} - ${data[i].piso} piso</option>
					`;
				}else{
					html += `
					<option value="${data[i].idArea}">${data[i].nombreArea} - ${data[i].piso} piso</option>
					`;
				}
			}
			html += "</select>";
		//}
		$('#divSelectAreaUpdate').html(html);
	})

	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}



function ListaSensoresReferencia() {
	var referencia = $("#inputConsultaReferencia").val();
	$.ajax({
		//url: "../Controllers/ConsultarSensoresReferencia.php",
		url: "../Controllers/SensoresController.php",
		type: "POST",
		data: {
			"opcion": 8,
			"referencia": referencia
		}
		//dataType: "JSON"
	})
	.done(function (data, textStatus, jqXHR) {

		console.log(data);
		//var tabla = data;
		var html = "";
		if (data == "error") {
			html = `<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>Debe digitar una referencia
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			<span aria-hidden='true'>&times;</span></button></div>`;
			$('#mensajeSensor').html(html);
		}else{
		for(var i in data){
				//console.log(data[i]);
				html += `<tr>
				<td>${data[i].nombreCentro}</td>
				<td>${data[i].nombreSede}</td>
				<td>${data[i].piso}</td>
				<td>${data[i].nombreArea}</td>
				<td>${data[i].referencia}</td>
				<td>${data[i].estadoSensor}</td>
				<td>
				<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateSensor" id="btnActualizarSensor" name='btnActualizarSensor' onclick="ConsultaSensorId(${data[i].idSensor})">
				<i class='fas fa-user-edit'></i></button>
				<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarSensor(${data[i].idSensor})'>
				<i class='fas fa-trash'></i></button>
				</td>
				</tr>`;
			}

			$('#tbodySensores').html(html);
			$('#tableSen').DataTable({
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



function ListaSensoresEstado() {
	var estado = $("#inputConsultarEstado").val();
	$.ajax({
		url: "../Controllers/SensoresController.php",
		type: "POST",
		data: {
			"opcion" : 9,
			"estado": estado
		}
		//dataType: "JSON"
	})
	.done(function (data, textStatus, jqXHR) {

		//console.log(data);
		//var tabla = data;
		var html = "";
		if (data == "error") {
			html = `<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>Debe seleccionar un estado
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			<span aria-hidden='true'>&times;</span></button></div>`;
			$('#mensajeSensor').html(html);
		}else{
			for(var i in data){
				//console.log(data[i].idSensor);
				html += `<tr>
				<td>${data[i].nombreCentro}</td>
				<td>${data[i].nombreSede}</td>
				<td>${data[i].piso}</td>
				<td>${data[i].nombreArea}</td>
				<td>${data[i].referencia}</td>
				<td>${data[i].estadoSensor}</td>
				<td>
				<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateSensor" id="btnActualizarSensor" name='btnActualizarSensor' onclick="ConsultaSensorId(${data[i].idSensor})">
				<i class='fas fa-user-edit'></i></button>
				<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarSensor(${data[i].idSensor})'>
				<i class='fas fa-trash'></i></button>
				</td>
				</tr>`;
			}
			$('#tbodySensores').html(html);
			$('#tableSen').DataTable({
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



function ListaSensoresCentros() {
	var idCentro = $("#selectCentroC").val();
	$.ajax({
		//url: "../Controllers/ConsultarSensoresReferencia.php",
		url: "../Controllers/SensoresController.php",
		type: "POST",
		data: {
			"opcion": 11,
			"idCentro": idCentro
		}
		//dataType: "JSON"
	})
	.done(function (data, textStatus, jqXHR) {

		console.log(data);
		//var tabla = data;
		var html = "";
		if (data == "error") {
			html = `<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>Debe seleccionar el centro de formacion
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			<span aria-hidden='true'>&times;</span></button></div>`;
			$('#mensajeSensor').html(html);
		}else{
		for(var i in data){
				//console.log(data[i]);
				html += `<tr>
				<td>${data[i].nombreCentro}</td>
				<td>${data[i].nombreSede}</td>
				<td>${data[i].piso}</td>
				<td>${data[i].nombreArea}</td>
				<td>${data[i].referencia}</td>
				<td>${data[i].estadoSensor}</td>
				<td>
				<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateSensor" id="btnActualizarSensor" name='btnActualizarSensor' onclick="ConsultaSensorId(${data[i].idSensor})">
				<i class='fas fa-user-edit'></i></button>
				<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarSensor(${data[i].idSensor})'>
				<i class='fas fa-trash'></i></button>
				</td>
				</tr>`;
			}

			$('#tbodySensores').html(html);
			$('#tableSen').DataTable({
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
			//$('#mensajeSensor').html("bien");
		}
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}


function ListaSensoresSedes() {
	var idCentro = $("#selectCentroS").val();
	var idSede = $("#selectSede_Centro").val();
	$.ajax({
		//url: "../Controllers/ConsultarSensoresReferencia.php",
		url: "../Controllers/SensoresController.php",
		type: "POST",
		data: {
			"opcion": 12,
			"idCentro": idCentro,
			"idSede": idSede
		}
		//dataType: "JSON"
	})
	.done(function (data, textStatus, jqXHR) {

		console.log(data);
		//var tabla = data;
		var html = "";
		if (data == "error") {
			html = `<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>Debe selecionar los lugares para hacer la consulta
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			<span aria-hidden='true'>&times;</span></button></div>`;
			$('#mensajeSensor').html(html);
		}else{
		for(var i in data){
				//console.log(data[i]);
				html += `<tr>
				<td>${data[i].nombreCentro}</td>
				<td>${data[i].nombreSede}</td>
				<td>${data[i].piso}</td>
				<td>${data[i].nombreArea}</td>
				<td>${data[i].referencia}</td>
				<td>${data[i].estadoSensor}</td>
				<td>
				<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateSensor" id="btnActualizarSensor" name='btnActualizarSensor' onclick="ConsultaSensorId(${data[i].idSensor})">
				<i class='fas fa-user-edit'></i></button>
				<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarSensor(${data[i].idSensor})'>
				<i class='fas fa-trash'></i></button>
				</td>
				</tr>`;
			}

			$('#tbodySensores').html(html);
			$('#tableSen').DataTable({
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
			//$('#mensajeSensor').html("bien");
		}
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}



function ListaSensoresAreas() {
	var idCentro = $("#selectCentroA").val();
	var idSede = $("#selectSede_Area").val();
	var idArea = $("#selectArea_Area").val();
	$.ajax({
		//url: "../Controllers/ConsultarSensoresReferencia.php",
		url: "../Controllers/SensoresController.php",
		type: "POST",
		data: {
			"opcion": 13,
			"idCentro": idCentro,
			"idSede": idSede,
			"idArea": idArea
		}
		//dataType: "JSON"
	})
	.done(function (data, textStatus, jqXHR) {

		console.log(data);
		//var tabla = data;
		var html = "";
		if (data == "error") {
			html = `<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡ERROR!</h3><hr>Debe selecionar los lugares para hacer la consulta
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			<span aria-hidden='true'>&times;</span></button></div>`;
			$('#mensajeSensor').html(html);
		}else{
		for(var i in data){
				//console.log(data[i]);
				html += `<tr>
				<td>${data[i].nombreCentro}</td>
				<td>${data[i].nombreSede}</td>
				<td>${data[i].piso}</td>
				<td>${data[i].nombreArea}</td>
				<td>${data[i].referencia}</td>
				<td>${data[i].estadoSensor}</td>
				<td>
				<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateSensor" id="btnActualizarSensor" name='btnActualizarSensor' onclick="ConsultaSensorId(${data[i].idSensor})">
				<i class='fas fa-user-edit'></i></button>
				<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarSensor(${data[i].idSensor})'>
				<i class='fas fa-trash'></i></button>
				</td>
				</tr>`;
			}

			$('#tbodySensores').html(html);
			$('#tableSen').DataTable({
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
			//$('#mensajeSensor').html("bien");
		}
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}



