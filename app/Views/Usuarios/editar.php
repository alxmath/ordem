<?= $this->extend('Layout/principal') ?>

<?= $this->section('titulo') ?>
<?php echo $titulo ?>
<?= $this->endsection() ?>

<?= $this->section('estilos') ?>
<!-- Aqui coloco os estilos da view -->
<?= $this->endsection() ?>

<?= $this->section('conteudo') ?>

<div class="row">
  <div class="col-lg-6">
    <div class="block">

      <div class="block-body">

        <!-- Exibirá os retornos do backend -->
        <div id="response">

        </div>

        <?php echo form_open('/', ['id' => 'form'], ['id' => "$usuario->id"]) ?>

        <?php echo $this->include('Usuarios/_form'); ?>

        <div class="form-group mt-5 mb-2">
          <input type="submit" id="btn-salvar" value="Salvar" class="btn btn-danger mr-2">
          <a href="<?php echo site_url("usuarios/exibir/$usuario->id") ?>" class="btn btn-secondary ml-2">Voltar</a>
        </div>

        <?php echo form_close(); ?>

      </div>
    </div>


  </div>
</div>

<?= $this->endsection() ?>

<?= $this->section('scripts') ?>
<!-- Aqui coloco os scripts da view -->
<?= $this->endsection() ?>