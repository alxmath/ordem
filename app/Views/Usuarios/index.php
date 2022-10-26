<?= $this->extend('Layout/principal') ?>

<?= $this->section('titulo') ?>
<?php echo $titulo ?>
<?= $this->endsection() ?>

<?= $this->section('estilos') ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.css" />
<?= $this->endsection() ?>

<?= $this->section('conteudo') ?>
<div class="row">
  <div class="col-lg-12">
    <div class="block">
      <div class="table-responsive">
        <table id='ajaxTable' class="table table-striped table-sm" style='width:100%;'>
          <thead>
            <tr>
              <th>Imagem</th>
              <th>Nome</th>
              <th>E-mail</th>
              <th>Situação</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
<?= $this->endsection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<?= $this->endsection() ?>