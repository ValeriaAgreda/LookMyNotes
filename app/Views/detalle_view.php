<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ver Archivo</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo base_url();?>../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>../assets/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
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
              <i class="nav-icon fas fa-home"></i>
              <p>Inicio</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url().'calendar';?>" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>Calendario</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url().'apuntes';?>" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Explorar de Apuntes</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url().'apuntesForm';?>" class="nav-link">
              <i class="nav-icon fas fa-upload"></i>
              <p>Subir Apuntes</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url().'user';?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Datos del Usuario</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url().'';?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Cerrar Sesión</p>
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
            <h1>Ver Archivo</h1>
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
                <h3><?= esc($archivo->title) ?></h3>
                <p><strong>Descripción:</strong> <?= esc($archivo->description) ?></p>
                <p><strong>Materia:</strong> <?= esc($archivo->idAssignment) ?></p>
                <p><strong>Archivo:</strong> <a href="<?= base_url('uploads/' . basename($archivo->archive)) ?>">Descargar</a></p>
                <a href="<?= base_url('apuntes') ?>" class="btn btn-secondary">Volver</a>
                
                <!-- Formulario de Edición -->
                <form action="<?= base_url('archivo/update/' . $archivo->id) ?>" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" name="title" class="form-control" value="<?= esc($archivo->title) ?>">
                  </div>
                  <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea name="description" class="form-control"><?= esc($archivo->description) ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="subject">Materia</label>
                    <input type="text" name="subject" class="form-control" value="<?= esc($archivo->idAssignment) ?>">
                  </div>
                  <div class="form-group">
                    <label for="file">Archivo</label>
                    <input type="file" name="file" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>

                <!-- Formulario de Eliminación -->
                <form action="<?= base_url('archivo/delete/' . $archivo->id) ?>" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este archivo?');">
                  <button type="submit" class="btn btn-danger mt-3">Eliminar</button>
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

<!-- jQuery -->
<script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('dist/js/adminlte.min.js') ?>"></script>
</body>
</html>
