<main class="flex-grow-1">
    <div class="container py-4">
        <!-- Dashboard Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h3 mb-0">Dashboard</h1>
                <p class="text-muted">Resumen general del sistema</p>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Usuarios
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">1,245</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Productos
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">856</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Categorías
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">24</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tags fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Ventas Hoy
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$15,340</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Users Table -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Usuarios Recientes</h6>
                        <a href="<?php echo base_url('panel/users'); ?>" class="btn btn-sm btn-primary">Ver Todos</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Estado</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>001</td>
                                        <td>Juan Pérez</td>
                                        <td>juan@email.com</td>
                                        <td><span class="badge bg-success">Activo</span></td>
                                        <td>2025-10-27</td>
                                    </tr>
                                    <tr>
                                        <td>002</td>
                                        <td>María García</td>
                                        <td>maria@email.com</td>
                                        <td><span class="badge bg-success">Activo</span></td>
                                        <td>2025-10-26</td>
                                    </tr>
                                    <tr>
                                        <td>003</td>
                                        <td>Carlos López</td>
                                        <td>carlos@email.com</td>
                                        <td><span class="badge bg-warning">Pendiente</span></td>
                                        <td>2025-10-25</td>
                                    </tr>
                                    <tr>
                                        <td>004</td>
                                        <td>Ana Martínez</td>
                                        <td>ana@email.com</td>
                                        <td><span class="badge bg-success">Activo</span></td>
                                        <td>2025-10-24</td>
                                    </tr>
                                    <tr>
                                        <td>005</td>
                                        <td>Luis Rodríguez</td>
                                        <td>luis@email.com</td>
                                        <td><span class="badge bg-danger">Inactivo</span></td>
                                        <td>2025-10-23</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Table -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-success">Productos Populares</h6>
                        <a href="<?php echo base_url('panel/products'); ?>" class="btn btn-sm btn-success">Ver Todos</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Producto</th>
                                        <th>Categoría</th>
                                        <th>Precio</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>P001</td>
                                        <td>Laptop HP</td>
                                        <td>Electrónicos</td>
                                        <td>$899.99</td>
                                        <td><span class="badge bg-success">25</span></td>
                                    </tr>
                                    <tr>
                                        <td>P002</td>
                                        <td>Mouse Inalámbrico</td>
                                        <td>Accesorios</td>
                                        <td>$29.99</td>
                                        <td><span class="badge bg-success">150</span></td>
                                    </tr>
                                    <tr>
                                        <td>P003</td>
                                        <td>Teclado Mecánico</td>
                                        <td>Accesorios</td>
                                        <td>$79.99</td>
                                        <td><span class="badge bg-warning">5</span></td>
                                    </tr>
                                    <tr>
                                        <td>P004</td>
                                        <td>Monitor 24"</td>
                                        <td>Electrónicos</td>
                                        <td>$199.99</td>
                                        <td><span class="badge bg-success">12</span></td>
                                    </tr>
                                    <tr>
                                        <td>P005</td>
                                        <td>Webcam HD</td>
                                        <td>Accesorios</td>
                                        <td>$49.99</td>
                                        <td><span class="badge bg-danger">0</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories and Quick Actions Row -->
        <div class="row">
            <!-- Categories Summary -->
            <div class="col-lg-8 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-info">Resumen por Categorías</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card bg-primary text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6>Electrónicos</h6>
                                                <h4>342</h4>
                                                <small>productos</small>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="fas fa-laptop fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card bg-success text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6>Accesorios</h6>
                                                <h4>289</h4>
                                                <small>productos</small>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="fas fa-mouse fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card bg-warning text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6>Software</h6>
                                                <h4>125</h4>
                                                <small>productos</small>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="fas fa-code fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card bg-info text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6>Gaming</h6>
                                                <h4>78</h4>
                                                <small>productos</small>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="fas fa-gamepad fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card bg-secondary text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6>Oficina</h6>
                                                <h4>156</h4>
                                                <small>productos</small>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="fas fa-briefcase fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card bg-dark text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6>Otros</h6>
                                                <h4>45</h4>
                                                <small>productos</small>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="fas fa-ellipsis-h fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-dark">Acciones Rápidas</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="<?php echo base_url('panel/users/add'); ?>" class="btn btn-primary">
                                <i class="fas fa-user-plus me-2"></i>Agregar Usuario
                            </a>
                            <a href="<?php echo base_url('panel/products/add'); ?>" class="btn btn-success">
                                <i class="fas fa-plus me-2"></i>Agregar Producto
                            </a>
                            <a href="<?php echo base_url('panel/categories/add'); ?>" class="btn btn-info">
                                <i class="fas fa-tag me-2"></i>Agregar Categoría
                            </a>
                            <a href="<?php echo base_url('panel/reports'); ?>" class="btn btn-warning">
                                <i class="fas fa-chart-bar me-2"></i>Ver Reportes
                            </a>
                            <a href="<?php echo base_url('panel/settings'); ?>" class="btn btn-secondary">
                                <i class="fas fa-cog me-2"></i>Configuración
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>