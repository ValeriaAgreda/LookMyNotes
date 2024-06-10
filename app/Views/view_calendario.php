<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Calendar</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="<?php echo base_url();?>../assets/plugins/fullcalendar/main.css">
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
            <h1>Calendario Universitario</h1>
          </div>
          <div class="col-sm-6"></div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-1"></div>
          <!-- Calendar Column -->
          <div class="col-md-10">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- CALENDARIO -->
                <div id="calendar"></div>
              </div>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-1"></div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Modal para editar/eliminar eventos -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="eventModalLabel">Editar Evento</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="modal-event-title">Título</label>
              <input type="text" id="modal-event-title" class="form-control">
            </div>
            <div class="form-group mt-2">
              <label for="modal-event-description">Descripción</label>
              <input type="text" id="modal-event-description" class="form-control">
            </div>
            <div class="form-group mt-2">
              <label for="modal-event-subject">Materia</label>
              <input type="text" id="modal-event-subject" class="form-control">
            </div>
            <div class="form-group mt-2">
              <label for="modal-event-time">Hora</label>
              <input type="time" id="modal-event-time" class="form-control">
            </div>
            <div class="form-group mt-2">
              <label for="modal-event-color">Color</label>
              <select id="modal-event-color" class="form-control">
                <option class="bg-primary text-white" value="bg-primary">Azul</option>
                <option class="bg-warning text-dark" value="bg-warning">Amarillo</option>
                <option class="bg-success text-white" value="bg-success">Verde</option>
                <option class="bg-danger text-white" value="bg-danger">Rojo</option>
                <option class="bg-info text-white" value="bg-info">Cian</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" id="save-event" class="btn btn-primary">Guardar Cambios</button>
            <button type="button" id="delete-event" class="btn btn-danger">Eliminar Evento</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.modal -->
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
<!-- jQuery UI -->
<script src="<?php echo base_url();?>../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>../assets/js/adminlte.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="<?php echo base_url();?>../assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url();?>../assets/plugins/fullcalendar/main.js"></script>
<!-- Page specific script -->
<script>
  $(document).ready(function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay'
      },
      editable: true,
      droppable: true,
      events: [],
      dateClick: function(info) {
        $('#modal-event-title').val('');
        $('#modal-event-description').val('');
        $('#modal-event-subject').val('');
        $('#modal-event-time').val('');
        $('#eventModal').modal('show');
        $('#save-event').off('click').on('click', function() {
          var title = $('#modal-event-title').val();
          var description = $('#modal-event-description').val();
          var subject = $('#modal-event-subject').val();
          var time = $('#modal-event-time').val();
          var color = $('#modal-event-color').val();
          if (title) {
            var startDateTime = info.dateStr + 'T' + time;
            calendar.addEvent({
              title: title + ' (' + subject + ')',
              start: startDateTime,
              description: description,
              subject: subject,
              time: time,
              className: color
            });
            $('#eventModal').modal('hide');
          }
        });
      },
      eventClick: function(info) {
        $('#modal-event-title').val(info.event.title);
        $('#modal-event-description').val(info.event.extendedProps.description);
        $('#modal-event-subject').val(info.event.extendedProps.subject);
        $('#modal-event-time').val(info.event.extendedProps.time);
        $('#modal-event-color').val(info.event.classNames[0]);
        $('#eventModal').modal('show');
        $('#save-event').off('click').on('click', function() {
          info.event.setProp('title', $('#modal-event-title').val());
          info.event.setExtendedProp('description', $('#modal-event-description').val());
          info.event.setExtendedProp('subject', $('#modal-event-subject').val());
          info.event.setExtendedProp('time', $('#modal-event-time').val());
          info.event.setProp('classNames', [$('#modal-event-color').val()]);
          $('#eventModal').modal('hide');
        });
        $('#delete-event').off('click').on('click', function() {
          info.event.remove();
          $('#eventModal').modal('hide');
        });
      }
    });
    calendar.render();
  });
</script>
</body>
</html>
