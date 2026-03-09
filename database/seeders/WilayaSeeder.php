<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wilaya;

class WilayaSeeder extends Seeder
{
    public function run(): void
    {
        $wilayas = [
            ['name' => 'أدرار', 'code' => '01', 'delivery_price' => 800],
            ['name' => 'الشلف', 'code' => '02', 'delivery_price' => 600],
            ['name' => 'الأغواط', 'code' => '03', 'delivery_price' => 700],
            ['name' => 'أم البواقي', 'code' => '04', 'delivery_price' => 650],
            ['name' => 'باتنة', 'code' => '05', 'delivery_price' => 600],
            ['name' => 'بجاية', 'code' => '06', 'delivery_price' => 550],
            ['name' => 'بسكرة', 'code' => '07', 'delivery_price' => 700],
            ['name' => 'بشار', 'code' => '08', 'delivery_price' => 900],
            ['name' => 'البليدة', 'code' => '09', 'delivery_price' => 400],
            ['name' => 'البويرة', 'code' => '10', 'delivery_price' => 500],
            ['name' => 'تمنراست', 'code' => '11', 'delivery_price' => 1200],
            ['name' => 'تبسة', 'code' => '12', 'delivery_price' => 750],
            ['name' => 'تلمسان', 'code' => '13', 'delivery_price' => 650],
            ['name' => 'تيارت', 'code' => '14', 'delivery_price' => 600],
            ['name' => 'تيزي وزو', 'code' => '15', 'delivery_price' => 500],
            ['name' => 'الجزائر', 'code' => '16', 'delivery_price' => 300],
            ['name' => 'الجلفة', 'code' => '17', 'delivery_price' => 650],
            ['name' => 'جيجل', 'code' => '18', 'delivery_price' => 550],
            ['name' => 'سطيف', 'code' => '19', 'delivery_price' => 500],
            ['name' => 'سعيدة', 'code' => '20', 'delivery_price' => 700],
            ['name' => 'سكيكدة', 'code' => '21', 'delivery_price' => 550],
            ['name' => 'سيدي بلعباس', 'code' => '22', 'delivery_price' => 650],
            ['name' => 'عنابة', 'code' => '23', 'delivery_price' => 550],
            ['name' => 'قالمة', 'code' => '24', 'delivery_price' => 600],
            ['name' => 'قسنطينة', 'code' => '25', 'delivery_price' => 500],
            ['name' => 'المدية', 'code' => '26', 'delivery_price' => 450],
            ['name' => 'مستغانم', 'code' => '27', 'delivery_price' => 600],
            ['name' => 'المسيلة', 'code' => '28', 'delivery_price' => 600],
            ['name' => 'معسكر', 'code' => '29', 'delivery_price' => 650],
            ['name' => 'ورقلة', 'code' => '30', 'delivery_price' => 900],
            ['name' => 'وهران', 'code' => '31', 'delivery_price' => 550],
            ['name' => 'البيض', 'code' => '32', 'delivery_price' => 800],
            ['name' => 'إليزي', 'code' => '33', 'delivery_price' => 1300],
            ['name' => 'برج بوعريريج', 'code' => '34', 'delivery_price' => 550],
            ['name' => 'بومرداس', 'code' => '35', 'delivery_price' => 400],
            ['name' => 'الطارف', 'code' => '36', 'delivery_price' => 600],
            ['name' => 'تندوف', 'code' => '37', 'delivery_price' => 1400],
            ['name' => 'تيسمسيلت', 'code' => '38', 'delivery_price' => 650],
            ['name' => 'الوادي', 'code' => '39', 'delivery_price' => 800],
            ['name' => 'خنشلة', 'code' => '40', 'delivery_price' => 700],
            ['name' => 'سوق أهراس', 'code' => '41', 'delivery_price' => 650],
            ['name' => 'تيبازة', 'code' => '42', 'delivery_price' => 400],
            ['name' => 'ميلة', 'code' => '43', 'delivery_price' => 600],
            ['name' => 'عين الدفلى', 'code' => '44', 'delivery_price' => 450],
            ['name' => 'النعامة', 'code' => '45', 'delivery_price' => 800],
            ['name' => 'عين تموشنت', 'code' => '46', 'delivery_price' => 650],
            ['name' => 'غرداية', 'code' => '47', 'delivery_price' => 850],
            ['name' => 'غليزان', 'code' => '48', 'delivery_price' => 600],
            ['name' => 'المغير', 'code' => '49', 'delivery_price' => 800],
            ['name' => 'المنيعة', 'code' => '50', 'delivery_price' => 900],
            ['name' => 'أولاد جلال', 'code' => '51', 'delivery_price' => 750],
            ['name' => 'برج باجي مختار', 'code' => '52', 'delivery_price' => 1500],
            ['name' => 'بني عباس', 'code' => '53', 'delivery_price' => 1300],
            ['name' => 'تيميمون', 'code' => '54', 'delivery_price' => 1100],
            ['name' => 'تقرت', 'code' => '55', 'delivery_price' => 850],
            ['name' => 'جانت', 'code' => '56', 'delivery_price' => 1400],
            ['name' => 'عين صالح', 'code' => '57', 'delivery_price' => 1200],
            ['name' => 'عين قزام', 'code' => '58', 'delivery_price' => 1600],
        ];

        foreach ($wilayas as $wilaya) {
            Wilaya::create($wilaya);
        }
    }
}
