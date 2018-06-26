<?php

use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('permissions')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Administer roles & permissions',
                'guard_name' => 'admin',
                'created_at' => '2018-02-10 17:55:52',
                'updated_at' => '2018-02-10 18:17:32',
            ),
        ));

        \DB::table('roles')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Admin',
                'guard_name' => 'admin',
                'created_at' => '2018-02-10 18:37:11',
                'updated_at' => '2018-02-10 18:37:11',
            ),
        ));

        \DB::table('role_has_permissions')->insert(array (
            0 =>
            array (
                'permission_id' => 1,
                'role_id' => 1,
            ),
        ));

        \DB::table('admins')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$ple.bpBzl297MBiU6cQ/7uheSVDk/1vmezCTS9GVsXQ8owHl7PDWi',
                'role' => 1,
                'remember_token' => NULL,
                'created_at' => '2018-02-07 15:16:36',
                'updated_at' => '2018-02-10 17:08:55',
            ),
        ));

        \DB::table('model_has_roles')->insert(array (
            0 =>
            array (
                'role_id' => 1,
                'model_id' => 1,
                'model_type' => 'App\\Admin',
            ),
        ));
    }
}
