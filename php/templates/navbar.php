<?php
// php/templates/navbar.php
// expectativas: session started, $_SESSION['user_id'], $_SESSION['username'], $CURRENT_SECTION (opcional)
require_once __DIR__ . '/../classes/Permissions.php';
if (session_status() === PHP_SESSION_NONE) session_start();

$userId = $_SESSION['user_id'] ?? null;
$username = $_SESSION['username'] ?? 'Usuário';
$perm = new Permissions();
$userPerms = $userId ? $perm->getUserPermissionCodes($userId) : [];
function can(array $userPerms, $code) { return in_array($code, $userPerms, true); }
function is_active($section, $match) {
    if (is_array($match)) return in_array($section, $match, true);
    return $section === $match;
}

$section = $CURRENT_SECTION ?? basename($_SERVER['SCRIPT_NAME']);

$menuItems = [
    ['label'=>'Home','link'=>'home.php','perm'=>'home.view','section'=>'home.php'],
    ['label'=>'Cadastros','link'=>'#','perm'=>'cadastros.view','section'=>'cadastros', 'dropdown'=>[
        ['label'=>'Clientes','link'=>'cadastros/clientes.php','perm'=>'cadastros.view','section'=>'clientes.php'],
        ['label'=>'Produtos','link'=>'cadastros/produtos.php','perm'=>'cadastros.view','section'=>'produtos.php'],
    ]],
    ['label'=>'Cardápio','link'=>'cardapio.php','perm'=>'cardapio.view','section'=>'cardapio.php'],
    ['label'=>'Estações','link'=>'estacoes.php','perm'=>'estacoes.view','section'=>'estacoes.php'],
    ['label'=>'Estoque','link'=>'estoque.php','perm'=>'estoque.view','section'=>'estoque.php'],
    ['label'=>'Faturamento','link'=>'faturamento.php','perm'=>'faturamento.view','section'=>'faturamento.php'],
    ['label'=>'Relatórios','link'=>'relatorios.php','perm'=>'relatorios.view','section'=>'relatorios.php'],
];
?>

<!-- PRIMEIRA LINHA: brand (left) + user block (right) -->
<nav class="navbar topbar" aria-label="Top bar">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <a class="brand" href="home.php">GastroSync</a>

    <div class="d-flex align-items-center user-block">
      <div class="me-3 text-end user-name">
        <small class="text-white">Olá, <strong><?= htmlspecialchars($username) ?></strong></small><br>
        <!-- <strong class="text-white"></strong> -->
      </div>
      <div class="me-2 avatar">
        <!-- circle avatar placeholder -->
        <span class="avatar-circle" id="userConfigBtn" data-bs-toggle="modal" data-bs-target="#userConfigModal"><?= strtoupper(substr($username,0,1)) ?></span>
      </div>
      <a class="btn btn-sm btn-secondary logout-btn" href="php/logout.php">Sair</a>
    </div>
  </div>
</nav>

<!-- SEGUNDA LINHA: menu -->
<nav class="navbar secondarybar navbar-expand-lg" aria-label="Main navigation">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
      aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 menu-line">
        <?php foreach($menuItems as $item):
            if (!in_array($item['perm'], $userPerms, true)) continue;
            $active = is_active($section, $item['section']) ? 'active' : '';
            if (isset($item['dropdown'])): ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= $active ?>" href="#" id="drop<?=htmlspecialchars($item['label'])?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <?=htmlspecialchars($item['label'])?>
                </a>
                <ul class="dropdown-menu">
                  <?php foreach($item['dropdown'] as $sub):
                      if (!in_array($sub['perm'], $userPerms, true)) continue;
                      $subActive = is_active($section, $sub['section']) ? 'selected' : '';
                  ?>
                    <li><a class="dropdown-item <?= $subActive ?>" href="<?=htmlspecialchars($sub['link'])?>"><?=htmlspecialchars($sub['label'])?></a></li>
                  <?php endforeach; ?>
                </ul>
              </li>
            <?php else: ?>
              <li class="nav-item">
                <a class="nav-link <?= $active ?>" href="<?=htmlspecialchars($item['link'])?>"><?=htmlspecialchars($item['label'])?></a>
              </li>
            <?php endif;
        endforeach; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- User config modal -->
<div class="modal fade" id="userConfigModal" tabindex="-1" aria-labelledby="userConfigModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="userConfigForm" action="php/user_update.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="userConfigModalLabel">Configuração de usuário</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Usuário</label>
            <input type="text" class="form-control" name="login" value="<?=htmlspecialchars($username)?>" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Nova senha</label>
            <input type="password" class="form-control" name="new_password" placeholder="Deixe vazio para manter">
          </div>
          <div class="form-text">Aqui você pode alterar sua senha.</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>
