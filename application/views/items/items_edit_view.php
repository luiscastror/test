<?php 
    $name = array(
        'name' => 'name',
        'id' => 'name',
        'class' => 'form-control mb-3',
        'placeholder' => 'Nombre del producto',
        'value' => set_value('name', isset($item['name']) ? $item['name'] : ''),
        'required' => 'required',
        'type' => 'text'
    );
    
    $description = array(
        'name' => 'description',
        'id' => 'description',
        'class' => 'form-control mb-3',
        'placeholder' => 'Descripción del producto',
        'value' => set_value('description', isset($item['description']) ? $item['description'] : ''),
        'rows' => '4'
    );
    
    $price = array(
        'name' => 'price',
        'id' => 'price',
        'class' => 'form-control mb-3',
        'placeholder' => '0.00',
        'value' => set_value('price', isset($item['price']) ? $item['price'] : ''),
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
        'value' => set_value('stock', isset($item['stock']) ? $item['stock'] : ''),
        'required' => 'required',
        'type' => 'number',
        'min' => '0'
    );
    
    $current_category = isset($item['category_id']) ? $item['category_id'] : '';
?>

<main class="flex-grow-1 mt-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-0">Editar Producto</h1>
                <p class="text-muted">Modificar información del producto</p>
            </div>
            <div class="col-lg-8 mt-3">
                <div class="card shadow mb-3">
                    <div class="card-body">
                        <?php echo form_open('items/update/' . $item['id']); ?>
                        
                        <?php echo form_hidden('id', $item['id']); ?>
                        
                        <div class="mb-3">
                            <?php echo form_label('Nombre del Producto', 'name', array('class' => 'form-label')); ?>
                            <?php echo form_input($name); ?>
                        </div>

                        <div class="mb-3">
                            <?php echo form_label('Descripción', 'description', array('class' => 'form-label')); ?>
                            <?php echo form_textarea($description); ?>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <?php echo form_label('Precio', 'price', array('class' => 'form-label')); ?>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <?php echo form_input($price); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <?php echo form_label('Stock', 'stock', array('class' => 'form-label')); ?>
                                    <?php echo form_input($stock); ?>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <?php echo form_label('Categoría', 'category_id', array('class' => 'form-label')); ?>
                            <?php 
                                $category_options = array('' => 'Selecciona una categoría');
                                foreach($categories as $category) {
                                    $category_options[$category['id']] = $category['name'];
                                }
                            ?>
                            <?php echo form_dropdown('category_id', $category_options, $current_category, 'class="form-select mb-3" required'); ?>
                        </div>

                        <div class="d-grid gap-2">
                            <?php echo form_submit('submit', 'Actualizar Producto', 'class="btn btn-primary"'); ?>
                            <a href="<?php echo base_url('items'); ?>" class="btn btn-secondary">Cancelar</a>
                        </div>
                        
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
