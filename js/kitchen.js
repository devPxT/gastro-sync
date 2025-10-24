  $(function(){
    function updateTimerFor(card) {
      const deadline = new Date(card.data('deadline'));
      const now = new Date();
      const diffMs = deadline - now;
      const $timer = card.find('.timer');
      if (diffMs >= 0) {
        // remaining
        const m = Math.floor(diffMs / 60000);
        const s = Math.floor((diffMs % 60000) / 1000);
        $timer.text(`${m}m ${s}s`);
        $timer.removeClass('text-danger').addClass('text-success');
      } else {
        // overdue
        const overdue = Math.abs(diffMs);
        const m = Math.floor(overdue / 60000);
        const s = Math.floor((overdue % 60000) / 1000);
        $timer.text(`ATRASADO ${m}m ${s}s`);
        $timer.removeClass('text-success').addClass('text-danger');
      }
    }

    // initial timers
    $('.kitchen-card').each(function(){
      updateTimerFor($(this));
    });

    // refresh timers every second
    setInterval(function(){
      $('.kitchen-card').each(function(){ updateTimerFor($(this)); });
    }, 1000);

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

    // mark ready via AJAX
    $(document).on('click', '.mark-ready', function(){
      const orderId = $(this).data('order-id');
      if (!confirm('Marcar pedido #' + orderId + ' como PRONTO?')) return;
      const $btn = $(this);
      $btn.prop('disabled', true).text('Processando...');
      $.post('php/kitchen_action.php', { order_id: orderId, action: 'ready' }, function(resp){
        if (resp && resp.ok) {
          showAlert(resp.msg || 'Marcado como pronto');
          // fade/mark card as ready, then remove after 2s
          const $card = $('#order-card-' + orderId);
          $card.addClass('ready');
          $btn.text('Pronto').prop('disabled', true);
          setTimeout(()=> $card.fadeOut(400, ()=> $card.remove()), 1500);
        } else {
          showAlert(resp && resp.msg ? resp.msg : 'Falha ao marcar pronto');
          $btn.prop('disabled', false).text('Marcar como pronto');
        }
      }, 'json').fail(function(){
        showAlert('Erro de rede ao marcar pronto.');
        $btn.prop('disabled', false).text('Marcar como pronto');
      });
    });

    // manual refresh button
    $('#refreshBtn').on('click', function(){ location.reload(); });
    $(document).on('click', '.btn-refresh-order', function(){ location.reload(); });
  });