$(document).ready(function(){
	
	ListarAreas("");
	
	$("#RegistrarArea").collapse('hide');

	$("#ConsultarNombre").collapse('hide');

	$("#ConsultarSede").collapse('hide');

	$("#ConsultarEstado").collapse('hide');



	$("#bntFormConsultarCentro").click(function () {
		LlenarSelectCentros();
		var idCentro = $("#selectCentroArea").val();
		LlenarSelectSedes(idCentro);
	});

	$("#btnFormRegistrarArea").click(function(){
		LlenarSelectCentros();
		var idCentro = $("#selectCentroArea").val();
		LlenarSelectSedes(idCentro);
	});

	$("#btnRegistrarArea").click(function(){
		RegistrarArea();
	});

	$("#btnUpdateArea").click(function(){
		ActualizarArea();
	});

	$("#btnConsultarTodos").click(function(){
		ListarAreas("");
	});

	$("#btnConsultarNombreArea").click(function(){
		ListarAreaNombre();
	});

	$("#btnConsultarSedeArea").click(function(){
		ListarAreaSede();
	});

	$("#btnConsultarEstado").click(function(){
		ListarAreaEstado();
	});
});


function ListarAreas(data) {
	$.ajax({
		url: "../Controllers/ConsultarAreas.php",
		type: "POST",
		data: {
			"data": data
		}
	}) 
	.done(function(data, textStatus, jqXHR){
		console.log(data);
		var html = "";

		for(var i in data){
			html += `<tr>
			<th class="col">${data[i].idArea}</th>
			<th class="col">${data[i].nombreCentro}</th>
			<th class="col">${data[i].nombreSede}</th>
			<th class="col">${data[i].direccion}</th>
			<th class="col">${data[i].nombreArea}</th>
			<th class="col">${data[i].piso}</th>
			<th class="col">${data[i].estadoArea}</th>
			<th class="col">
			<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateArea" id="btnActualizarArea" name='btnActualizarArea' onclick="ConsultarAreaId(${data[i].idArea})">
			<i class='fas fa-user-edit'></i></button>
			<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarArea(${data[i].idArea})'>
			<i class='fas fa-trash'></i></button>
			</th>
			</tr>
			`;
		}
		$("#tbodyArea").html(html);
		$('#tableArea').DataTable({
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

function InhabilitarArea(idArea) {
	$.ajax({
		url: "../Controllers/InhabilitarArea.php",
		type: "POST",
		data: {
			"idArea": idArea
		}
	}) 
	.done(function(data, textStatus, jqXHR){
		//console.log(data);
		$("#mensajeArea").html(data);
		ListarAreas("");		
		
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}


function ConsultarAreaId(idArea) {
	$.ajax({
		url: "../Controllers/ConsultarAreas.php",
		type: "POST",
		data: {
			"idArea": idArea
		}
	}) 
	.done(function(data, textStatus, jqXHR){
		//console.log(data);
		for(var i in data){
			var idArea = data[i].idArea;
			var nombreArea = data[i].nombreArea;
			var nombreCentro = data[i].nombreCentro;
			var idCentro = data[i].idCentro;
			var nombreSede = data[i].nombreSede;
			var idSede = data[i].idSede;
			var piso = data[i].piso;
			var estadoArea = data[i].estadoArea;
		}
		LlenarSelectCentros();
		LlenarSelectSedes(idCentro);
		$("#inputIdAreaUpdate").val(idArea);		
		$("#inputNombreAreaUpdate").val(nombreArea);		
		$("#selectCentroArea").val(idCentro);		
		$("#selectSedeArea").val(idSede);		
		$("#inputPisoAreaUpdate").val(piso);		
		$("#inputEstadoUpdateArea").val(estadoArea);		
		
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}

function LlenarSelectCentros() {
	$.ajax({
		url: "../Controllers/LlenarSelect.php",
		type: "POST",
		data: {
			"opcion": 1
		}
	}) 
	.done(function(data, textStatus, jqXHR){
		//console.log(data);
		var html = `<label>Centro donde se ubica la sede</label>
		<select class="form-control" id="selectCentroArea" onchange="LlenarSelectSedes(this.value)">`;
		html += `<option value=0 selected></option>`;
		for(var i in data){
			html += `<option value=${data[i].idCentro}>${data[i].nombreCentro}</option>`;
			
		}
		html +=`</select>`;

		$("#divSelectCentroArea").html(html);
		$("#divSelectCentroAreaRegistro").html(html);
		$("#divSelectCentroAreaConsulta").html(html);
		
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}


function LlenarSelectSedes(idCentro) {
	$.ajax({
		url: "../Controllers/LlenarSelect.php",
		type: "POST",
		data: {
			"idCentro": idCentro,
			"opcion": 2
		}
	}) 
	.done(function(data, textStatus, jqXHR){
		//console.log(data);
		var html = `<label>Sede donde se ubica el area</label>
		<select class="form-control" id="selectSedeArea">`;
		for(var i in data){
			/*var idCentro = data[i].idCentro;
			var nombreCentro = data[i].nombreCentro;*/
			html += `<option value=${data[i].idSede}>${data[i].nombreSede}</option>`;
		}
		html +=`</select>`;

		$("#divSelectSedeArea").html(html);
		$("#divSelectSedeAreaRegistro").html(html);
		$("#divSelectSedeAreaConsulta").html(html);
		
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}


function RegistrarArea() {
	var idSede = $("#selectSedeArea").val();
	var nombreArea = $("#inputNombreArea").val();
	var piso = $("#inputPisoArea").val();
	var estadoArea = $("#inputEstadoArea").val();

	$.ajax({
		url: "../Controllers/RegistrarArea.php",
		type: "POST",
		data: {
			"opcion": 1,
			"idSede": idSede,
			"nombreArea": nombreArea,
			"piso": piso,
			"estadoArea": estadoArea
		},
		datatype: "text"
	}) 
	.done(function(data, textStatus, jqXHR){
		//console.log(data);
		
		$("#mensajeArea").html(data);
		ListarAreas("");
		
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}

function ActualizarArea() {
		var idArea = $("#inputIdAreaUpdate").val();		
		var nombreArea = $("#inputNombreAreaUpdate").val();				
		var idSede = $("#selectSedeArea").val();		
		var piso = $("#inputPisoAreaUpdate").val();
		var estadoArea = $("#inputEstadoUpdateArea").val();

		$.ajax({
		url: "../Controllers/RegistrarArea.php",
		type: "POST",
		data: {
			"opcion": 2,
			"idArea": idArea,
			"idSede": idSede,
			"nombreArea": nombreArea,
			"piso": piso,
			"estadoArea": estadoArea
		},
		datatype: "text"
	}) 
	.done(function(data, textStatus, jqXHR){
		
		$("#mensajeArea").html(data);
		ListarAreas("");
		
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}


function ListarAreaNombre() {
	var nombreArea = $("#inputConsultarNombreArea").val();
	$.ajax({
		url: "../Controllers/ConsultarAreas.php",
		type: "POST",
		data: {
			"nombreArea": nombreArea
		}
	}) 
	.done(function(data, textStatus, jqXHR){
		console.log(data);
		var html = "";

		for(var i in data){
			html += `<tr>
			<th class="col">${data[i].idArea}</th>
			<th class="col">${data[i].nombreCentro}</th>
			<th class="col">${data[i].nombreSede}</th>
			<th class="col">${data[i].direccion}</th>
			<th class="col">${data[i].nombreArea}</th>
			<th class="col">${data[i].piso}</th>
			<th class="col">${data[i].estadoArea}</th>
			<th class="col">
			<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateArea" id="btnActualizarArea" name='btnActualizarArea' onclick="ConsultarAreaId(${data[i].idArea})">
			<i class='fas fa-user-edit'></i></button>
			<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarArea(${data[i].idArea})'>
			<i class='fas fa-trash'></i></button>
			</th>
			</tr>
			`;
		}
		$("#tbodyArea").html(html);
		$('#tableArea').DataTable({
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



function ListarAreaSede() {
	var sedeArea = $("#selectSedeArea").val();
	$.ajax({
		url: "../Controllers/ConsultarAreas.php",
		type: "POST",
		data: {
			"sedeArea": sedeArea
		}
	}) 
	.done(function(data, textStatus, jqXHR){
		console.log(data);
		var html = "";

		for(var i in data){
			html += `<tr>
			<th class="col">${data[i].idArea}</th>
			<th class="col">${data[i].nombreCentro}</th>
			<th class="col">${data[i].nombreSede}</th>
			<th class="col">${data[i].direccion}</th>
			<th class="col">${data[i].nombreArea}</th>
			<th class="col">${data[i].piso}</th>
			<th class="col">${data[i].estadoArea}</th>
			<th class="col">
			<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateArea" id="btnActualizarArea" name='btnActualizarArea' onclick="ConsultarAreaId(${data[i].idArea})">
			<i class='fas fa-user-edit'></i></button>
			<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarArea(${data[i].idArea})'>
			<i class='fas fa-trash'></i></button>
			</th>
			</tr>
			`;
		}
		$("#tbodyArea").html(html);
		$('#tableArea').DataTable({
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


function ListarAreaEstado() {
	var estadoArea = $("#inputConsultarEstado").val();
	$.ajax({
		url: "../Controllers/ConsultarAreas.php",
		type: "POST",
		data: {
			"estadoArea": estadoArea
		}
	}) 
	.done(function(data, textStatus, jqXHR){
		console.log(data);
		var html = "";

		for(var i in data){
			html += `<tr>
			<th class="col">${data[i].idArea}</th>
			<th class="col">${data[i].nombreCentro}</th>
			<th class="col">${data[i].nombreSede}</th>
			<th class="col">${data[i].direccion}</th>
			<th class="col">${data[i].nombreArea}</th>
			<th class="col">${data[i].piso}</th>
			<th class="col">${data[i].estadoArea}</th>
			<th class="col">
			<button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#ModalUpdateArea" id="btnActualizarArea" name='btnActualizarArea' onclick="ConsultarAreaId(${data[i].idArea})">
			<i class='fas fa-user-edit'></i></button>
			<button class='btn btn-danger btn-sm' name='btnEliminar' onclick='InhabilitarArea(${data[i].idArea})'>
			<i class='fas fa-trash'></i></button>
			</th>
			</tr>
			`;
		}
		$("#tbodyArea").html(html);
		$('#tableArea').DataTable({
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

window.addEventListener("load", function() {
      formRegistrarArea.inputPisoArea.addEventListener("keypress", soloNumeros, false);
      formUpdateArea.inputPisoAreaUpdate.addEventListener("keypress", soloNumeros, false);
    });

    //Solo permite introducir numeros.
    function soloNumeros(e){
      var key = window.event ? e.which : e.keyCode;
      if (key < 45 || key > 57) {
        e.preventDefault();
      }
    }





