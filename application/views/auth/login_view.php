<?php 
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
?>
<main class="flex-grow-1 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h2 class="card-title text-center mb-4">Iniciar Sesión</h2>
                        <?php echo form_open('auth/authenticate'); ?>
                            <?php echo form_label('Email'); ?>
                            <?php echo form_input($email); ?>
                            <?php echo form_label('Clave'); ?>
                            <?php echo form_password($password); ?>
                            <?php echo form_submit('submit', 'Iniciar Sesión', 'class="btn btn-primary w-100 mb-3"'); ?>
                        <?php echo form_close(); ?>
                        <div class="text-center">
                            <a href="<?php echo base_url('welcome'); ?>" class="btn btn-link">Volver al inicio</a>
                        </div>
                        <hr>
                        <div class="text-muted small">
                            <p class="mb-1"><strong>Credenciales de prueba:</strong></p>
                            <p class="mb-1">Admin: admin@gmail.com / 123456</p>
                            <p class="mb-0">Cliente: cliente@gmail.com / 123456</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
