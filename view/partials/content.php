<style>
    .chart-container {
        position: relative;
        width: 100%;
        max-width: 800px;
        height: 400px;
    }

    canvas {
        width: 100% !important;
        height: auto !important;
    }
</style>
<div class="container row d-flex justify-content-center mt-5">
    <h1 class="text-center mb-2">Grafico de reportes hechos</h1>
    <div class="chart-container">
        <canvas id="mychart"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

    consultar1 = new objectAjax();
    consultar1.open("GET", `ajax.php?modulo=Solicitudes&controlador=Solicitudes&funcion=getNumReportes`, true);

    consultar1.onreadystatechange = function () {
        if (consultar1.readyState === 4) {

            const reportes = ['Reporte de accidentes', 'Reporte de vías en mal estado', 'Reporte de señales nuevas'];
            const respuesta = consultar1.responseText.split(',').map(Number);

            const ctx = document.getElementById('mychart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'pie', // Gráfico tipo pie
                data: {
                    labels: reportes,
                    datasets: [{
                        label: 'Reportes realizados',
                        data: respuesta,
                        backgroundColor: [
                            'rgba(42, 47, 91, 0.52)',
                            'rgba(91, 147, 191, 0.52)',
                            'rgba(191, 91, 91, 0.52)'
                        ],
                        borderColor: [
                            'rgb(42, 47, 91)',
                            'rgb(91, 147, 191)',
                            'rgb(191, 91, 91)'
                        ],
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


</script>