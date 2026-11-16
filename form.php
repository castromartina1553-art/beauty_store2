<?php
include "inc/header.php";
include "conexion.php";
[$m, $mod] = modulo_actual();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$titulo_pagina = ($id ? 'Editar ' : 'Nuevo ') . $mod['titulo'];

$datos = [];
if ($id) {
    $st = $conexion->prepare("SELECT * FROM `$m` WHERE id = ?");
    $st->bind_param("i", $id); $st->execute();
    $datos = $st->get_result()->fetch_assoc();
    if (!$datos) { $_SESSION['msg'] = ['danger', 'El registro no existe.']; header("Location: listado.php?m=$m"); exit; }
}
?>
<h3 class="mb-3"><i class="<?= $mod['icono'] ?>"></i> <?= e($titulo_pagina) ?></h3>
<div class="card"><div class="card-body">
<form action="guardar.php" method="post">
  <input type="hidden" name="m" value="<?= $m ?>">
  <input type="hidden" name="id" value="<?= $id ?>">
  <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
  <div class="row">
  <?php foreach ($mod['campos'] as $campo => $c):
    $val = $datos[$campo] ?? ($c['tipo'] === 'date' ? date('Y-m-d') : '');
    $req = !empty($c['req']) ? 'required' : ''; ?>
    <div class="col-md-6 mb-3">
      <label class="form-label"><?= e($c['label']) ?><?= $req ? ' *' : '' ?></label>
      <?php switch ($c['tipo']):
        case 'textarea': ?>
          <textarea name="<?= $campo ?>" class="form-control" rows="3" <?= $req ?>><?= e($val) ?></textarea>
        <?php break;
        case 'select':
          $opts = $conexion->query("SELECT id, `{$c['fk']['label']}` AS l FROM `{$c['fk']['tabla']}` ORDER BY id"); ?>
          <select name="<?= $campo ?>" class="form-select" <?= $req ?>>
            <option value="">-- Seleccione --</option>
            <?php while ($o = $opts->fetch_assoc()): ?>
              <option value="<?= $o['id'] ?>" <?= ((string)$val === (string)$o['id']) ? 'selected' : '' ?>><?= e($o['l']) ?></option>
            <?php endwhile; ?>
          </select>
        <?php break;
        case 'enum': ?>
          <select name="<?= $campo ?>" class="form-select" <?= $req ?>>
            <?php foreach ($c['opciones'] as $op): ?>
              <option <?= $val === $op ? 'selected' : '' ?>><?= e($op) ?></option>
            <?php endforeach; ?>
          </select>
        <?php break;
        case 'password': ?>
          <input type="password" name="<?= $campo ?>" class="form-control" autocomplete="new-password"
                 <?= $id ? '' : $req ?> placeholder="<?= $id ? 'Dejar vacío para mantener la actual' : '' ?>">
        <?php break;
        default:
          $type = ['email'=>'email','number'=>'number','decimal'=>'number','date'=>'date'][$c['tipo']] ?? 'text';
          $step = $c['tipo'] === 'decimal' ? 'step="0.01" min="0"' : ($c['tipo'] === 'number' ? 'step="1" min="0"' : ''); ?>
          <input type="<?= $type ?>" <?= $step ?> name="<?= $campo ?>" class="form-control" value="<?= e($val) ?>" <?= $req ?>>
      <?php endswitch; ?>
    </div>
  <?php endforeach; ?>
  </div>
  <button class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
  <a href="listado.php?m=<?= $m ?>" class="btn btn-secondary">Cancelar</a>
</form>
</div></div>
<?php include "inc/footer.php"; ?>
