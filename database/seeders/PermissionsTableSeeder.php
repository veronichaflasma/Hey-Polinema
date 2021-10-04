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
                'title' => 'feed_create',
            ],
            [
                'id'    => 18,
                'title' => 'feed_edit',
            ],
            [
                'id'    => 19,
                'title' => 'feed_show',
            ],
            [
                'id'    => 20,
                'title' => 'feed_delete',
            ],
            [
                'id'    => 21,
                'title' => 'feed_access',
            ],
            [
                'id'    => 22,
                'title' => 'comment_create',
            ],
            [
                'id'    => 23,
                'title' => 'comment_edit',
            ],
            [
                'id'    => 24,
                'title' => 'comment_show',
            ],
            [
                'id'    => 25,
                'title' => 'comment_delete',
            ],
            [
                'id'    => 26,
                'title' => 'comment_access',
            ],
            [
                'id'    => 27,
                'title' => 'journal_create',
            ],
            [
                'id'    => 28,
                'title' => 'journal_edit',
            ],
            [
                'id'    => 29,
                'title' => 'journal_show',
            ],
            [
                'id'    => 30,
                'title' => 'journal_delete',
            ],
            [
                'id'    => 31,
                'title' => 'journal_access',
            ],
            [
                'id'    => 32,
                'title' => 'event_create',
            ],
            [
                'id'    => 33,
                'title' => 'event_edit',
            ],
            [
                'id'    => 34,
                'title' => 'event_show',
            ],
            [
                'id'    => 35,
                'title' => 'event_delete',
            ],
            [
                'id'    => 36,
                'title' => 'event_access',
            ],
            [
                'id'    => 37,
                'title' => 'student_create',
            ],
            [
                'id'    => 38,
                'title' => 'student_edit',
            ],
            [
                'id'    => 39,
                'title' => 'student_show',
            ],
            [
                'id'    => 40,
                'title' => 'student_delete',
            ],
            [
                'id'    => 41,
                'title' => 'student_access',
            ],
            [
                'id'    => 42,
                'title' => 'owner_fund_raiser_create',
            ],
            [
                'id'    => 43,
                'title' => 'owner_fund_raiser_edit',
            ],
            [
                'id'    => 44,
                'title' => 'owner_fund_raiser_show',
            ],
            [
                'id'    => 45,
                'title' => 'owner_fund_raiser_delete',
            ],
            [
                'id'    => 46,
                'title' => 'owner_fund_raiser_access',
            ],
            [
                'id'    => 47,
                'title' => 'donor_fund_raiser_create',
            ],
            [
                'id'    => 48,
                'title' => 'donor_fund_raiser_edit',
            ],
            [
                'id'    => 49,
                'title' => 'donor_fund_raiser_show',
            ],
            [
                'id'    => 50,
                'title' => 'donor_fund_raiser_delete',
            ],
            [
                'id'    => 51,
                'title' => 'donor_fund_raiser_access',
            ],
            [
                'id'    => 52,
                'title' => 'scholarship_create',
            ],
            [
                'id'    => 53,
                'title' => 'scholarship_edit',
            ],
            [
                'id'    => 54,
                'title' => 'scholarship_show',
            ],
            [
                'id'    => 55,
                'title' => 'scholarship_delete',
            ],
            [
                'id'    => 56,
                'title' => 'scholarship_access',
            ],
            [
                'id'    => 57,
                'title' => 'rate_journal_create',
            ],
            [
                'id'    => 58,
                'title' => 'rate_journal_edit',
            ],
            [
                'id'    => 59,
                'title' => 'rate_journal_show',
            ],
            [
                'id'    => 60,
                'title' => 'rate_journal_delete',
            ],
            [
                'id'    => 61,
                'title' => 'rate_journal_access',
            ],
            [
                'id'    => 62,
                'title' => 'post_access',
            ],
            [
                'id'    => 63,
                'title' => 'fund_raiser_access',
            ],
            [
                'id'    => 64,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
