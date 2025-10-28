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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Lista de Productos</h5>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control form-control-sm" placeholder="Buscar productos..." style="width: 200px;">
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
</script>
