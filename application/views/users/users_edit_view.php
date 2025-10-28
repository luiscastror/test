<?php 
    // Prepare form field arrays with user data
    $name = array(
        'name' => 'name',
        'id' => 'name',
        'class' => 'form-control mb-3',
        'placeholder' => 'Escribe tu nombre',
        'value' => set_value('name', isset($user['name']) ? $user['name'] : ''),
        'required' => 'required',
        'type' => 'text'
    );
    
    $email = array(
        'name' => 'email',
        'id' => 'email',
        'class' => 'form-control mb-3',
        'placeholder' => 'Escribe tu correo electronico',
        'value' => set_value('email', isset($user['email']) ? $user['email'] : ''),
        'required' => 'required',
        'type' => 'email'
    );
    
    // Get current user role for dropdown selection
    $current_role = isset($user['role']) ? $user['role'] : 'user';
    $role = array(
        'name' => 'role',
        'id' => 'role',
        'class' => 'form-control mb-3',
        'placeholder' => 'Escribe tu rol',
        'value' => set_value('role', $current_role),
        'required' => 'required',
        'type' => 'text'
    );
?>

<main class="flex-grow-1 mt-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-0">Editar Usuario</h1>
                <p class="text-muted">Editar usuario</p>
            </div>
            <div class="col-lg-8 mt-3">
                <div class="card shadow mb-3">
                    <div class="card-body">
                        <?php echo form_open('users/update/' . $user['id']); ?>
                        
                        <?php echo form_hidden('id', $user['id']); ?>
                        
                        <div class="mb-3">
                            <?php echo form_label('Nombre', 'name', array('class' => 'form-label')); ?>
                            <?php echo form_input($name); ?>
                        </div>

                        <div class="mb-3">
                            <?php echo form_label('Email', 'email', array('class' => 'form-label')); ?>
                            <?php echo form_input($email); ?>
                        </div>

                        <div class="mb-3">
                            <?php echo form_label('Rol', 'role', array('class' => 'form-label')); ?>
                            <?php 
                                $role_options = array(
                                    'admin' => 'Administrador', 
                                    'usuario' => 'Usuario'
                                ); 
                            ?>
                            <?php echo form_dropdown('role', $role_options, $current_role, 'class="form-select mb-3"'); ?>
                        </div>

                        <div class="d-grid gap-2">
                            <?php echo form_submit('submit', 'Actualizar Usuario', 'class="btn btn-primary"'); ?>
                            <a href="<?php echo base_url('users'); ?>" class="btn btn-secondary">Cancelar</a>
                        </div>
                        
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>