 <?php

return [
    'global' => [
        'save'   => 'Guardar',
        'close'  => 'Cerrar',
        'action' => 'Acción',
        'logout' => 'Salir',
        'search' => 'Buscar',
        'sweet'  => [
            'title'          => 'Estás Seguro?',
            'text'           => 'Si no estas seguro da click en cancelar!',
            'confirm_delete' => 'Si, Eliminalo!',
        ],
    ],

    /**
     * Permission.
     */
    'permission' => [
        'add'      => 'Agregar permiso',
        'edit'     => 'Editar permiso',
        'title'    => 'Administración de permisos',
        'subtitle' => 'Lista de Permisos',
        'fields'   => [
            'name'            => 'Permiso',
            'description'     => 'Descripcion',
            'plc_name'        => 'Nombre del permiso',
            'plc_description' => 'Descripcion del Permiso',
        ],
        'msg' => [
            'msg_insert'   => 'El permiso se ha agregado correctamente.',
            'msg_update'   => 'El permiso con id {0} ha sido modificado corecctamente.',
            'msg_delete'   => 'El permiso con id {0} ha sido eliminado.',
            'msg_get'      => 'El permiso con id {0} obtenido correctamente.',
            'msg_get_fail' => 'El permiso con id {0} no se encontro o fue eliminado.',
        ],
    ],

    /**
     * Role.
     */
    'role' => [
        'add'      => 'Agregar rol',
        'edit'     => 'Editar rol',
        'title'    => 'Administrar rol',
        'subtitle' => 'Lista de roles',
        'fields'   => [
            'name'            => 'Rol',
            'description'     => 'Descripción',
            'plc_name'        => 'Nombre del rol',
            'plc_description' => 'Descripción para el rol',
        ],
        'msg' => [
            'msg_insert'   => 'El rol ha sido agregado correctamente.',
            'msg_update'   => 'El rol con id {0} ha sido modificado corecctamente.',
            'msg_delete'   => 'El rol con id {0} ha sido eliminado.',
            'msg_get'      => 'El rol con id {0} obtenido correctamente.',
            'msg_get_fail' => 'El rol con id {0} no se encontro o fue eliminado.',
        ],
    ],

    /**
     * Menu.
     */
    'menu' => [
        'expand'   => 'Expandir',
        'collapse' => 'Colapsar',
        'refresh'  => 'Refrescar',
        'add'      => 'Agregar menu',
        'edit'     => 'Editar menu',
        'title'    => 'Administrar menu',
        'subtitle' => 'Lista del Menu',
        'fields'   => [
            'parent'         => 'Padre',
            'warning_parent' => '¡Tenga en cuenta! el menu solo es compatible con la profundidad máxima 2',
            'active'         => 'Activo',
            'non_active'     => 'No Activo',
            'icon'           => 'Icono',
            'info_icon'      => 'Para mas iconos, por favor ver',
            'place_icon'     => 'Iconos desde fontawesome.',
            'name'           => 'Titulo',
            'place_title'    => 'Nombre del menu.',
            'route'          => 'Ruta',
            'place_route'    => 'Menu de ruta para enlace.',
        ],
        'msg' => [
            'msg_insert'     => 'El menu ha sido agregado correctamente.',
            'msg_update'     => 'El menu ha sido modificado correctamente.',
            'msg_delete'     => 'El menu ha sido eliminado correctamente.',
            'msg_get'        => 'El menu ha sido obtenido satisfactoriamente.',
            'msg_get_fail'   => 'El menu no se encontro o fue eliminado.',
            'msg_fail_order' => 'El menu falló el reordenamiento.',
        ],
    ],

    /**
     * user.
     */
    'user' => [
        'add'      => 'Agregar usuario',
        'edit'     => 'Editar usuario',
        'title'    => 'Administrar usuario',
        'subtitle' => 'Lista de usuarios',
        'lastname' => 'Apellidos',
        'firstname' => 'Nombres',
        'fields'   => [
            'active'          => 'Activo',
            'profile'         => 'Perfil',
            'join'            => 'Miembro desde',
            'setting'         => 'Configuraciones',
            'non_active'      => 'No activo',
        ],
        'msg' => [
            'msg_insert'   => 'El usuario ha sido agregado correctamente.',
            'msg_update'   => 'El usuario ha sido modificado correctamente.',
            'msg_delete'   => 'El usuario ha sido eliminado correctamente.',
            'msg_get'      => 'El usuario ha sido obtenido correctamente.',
            'msg_get_fail' => 'El usuario no existe o fue eliminado.',
        ],
    ],
];
