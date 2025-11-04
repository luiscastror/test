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
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Lista de Categorías</h5>
                            <small class="text-muted">
                                Total: <?php echo $total_categories; ?> categoría(s) 
                                <?php if (!empty($search_term)): ?>
                                    | Búsqueda: "<?php echo htmlspecialchars($search_term); ?>"
                                <?php endif; ?>
                            </small>
                        </div>
                        
                        <!-- Controles de búsqueda y paginación -->
                        <div class="row g-2">
                            <div class="col-md-6">
                                <?php echo form_open('categories/index', array('method' => 'GET', 'class' => 'd-flex gap-2')); ?>
                                    <input type="text" name="search" class="form-control form-control-sm" 
                                           placeholder="Buscar por nombre o descripción..." 
                                           value="<?php echo htmlspecialchars($search_term); ?>">
                                    <input type="hidden" name="per_page" value="<?php echo $per_page; ?>">
                                    <button type="submit" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <?php if (!empty($search_term)): ?>
                                        <a href="<?php echo base_url('categories/index' . ($per_page != 5 ? '?per_page=' . $per_page : '')); ?>" 
                                           class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    <?php endif; ?>
                                <?php echo form_close(); ?>
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
                                        <th>Descripción</th>
                                        <th>Productos</th>
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
                                        <td>
                                            <?php if ($category['products_count'] > 0): ?>
                                                <span class="badge bg-info"><?php echo $category['products_count']; ?> producto(s)</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Sin productos</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo isset($category['created_at']) ? $category['created_at'] : 'N/A'; ?></td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a class="btn btn-outline-primary" title="Editar" href="categories/edit/<?php echo $category['id']; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <?php if ($category['has_products']): ?>
                                                    <button class="btn btn-outline-danger" title="No se puede eliminar: tiene productos asociados" disabled>
                                                        <i class="fas fa-ban"></i>
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn btn-outline-danger" title="Eliminar" onclick="delete_category(<?php echo $category['id']; ?>)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Footer con información de paginación -->
                        <?php if (!empty($categories)): ?>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">
                                        Mostrando <?php echo count($categories); ?> de <?php echo $total_categories; ?> categorías
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
                                <h5>No se encontraron categorías</h5>
                                <?php if (!empty($search_term)): ?>
                                    <p>No hay resultados para: "<strong><?php echo htmlspecialchars($search_term); ?></strong>"</p>
                                    <a href="<?php echo base_url('categories/index' . ($per_page != 5 ? '?per_page=' . $per_page : '')); ?>" class="btn btn-outline-primary">
                                        <i class="fas fa-arrow-left"></i> Ver todas las categorías
                                    </a>
                                <?php else: ?>
                                    <p>Aún no hay categorías creadas.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
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

    function changePerPage(perPage) {
        var currentUrl = new URL(window.location);
        var search = currentUrl.searchParams.get('search');
        
        // Construir nueva URL con segmentos URI
        var newUrl = '/test/categories/index';
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