<div class="mt-5 d-flex justify-content-center p-5">
    <div class="row">
        <div class="col-md-6">
            <div class="row mb-4 justify-content-center">
                <div class="col-12 text-center">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Gráfico de reportes hechos</h5>
                            <div class="chart-container d-flex justify-content-center">
                                <canvas id="mychart" style="max-width: 100%; height: auto;"></canvas>
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

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Card 3</h5>
                            <p class="card-text" id="text3"></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Card 4</h5>
                            <p class="card-text" id="text4"></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Card 5</h5>
                            <p class="card-text" id="text5"></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Card 6</h5>
                            <p class="card-text" id="text6"></p>
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

            const reportes = ['Reporte de accidentes', 'Reporte de vías en mal estado', 'Reporte de señales nuevas', 'Reporte de señales dañadas', 'Reporte de reductores dañados'];
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
                         'rgba(147, 91, 191, 0.52)'],
                        borderColor: 
                        ['rgb(42, 47, 91)',
                         'rgb(91, 147, 191)', 
                         'rgb(191, 91, 91)', 
                         'rgb(91, 191, 91)', 
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

</script>