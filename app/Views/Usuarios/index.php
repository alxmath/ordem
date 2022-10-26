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

<script>
  $(document).ready(function() {

    const DATATABLE_PTBR = {
      "sEmptyTable": "Nenhum registro encontrado",
      "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
      "sInfoFiltered": "(Filtrados de _MAX_ registros)",
      "sInfoPostFix": "",
      "sInfoThousands": ".",
      "sLengthMenu": "_MENU_ resultados por página",
      "sLoadingRecords": "Carregando...",
      "sProcessing": "Processando...",
      "sZeroRecords": "Nenhum registro encontrado",
      "sSearch": "Pesquisar",
      "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
      },
      "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
      },
      "select": {
        "rows": {
          "_": "Selecionado %d linhas",
          "0": "Nenhuma linha selecionada",
          "1": "Selecionado 1 linha"
        }
      }
    }


    $('#ajaxTable').DataTable({
      "oLanguage":DATATABLE_PTBR,
      'ajax': '<?php echo site_url('usuarios/recuperausuarios'); ?>',
      'columns': [{
          'data': 'imagem'
        },
        {
          'data': 'nome'
        },
        {
          'data': 'email'
        },
        {
          'data': 'ativo'
        },
      ],
      "deferRender": true,
      "processing": true,
      "responsive": true,
      "pagingType": $(window).width() < 768 ? "simple" : "simple_numbers",
    });
  });
</script>

<?= $this->endsection() ?>