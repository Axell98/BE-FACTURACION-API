/* Eliminar registros previos */
TRUNCATE TABLE menus;
/* Insertar registros */
START TRANSACTION;
INSERT INTO menus (id, id_pad, nombre, url, icono, activo, orden, permission_name) VALUES 
(1, null, 'Home', '/home', 'i-lucide-house', 1, 1, 'home'),

(2, null, 'Registros', null, 'i-lucide-folder-kanban', 1, 2, null),
(3, 2, 'Productos', '/registros/productos', null, 1, 1, 'productos'),
(4, 2, 'Categorias', '/registros/categorias', null, 1, 2, 'categorias'),
(5, 2, 'Unidad de medida', '/registros/unidad-medida', null, 1, 2, 'unidad_medida'),

(6, null, 'Configuración', null, 'i-lucide-bolt', 1, 3, null),
(7, 6, 'Roles', '/configuracion/roles', null, 1, 1, 'role'),
(8, 6, 'Usuarios', '/configuracion/usuarios', null, 1, 2, 'usuario'),
(9, 6, 'Empresa', '/configuracion/empresa', null, 1, 3, 'empresa'),
(10, 6, 'Sucursales', '/configuracion/sucursales', null, 1, 4, 'sucursal');
COMMIT;