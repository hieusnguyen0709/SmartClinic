<?php
return [
    'VIEW_DASHBOAD' => 1,
    'menu' => [
        [
            'id' => 1,
            'name' => 'Dashboard'
        ],
        [
            'id' => 2,
            'name' => 'Users'
        ],
        [
            'id' => 3,
            'name' => 'Roles'
        ],
    ],
    'permission' => [
        [
            'id' => config('constants.PERMISSION.VIEW_DASHBOARD'),
            'menu_id' => 1,
            'name' => 'View dashboard',
            'action' => 'dashboard.index',
            'is_view' => true
        ],
        [
            'id' => config('constants.PERMISSION.VIEW_USER'),
            'menu_id' => 2,
            'name' => 'View user',
            'action' => 'user.index',
            'is_view' => true
        ],
        [
            'id' => config('constants.PERMISSION.CREATE_USER'),
            'menu_id' => 2,
            'name' => 'Create user',
            'action' => 'user.store',
            'is_view' => false
        ],
        [
            'id' =>config('constants.PERMISSION.EDIT_USER'),
            'menu_id' => 2,
            'name' => 'Edit user',
            'action' => 'user.store',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.DELETE_USER'),
            'menu_id' => 2,
            'name' => 'Delete user',
            'action' => 'user.delete',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.LOCK_USER'),
            'menu_id' => 2,
            'name' => 'Lock/Unlock',
            'action' => 'user.update.status',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.VIEW_ROLE'),
            'menu_id' => 3,
            'name' => 'View role',
            'action' => 'role.index',
            'is_view' => true
        ],
        [
            'id' => config('constants.PERMISSION.CREATE_ROLE'),
            'menu_id' => 3,
            'name' => 'Add role',
            'action' => 'role.create',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.EDIT_ROLE'),
            'menu_id' => 3,
            'name' => 'Edit role',
            'action' => 'role.edit',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.DELETE_ROLE'),
            'menu_id' => 3,
            'name' => 'Delete role',
            'action' => 'role.delete',
            'is_view' => false
        ],
    ],
];
