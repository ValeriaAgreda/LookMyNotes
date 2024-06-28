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

    <!-- Table Section -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lista de Recordatorios</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Título</th>
                      <th>Descripción</th>
                      <th>Fecha</th>
                      <th>Color</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="reminderTableBody">
                    <!-- Table rows will be added here dynamically -->
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-1"></div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Modal para editar/eliminar eventos -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="eventModalLabel">Editar Evento</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="id">
            <div class="form-group">
              <label for="modal-event-title">Título</label>
              <input type="text" id="titulo" name="titulo" class="form-control">
            </div>
            <div class="form-group mt-2">
              <label for="modal-event-description">Descripción</label>
              <input type="text" id="descripcion" name="descripcion" class="form-control">
            </div>
            <div class="form-group mt-2">
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
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

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

  // Función para guardar o actualizar un evento
  function saveEvent() {
    var id = $('#id').val();
    var title = $('#titulo').val();
    var description = $('#descripcion').val();
    var subject = $('#materia').val();
    var color = $('#color').val();
    var date = clickedDateStr || $('#fecha').val(); // Usar la fecha de clic o la fecha del evento

    if (title && date) {
      var url = id ? '<?php echo base_url();?>reminder/updateReminder/' + id : '<?php echo base_url();?>reminder/addReminder';
      var method = id ? 'PUT' : 'POST';

      $.ajax({
        url: url,
        type: method,
        data: {
          title: title,
          description: description,
          date: date, // Guardar la fecha sin hora
          color: color,
          idStudent: 2, // Ajusta según necesidades
          idAssignment: subject // Ajusta según necesidades
        },
        dataType: 'json',
        success: function(response) {
          console.log('Éxito:', response);
          if (response.status === 'success') {
            location.reload(); // Recargar la página directamente
          } else {
            alert('Error al guardar el evento: ' + response.message);
          }
        },
        error: function(xhr, status, error) {
          console.error('Error en la solicitud AJAX:', error);
          alert('Hubo un error al guardar el evento.');
        }
      });
    } else {
      alert('Por favor, completa todos los campos.');
    }
  }

  // Función para eliminar un evento
  function deleteEvent() {
    var id = $('#id').val();
    if (confirm('¿Estás seguro de que deseas eliminar este evento?')) {
        $.ajax({
            url: '<?php echo base_url();?>reminder/deleteReminder/' + id, // Verifica esta URL
            type: 'DELETE', // Asegúrate que sea DELETE si así está definido en las rutas
            success: function(response) {
                if (response.status === 'success') {
                    location.reload(); // Recargar la página directamente
                } else {
                    alert('Error al eliminar el evento: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX:', error);
                alert('Hubo un error al eliminar el evento.');
            }
        });
    }
}

  // Función para cerrar el modal
  function closeModal() {
    $('#eventModal').modal('hide');
  }

  // Función para poblar la tabla de recordatorios
function populateTable() {
    $.ajax({
        url: '<?php echo base_url();?>reminder/getReminders',
        type: 'GET',
        dataType: 'json',
        success: function(reminders) {
            var tableBody = $('#reminderTableBody');
            tableBody.empty(); // Vaciar la tabla antes de agregar los recordatorios
            reminders.forEach(function(reminder) {
                var row = $('<tr></tr>');
                row.append('<td>' + reminder.id + '</td>');
                row.append('<td>' + reminder.title + '</td>');
                row.append('<td>' + reminder.description + '</td>');
                row.append('<td>' + reminder.date.split('T')[0] + '</td>'); // Mostrar solo la fecha sin hora
                row.append('<td><span class="badge ' + reminder.color + '">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>');
                row.append('<td><button class="btn btn-primary btn-sm" onclick="editEvent(' + reminder.id + ')">Editar</button></td>');
                tableBody.append(row);
            });
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', error);
            alert('Hubo un error al obtener los recordatorios.');
        }
    });
}

// Función para editar un evento
function editEvent(id) {
    $.ajax({
        url: '<?php echo base_url();?>reminder/getReminder/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#id').val(data.id);
            $('#titulo').val(data.title);
            $('#descripcion').val(data.description);
            $('#materia').val(data.idAssignment);
            $('#color').val(data.color);
            clickedDateStr = data.date.split('T')[0]; // Solo la parte de la fecha
            $('#eventModal').modal('show');
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', error);
            alert('Hubo un error al obtener el evento.');
        }
    });
}

// Función para guardar o actualizar un evento
function saveEvent() {
    var id = $('#id').val();
    var title = $('#titulo').val();
    var description = $('#descripcion').val();
    var subject = $('#materia').val();
    var color = $('#color').val();
    var date = clickedDateStr || $('#fecha').val(); // Usar la fecha de clic o la fecha del evento

    if (title && date) {
        var url = id ? '<?php echo base_url();?>/reminder/updateReminder/' + id : '<?php echo base_url();?>/reminder/addReminder';
        var method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            type: method,
            data: JSON.stringify({
                title: title,
                description: description,
                date: date, // Guardar la fecha sin hora
                color: color,
                idStudent: 2, // Ajusta según necesidades
                idAssignment: subject // Ajusta según necesidades
            }),
            contentType: 'application/json', // Añadir esto para que el servidor interprete correctamente los datos
            dataType: 'json',
            success: function(response) {
                console.log('Éxito:', response);
                if (response.status === 'success') {
                    location.reload(); // Recargar la página directamente
                } else {
                    alert('Error al guardar el evento: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX:', error);
                alert('Hubo un error al guardar el evento.');
            }
        });
    } else {
        alert('Por favor, completa todos los campos.');
    }
}


// Función para eliminar un evento
function deleteEvent() {
    var id = $('#id').val();
    if (confirm('¿Estás seguro de que deseas eliminar este evento?')) {
        $.ajax({
            url: '<?php echo base_url();?>reminder/deleteReminder/' + id,
            type: 'DELETE',
            success: function(response) {
                if (response.status === 'success') {
                    location.reload(); // Recargar la página directamente
                } else {
                    alert('Error al eliminar el evento: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX:', error);
                alert('Hubo un error al eliminar el evento.');
            }
        });
    }
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
                url: '<?php echo base_url();?>reminder/getReminders',
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
                            className: this.color
                        });
                    });
                    successCallback(events);
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                    alert('Hubo un error al obtener los eventos del calendario.');
                }
            });
        },
        dateClick: function(info) {
            clickedDateStr = info.dateStr; // Almacenar la fecha de clic globalmente
            $('#eventModal').modal('show');
            $('#titulo').val('');
            $('#descripcion').val('');
            $('#color').val('bg-primary');
        },
        eventClick: function(info) {
            $('#id').val(info.event.id);
            $('#titulo').val(info.event.title);
            $('#descripcion').val(info.event.extendedProps.description);
            $('#color').val(info.event.backgroundColor);
            $('#materia').val(info.event.extendedProps.subject);
            clickedDateStr = info.event.startStr.split('T')[0]; // Usar la fecha del evento
            $('#eventModal').modal('show');
        }
    });

    calendar.render();
    populateTable(); // Llamar a la función para llenar la tabla
});

</script>
</body>
</html>
