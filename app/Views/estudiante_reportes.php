<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Estudiantes</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('../assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('../assets/css/adminlte.min.css') ?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url('menu') ?>" class="nav-link">Inicio</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('menu') ?>" class="brand-link">
      <img src="<?= base_url('assets/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('../assets/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?= base_url('user') ?>" class="d-block">Usuario</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?= base_url('menu') ?>" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Inicio</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('calendar') ?>" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>Calendario</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('apuntes') ?>" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Explorar Apuntes</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('apuntesForm') ?>" class="nav-link">
              <i class="nav-icon fas fa-upload"></i>
              <p>Subir Apuntes</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('user') ?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Datos del Usuario</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('logout') ?>" class="nav-link">
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
            <h1>Gestión de Estudiantes</h1>
          </div>
          <div class="col-sm-6">
            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addStudentModal">Agregar Estudiante</button>
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
                <h3 class="card-title">Lista de Estudiantes</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="studentsTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Usuario</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Carrera</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($students as $student): ?>
                      <tr>
                        <td><?= esc($student->id) ?></td>
                        <td><?= esc($student->user) ?></td>
                        <td><?= esc($student->name) ?></td>
                        <td><?= esc($student->lastName) ?></td>
                        <td>
                          <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editStudentModal-<?= $student->id ?>">Editar</button>
                          <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteStudentModal-<?= $student->id ?>">Eliminar</button>
                        </td>
                      </tr>
                      <!-- Edit Student Modal -->
                      <div class="modal fade" id="editStudentModal-<?= $student->id ?>" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel-<?= $student->id ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editStudentModalLabel-<?= $student->id ?>">Editar Estudiante</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="<?= base_url('students/update/' . $student->id) ?>" method="post">
                                <div class="form-group">
                                  <label for="user-<?= $student->id ?>">Usuario</label>
                                  <input type="text" class="form-control" id="user-<?= $student->id ?>" name="user" value="<?= esc($student->user) ?>">
                                </div>
                                <div class="form-group">
                                  <label for="name-<?= $student->id ?>">Nombre</label>
                                  <input type="text" class="form-control" id="name-<?= $student->id ?>" name="name" value="<?= esc($student->name) ?>">
                                </div>
                                <div class="form-group">
                                  <label for="lastName-<?= $student->id ?>">Apellido</label>
                                  <input type="text" class="form-control" id="lastName-<?= $student->id ?>" name="lastName" value="<?= esc($student->lastName) ?>">
                                </div>

                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Delete Student Modal -->
                      <div class="modal fade" id="deleteStudentModal-<?= $student->id ?>" tabindex="-1" role="dialog" aria-labelledby="deleteStudentModalLabel-<?= $student->id ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="deleteStudentModalLabel-<?= $student->id ?>">Eliminar Estudiante</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p>¿Estás seguro de que quieres eliminar a <strong><?= esc($student->name) ?> <?= esc($student->lastName) ?></strong>?</p>
                            </div>
                            <div class="modal-footer">
                              <a href="<?= base_url('students/delete/' . $student->id) ?>" class="btn btn-danger">Eliminar</a>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
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
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Add Student Modal -->
  <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addStudentModalLabel">Agregar Estudiante</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('students/store') ?>" method="post">
            <div class="form-group">
              <label for="user">Usuario</label>
              <input type="text" class="form-control" id="user" name="user" required>
            </div>
            <div class="form-group">
              <label for="name">Nombre</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
              <label for="lastName">Apellido</label>
              <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      Cualquier cosa que quieras
    </div>
    <strong>&copy; 2024 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> Todos los derechos reservados.
  </footer>
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
    $("#studentsTable").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#studentsTable_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>
