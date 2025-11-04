<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="<?php echo base_url('panel'); ?>">CodeIgniter 2 - Lanzadera</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('panel'); ?>">Panel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('users'); ?>">Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('categories'); ?>">Categorias</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('items'); ?>">Productos</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link"><?php echo $this->session->userdata('user_name'); ?> - <?php echo strtoupper($this->session->userdata('user_role')); ?></a>
        </li>  
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('auth/logout'); ?>">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>