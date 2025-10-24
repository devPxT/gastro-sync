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

  /**
   * Formata quantidade (pt-BR):
   *  - maxDecimals: casas decimais máximas (default 3)
   *  - remove zeros finais: 20.000 -> "20", 5.500 -> "5,5"
   *  - retorna string com vírgula decimal
   */
  function formatQuantity(value, maxDecimals = 3) {
    const n = parseFloat(value);
    if (!isFinite(n)) return value === null || value === undefined ? '-' : String(value);

    // fixa maxDecimals para manipular trailing zeros
    let s = n.toFixed(maxDecimals);

    // remove zeros à direita após o decimal (ex: 5.500 -> 5.5 ; 20.000 -> 20)
    s = s.replace(/(\.\d*?[1-9])0+$/, '$1'); // remove zeros à direita mantendo decimais se existirem
    s = s.replace(/\.0+$/, '');               // remove .000

    // trocar ponto por vírgula para pt-BR
    s = s.replace('.', ',');

    return s;
  }

  /**
   * Formata valor monetário em pt-BR (R$ 0,00)
   */
  function formatMoneyBR(value) {
    const n = parseFloat(value);
    if (!isFinite(n)) return 'R$ 0,00';
    return n.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  }

  // util: zero pad
  function pad(n){ return n < 10 ? '0'+n : String(n); }

  /**
   * Converte "2025-10-22 23:05:23" ou ISO para "22/10/2025 23:05"
   * Retorna '-' para valores falsy.
   */
  function formatDateTime(value) {
    if (!value) return '-';

    // aceita "YYYY-MM-DD HH:MM:SS" ou "YYYY-MM-DDTHH:MM:SS" etc.
    const m = value.toString().match(/^(\d{4})-(\d{2})-(\d{2})[ T](\d{2}):(\d{2})(?::(\d{2}))?/);
    if (m) {
      const year  = parseInt(m[1], 10);
      const month = parseInt(m[2], 10) - 1; // Date month 0-based
      const day   = parseInt(m[3], 10);
      const hour  = parseInt(m[4], 10);
      const minute= parseInt(m[5], 10);
      // const second = m[6] ? parseInt(m[6],10) : 0;
      const d = new Date(year, month, day, hour, minute);
      // montar string no formato DD/MM/YYYY HH:MM
      return pad(d.getDate()) + '/' + pad(d.getMonth()+1) + '/' + d.getFullYear() + ' ' + pad(d.getHours()) + ':' + pad(d.getMinutes());
    }

    // fallback: tenta criar Date a partir do valor e formatar (se parse falhar, retorna value cru)
    const parsed = new Date(value);
    if (!isNaN(parsed)) {
      return pad(parsed.getDate()) + '/' + pad(parsed.getMonth()+1) + '/' + parsed.getFullYear() + ' ' + pad(parsed.getHours()) + ':' + pad(parsed.getMinutes());
    }

    return String(value);
  }

  function loadStock(){
    $.getJSON('php/stock_api.php?action=list', function(resp){
      if (!resp.ok) return $('#stockAlert').html('<div class="alert alert-danger">Erro ao carregar estoque</div>');
      $tableBody.empty();
      resp.data.forEach(function(row){
        const tr = $('<tr>');
        tr.append('<td>'+escapeHtml(row.name)+'</td>');
        tr.append('<td>'+ escapeHtml(formatQuantity(row.quantity, 3)) +'</td>');
        tr.append('<td>'+escapeHtml(row.unit || '-')+'</td>');
        tr.append('<td>'+ escapeHtml(formatQuantity(row.threshold, 3)) +'</td>');
        tr.append('<td>R$ '+ escapeHtml(formatMoneyBR(row.unit_price||0)) +'</td>');
        tr.append('<td>'+ escapeHtml(formatDateTime(row.updated_at)) +'</td>');
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
