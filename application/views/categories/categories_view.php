<?php 
    $name = array(
        'name' => 'name',
        'id' => 'name',
        'class' => 'form-control mb-3',
        'placeholder' => 'Nombre de la categoría',
        'value' => set_value('name'),
        'required' => 'required',
        'type' => 'text'
    );
    $description = array(
        'name' => 'description',
        'id' => 'description',
        'class' => 'form-control mb-3',
        'placeholder' => 'Descripción de la categoría',
        'value' => set_value('description'),
        'rows' => '3'
    );
?>
<main class="flex-grow-1">
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h3 mb-0">Gestión de Categorías</h1>
                <p class="text-muted">Administra las categorías de productos</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Lista de Categorías</h5>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control form-control-sm" placeholder="Buscar categorías..." style="width: 200px;">
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
                                        <th>Descripción</th>
                                        <th>Fecha Creación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as $category) { ?>
                                    <tr>
                                        <td><?php echo $category['id']; ?></td>    
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                                    <?php echo strtoupper($category['name'][0]); ?>
                                                </div>
                                                <?php echo $category['name']; ?>
                                            </div>
                                        </td>
                                        <td><?php echo substr($category['description'], 0, 50) . '...'; ?></td>
                                        <td><?php echo isset($category['createdAt']) ? $category['createdAt'] : 'N/A'; ?></td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a class="btn btn-outline-primary" title="Editar" href="categories/edit/<?php echo $category['id']; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-outline-danger" title="Eliminar" onclick="delete_category(<?php echo $category['id']; ?>)">
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
                </div>
            </div>
            
            <?php if($this->session->userdata('user_role') == 'admin') { ?>
            <div class="col-lg-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="mb-0">
                            Crear Nueva Categoría
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php echo form_open('categories/create'); ?>
                            <?php echo form_label('Nombre'); ?>
                            <?php echo form_input($name); ?>

                            <?php echo form_label('Descripción'); ?>
                            <?php echo form_textarea($description); ?>

                            <?php echo form_submit('submit', 'Crear Categoría', 'class="btn btn-success w-100 my-3"'); ?>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</main>

<script>
    function delete_category(id) {
        if (confirm('¿Estás seguro de eliminar esta categoría?')) {
            window.location.href = 'categories/delete/' + id;
        }
    }
</script>