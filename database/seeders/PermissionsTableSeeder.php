<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'transeformer_create',
            ],
            [
                'id'    => 18,
                'title' => 'transeformer_edit',
            ],
            [
                'id'    => 19,
                'title' => 'transeformer_show',
            ],
            [
                'id'    => 20,
                'title' => 'transeformer_delete',
            ],
            [
                'id'    => 21,
                'title' => 'transeformer_access',
            ],
            [
                'id'    => 22,
                'title' => 'cb_create',
            ],
            [
                'id'    => 23,
                'title' => 'cb_edit',
            ],
            [
                'id'    => 24,
                'title' => 'cb_show',
            ],
            [
                'id'    => 25,
                'title' => 'cb_delete',
            ],
            [
                'id'    => 26,
                'title' => 'cb_access',
            ],
            [
                'id'    => 27,
                'title' => 'minibller_create',
            ],
            [
                'id'    => 28,
                'title' => 'minibller_edit',
            ],
            [
                'id'    => 29,
                'title' => 'minibller_show',
            ],
            [
                'id'    => 30,
                'title' => 'minibller_delete',
            ],
            [
                'id'    => 31,
                'title' => 'minibller_access',
            ],
            [
                'id'    => 32,
                'title' => 'box_create',
            ],
            [
                'id'    => 33,
                'title' => 'box_edit',
            ],
            [
                'id'    => 34,
                'title' => 'box_show',
            ],
            [
                'id'    => 35,
                'title' => 'box_delete',
            ],
            [
                'id'    => 36,
                'title' => 'box_access',
            ],
            [
                'id'    => 37,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 38,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 39,
                'title' => 'bill_create',
            ],
            [
                'id'    => 40,
                'title' => 'bill_edit',
            ],
            [
                'id'    => 41,
                'title' => 'bill_show',
            ],
            [
                'id'    => 42,
                'title' => 'bill_delete',
            ],
            [
                'id'    => 43,
                'title' => 'bill_access',
            ],
            [
                'id'    => 44,
                'title' => 'allnote_create',
            ],
            [
                'id'    => 45,
                'title' => 'allnote_edit',
            ],
            [
                'id'    => 46,
                'title' => 'allnote_delete',
            ],
            [
                'id'    => 47,
                'title' => 'allnote_access',
            ],
            [
                'id'    => 48,
                'title' => 'minibllarnote_create',
            ],
            [
                'id'    => 49,
                'title' => 'minibllarnote_edit',
            ],
            [
                'id'    => 50,
                'title' => 'minibllarnote_delete',
            ],
            [
                'id'    => 51,
                'title' => 'minibllarnote_access',
            ],
            [
                'id'    => 52,
                'title' => 'license_access',
            ],
            [
                'id'    => 53,
                'title' => 'lic_create',
            ],
            [
                'id'    => 54,
                'title' => 'lic_edit',
            ],
            [
                'id'    => 55,
                'title' => 'lic_show',
            ],
            [
                'id'    => 56,
                'title' => 'lic_delete',
            ],
            [
                'id'    => 57,
                'title' => 'lic_access',
            ],
            [
                'id'    => 58,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 59,
                'title' => 'user_alert_edit',
            ],
            [
                'id'    => 60,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 61,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 62,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 63,
                'title' => 'electrical_access',
            ],
            [
                'id'    => 64,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 65,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 66,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 67,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 68,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 69,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 70,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 71,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 72,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 73,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 74,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 75,
                'title' => 'task_create',
            ],
            [
                'id'    => 76,
                'title' => 'task_edit',
            ],
            [
                'id'    => 77,
                'title' => 'task_show',
            ],
            [
                'id'    => 78,
                'title' => 'task_delete',
            ],
            [
                'id'    => 79,
                'title' => 'task_access',
            ],
            [
                'id'    => 80,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 81,
                'title' => 'esfelt_create',
            ],
            [
                'id'    => 82,
                'title' => 'esfelt_edit',
            ],
            [
                'id'    => 83,
                'title' => 'esfelt_show',
            ],
            [
                'id'    => 84,
                'title' => 'esfelt_delete',
            ],
            [
                'id'    => 85,
                'title' => 'esfelt_access',
            ],
            [
                'id'    => 86,
                'title' => 'close_create',
            ],
            [
                'id'    => 87,
                'title' => 'close_edit',
            ],
            [
                'id'    => 88,
                'title' => 'close_show',
            ],
            [
                'id'    => 89,
                'title' => 'close_delete',
            ],
            [
                'id'    => 90,
                'title' => 'close_access',
            ],
            [
                'id'    => 91,
                'title' => 'contractor_create',
            ],
            [
                'id'    => 92,
                'title' => 'contractor_edit',
            ],
            [
                'id'    => 93,
                'title' => 'contractor_show',
            ],
            [
                'id'    => 94,
                'title' => 'contractor_delete',
            ],
            [
                'id'    => 95,
                'title' => 'contractor_access',
            ],
            [
                'id'    => 96,
                'title' => 'billcon_create',
            ],
            [
                'id'    => 97,
                'title' => 'billcon_edit',
            ],
            [
                'id'    => 98,
                'title' => 'billcon_show',
            ],
            [
                'id'    => 99,
                'title' => 'billcon_delete',
            ],
            [
                'id'    => 100,
                'title' => 'billcon_access',
            ],
            [
                'id'    => 101,
                'title' => 'station_create',
            ],
            [
                'id'    => 102,
                'title' => 'station_edit',
            ],
            [
                'id'    => 103,
                'title' => 'station_show',
            ],
            [
                'id'    => 104,
                'title' => 'station_delete',
            ],
            [
                'id'    => 105,
                'title' => 'station_access',
            ],
            [
                'id'    => 106,
                'title' => 'line_create',
            ],
            [
                'id'    => 107,
                'title' => 'line_edit',
            ],
            [
                'id'    => 108,
                'title' => 'line_show',
            ],
            [
                'id'    => 109,
                'title' => 'line_delete',
            ],
            [
                'id'    => 110,
                'title' => 'line_access',
            ],
            [
                'id'    => 111,
                'title' => 'ct_create',
            ],
            [
                'id'    => 112,
                'title' => 'ct_edit',
            ],
            [
                'id'    => 113,
                'title' => 'ct_show',
            ],
            [
                'id'    => 114,
                'title' => 'ct_delete',
            ],
            [
                'id'    => 115,
                'title' => 'ct_access',
            ],
            [
                'id'    => 116,
                'title' => 'diagram_create',
            ],
            [
                'id'    => 117,
                'title' => 'diagram_edit',
            ],
            [
                'id'    => 118,
                'title' => 'diagram_show',
            ],
            [
                'id'    => 119,
                'title' => 'diagram_delete',
            ],
            [
                'id'    => 120,
                'title' => 'diagram_access',
            ],
            [
                'id'    => 121,
                'title' => 'project_create',
            ],
            [
                'id'    => 122,
                'title' => 'project_edit',
            ],
            [
                'id'    => 123,
                'title' => 'project_show',
            ],
            [
                'id'    => 124,
                'title' => 'project_delete',
            ],
            [
                'id'    => 125,
                'title' => 'project_access',
            ],
            [
                'id'    => 126,
                'title' => 'rmu_create',
            ],
            [
                'id'    => 127,
                'title' => 'rmu_edit',
            ],
            [
                'id'    => 128,
                'title' => 'rmu_show',
            ],
            [
                'id'    => 129,
                'title' => 'rmu_delete',
            ],
            [
                'id'    => 130,
                'title' => 'rmu_access',
            ],
            [
                'id'    => 131,
                'title' => 'autorecloser_create',
            ],
            [
                'id'    => 132,
                'title' => 'autorecloser_edit',
            ],
            [
                'id'    => 133,
                'title' => 'autorecloser_show',
            ],
            [
                'id'    => 134,
                'title' => 'autorecloser_delete',
            ],
            [
                'id'    => 135,
                'title' => 'autorecloser_access',
            ],
            [
                'id'    => 136,
                'title' => 'section_lazy_create',
            ],
            [
                'id'    => 137,
                'title' => 'section_lazy_edit',
            ],
            [
                'id'    => 138,
                'title' => 'section_lazy_show',
            ],
            [
                'id'    => 139,
                'title' => 'section_lazy_delete',
            ],
            [
                'id'    => 140,
                'title' => 'section_lazy_access',
            ],
            [
                'id'    => 141,
                'title' => 'avr_create',
            ],
            [
                'id'    => 142,
                'title' => 'avr_edit',
            ],
            [
                'id'    => 143,
                'title' => 'avr_show',
            ],
            [
                'id'    => 144,
                'title' => 'avr_delete',
            ],
            [
                'id'    => 145,
                'title' => 'avr_access',
            ],
            [
                'id'    => 146,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
