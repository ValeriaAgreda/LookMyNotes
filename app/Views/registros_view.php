<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registros de Archivos</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo base_url();?>../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>../assets/css/adminlte.min.css">
</head>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include 'sidebar_menu.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registros de Archivos</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lista de Archivos Subidos</h3>
                <!-- Filtro de Materias -->
                <form action="<?= base_url('apuntes') ?>" method="get">
    <div class="form-group">
        <label for="materia">Seleccionar Materia:</label>
        <select name="materia" id="materia" class="form-control">
            <option value="">Todas las Materias</option>
            <?php foreach ($materiasMap as $id => $nombre): ?>
                <option value="<?= $id ?>" <?= ($id == $materiaSeleccionada) ? 'selected' : '' ?>><?= esc($nombre) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Filtrar</button>
</form>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Título</th>
                      <th>Descripción</th>
                      <th>Materia</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (empty($archivos)): ?>
                      <tr>
                        <td colspan="4" class="text-center">No se encontraron archivos para esta materia.</td>
                      </tr>
                    <?php else: ?>
                      <?php foreach ($archivos as $archivo): ?>
                        <tr>
                          <td><?= esc($archivo->title) ?></td>
                          <td><?= esc($archivo->description) ?></td>
                          <td><?= esc($materiasMap[$archivo->idAssignment] ?? 'Materia Desconocida') ?></td>
                          <td>
                            <a href="<?= base_url('archivo/view/' . $archivo->id) ?>" class="btn btn-info">Ver</a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url();?>../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url();?>../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>../assets/js/adminlte.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="<?php echo base_url();?>../assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url();?>../assets/plugins/fullcalendar/main.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>
</body>
</html>
