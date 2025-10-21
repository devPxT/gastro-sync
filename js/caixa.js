// js/caixa.js
$(function() {
  const cart = []; // {id,name,price,qty}

  function formatBRL(v) {
    return 'R$ ' + Number(v).toFixed(2).replace('.', ',');
  }

  function recalc() {
    let subtotal = 0;
    cart.forEach(i => { subtotal += i.price * i.qty; });
    $('#displaySubtotal').text(formatBRL(subtotal));

    const dtype = $('#discountType').val();
    let dval = parseFloat($('#discountValue').val() || 0);
    let discount = 0;
    if (dtype === 'percent') discount = subtotal * (dval / 100.0);
    else if (dtype === 'fixed') discount = dval;
    discount = Math.max(0, discount);
    $('#displayDiscount').text(formatBRL(discount));

    let total = Math.max(0, subtotal - discount);
    $('#displayTotal').text(formatBRL(total));

    // sync hidden: only send id and qty to server (server rebuilds price)
    const safeCart = cart.map(i => ({ id: i.id, qty: i.qty }));
    $('#cartJson').val(JSON.stringify(safeCart));
  }

  function renderCart() {
    const $body = $('#cartTable tbody').empty();
    cart.forEach((it, idx) => {
      const subtotal = (it.price * it.qty).toFixed(2);
      const $tr = $('<tr>');
      $tr.append(`<td>${it.name}</td>`);
      $tr.append(`<td>R$ ${Number(it.price).toFixed(2).replace('.',',')}</td>`);
      $tr.append(`<td><input type="number" min="1" class="form-control cart-qty" data-idx="${idx}" value="${it.qty}" style="width:90px;"></td>`);
      $tr.append(`<td>R$ ${Number(subtotal).toFixed(2).replace('.',',')}</td>`);
      $tr.append(`<td><button class="btn btn-sm btn-danger remove-item" data-idx="${idx}">&times;</button></td>`);
      $body.append($tr);
    });
    recalc();
  }

  $('#addItemBtn').on('click', function(e) {
    e.preventDefault();
    const sel = $('#menuSelect');
    const val = sel.val();
    if (!val) return;
    const name = sel.find('option:selected').data('name');
    const price = parseFloat(sel.find('option:selected').data('price'));
    const qty = Math.max(1, parseInt($('#menuQty').val() || 1));
    const exists = cart.find(i => i.id == val);
    if (exists) exists.qty += qty;
    else cart.push({id: parseInt(val), name: name, price: price, qty: qty});
    renderCart();
  });

  $(document).on('click', '.remove-item', function(){
    const idx = parseInt($(this).data('idx'));
    cart.splice(idx,1);
    renderCart();
  });

  $(document).on('change', '.cart-qty', function(){
    const idx = parseInt($(this).data('idx'));
    const v = Math.max(1, parseInt($(this).val()||1));
    cart[idx].qty = v;
    renderCart();
  });

  $('#discountType, #discountValue').on('change keyup', function() { 
    recalc(); 
 });

  $('#paymentMethod').on('change', function(){
    const method = $(this).val();
    $('.pay-block').hide();
    if (method === 'cash') $('#cashFields').show();
    if (method === 'card') $('#cardFields').show();
    if (method === 'pix') $('#pixFields').show();
  });

  $('#caixaForm').on('submit', function(e){
    if (cart.length === 0) {
      e.preventDefault();
      showAlert('Adicione ao menos 1 item ao pedido.');
      return false;
    }
    // total must be greater or equal zero (server will validate)
    // allow submit; server will verify prices & quantities
  });

  recalc();
});
