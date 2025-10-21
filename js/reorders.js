// js/reorders.js
$(function(){
  const $tbl = $('#reorderTable tbody');
  const reorderModal = new bootstrap.Modal(document.getElementById('reorderModal'));
  const markModal = new bootstrap.Modal(document.getElementById('markReceivedModal'));

  loadReorders();
  loadIngredientsSelect();

  $('#btnAddReorder').on('click', function(){
    $('#reorderForm')[0].reset();
    $('#reorder_id').val('');
    reorderModal.show();
  });

  $('#reorderForm').on('submit', function(e){
    e.preventDefault();
    $.post('php/reorder_api.php?action=add', $(this).serialize(), function(resp){
      if (resp && resp.ok) {
        showAlert('Recompra criada');
        reorderModal.hide();
        loadReorders();
      } else showAlert(resp && resp.msg ? resp.msg : 'Erro ao criar recompra');
    }, 'json').fail(()=> showAlert('Erro de rede'));
  });

  // mark received modal open
  $(document).on('click', '.btn-mark-received', function(){
    const id = $(this).data('id');
    $('#mark_reorder_id').val(id);
    $('#mark_received_qty').val('');
    $('#mark_note').val('');
    markModal.show();
  });

  $('#markReceivedForm').on('submit', function(e){
    e.preventDefault();
    const data = $(this).serialize();
    $.post('php/reorder_api.php?action=mark_received', data, function(resp){
      if (resp && resp.ok) {
        showAlert('Recebido e estoque atualizado');
        markModal.hide();
        loadReorders();
      } else showAlert(resp && resp.msg ? resp.msg : 'Erro ao marcar recebido');
    }, 'json').fail(()=> showAlert('Erro de rede'));
  });

  // delete reorder
  $(document).on('click', '.btn-delete-reorder', function(){
    const id = $(this).data('id');
    if (!confirm('Remover recompra?')) return;
    $.post('php/reorder_api.php?action=delete', {id:id}, function(resp){
      if (resp && resp.ok) {
        showAlert('Removido');
        loadReorders();
      } else showAlert(resp && resp.msg ? resp.msg : 'Erro ao remover');
    }, 'json').fail(()=> showAlert('Erro de rede'));
  });

  function loadReorders(){
    $.getJSON('php/reorder_api.php?action=list', function(resp){
      if (!resp.ok) return $tbl.html('<tr><td colspan="8">Erro ao carregar</td></tr>');
      $tbl.empty();
      resp.data.forEach(function(r){
        const est = r.estimated_total ? 'R$ ' + Number(r.estimated_total).toFixed(2) : '-';
        const receivedAt = r.received_at ? r.received_at : '-';
        const statusLabel = r.status === 'requested' ? '<span class="badge bg-warning text-dark">Solicitado</span>'
                          : r.status === 'received' ? '<span class="badge bg-success">Recebido</span>'
                          : '<span class="badge bg-secondary">'+r.status+'</span>';
        const tr = $('<tr>');
        tr.append('<td>'+r.id+'</td>');
        tr.append('<td>'+escapeHtml(r.ingredient_name)+'</td>');
        tr.append('<td>'+Number(r.quantity).toFixed(3)+'</td>');
        tr.append('<td>'+est+'</td>');
        tr.append('<td>'+statusLabel+'</td>');
        tr.append('<td>'+r.created_at+'</td>');
        tr.append('<td>'+receivedAt+'</td>');
        let actions = '';
        if (r.status !== 'received') {
          actions += '<button class="btn btn-sm btn-success btn-mark-received me-1" data-id="'+r.id+'">Recebido</button>';
        }
        actions += '<button class="btn btn-sm btn-danger btn-delete-reorder" data-id="'+r.id+'">Remover</button>';
        tr.append('<td>'+actions+'</td>');
        $tbl.append(tr);
      });
    }).fail(()=> $tbl.html('<tr><td colspan="8">Erro (network)</td></tr>'));
  }

  function loadIngredientsSelect(){
    $.getJSON('php/stock_api.php?action=list', function(resp){
      if (!resp.ok) return;
      const $sel = $('#reorder_ingredient').empty();
      resp.data.forEach(function(i){
        $sel.append('<option value="'+i.id+'">'+escapeHtml(i.name)+'</option>');
      });
    });
  }

  function escapeHtml(s){ return $('<div>').text(s).html(); }
});
