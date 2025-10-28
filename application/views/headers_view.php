<!DOCTYPE html>
<html lang="es">
<head>
  <title>Sistema</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex flex-column min-vh-100 bg-secondary-subtle">

<?php if($this->session->flashdata('error')): ?>
  <div class="alert alert-danger alert-dismissible rounded-0 mb-0">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong><?php echo $this->session->flashdata('error'); ?></strong> 
  </div>
<?php endif; ?>

<?php if($this->session->flashdata('success')): ?>
  <div class="alert alert-success alert-dismissible rounded-0 mb-0">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong><?php echo $this->session->flashdata('success'); ?></strong> 
  </div>
<?php endif; ?>