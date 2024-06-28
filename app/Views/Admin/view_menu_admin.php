<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Menú Principal Administrador</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>../assets/css/adminlte.min.css">
  <style>
    .button-container {
      display: flex;
      justify-content: center;
      margin: 20px 0;
    }
    .custom-button {
      margin: 10px;
      padding: 20px 40px;
      font-size: 20px;
      font-weight: bold;
      color: #fff;
      background-color: #007bff;
      border: none;
      border-radius: 10px;
      text-decoration: none;
      transition: background-color 0.3s ease, transform 0.3s ease;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .custom-button:hover {
      background-color: #0056b3;
      transform: translateY(-3px);
    }
    .custom-button i {
      margin-right: 10px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php include 'sidebar_menu_admin.php'; ?>


  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menú Principal Administrador</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Menu de botones vistosos -->
    <div class="button-container">
      <a href="<?php echo base_url().'calendar';?>" class="custom-button">
        <i class="fas fa-calendar-alt"></i> Calendario
      </a>
      <a href="<?php echo base_url().'apuntes';?>" class="custom-button">
        <i class="fas fa-book"></i> Base de Apuntes
      </a>
      <a href="<?php echo base_url().'user';?>" class="custom-button">
        <i class="fas fa-user"></i> Datos del Usuario
      </a>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- Aquí puedes agregar contenido adicional si es necesario -->
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

<!-- Scripts -->
<!-- jQuery -->
<script src="<?php echo base_url();?>../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url();?>../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>../assets/js/adminlte.min.js"></script>
</body>
</html>
