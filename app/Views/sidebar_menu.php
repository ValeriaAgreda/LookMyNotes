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