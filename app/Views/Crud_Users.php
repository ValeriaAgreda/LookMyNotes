<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Estudiantes</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo base_url(); ?>../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>../assets/plugins/fullcalendar/main.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>../assets/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include 'sidebar_menu.php'; ?>
    <div class="content-wrapper">
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
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Listado de Estudiantes</h3>
                            </div>
                            <div class="card-body">
                                <?php if (session()->getFlashdata('success')): ?>
                                    <div class="alert alert-success">
                                        <?= session()->getFlashdata('success'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (session()->getFlashdata('error')): ?>
                                    <div class="alert alert-danger">
                                        <?= session()->getFlashdata('error'); ?>
                                    </div>
                                <?php endif; ?>
                                <table id="studentTable" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Carrera</th>
                                        <th>Rol</th> <!-- Nuevo campo para el rol en la tabla -->
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($students as $student): ?>
                                        <tr>
                                            <td><?php echo $student->user; ?></td>
                                            <td><?php echo $student->name; ?></td>
                                            <td><?php echo $student->lastName; ?></td>
                                            <td><?php echo $student->career_name; ?></td>
                                            <td><?php echo $student->role; ?></td> <!-- Mostrar el rol -->
                                            <td>
                                                <button class="btn btn-warning btn-sm edit-btn" data-id="<?php echo $student->id; ?>" data-toggle="modal" data-target="#studentModal">Editar</button>
                                                <form action="<?php echo base_url('estudiante/delete/' . $student->id); ?>" method="post" class="d-inline">
                                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="studentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="studentModalLabel">Agregar/Editar Estudiante</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="studentForm" method="post">
                        <div class="modal-body">
                            <input type="hidden" id="studentId" name="id">
                            <div class="form-group">
                                <label for="user">Usuario</label>
                                <input type="text" class="form-control" id="user" name="user" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Apellido</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required>
                            </div>
                            <div class="form-group">
                                <label for="idCareer">Carrera</label>
                                <select class="form-control" id="idCareer" name="idCareer" required>
                                    <?php foreach ($careers as $career): ?>
                                        <option value="<?php echo $career->id; ?>"><?php echo $career->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="role">Rol</label>
                                <input type="text" class="form-control" id="role" name="role" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="<?php echo base_url(); ?>../assets/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url(); ?>../assets/js/adminlte.min.js"></script>
        <script>
            $(document).ready(function () {
                // Configurar el modal para edición de estudiante existente
                $('.edit-btn').on('click', function () {
                    var studentId = $(this).data('id');
                    $.ajax({
                        url: '<?php echo base_url('estudiante/edit/'); ?>' + studentId,
                        method: 'GET',
                        success: function (data) {
                            $('#studentForm').attr('action', '<?php echo base_url('estudiante/update/'); ?>' + studentId);
                            $('#studentId').val(data.id);
                            $('#user').val(data.user);
                            $('#password').val(data.password);
                            $('#name').val(data.name);
                            $('#lastName').val(data.lastName);
                            $('#idCareer').val(data.idCareer);
                            $('#role').val(data.role); // Cargar el rol en el formulario
                        }
                    });
                });

                // Resetear el formulario cuando se abre el modal para agregar un nuevo estudiante
                $('#studentModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var modal = $(this);

                    // Si el botón que abre el modal no tiene la clase 'edit-btn', es un nuevo registro
                    if (!button.hasClass('edit-btn')) {
                        modal.find('#studentForm').attr('action', '<?php echo base_url('estudiante/store'); ?>');
                        modal.find('#studentForm')[0].reset();
                    }
                });
            });
        </script>
    </div>
</div>
</body>
</html>
