<?php 
    $name = array(
        'name' => 'name',
        'id' => 'name',
        'class' => 'form-control mb-3',
        'placeholder' => 'Nombre de la categoría',
        'value' => set_value('name', isset($category['name']) ? $category['name'] : ''),
        'required' => 'required',
        'type' => 'text'
    );
    
    $description = array(
        'name' => 'description',
        'id' => 'description',
        'class' => 'form-control mb-3',
        'placeholder' => 'Descripción de la categoría',
        'value' => set_value('description', isset($category['description']) ? $category['description'] : ''),
        'rows' => '3'
    );
?>

<main class="flex-grow-1 mt-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-0">Editar Categoría</h1>
                <p class="text-muted">Editar categoría de productos</p>
            </div>
            <div class="col-lg-8 mt-3">
                <div class="card shadow mb-3">
                    <div class="card-body">
                        <?php echo form_open('categories/update/' . $category['id']); ?>
                        
                        <?php echo form_hidden('id', $category['id']); ?>
                        
                        <div class="mb-3">
                            <?php echo form_label('Nombre', 'name', array('class' => 'form-label')); ?>
                            <?php echo form_input($name); ?>
                        </div>

                        <div class="mb-3">
                            <?php echo form_label('Descripción', 'description', array('class' => 'form-label')); ?>
                            <?php echo form_textarea($description); ?>
                        </div>

                        <div class="d-grid gap-2">
                            <?php echo form_submit('submit', 'Actualizar Categoría', 'class="btn btn-success"'); ?>
                            <a href="<?php echo base_url('categories'); ?>" class="btn btn-secondary">Cancelar</a>
                        </div>
                        
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>