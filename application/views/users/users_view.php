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
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Lista de Usuarios</h5>
                            <small class="text-muted">
                                Total: <?php echo $total_users; ?> usuario(s) 
                                <?php if (!empty($search_term)): ?>
                                    | Búsqueda: "<?php echo htmlspecialchars($search_term); ?>"
                                <?php endif; ?>
                            </small>
                        </div>
                        
                        <!-- Controles de búsqueda y paginación -->
                        <div class="row g-2">
                            <div class="col-md-6">
                                <form method="GET" action="<?php echo base_url('users/index'); ?>" class="d-flex gap-2">
                                    <input type="text" name="search" class="form-control form-control-sm" 
                                           placeholder="Buscar por nombre, email o rol..." 
                                           value="<?php echo htmlspecialchars($search_term); ?>">
                                    <input type="hidden" name="per_page" value="<?php echo $per_page; ?>">
                                    <button type="submit" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <?php if (!empty($search_term)): ?>
                                        <a href="<?php echo base_url('users/index' . ($per_page != 5 ? '?per_page=' . $per_page : '')); ?>" 
                                           class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    <?php endif; ?>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-end align-items-center gap-2">
                                    <label class="form-label mb-0 text-nowrap">Mostrar:</label>
                                    <select class="form-select form-select-sm" style="width: auto;" onchange="changePerPage(this.value)">
                                        <option value="5" <?php echo ($per_page == 5) ? 'selected' : ''; ?>>5</option>
                                        <option value="10" <?php echo ($per_page == 10) ? 'selected' : ''; ?>>10</option>
                                        <option value="15" <?php echo ($per_page == 15) ? 'selected' : ''; ?>>15</option>
                                        <option value="25" <?php echo ($per_page == 25) ? 'selected' : ''; ?>>25</option>
                                    </select>
                                    <span class="text-nowrap">por página</span>
                                </div>
                            </div>
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
                        
                        <!-- Footer con información de paginación -->
                        <?php if (!empty($users)): ?>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">
                                        Mostrando <?php echo count($users); ?> de <?php echo $total_users; ?> usuarios
                                        <?php if ($total_pages > 1): ?>
                                            | Página <?php echo floor($current_page / $per_page) + 1; ?> de <?php echo $total_pages; ?>
                                        <?php endif; ?>
                                    </small>
                                </div>
                                <div>
                                    <?php echo $pagination; ?>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="card-body text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-search fa-3x mb-3"></i>
                                <h5>No se encontraron usuarios</h5>
                                <?php if (!empty($search_term)): ?>
                                    <p>No hay resultados para: "<strong><?php echo htmlspecialchars($search_term); ?></strong>"</p>
                                    <a href="<?php echo base_url('users/index' . ($per_page != 5 ? '?per_page=' . $per_page : '')); ?>" class="btn btn-outline-primary">
                                        <i class="fas fa-arrow-left"></i> Ver todos los usuarios
                                    </a>
                                <?php else: ?>
                                    <p>Aún no hay usuarios creados.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
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

    function changePerPage(perPage) {
        var currentUrl = new URL(window.location);
        var search = currentUrl.searchParams.get('search');
        
        // Construir nueva URL con segmentos URI
        var newUrl = '/test/users/index';
        var params = [];
        
        if (search) {
            params.push('search=' + encodeURIComponent(search));
        }
        if (perPage != 5) { // Solo agregar si no es el valor por defecto
            params.push('per_page=' + perPage);
        }
        
        if (params.length > 0) {
            newUrl += '?' + params.join('&');
        }
        
        window.location.href = newUrl;
    }

    // Función para búsqueda con Enter
    document.addEventListener('DOMContentLoaded', function() {
        var searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    this.form.submit();
                }
            });
        }
    });
</script>