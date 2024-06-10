<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Recordatorios</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('../assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('../assets/css/adminlte.min.css') ?>">
</head>
<body>
  <div class="container">
    <h1>Recordatorios</h1>

    <!-- Formulario para Crear/Editar Recordatorio -->
    <form action="<?= isset($reminder) ? base_url('reminder/update/'.$reminder->id) : base_url('reminder/store') ?>" method="post">
      <div class="form-group">
        <label for="title">Título</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= isset($reminder) ? $reminder->title : '' ?>">
      </div>
      <div class="form-group">
        <label for="description">Descripción</label>
        <input type="text" class="form-control" id="description" name="description" value="<?= isset($reminder) ? $reminder->description : '' ?>">
      </div>
      <div class="form-group">
        <label for="date">Fecha</label>
        <input type="date" class="form-control" id="date" name="date" value="<?= isset($reminder) ? $reminder->date : '' ?>">
      </div>
      <div class="form-group">
        <label for="color">Color</label>
        <input type="text" class="form-control" id="color" name="color" value="<?= isset($reminder) ? $reminder->color : '' ?>">
      </div>
      <div class="form-group">
        <label for="idStudent">ID Estudiante</label>
        <input type="text" class="form-control" id="idStudent" name="idStudent" value="<?= isset($reminder) ? $reminder->idStudent : '' ?>">
      </div>
      <div class="form-group">
        <label for="idAssignment">ID Asignatura</label>
        <input type="text" class="form-control" id="idAssignment" name="idAssignment" value="<?= isset($reminder) ? $reminder->idAssignment : '' ?>">
      </div>
      <button type="submit" class="btn btn-primary"><?= isset($reminder) ? 'Actualizar' : 'Guardar' ?></button>
      <?php if (isset($reminder)): ?>
        <a href="<?= base_url('reminder') ?>" class="btn btn-secondary">Cancelar</a>
      <?php endif; ?>
    </form>

    <!-- Lista de Recordatorios -->
    <h2 class="mt-4">Lista de Recordatorios</h2>
    <table class="table table-bordered mt-3">
      <thead>
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Descripción</th>
          <th>Fecha</th>
          <th>Color</th>
          <th>ID Estudiante</th>
          <th>ID Asignatura</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($reminders as $reminder): ?>
          <tr>
            <td><?= $reminder->id ?></td>
            <td><?= $reminder->title ?></td>
            <td><?= $reminder->description ?></td>
            <td><?= $reminder->date ?></td>
            <td><?= $reminder->color ?></td>
            <td><?= $reminder->idStudent ?></td>
            <td><?= $reminder->idAssignment ?></td>
            <td>
              <a href="<?= base_url('reminder/edit/'.$reminder->id) ?>" class="btn btn-warning">Editar</a>
              <a href="<?= base_url('reminder/delete/'.$reminder->id) ?>" class="btn btn-danger">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
