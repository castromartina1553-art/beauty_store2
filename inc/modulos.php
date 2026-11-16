<?php
// Configuración de los módulos CRUD. Cada módulo = una tabla de la base de datos.
// tipo: text | email | number | decimal | date | textarea | password | select (FK) | enum
$MODULOS = [
  'tipos_usuarios' => [
    'titulo' => 'Tipos de usuario', 'icono' => 'fas fa-id-badge', 'grupo' => 'Administración', 'solo_admin' => true,
    'campos' => [
      'nombre'      => ['label'=>'Nombre', 'tipo'=>'text', 'req'=>true],
      'descripcion' => ['label'=>'Descripción', 'tipo'=>'text'],
    ],
  ],
  'usuarios' => [
    'titulo' => 'Usuarios del sistema', 'icono' => 'fas fa-users', 'grupo' => 'Administración', 'solo_admin' => true,
    'campos' => [
      'nombre'          => ['label'=>'Nombre', 'tipo'=>'text', 'req'=>true],
      'email'           => ['label'=>'Email', 'tipo'=>'email', 'req'=>true],
      'telefono'        => ['label'=>'Teléfono', 'tipo'=>'text'],
      'usuario'         => ['label'=>'Usuario', 'tipo'=>'text', 'req'=>true],
      'clave'           => ['label'=>'Clave', 'tipo'=>'password', 'req'=>true],
      'tipo_usuario_id' => ['label'=>'Tipo de usuario', 'tipo'=>'select', 'req'=>true, 'fk'=>['tabla'=>'tipos_usuarios','label'=>'nombre']],
    ],
  ],
  'categorias' => [
    'titulo' => 'Categorías', 'icono' => 'fas fa-th-large', 'grupo' => 'Catálogo',
    'campos' => [
      'nombre'      => ['label'=>'Nombre', 'tipo'=>'text', 'req'=>true],
      'descripcion' => ['label'=>'Descripción', 'tipo'=>'text'],
    ],
  ],
  'marcas' => [
    'titulo' => 'Marcas', 'icono' => 'fas fa-tags', 'grupo' => 'Catálogo',
    'campos' => [
      'nombre' => ['label'=>'Nombre', 'tipo'=>'text', 'req'=>true],
      'pais'   => ['label'=>'País', 'tipo'=>'text'],
    ],
  ],
  'proveedores' => [
    'titulo' => 'Proveedores', 'icono' => 'fas fa-truck', 'grupo' => 'Catálogo',
    'campos' => [
      'nombre'    => ['label'=>'Nombre', 'tipo'=>'text', 'req'=>true],
      'email'     => ['label'=>'Email', 'tipo'=>'email'],
      'telefono'  => ['label'=>'Teléfono', 'tipo'=>'text'],
      'direccion' => ['label'=>'Dirección', 'tipo'=>'text'],
    ],
  ],
  'productos' => [
    'titulo' => 'Productos', 'icono' => 'fas fa-shopping-bag', 'grupo' => 'Catálogo',
    'campos' => [
      'nombre'       => ['label'=>'Nombre', 'tipo'=>'text', 'req'=>true],
      'descripcion'  => ['label'=>'Descripción', 'tipo'=>'textarea'],
      'precio'       => ['label'=>'Precio', 'tipo'=>'decimal', 'req'=>true],
      'stock'        => ['label'=>'Stock', 'tipo'=>'number', 'req'=>true],
      'categoria_id' => ['label'=>'Categoría', 'tipo'=>'select', 'req'=>true, 'fk'=>['tabla'=>'categorias','label'=>'nombre']],
      'marca_id'     => ['label'=>'Marca', 'tipo'=>'select', 'req'=>true, 'fk'=>['tabla'=>'marcas','label'=>'nombre']],
      'proveedor_id' => ['label'=>'Proveedor', 'tipo'=>'select', 'req'=>true, 'fk'=>['tabla'=>'proveedores','label'=>'nombre']],
    ],
  ],
  'clientes' => [
    'titulo' => 'Clientes', 'icono' => 'fas fa-user-friends', 'grupo' => 'Ventas',
    'campos' => [
      'nombre'    => ['label'=>'Nombre', 'tipo'=>'text', 'req'=>true],
      'email'     => ['label'=>'Email', 'tipo'=>'email'],
      'telefono'  => ['label'=>'Teléfono', 'tipo'=>'text'],
      'direccion' => ['label'=>'Dirección', 'tipo'=>'text'],
    ],
  ],
  'pedidos' => [
    'titulo' => 'Pedidos', 'icono' => 'fas fa-shopping-cart', 'grupo' => 'Ventas',
    'campos' => [
      'cliente_id' => ['label'=>'Cliente', 'tipo'=>'select', 'req'=>true, 'fk'=>['tabla'=>'clientes','label'=>'nombre']],
      'fecha'      => ['label'=>'Fecha', 'tipo'=>'date', 'req'=>true],
      'estado'     => ['label'=>'Estado', 'tipo'=>'enum', 'req'=>true, 'opciones'=>['Pendiente','Pagado','Enviado','Entregado','Cancelado']],
      'total'      => ['label'=>'Total', 'tipo'=>'decimal', 'req'=>true],
    ],
  ],
  'detalle_pedido' => [
    'titulo' => 'Detalle de pedidos', 'icono' => 'fas fa-list-alt', 'grupo' => 'Ventas',
    'campos' => [
      'pedido_id'       => ['label'=>'Pedido Nº', 'tipo'=>'select', 'req'=>true, 'fk'=>['tabla'=>'pedidos','label'=>'id']],
      'producto_id'     => ['label'=>'Producto', 'tipo'=>'select', 'req'=>true, 'fk'=>['tabla'=>'productos','label'=>'nombre']],
      'cantidad'        => ['label'=>'Cantidad', 'tipo'=>'number', 'req'=>true],
      'precio_unitario' => ['label'=>'Precio unitario', 'tipo'=>'decimal', 'req'=>true],
    ],
  ],
];

// Devuelve el módulo pedido por ?m= (o aborta). Controla permisos.
function modulo_actual() {
    global $MODULOS;
    $m = $_GET['m'] ?? $_POST['m'] ?? '';
    if (!isset($MODULOS[$m])) { http_response_code(404); exit('Módulo no encontrado'); }
    if (!empty($MODULOS[$m]['solo_admin']) && ($_SESSION['tipo'] ?? 0) !== 1) {
        http_response_code(403); exit('Acceso restringido a administradores.');
    }
    return [$m, $MODULOS[$m]];
}

function e($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
