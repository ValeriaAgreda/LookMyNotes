<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Subida de Archivos</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>../assets/css/adminlte.min.css">
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
            <h1>Formulario de Subida de Archivos</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body">
                <?php if(session()->getFlashdata('message')): ?>
                  <div class="alert alert-info">
                      <?= session()->getFlashdata('message') ?>
                  </div>
                <?php endif; ?>
                <!-- Formulario de subida de archivos -->
                <form action="<?php echo base_url().'subir';?>" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                  </div>
                  <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="subject">Materia</label>
                    <select class="form-control" id="subject" name="subject" required>
                      <?php if (!empty($assignments)) : ?>
                        <?php foreach ($assignments as $assignment): ?>
                          <option value="<?= $assignment->id ?>"><?= $assignment->name ?></option>
                        <?php endforeach; ?>
                      <?php else : ?>
                        <option value="">No hay materias disponibles</option>
                      <?php endif; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="file">Seleccionar archivo</label>
                    <input type="file" class="form-control" id="file" name="file" >
                  </div>
                  <button type="submit" class="btn btn-primary">Subir Archivo</button>
                </form>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
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

<script src="<?php echo base_url();?>../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url();?>../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>../assets/js/adminlte.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="<?php echo base_url();?>../assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url();?>../assets/plugins/fullcalendar/main.js"></script>
</body>
</html>
