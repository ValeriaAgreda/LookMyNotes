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
<?php include 'sidebar_menu.php'; ?>
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
php
Copy code
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
          <input type="text" id="titulo" name="titulo" class="form-control">
        </div>
        <div class="form-group mt-2">
          <label for="modal-event-description">Descripción</label>
          <input type="text" id="descripcion" name="descripcion" class="form-control">
        </div>
        <div class="form-group">
          <label for="subject">Materia</label>
          <select class="form-control" id="materia" name="materia" required>
            <?php if (!empty($assignments)) : ?>
              <?php foreach ($assignments as $assignment): ?>
                <option value="<?= $assignment->id ?>"><?= $assignment->name ?></option>
              <?php endforeach; ?>
            <?php else : ?>
              <option value="">No hay materias disponibles</option>
            <?php endif; ?>
          </select>
        </div>
        <div class="form-group mt-2">
          <label for="modal-event-time">Hora</label>
          <input type="time" id="hora" name="hora" class="form-control">
        </div>
        <div class="form-group mt-2">
          <label for="modal-event-color">Color</label>
          <select id="color" name="color" class="form-control">
            <option class="bg-primary text-white" value="bg-primary">Azul</option>
            <option class="bg-warning text-dark" value="bg-warning">Amarillo</option>
            <option class="bg-success text-white" value="bg-success">Verde</option>
            <option class="bg-danger text-white" value="bg-danger">Rojo</option>
            <option class="bg-info text-white" value="bg-info">Cian</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeModal()">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="saveEvent()">Guardar Cambios</button>
        <button type="button" class="btn btn-danger" onclick="deleteEvent()">Eliminar Evento</button>
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->
<!-- Scripts -->
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
  // Variable global para almacenar la fecha de clic
  var clickedDateStr = '';

  // Funciones globales
  function saveEvent() {
    var title = $('#titulo').val();
    var description = $('#descripcion').val();
    var subject = $('#materia').val();
    var time = $('#hora').val();
    var color = $('#color').val();
    
    if (title && time && clickedDateStr) {
        var startDateTime = clickedDateStr + 'T' + time; // Construir fecha y hora

        $.ajax({
            url: 'http://localhost:9090/lookMN/public/reminder/addReminder',
            type: 'POST',
            data: {
                title: title,
                description: description,
                date: startDateTime,
                color: color,
                idStudent: 2, // Ajusta según necesidades
                idAssignment: subject // Ajusta según necesidades
            },
            dataType: 'json',
            success: function(response) {
                console.log('Éxito:', response);
                if(response.status === 'success') {
                    location.reload(); // Recargar la página directamente
                } else {
                    alert('Error al guardar el evento: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX:', error);
                console.log('Estado:', status);
                console.log('Respuesta:', xhr.responseText);
                alert('Hubo un error al guardar el evento.');
            }
        });
    } else {
        alert('Por favor, completa todos los campos.');
    }
}



  function deleteEvent() {
    if (confirm('¿Estás seguro de que deseas eliminar este evento?')) {
      var eventId = $('#modal-event-id').val(); // Ajusta cómo obtienes el ID del evento

      $.ajax({
        url: '<?php echo base_url().'reminder/getReminders';?>' + eventId,
        type: 'POST',
        success: function(data) {
          calendar.refetchEvents();
          $('#eventModal').modal('hide');
        }
      });
    }
  }

  function closeModal() {
    $('#eventModal').modal('hide');
  }

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
      events: function(fetchInfo, successCallback, failureCallback) {
        $.ajax({
          url: '<?php echo base_url().'reminder/getReminders';?>',
          type: 'GET',
          dataType: 'json',
          success: function(data) {
            var events = [];
            $(data).each(function() {
              events.push({
                id: this.id,
                title: this.title,
                start: this.date,
                description: this.description,
                subject: this.subject,
                time: this.time,
                className: this.color
              });
            });
            successCallback(events);
          }
        });
      },
      dateClick: function(info) {
        clickedDateStr = info.dateStr; // Almacenar la fecha de clic globalmente
        $('#eventModal').modal('show');
        $('#modal-event-title').val('');
        $('#modal-event-description').val('');
        $('#modal-event-time').val('');
        $('#modal-event-color').val('bg-primary');
      },
      eventClick: function(info) {
        $('#modal-event-id').val(info.event.id);
        $('#modal-event-title').val(info.event.title);
        $('#modal-event-description').val(info.event.extendedProps.description);
        $('#modal-event-time').val(info.event.extendedProps.time);
        $('#modal-event-color').val(info.event.className[0]);
        $('#eventModal').modal('show');
      }
    });

    calendar.render();
  });
</script>
</body>
</html>