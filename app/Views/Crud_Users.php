<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRUD Estudiantes</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/bootstrap/css/bootstrap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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
            <h1>Gestión de Estudiantes</h1>
          </div>
          <div class="col-sm-6">
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#studentModal">
              Agregar Estudiante
            </button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
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
                  <tbody id="studentsTableBody">
                    <!-- Table rows will be added here dynamically -->
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Modal para crear/editar estudiante -->
    <div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="studentModalLabel">Agregar Estudiante</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="id">
            <div class="form-group">
              <label for="user">Usuario</label>
              <input type="text" id="user" name="user" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="password">Contraseña</label>
              <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="name">Nombre</label>
              <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="lastName">Apellido</label>
              <input type="text" id="lastName" name="lastName" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="career">Carrera</label>
              <select id="career" name="career" class="form-control" required>
                <?php if (!empty($careers)) : ?>
                  <?php foreach ($careers as $career): ?>
                    <option value="<?= $career->id ?>"><?= $career->name ?></option>
                  <?php endforeach; ?>
                <?php else : ?>
                  <option value="">No hay carreras disponibles</option>
                <?php endif; ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="saveStudent()">Guardar Cambios</button>
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
<script src="<?php echo base_url();?>/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url();?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo base_url();?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>/assets/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>
  $(document).ready(function() {
    loadStudents();

    // Inicializar DataTable
    $('#studentsTable').DataTable({
      responsive: true,
      autoWidth: false,
    });
  });

  function loadStudents() {
    $.ajax({
      url: '<?php echo base_url();?>student/getStudents',
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        if (response.status === 'success') {
          var students = response.data;
          var tbody = $('#studentsTableBody');
          tbody.empty(); // Vaciar el cuerpo de la tabla antes de agregar nuevas filas

          students.forEach(function(student) {
            var row = '<tr>' +
                      '<td>' + student.id + '</td>' +
                      '<td>' + student.user + '</td>' +
                      '<td>' + student.name + '</td>' +
                      '<td>' + student.lastName + '</td>' +
                      '<td>' + student.career_name + '</td>' +
                      '<td>' +
                      '<button class="btn btn-primary btn-sm" onclick="editStudent(' + student.id + ')">Editar</button>' +
                      '<button class="btn btn-danger btn-sm" onclick="deleteStudent(' + student.id + ')">Eliminar</button>' +
                      '</td>' +
                      '</tr>';
            tbody.append(row);
          });
        } else {
          alert('Error al cargar los estudiantes: ' + response.message);
        }
      },
      error: function(xhr, status, error) {
        console.error('Error en la solicitud AJAX:', error);
        alert('Hubo un error al cargar los estudiantes.');
      }
    });
  }

  function saveStudent() {
    var id = $('#id').val();
    var user = $('#user').val();
    var password = $('#password').val();
    var name = $('#name').val();
    var lastName = $('#lastName').val();
    var career = $('#career').val();

    if (user && password && name && lastName && career) {
      var url = id ? '<?php echo base_url();?>student/updateStudent/' + id : '<?php echo base_url();?>student/addStudent';
      var method = id ? 'PUT' : 'POST';

      $.ajax({
        url: url,
        type: method,
        data: {
          user: user,
          password: password,
          name: name,
          lastName: lastName,
          idCareer: career
        },
        dataType: 'json',
        success: function(response) {
          if (response.status === 'success') {
            $('#studentModal').modal('hide');
            loadStudents();
          } else {
            alert('Error al guardar el estudiante: ' + response.message);
          }
        },
        error: function(xhr, status, error) {
          console.error('Error en la solicitud AJAX:', error);
          alert('Hubo un error al guardar el estudiante.');
        }
      });
    } else {
      alert('Por favor, completa todos los campos.');
    }
  }

  function editStudent(id) {
    $.ajax({
      url: '<?php echo base_url();?>student/getStudentById/' + id,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        if (response.status === 'success') {
          var student = response.data;
          $('#id').val(student.id);
          $('#user').val(student.user);
          $('#password').val(student.password);
          $('#name').val(student.name);
          $('#lastName').val(student.lastName);
          $('#career').val(student.idCareer);
          $('#studentModalLabel').text('Editar Estudiante');
          $('#studentModal').modal('show');
        } else {
          alert('Error al cargar el estudiante: ' + response.message);
        }
      },
      error: function(xhr, status, error) {
        console.error('Error en la solicitud AJAX:', error);
        alert('Hubo un error al cargar el estudiante.');
      }
    });
  }

  function deleteStudent(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este estudiante?')) {
      $.ajax({
        url: '<?php echo base_url();?>student/deleteStudent/' + id,
        type: 'DELETE',
        dataType: 'json',
        success: function(response) {
          if (response.status === 'success') {
            loadStudents();
          } else {
            alert('Error al eliminar el estudiante: ' + response.message);
          }
        },
        error: function(xhr, status, error) {
          console.error('Error en la solicitud AJAX:', error);
          alert('Hubo un error al eliminar el estudiante.');
        }
      });
    }
  }
</script>
</body>
</html>
