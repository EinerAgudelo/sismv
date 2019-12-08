$(document).ready(function() {
	LlenarSelect("");

	$("#btnObtenerReporte").prop("disabled", true);

	$("#btnObtenerDatos").click(function(){
		ObtenerDatos();
		
	});	
/*
$("#inputFechaInicio").datepicker("option", "YearRange", "-99:+0d");
$("#inputFechaInicio").datepicker("option", "maxDate", "+0m+0d");

$("#inputFechaFin").datepicker("option", "YearRange", "-99:+0d");
$("#inputFechaFin").datepicker("option", "maxDate", "+0m +0d");
*/

});



function LlenarSelect(data){
	$.ajax({
		url: "../Controllers/ConsultarTipoDatoController.php",
		type: "POST",
		data: data
		//dataType: "JSON"
	})
	.done(function (data, textStatus, jqXHR) {

		console.log(data);

		var html = "<select class='form-control' id='inputTipoDato' >";
		for(var i in data){
			
			console.log(data[i].idTipoDato);
			html += `<option value=${data[i].idTipoDato}>${data[i].nombreTipoDato}</option>`;
		}
		html +=`</select>`;
		$('#selectTipoDato').html(html);

	})
	.fail(function (jqXHR, textStatus, errorThrown) {
		alert("La solicitud ha fallado: " + textStatus);
	});
}


function ObtenerDatos(){
	var idTipoDato = $("#inputTipoDato").val();
	var fechaInicio = $("#inputFechaInicio").val();
	var fechaFin = $("#inputFechaFin").val();


	if ( idTipoDato == "" || idTipoDato == 0 ||
		fechaInicio == "" || fechaInicio == 0 ||
		fechaFin == "" || fechaFin == 0) {
		var mensajeError = `<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>Debe de llenar todos los campos
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			<span aria-hidden='true'>&times;</span></button></div>`;
			
			$('#mensajeReporte').html(mensajeError);

	}else{
		var tiempoConcurrente = new Date();
		/* if(fechaInicio < tiempoConcurrente ||
		 	fechaFin <= tiempoConcurrente){*/
				$.ajax({
					url: "../Controllers/ObtenerDatosSensores.php",
					type: "POST",
					data: {
						//"tiempoConcurrente": tiempoConcurrente
						"idTipoDato": idTipoDato,
						"fechaInicio": fechaInicio,
						"fechaFin": fechaFin
					},
					//dataType: "text"
				})
				.done(function (data, textStatus, jqXHR) {

					console.log(data);
					var html = "";
					var thead = ` <tr>
           <th>Código sensor / Referencia</th>
           <th>Medición</th>
           <th>Tipo de dato</th>
           <th>Fecha</th>
          </tr>`;
					for (var i in data){
						console.log(data[i].dato);
						html += `<tr>
			      	<td>${data[i].idSensor} / ${data[i].referencia}</td>
			      	<td>${data[i].dato}</td>
			      	<td>${data[i].nombreTipoDato}</td>
			      	<td>${data[i].fecha}</td>
			      	</tr>
			      	`;
					}
					$("#inputTipoDatoReporte").val(idTipoDato);
					$("#datetimepicker7Reporte").val(fechaInicio);
					$("#datetimepicker8Reporte").val(fechaFin);		
					$('#theadDatos').html(thead);
					$('#tbodyDatos').html(html);					
					$('#tableReport').DataTable({
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
					$("#btnObtenerReporte").prop("disabled", false);				
			  })
				.fail(function (jqXHR, textStatus, errorThrown) {
					alert("La solicitud ha fallado: " + textStatus);
				});
			
		// }
		// else{
		// 	var mensajeError = `<div class='alert alert-danger alert-dismissible fade show' role='alert'> <h3>¡Aviso!</h3><hr>No puede seleccionar una fecha mayor a la fecha concurrente
		// 	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		// 	<span aria-hidden='true'>&times;</span></button></div>`;
			
		// 	$('#mensajeReporte').html(mensajeError);
		// }
	}
}



