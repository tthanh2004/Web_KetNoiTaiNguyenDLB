<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeeDataSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Dữ liệu Tài nguyên đất, nước ven biển' => [
                ['Bản đồ chất lượng đất ven biển tỷ lệ 1/250.000', 'Mảnh', 2800000],
                ['Bản đồ hiện trạng khai thác, sử dụng nước mặt tại các thủy vực vùng ven biển tỷ lệ 1/100.000', 'Mảnh', 1500000],
                ['Bản đồ tiềm năng nước dưới đất vùng ven biển và hải đảo tỷ lệ 1/200.000', 'Mảnh', 2000000],
                ['Bản đồ tiềm năng nước dưới đất tỷ lệ 1/50.000', 'Mảnh', 670000],
                ['Bản đồ tiềm năng nước dưới đất tỷ lệ 1/25.000', 'Mảnh', 550000],
                ['Hồ sơ về dữ liệu tài nguyên đất, nước ven biển', 'Trang', 2000],
            ],
            'Dữ liệu Địa hình đáy biển' => [
                ['Bản đồ địa hình đáy biển tỷ lệ 1/10.000', 'Mảnh', 750000],
                ['Bản đồ địa hình đáy biển tỷ lệ 1/50.000', 'Mảnh', 1060000],
                ['Hải đồ tỷ lệ 1/100.000', 'Mảnh', 2300000],
                ['Cơ sở dữ liệu bản đồ địa hình đáy biển tỷ lệ 1/10.000', 'Mảnh', 950000],
                ['Cơ sở dữ liệu bản đồ địa hình đáy biển tỷ lệ 1/50.000', 'Mảnh', 1670000],
                ['Cơ sở dữ liệu nền địa lý biển tỉ lệ 1/50.000', 'Mảnh', 1700000],
            ],
            'Dữ liệu Khí tượng, thủy văn biển' => [
                ['Khí tượng hải văn ven bờ (Hướng gió, mực nước, nhiệt độ, độ mặn...)', 'Yếu tố đo/năm/trạm', 220000],
                ['Khảo sát khí tượng thủy văn biển (Vị trí, độ sâu, Oxy, pH, độ đục...)', 'Yếu tố đo/năm/trạm', 2000000],
                ['Bản đồ khí tượng, thủy văn tỷ lệ từ 1/4.000.000 đến 1/250.000', 'Mảnh', 2000000],
                ['Bản đồ khí tượng, thủy văn tỷ lệ từ 1/200.000 đến 1/10.000', 'Mảnh', 1500000],
            ],
            'Dữ liệu Địa chất khoáng sản biển' => [
                ['Bản đồ địa chất, khoáng sản biển ven bờ (0-30m) tỷ lệ 1/1.000.000', 'Mảnh', 3280000],
                ['Bản đồ địa chất, khoáng sản biển ven bờ (0-30m) tỷ lệ 1/500.000', 'Mảnh', 2500000],
                ['Bản đồ địa chất, khoáng sản biển ven bờ (0-30m) tỷ lệ 1/200.000', 'Mảnh', 1970000],
                ['Bản đồ địa chất, khoáng sản biển ven bờ (0-30m) tỷ lệ 1/10.000', 'Mảnh', 440000],
                ['Bản đồ địa chất, khoáng sản đới ven biển (30-100m) tỷ lệ 1/1.000.000', 'Mảnh', 5260000],
                ['Tài liệu địa chất, khoáng sản, địa chất môi trường... dải ven biển', 'Trang', 2500],
                ['Cơ sở dữ liệu bản đồ địa chất, khoáng sản tỷ lệ 1/1.000.000', 'Mảnh', 4900000],
                ['Cơ sở dữ liệu bản đồ địa chất, khoáng sản tỷ lệ 1/10.000', 'Mảnh', 670000],
            ],
            'Dữ liệu Hệ sinh thái, đa dạng sinh học và nguồn lợi hải sản' => [
                ['Bản đồ đa dạng sinh học và bảo tồn biển tỷ lệ 1/10.000', 'Mảnh', 440000],
                ['Bản đồ đa dạng sinh học và bảo tồn biển tỷ lệ 1/50.000', 'Mảnh', 620000],
                ['Nhóm bản đồ nguồn lợi thủy hải sản/hải dương học/môi trường nghề cá 1/1.000.000', 'Mảnh', 5250000],
                ['Tài liệu Hệ sinh thái, đa dạng sinh học và nguồn lợi hải sản', 'Trang', 1500],
                ['Cơ sở dữ liệu các bản đồ tỷ lệ 1/1.000.000', 'Mảnh', 5250000],
            ],
            'Dữ liệu Tài nguyên vị thế và Kỳ quan sinh thái biển' => [
                ['Hồ sơ đánh giá Tài nguyên vị thế/Kỳ quan sinh thái/Địa chất', 'Trang', 3000],
                ['Tập bản đồ chuyên đề Biển Đông khổ 60 x 60', 'Quyển', 3500000],
                ['Bản đồ chuyên đề biển và hải đảo tỷ lệ 1/1.000.000', 'Mảnh', 8000000],
                ['Bản đồ chuyên đề biển và hải đảo tỷ lệ 1/4.000.000', 'Mảnh', 4000000],
            ],
            'Dữ liệu Môi trường biển' => [
                ['Số liệu quan trắc môi trường biển', 'Yếu tố đo/năm/trạm', 2000000],
                ['Bản đồ nhạy cảm môi trường tỷ lệ 1/50.000', 'Mảnh', 750000],
                ['Dữ liệu Hồ sơ đánh giá về môi trường', 'Trang', 2000],
                ['Cơ sở dữ liệu bản đồ nhạy cảm môi trường', 'Mảnh', 1100000],
            ],
            'Dữ liệu Hải đảo' => [
                ['Bản đồ địa hình đảo tỷ lệ 1/5.000', 'Mảnh', 490000],
                ['Bản đồ địa mạo, địa chất, khoáng sản đảo tỷ lệ 1/5.000', 'Mảnh', 350000],
                ['Bản đồ tài nguyên đất, nước của đảo tỷ lệ 1/5.000', 'Mảnh', 350000],
                ['Hồ sơ, tài liệu về hải đảo', 'Trang', 2500],
            ],
            'Dữ liệu quy hoạch, kế hoạch sử dụng biển' => [
                ['Bản đồ quy hoạch sử dụng biển tỷ lệ 1/200.000', 'Mảnh', 1900000],
                ['Hồ sơ về quy hoạch, kế hoạch sử dụng biển', 'Trang', 2500],
                ['Hồ sơ về giao khu vực biển', 'Trang', 2500],
            ],
            'Dữ liệu Viễn thám biển' => [
                ['Ảnh Spot 2,4, 5 nắn mức 2A độ phân giải 10m', 'Cảnh', 10018000],
                ['Ảnh Spot 5 nắn mức 2A độ phân giải 2,5m', 'Cảnh', 28036000],
                ['Ảnh Meris 2A độ phân giải 300m', 'Cảnh', 5391000],
                ['Ảnh EnvisatAsar 2A độ phân giải 150m', 'Cảnh', 8041000],
            ],
        ];

        $catOrder = 1;
        foreach ($data as $categoryName => $items) {
            // Tạo Category
            $categoryId = DB::table('fee_categories')->insertGetId([
                'name' => $categoryName,
                'order' => $catOrder++,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Tạo các Items thuộc Category đó
            $itemOrder = 1;
            foreach ($items as $item) {
                DB::table('fee_items')->insert([
                    'fee_category_id' => $categoryId,
                    'name' => $item[0],
                    'unit' => $item[1],
                    'price' => $item[2],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}