<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Estudiantes por Carrera</title>
    <link rel="stylesheet" href="<?php echo base_url();?>../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>../assets/css/adminlte.min.css">
    <script src="<?php echo base_url();?>../assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>../assets/plugins/chart.js/Chart.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">
<?php include realpath(__DIR__ . '/../sidebar_menu.php'); ?>

    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Estudiantes por Carrera</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="studentsByCareerChart"></canvas>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
$(document).ready(function () {
    var ctx = document.getElementById('studentsByCareerChart').getContext('2d');
    var studentsByCareerChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [<?php foreach ($estudiantes_por_carrera as $row) { echo '"' . $row->career_name . '",'; } ?>],
            datasets: [{
                label: '# de Estudiantes',
                data: [<?php foreach ($estudiantes_por_carrera as $row) { echo $row->student_count . ','; } ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });
});
</script>

</body>
</html>
