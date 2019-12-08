$(document).ready(function () {
    $('#profile').click(function () {
        requestData("");
    });
    $('#btnActualizarMisDatos').click(function () {
        ActualizarMisDatos();
        obtener_usuarios("");
    });

    //CrearGrafica();

    GetJSON();
    GetJSON_Humedad();
    GetJSON_Aire();
    GetJSON_CO2();
    
    setInterval(function(){
        GetJSON();
        GetJSON_Humedad();
        GetJSON_Aire();
        GetJSON_CO2();
}, 2000);
});

function requestData(data) {
    $.ajax({
        url: "Controllers/ConsultarMisDatos.php",
        type: "POST",
        data: data
    })
            .done(function (data, textStatus, jqXHR) {
                var consulta = JSON.parse(data);
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
                if (tipo_documento == 'CC') {
                    $('#inputMiTipoDocumento').val(1);
                }
                if (tipo_documento == 'TI') {
                    $('#inputMiTipoDocumento').val(2);
                }
                if (tipo_documento == 'CE') {
                    $('#inputMiTipoDocumento').val(3);
                }
                if (tipo_documento == 'TP') {
                    $('#inputMiTipoDocumento').val(4);
                }
                if (tipo_documento == 'Otro') {
                    $('#inputMiTipoDocumento').val(5);
                }
                $('#inputMiNumeroDocumento').val(numero_documento);
                $('#inputMiCorreo').val(correo);
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                alert("La solicitud ha fallado: " + textStatus);
            });
}

function ActualizarMisDatos() {
    var correoUsuario = $('#inputMiCorreo').val();
    var tipo_documento = $('#inputMiTipoDocumento').val();
    var numero_documento = $('#inputMiNumeroDocumento').val();
    var nombreUsuario = $('#inputMiNombre').val();
    var apellidoUsuario = $('#inputMiApellidos').val();
    $.ajax({
        url: "Controllers/ActualizarMisDatos.php",
        type: "POST",
        data: {
            "correoUsuario": correoUsuario,
            "tipo_documento": tipo_documento,
            "numero_documento": numero_documento,
            "nombreUsuario": nombreUsuario,
            "apellidoUsuario": apellidoUsuario
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



function GetJSON() {
    $.ajax({
        url: "Controllers/Grafica_Controller.php",
        type: "GET",
        datatype: "text",
        data: {
            "opcion": 4
        }
    })
            .done(function (data, textStatus, jqXHR) {
                console.log(data);
                var datos = [];
                for (var row in data.DatosSensor) {
                    //console.log(data.DatosSensor[row].dato);
                    //var datos = data.DatosSensor[row].dato;
                    datos.push(data.DatosSensor[row].dato);  
                }
                console.log(datos);
                
                CrearGrafica(datos, "Temperatura en grados celsius/centigrados", "myChart");
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                alert("La solicitud ha fallado: " + textStatus);
            });
}



function GetJSON_CO2() {
    $.ajax({
        url: "Controllers/Grafica_Controller.php",
        type: "GET",
        datatype: "text",
        data: {
            "opcion": 3
        }
    })
            .done(function (data, textStatus, jqXHR) {
                console.log(data);
                var datos = [];
                for (var row in data.DatosSensor) {
                    //console.log(data.DatosSensor[row].dato);
                    //var datos = data.DatosSensor[row].dato;
                    datos.push(data.DatosSensor[row].dato);  
                }
                console.log(datos);
                
                CrearGrafica(datos, "CO2 / partes por millon (ppm)", "myChartCO2");
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                alert("La solicitud ha fallado: " + textStatus);
            });
}



function GetJSON_Aire() {
    $.ajax({
        url: "Controllers/Grafica_Controller.php",
        type: "GET",
        datatype: "text",
        data: {
            "opcion": 2
        }
    })
            .done(function (data, textStatus, jqXHR) {
                console.log(data);
                var datos = [];
                for (var row in data.DatosSensor) {
                    //console.log(data.DatosSensor[row].dato);
                    //var datos = data.DatosSensor[row].dato;
                    datos.push(data.DatosSensor[row].dato);  
                }
                console.log(datos);
                
                CrearGrafica(datos, "Calidad del aire / partes por millon (ppm)", "myChartAire");
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                alert("La solicitud ha fallado: " + textStatus);
            });
}

function GetJSON_Humedad() {
    $.ajax({
        url: "Controllers/Grafica_Controller.php",
        type: "GET",
        datatype: "text",
        data: {
            "opcion": 1
        }
    })
            .done(function (data, textStatus, jqXHR) {
                console.log(data);
                var datos = [];
                for (var row in data.DatosSensor) {
                    //console.log(data.DatosSensor[row].dato);
                    //var datos = data.DatosSensor[row].dato;
                    datos.push(data.DatosSensor[row].dato);  
                }
                console.log(datos);
                
                CrearGrafica(datos, "Humedad / partes por millon (ppm)", "myChartHumedad");
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                alert("La solicitud ha fallado: " + textStatus);
            });
}





function CrearGrafica(datos, labelMensaje, canvas) {

    var ctx = document.getElementById(canvas).getContext('2d');
    
    var config = {
        type: 'line',
        data: {
            labels: ['-50', '-40', '-30', '-20', '-10', 'Ahora'],
            datasets: [{
                    //label: 'Temperatura  grados celsius/centigrados',
                    label: labelMensaje,
                    //data: [12, 19, 3, 5, 2, 3],
                    data: [datos[5], datos[4], datos[3], datos[2], datos[1], datos[0]],
                    backgroundColor: [
                        'rgba(20, 185, 82, 0.2)',
                        'rgba(54, 162, 235, 0.4)',
                        'rgba(230, 255, 86, 0.4)',
                        'rgba(75, 192, 192, 0.4)',
                        'rgba(153, 102, 255, 0.4)',
                        'rgba(255, 159, 64, 0.4)'
                    ],
                    borderColor: [
                        'rgba(10, 135, 112, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(230, 180, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
        },
        options: {
            responsive: true,
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
            }
        }
    };

    var myChart = new Chart(ctx, config);
}






