<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Ministry;
use App\Models\ProjectGroup;
use App\Models\ImplementingUnit;
use App\Models\FeeCategory;
use App\Models\Field;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tạo Tài khoản Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com', // Tài khoản đăng nhập
            'password' => Hash::make('12345678'), // Mật khẩu
        ]);

        // 2. Tạo Bộ ngành mẫu
        $ministry = Ministry::create(['name' => 'Bộ Tài nguyên và Môi trường', 'code' => 'BTNMT']);


        // 4. Tạo Nhóm dự án mẫu
        ProjectGroup::create(['name' => 'Đề án 47']);

        // 6. Tạo Đơn vị thực hiện mẫu
        Field::create(['name' => 'Địa chất - Khoáng sản', 'color' => '#ef4444']);
        Field::create(['name' => 'Sinh học - Nguồn lợi', 'color' => '#10b981']);
        Field::create(['name' => 'Môi trường biển', 'color' => '#06b6d4']);
        Field::create(['name' => 'Khí tượng - Hải văn', 'color' => '#8b5cf6']);
        Field::create(['name' => 'Vật lý biển', 'color' => '#f59e0b']);

        $this->call([
            FeeDataSeeder::class,
        ]);
    }
}