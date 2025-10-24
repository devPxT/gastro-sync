<?php
/**
 * templates/Home/index.php
 * @var \App\View\AppView $this
 * @var array $controllers
 */
?>
<style>
/* Pequenas regras locais para manter espacamento e evitar overflow */
.dashboard-grid .card {
  height: 100%;
  display: flex;
  flex-direction: column;
  border-radius: .5rem;
  box-shadow: 0 0.15rem 0.5rem rgba(0,0,0,0.06);
}
.dashboard-grid .card-body {
  display: flex;
  flex-direction: column;
  gap: .5rem;
  padding: 1rem;
}
.dashboard-grid .route-text {
  font-size: .85rem;
  color: #6c757d;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.dashboard-grid .card-title {
  margin-bottom: .25rem;
  font-weight: 600;
}
.dashboard-grid .btn-open {
  margin-top: auto; /* empurra o botao para baixo */
}
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container py-4">
  <div class="mb-4">
    <h1 class="h3 mb-1"><?= h($title ?? 'Painel') ?></h1>
    <p class="text-muted">Acesse as telas geradas automaticamente pelo Bake.</p>
  </div>

  <?php if (empty($controllers)): ?>
    <div class="alert alert-info">Nenhuma controller detectada em <code>src/Controller</code>.</div>
  <?php else: ?>
    <div class="row dashboard-grid gx-3 gy-4">
      <?php foreach ($controllers as $c):
        // url amigavel (ja gerada no controller Home) ou garantir fallback
        $url = $c['url'] ?? ('/' . strtolower(\Cake\Utility\Inflector::dasherize(\Cake\Utility\Inflector::underscore($c['name']))));
      ?>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="card h-100">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title"><?= h($c['label']) ?></h5>
              <div class="route-text mb-2" title="<?= h($url) ?>"><?= h($url) ?></div>
              <p class="text-muted small mb-3">Visualizar a listagem, adicionar e editar registros dessa área.</p>
              <?= $this->Html->link('Abrir', $url, ['class'=>'btn btn-primary btn-open w-100']) ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
