<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Ministry;
use App\Models\ProjectGroup;
use App\Models\ImplementingUnit;
use App\Models\FeeCategory;

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

        // 3. Tạo Đơn vị mẫu
        ImplementingUnit::create(['name' => 'Viện Hải dương học', 'ministry_id' => $ministry->id]);
        ImplementingUnit::create(['name' => 'Cục Biển và Hải đảo', 'ministry_id' => $ministry->id]);

        // 4. Tạo Nhóm dự án mẫu
        ProjectGroup::create(['name' => 'Nhiệm vụ thường xuyên']);
        ProjectGroup::create(['name' => 'Đề án 47']);

        // 5. Tạo Nhóm phí mẫu
        FeeCategory::create(['name' => 'I. Dữ liệu Tài nguyên đất', 'order' => 1]);
    }
}