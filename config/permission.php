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
        [
            'id' => 4,
            'name' => 'Categories'
        ],
        [
            'id' => 5,
            'name' => 'Medicines'
        ],
        [
            'id' => 6,
            'name' => 'Prescriptions'
        ],
        [
            'id' => 7,
            'name' => 'Schedules'
        ],
        [
            'id' => 8,
            'name' => 'Frames'
        ],
        [
            'id' => 9,
            'name' => 'Appointments'
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
            'name' => 'Create role',
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
        [
            'id' => config('constants.PERMISSION.VIEW_CATEGORY'),
            'menu_id' => 4,
            'name' => 'View category',
            'action' => 'category.index',
            'is_view' => true
        ],
        [
            'id' => config('constants.PERMISSION.CREATE_CATEGORY'),
            'menu_id' => 4,
            'name' => 'Create category',
            'action' => 'category.create',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.EDIT_CATEGORY'),
            'menu_id' => 4,
            'name' => 'Edit category',
            'action' => 'category.edit',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.DELETE_CATEGORY'),
            'menu_id' => 4,
            'name' => 'Delete category',
            'action' => 'category.delete',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.VIEW_MEDICINE'),
            'menu_id' => 5,
            'name' => 'View medicine',
            'action' => 'medicine.index',
            'is_view' => true
        ],
        [
            'id' => config('constants.PERMISSION.CREATE_MEDICINE'),
            'menu_id' => 5,
            'name' => 'Create medicine',
            'action' => 'medicine.create',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.EDIT_MEDICINE'),
            'menu_id' => 5,
            'name' => 'Edit medicine',
            'action' => 'medicine.edit',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.DELETE_MEDICINE'),
            'menu_id' => 5,
            'name' => 'Delete medicine',
            'action' => 'medicine.delete',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.VIEW_PRESCRIPTION'),
            'menu_id' => 6,
            'name' => 'View prescription',
            'action' => 'prescription.index',
            'is_view' => true
        ],
        [
            'id' => config('constants.PERMISSION.CREATE_PRESCRIPTION'),
            'menu_id' => 6,
            'name' => 'Create prescription',
            'action' => 'prescription.create',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.EDIT_PRESCRIPTION'),
            'menu_id' => 6,
            'name' => 'Edit prescription',
            'action' => 'prescription.edit',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.DELETE_PRESCRIPTION'),
            'menu_id' => 6,
            'name' => 'Delete prescription',
            'action' => 'prescription.delete',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.VIEW_SCHEDULE'),
            'menu_id' => 7,
            'name' => 'View schedule',
            'action' => 'schedule.index',
            'is_view' => true
        ],
        [
            'id' => config('constants.PERMISSION.CREATE_SCHEDULE'),
            'menu_id' => 7,
            'name' => 'Create schedule',
            'action' => 'schedule.create',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.EDIT_SCHEDULE'),
            'menu_id' => 7,
            'name' => 'Edit schedule',
            'action' => 'schedule.edit',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.DELETE_SCHEDULE'),
            'menu_id' => 7,
            'name' => 'Delete schedule',
            'action' => 'schedule.delete',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.VIEW_FRAME'),
            'menu_id' => 8,
            'name' => 'View frame',
            'action' => 'frame.index',
            'is_view' => true
        ],
        [
            'id' => config('constants.PERMISSION.CREATE_FRAME'),
            'menu_id' => 8,
            'name' => 'Create frame',
            'action' => 'frame.create',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.EDIT_FRAME'),
            'menu_id' => 8,
            'name' => 'Edit frame',
            'action' => 'frame.edit',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.DELETE_FRAME'),
            'menu_id' => 8,
            'name' => 'Delete frame',
            'action' => 'frame.delete',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.VIEW_APPOINTMENT'),
            'menu_id' => 9,
            'name' => 'View appointment',
            'action' => 'appointment.index',
            'is_view' => true
        ],
        [
            'id' => config('constants.PERMISSION.CREATE_APPOINTMENT'),
            'menu_id' => 9,
            'name' => 'Create appointment',
            'action' => 'appointment.create',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.EDIT_APPOINTMENT'),
            'menu_id' => 9,
            'name' => 'Edit appointment',
            'action' => 'appointment.edit',
            'is_view' => false
        ],
        [
            'id' => config('constants.PERMISSION.DELETE_APPOINTMENT'),
            'menu_id' => 9,
            'name' => 'Delete appointment',
            'action' => 'appointment.delete',
            'is_view' => false
        ],
    ],
];
