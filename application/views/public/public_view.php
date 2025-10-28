<main class="flex-grow-1 bg-white">
    <div class="container">
        <h1 class="display-1 mb-4">¡Bienvenidos!</h1>
        <p class="lead">Este es un proyecto de CodeIgniter 2 con Bootstrap 5.</p>
        <hr>
        <div class="row bg-light rounded p-4">
            <div class="col-md-6">
                <h2>Usuario Admin</h2>
                <p><strong>Email:</strong> admin@gmail.com</p>
                <p><strong>Password:</strong> 123456</p>

                <a href="<?php echo base_url('auth'); ?>" class="btn btn-primary btn-sm mt-2">Iniciar sesión</a>
            </div>
            <div class="col-md-6">
                <h2>Usuario Cliente</h2>
                <p><strong>Email:</strong> cliente@gmail.com</p>
                <p><strong>Password:</strong> 123456</p>
            </div>
        </div>
        <hr>
        <p>Para iniciar sesión, ingresa los datos proporcionados en la tabla anterior.</p>
        <hr>
        <div class="row bg-light rounded p-4">
            <div class="col-md-6">
                <h2>El proyecto cuenta con</h2>
                <p>CodeIgniter 2</p>
                <p>Bootstrap 5</p>
                <p>PHP 7.4</p>
                <p>MySQL 5.7</p>
            </div>
        </div>
    </div>
</main>

