<?= $this->extend('Layout/principal') ?>

<?= $this->section('titulo') ?>
  <?php echo $titulo ?>
<?= $this->endsection() ?>

<?= $this->section('estilos') ?>
  <!-- Aqui coloco os estilos da view -->
<?= $this->endsection() ?>

<?= $this->section('conteudo') ?>
  <!-- Aqui coloco os conteudo da view -->
<?= $this->endsection() ?>

<?= $this->section('scripts') ?>
  <!-- Aqui coloco os scripts da view -->
<?= $this->endsection() ?>