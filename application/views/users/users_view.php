<?php 
    $name = array(
        'name' => 'name',
        'id' => 'name',
        'class' => 'form-control mb-3',
        'placeholder' => 'Escribe tu nombre',
        'value' => set_value('name'),
        'required' => 'required',
        'type' => 'text'
    );
    $email = array(
        'name' => 'email',
        'id' => 'email',
        'class' => 'form-control mb-3',
        'placeholder' => 'Escribe tu correo electronico',
        'value' => set_value('email'),
        'required' => 'required',
        'type' => 'email'
    );
     $password = array(
        'name' => 'password',
        'id' => 'password',
        'class' => 'form-control mb-3',
        'placeholder' => 'Escribe tu clave',
        'value' => set_value('password'),
        'required' => 'required',
        'type' => 'password'
    );
    $role = array(
        'name' => 'role',
        'id' => 'role',
        'class' => 'form-control mb-3',
        'placeholder' => 'Escribe tu rol',
        'value' => set_value('role'),
        'required' => 'required',
        'type' => 'text'
    );
?>
<main class="flex-grow-1">
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h3 mb-0">Gestión de Usuarios</h1>
                <p class="text-muted">Administra los usuarios del sistema</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Lista de Usuarios</h5>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control form-control-sm" placeholder="Buscar usuarios..." style="width: 200px;">
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Estado</th>
                                        <th>Fecha Registro</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user) { ?>
                                    <tr>
                                        <td><?php echo $user['id']; ?></td>    
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                                    <?php echo strtoupper($user['name'][0]); ?>
                                                </div>
                                                <?php echo $user['name']; ?>
                                            </div>
                                        </td>
                                        <td><?php echo $user['email']; ?></td>
                                        <td><span class="badge bg-danger"><?php echo $user['role']; ?></span></td>
                                        <td><span class="badge bg-success"><?php echo $user['status']; ?></span></td>
                                        <td><?php echo $user['createdAt']; ?></td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a class="btn btn-outline-primary" title="Editar" href="users/edit/<?php echo $user['id']; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-outline-danger" title="Eliminar" onclick="delete_user(<?php echo $user['id']; ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <nav aria-label="Paginación de usuarios">
                            <ul class="pagination pagination-sm mb-0 justify-content-center">
                                <li class="page-item disabled">
                                    <span class="page-link">Anterior</span>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">1</span>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Siguiente</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="card shadow mt-4">
                    <div class="card-header">
                        <h6 class="mb-0">Estadísticas Rápidas</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="border-end">
                                    <h4 class="text-primary mb-1">1,245</h4>
                                    <small class="text-muted">Total Usuarios</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <h4 class="text-success mb-1">1,156</h4>
                                <small class="text-muted">Activos</small>
                            </div>
                        </div>
                        <hr>
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="border-end">
                                    <h4 class="text-warning mb-1">45</h4>
                                    <small class="text-muted">Pendientes</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <h4 class="text-danger mb-1">44</h4>
                                <small class="text-muted">Inactivos</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php  if($this->session->userdata('user_role') == 'admin') { ?>
            <div class="col-lg-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="mb-0">
                            Crear Nuevo Usuario
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php echo form_open('users/create'); ?>
                            <?php echo form_label('Nombre'); ?>
                            <?php echo form_input($name); ?>

                            <?php echo form_label('Email'); ?>
                            <?php echo form_input($email); ?>

                            <?php echo form_label('Clave'); ?>
                            <?php echo form_password($password); ?>
                            
                            <?php echo form_label('Rol'); ?>
                            <?php $options = array('admin' => 'Admin', 'user' => 'Usuario'); ?>
                            <?php echo form_dropdown('role', $options, 'user', 'class="form-control"'); ?>

                            <?php echo form_submit('submit', 'Crear / Editar', 'class="btn btn-primary w-100 my-3"'); ?>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</main>


<script>
    function delete_user(id) {
        if (confirm('¿Estás seguro de eliminar este usuario?')) {
            window.location.href = 'users/delete/' + id;
        }
    }
</script>