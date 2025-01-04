<div class="mt-5 d-flex justify-content-center p-5">
    <div class="row">
        <div class="col-md-6">
            <div class="row mb-4 justify-content-center">
                <div class="col-12 text-center">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Gráfico de reportes hechos</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container d-flex justify-content-center">
                                <canvas id="mychart" style="max-width: 100%; height: 400px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6  text-center">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Solicitud que más se ha realizado:</h5>
                            <p class="card-text" id="text1"></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Solicitud que menos se ha realizado:</h5>
                            <p class="card-text" id="text2"></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Gráfico de usuarios registrados</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="mychart2" style="max-width: 100%; max-height: 270px;"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
    consultar1 = new objectAjax();
    consultar1.open("GET", `ajax.php?modulo=Solicitudes&controlador=Solicitudes&funcion=getNumReportes`, true);

    consultar1.onreadystatechange = function () {
        if (consultar1.readyState === 4) {

            const reportes = ['Reporte de accidentes', 'Reporte de vías en mal estado', 'Reporte de señales nuevas', 'Reporte de señales dañadas', 'Reporte de reductores dañados', 'Reporte de reductores Nuevos'];
            const respuesta = consultar1.responseText.split(',').map(Number);

            const ctx = document.getElementById('mychart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: reportes,
                    datasets: [{
                        label: 'Reportes realizados',
                        data: respuesta,
                        backgroundColor:
                            ['rgba(42, 47, 91, 0.52)',
                                'rgba(91, 147, 191, 0.52)',
                                'rgba(191, 91, 91, 0.52)',
                                'rgba(91, 191, 91, 0.52)',
                                'rgba(53, 75, 199, 0.52)',
                                'rgba(147, 91, 191, 0.52)'],
                        borderColor:
                            ['rgb(42, 47, 91)',
                                'rgb(91, 147, 191)',
                                'rgb(191, 91, 91)',
                                'rgb(91, 191, 91)',
                                'rgb(30, 45, 133)',
                                'rgb(147, 91, 191)'],
                        borderWidth: 1.5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true
                        }
                    }
                }
            });
        };
    }
    consultar1.send(null);

    consultar2 = new objectAjax();
    consultar2.open("GET", `ajax.php?modulo=Solicitudes&controlador=Solicitudes&funcion=getDatosCards`, true);

    consultar2.onreadystatechange = function () {
        if (consultar2.readyState === 4) {
            const respuesta = consultar2.responseText.split(',');

            document.getElementById("text1").innerText = respuesta[0];
            document.getElementById("text2").innerText = respuesta[1];


        }
    }
    consultar2.send(null);


    consultar3 = new objectAjax();
    consultar3.open("GET", `ajax.php?modulo=Usuarios&controlador=Usuarios&funcion=getDatosGraf`, true);

    consultar3.onreadystatechange = function () {
        if (consultar3.readyState === 4) {

            var respuesta = consultar3.responseText;

            var registros = respuesta.split(';');
            var meses = [];
            var usuarios = [];

            const nombresMeses = [
                "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
            ];

            var anio = '';

            var datosMeses = new Array(12).fill(0);

            registros.forEach(function (registro) {
                var partes = registro.split(',');
                var mesAnio = partes[0];
                var cantidadUsuarios = partes[1];

                var mes = mesAnio.split('/')[0];
                anio = mesAnio.split('/')[1];


                var mesNom = parseInt(mes) - 1;

                datosMeses[mesNom] = parseInt(cantidadUsuarios);

                meses.push(nombresMeses[mesNom] + ' ' + anio);
            });


            const ctx2 = document.getElementById('mychart2').getContext('2d');
            const myChart2 = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: nombresMeses,
                    datasets: [{
                        label: 'Usuarios Registrados',
                        data: datosMeses,
                        fill: true,
                        backgroundColor: 'rgba(42, 47, 91, 0.52)',
                        borderColor: 'rgba(42, 47, 91,1)',
                        tension: 0.8
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Meses - ' + anio  // Concatenamos "Meses - " con el año
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Cantidad de Usuarios'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });

        }
    }
    consultar3.send(null);

</script>