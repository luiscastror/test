<?php 
    $name = array(
        'name' => 'name',
        'id' => 'name',
        'class' => 'form-control mb-3',
        'placeholder' => 'Nombre del producto',
        'value' => set_value('name'),
        'required' => 'required',
        'type' => 'text'
    );
    $description = array(
        'name' => 'description',
        'id' => 'description',
        'class' => 'form-control mb-3',
        'placeholder' => 'Descripción del producto',
        'value' => set_value('description'),
        'rows' => '3'
    );
    $price = array(
        'name' => 'price',
        'id' => 'price',
        'class' => 'form-control mb-3',
        'placeholder' => '0.00',
        'value' => set_value('price'),
        'required' => 'required',
        'type' => 'number',
        'step' => '0.01',
        'min' => '0'
    );
    $stock = array(
        'name' => 'stock',
        'id' => 'stock',
        'class' => 'form-control mb-3',
        'placeholder' => '0',
        'value' => set_value('stock'),
        'required' => 'required',
        'type' => 'number',
        'min' => '0'
    );
?>
<main class="flex-grow-1">
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h3 mb-0">Gestión de Productos</h1>
                <p class="text-muted">Administra los productos del inventario</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div></div>
                    <a href="items/add" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar Producto
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Lista de Productos</h5>
                            <small class="text-muted">
                                Total: <?php echo $total_items; ?> producto(s) 
                                <?php if (!empty($search_term)): ?>
                                    | Búsqueda: "<?php echo htmlspecialchars($search_term); ?>"
                                <?php endif; ?>
                            </small>
                        </div>
                        
                        <!-- Controles de búsqueda y paginación -->
                        <div class="row g-2">
                            <div class="col-md-6">
                                <form method="GET" action="<?php echo base_url('items/index'); ?>" class="d-flex gap-2">
                                    <input type="text" name="search" class="form-control form-control-sm" 
                                           placeholder="Buscar por nombre, descripción o categoría..." 
                                           value="<?php echo htmlspecialchars($search_term); ?>">
                                    <input type="hidden" name="per_page" value="<?php echo $per_page; ?>">
                                    <button type="submit" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <?php if (!empty($search_term)): ?>
                                        <a href="<?php echo base_url('items/index' . ($per_page != 5 ? '?per_page=' . $per_page : '')); ?>" 
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
                                        <th>Producto</th>
                                        <th>Categoría</th>
                                        <th>Precio</th>
                                        <th>Stock</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['id']; ?></td>    
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                                    <?php echo strtoupper($item['name'][0]); ?>
                                                </div>
                                                <div>
                                                    <div class="fw-bold"><?php echo $item['name']; ?></div>
                                                    <small class="text-muted"><?php echo substr($item['description'], 0, 30) . '...'; ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary"><?php echo isset($item['category_name']) ? $item['category_name'] : 'Sin categoría'; ?></span>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-success">$<?php echo number_format($item['price'], 2); ?></span>
                                        </td>
                                        <td>
                                            <?php if($item['stock'] > 10): ?>
                                                <span class="badge bg-success"><?php echo $item['stock']; ?></span>
                                            <?php elseif($item['stock'] > 0): ?>
                                                <span class="badge bg-warning"><?php echo $item['stock']; ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Agotado</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($item['stock'] > 0): ?>
                                                <span class="badge bg-success">Disponible</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Agotado</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a class="btn btn-outline-primary" title="Editar" href="items/edit/<?php echo $item['id']; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-outline-danger" title="Eliminar" onclick="delete_item(<?php echo $item['id']; ?>)">
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
                        <?php if (!empty($items)): ?>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">
                                        Mostrando <?php echo count($items); ?> de <?php echo $total_items; ?> productos
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
                                <h5>No se encontraron productos</h5>
                                <?php if (!empty($search_term)): ?>
                                    <p>No hay resultados para: "<strong><?php echo htmlspecialchars($search_term); ?></strong>"</p>
                                    <a href="<?php echo base_url('items/index' . ($per_page != 5 ? '?per_page=' . $per_page : '')); ?>" class="btn btn-outline-primary">
                                        <i class="fas fa-arrow-left"></i> Ver todos los productos
                                    </a>
                                <?php else: ?>
                                    <p>Aún no hay productos creados.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function delete_item(id) {
        if (confirm('¿Estás seguro de eliminar este producto?')) {
            window.location.href = 'items/delete/' + id;
        }
    }

    function changePerPage(perPage) {
        var currentUrl = new URL(window.location);
        var search = currentUrl.searchParams.get('search');
        
        // Construir nueva URL con segmentos URI
        var newUrl = '/test/items/index';
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
