<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reportes - Administrador</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>../assets/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url();?>../assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?php echo base_url().'user';?>" class="d-block">Usuario</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?php echo base_url().'menu';?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Inicio</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url().'calendar';?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Calendario</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url().'apuntes';?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Explorar de apuntes</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url().'apuntesForm';?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Subir Apuntes</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url().'reportes';?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Reportes</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reportes - Administrador</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Cantidad de Notas por Materia</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="list-group">
                  <?php foreach ($assignments as $assignment): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <?= esc($assignment->name) ?>
                      <span class="badge badge-primary badge-pill"><?= $assignment->num_notes ?></span>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recordatorios por Estudiante</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="list-group">
                  <?php foreach ($students as $student): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <?= esc($student->name . ' ' . $student->lastName) ?>
                      <span class="badge badge-info badge-pill"><?= $student->num_reminders ?></span>
                    </li>
                  <?php endforeach; ?>
                </ul>
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
<script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('dist/js/adminlte.min.js') ?>"></script>
</body>
</html>
