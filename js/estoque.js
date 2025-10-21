// js/estoque.js
$(function(){
  const $tableBody = $('#stockTable tbody');
  const $modal = new bootstrap.Modal(document.getElementById('ingredientModal'));
  loadStock();

  $('#btnAddIngredient').on('click', function(){
    $('#ingredientForm')[0].reset();
    $('#ing_id').val('');
    $('#ingredientModalLabel').text('Adicionar ingrediente');
    $modal.show();
  });

  // submit add/edit
  $('#ingredientForm').on('submit', function(e){
    e.preventDefault();
    const id = $('#ing_id').val();
    const data = $(this).serializeArray();
    const action = id ? 'edit' : 'add';
    $.post('php/stock_api.php?action=' + action, data, function(resp){
      if (resp && resp.ok) {
        showAlert('Salvo com sucesso!');
        $modal.hide();
        loadStock();
      } else {
        showAlert(resp && resp.msg ? resp.msg : 'Erro ao salvar');
      }
    }, 'json').fail(function(){ showAlert('Erro de rede'); });
  });

  // edit button click
  $(document).on('click', '.btn-edit-ingredient', function(){
    const id = $(this).data('id');
    // fetch single row from list (or call API)
    $.getJSON('php/stock_api.php?action=list', function(resp){
      if (!resp.ok) return showAlert('Erro ao carregar dados');
      const item = resp.data.find(i => parseInt(i.id) === parseInt(id));
      if (!item) return showAlert('Ingrediente não encontrado');
      $('#ing_id').val(item.id);
      $('#ing_name').val(item.name);
      $('#ing_quantity').val(item.quantity);
      $('#ing_threshold').val(item.threshold);
      $('#ing_unit').val(item.unit);
      $('#ing_unit_price').val(item.unit_price ?? 0);
      $('#ing_note').val(item.note ?? '');
      $('#ingredientModalLabel').text('Editar ingrediente');
      $modal.show();
    }).fail(()=> showAlert('Erro ao carregar ingrediente'));
  });

  // delete
  $(document).on('click', '.btn-delete-ingredient', function(){
    const id = $(this).data('id');
    if (!confirm('Remover ingrediente?')) return;
    $.post('php/stock_api.php?action=delete', {id:id}, function(resp){
      if (resp && resp.ok) {
        showAlert('Removido');
        loadStock();
      } else showAlert(resp && resp.msg ? resp.msg : 'Erro ao remover');
    }, 'json').fail(()=> showAlert('Erro de rede'));
  });

  function loadStock(){
    $.getJSON('php/stock_api.php?action=list', function(resp){
      if (!resp.ok) return $('#stockAlert').html('<div class="alert alert-danger">Erro ao carregar estoque</div>');
      $tableBody.empty();
      resp.data.forEach(function(row){
        const tr = $('<tr>');
        tr.append('<td>'+escapeHtml(row.name)+'</td>');
        tr.append('<td>'+Number(row.quantity).toFixed(3)+'</td>');
        tr.append('<td>'+escapeHtml(row.unit || '-')+'</td>');
        tr.append('<td>'+Number(row.threshold).toFixed(3)+'</td>');
        tr.append('<td>R$ '+Number(row.unit_price||0).toFixed(2)+'</td>');
        tr.append('<td>'+ (row.updated_at ?? '-') +'</td>');
        tr.append('<td>' +
          '<button class="btn btn-sm btn-secondary btn-edit-ingredient me-1" data-id="'+row.id+'">Editar</button>' +
          '<button class="btn btn-sm btn-danger btn-delete-ingredient" data-id="'+row.id+'">Remover</button>' +
          '</td>');
        $tableBody.append(tr);
      });
    }).fail(()=> $('#stockAlert').html('<div class="alert alert-danger">Erro ao carregar estoque (network)</div>'));
  }

  function escapeHtml(s){ return $('<div>').text(s).html(); }
});
