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

  // util helpers (cole no topo do ficheiro, antes de loadReorders)
  function pad(n){ return n < 10 ? '0'+n : String(n); }

  function formatQuantity(value, maxDecimals = 3) {
    const n = parseFloat(value);
    if (!isFinite(n)) return value === null || value === undefined ? '-' : String(value);
    let s = n.toFixed(maxDecimals);
    s = s.replace(/(\.\d*?[1-9])0+$/, '$1'); // remove zeros à direita mantendo decimais se existirem
    s = s.replace(/\.0+$/, '');               // remove .000
    s = s.replace('.', ',');                  // ponto -> vírgula PT-BR
    return s;
  }

  function formatMoneyBR(value) {
    const n = parseFloat(value);
    if (!isFinite(n)) return '-';
    return n.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  }

  /**
   * Converte "YYYY-MM-DD HH:MM:SS" ou ISO para "DD/MM/YYYY HH:MM"
   * Retorna '-' para valores falsy.
   */
  function formatDateTime(value) {
    if (!value) return '-';
    const s = value.toString();
    const m = s.match(/^(\d{4})-(\d{2})-(\d{2})[ T](\d{2}):(\d{2})(?::(\d{2}))?/);
    if (m) {
      const year  = parseInt(m[1], 10);
      const month = parseInt(m[2], 10) - 1;
      const day   = parseInt(m[3], 10);
      const hour  = parseInt(m[4], 10);
      const minute= parseInt(m[5], 10);
      const d = new Date(year, month, day, hour, minute);
      return pad(d.getDate()) + '/' + pad(d.getMonth()+1) + '/' + d.getFullYear() + ' ' + pad(d.getHours()) + ':' + pad(d.getMinutes());
    }
    const parsed = new Date(value);
    if (!isNaN(parsed)) {
      return pad(parsed.getDate()) + '/' + pad(parsed.getMonth()+1) + '/' + parsed.getFullYear() + ' ' + pad(parsed.getHours()) + ':' + pad(parsed.getMinutes());
    }
    return String(value);
  }

  // função loadReorders atualizada
  function loadReorders(){
    $.getJSON('php/reorder_api.php?action=list', function(resp){
      if (!resp.ok) return $tbl.html('<tr><td colspan="8">Erro ao carregar</td></tr>');
      $tbl.empty();
      resp.data.forEach(function(r){
        // quantity formatado (se existir unidade, pode concatenar)
        const qtyText = formatQuantity(r.quantity, 3) + (r.unit ? ' ' + escapeHtml(r.unit) : '');

        // estimated total formatado
        const est = r.estimated_total ? 'R$ ' + formatMoneyBR(r.estimated_total) : '-';

        // datas formatadas
        const createdAtText = formatDateTime(r.created_at);
        const receivedAtText = r.received_at ? formatDateTime(r.received_at) : '-';

        const statusLabel = r.status === 'requested' ? '<span class="badge bg-warning text-dark">Solicitado</span>'
                          : r.status === 'received'  ? '<span class="badge bg-success">Recebido</span>'
                          : '<span class="badge bg-secondary">'+ escapeHtml(r.status) +'</span>';

        const tr = $('<tr>');
        tr.append('<td>'+ escapeHtml(r.id) +'</td>');
        tr.append('<td>'+ escapeHtml(r.ingredient_name) +'</td>');
        tr.append('<td>'+ escapeHtml(qtyText) +'</td>');
        tr.append('<td>'+ escapeHtml(est) +'</td>');
        tr.append('<td>'+ statusLabel +'</td>');
        tr.append('<td>'+ escapeHtml(createdAtText) +'</td>');
        tr.append('<td>'+ escapeHtml(receivedAtText) +'</td>');

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
