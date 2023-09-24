<?php

namespace Database\Seeders;

use App\Models\User;
use App\Modules\System\Constants\UserStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);
        if(!empty($user)) {
            echo "admin 管理者已建立 \n";
			exit;
        }
        DB::beginTransaction();

        $admin = User::create([
            'account'   => 'admin',
            'password'  => bcrypt(md5('a123456')),
            //'password'  => bcrypt('a123456'),
            'name'      => 'administrator',
            'status'    => UserStatus::ENABLE,
            'created_by' => 0,
            'updated_by' => 0,
        ]);

        $manager = User::create([
            'account'   => 'manager',
            'password'  => bcrypt(md5('a123456')),
            'name'      => 'manager',
            'status'    => UserStatus::ENABLE,
            'created_by' => 0,
            'updated_by' => 0,
        ]);

        DB::commit();
        echo "admin 管理者建立完成 \n";
    }
}
