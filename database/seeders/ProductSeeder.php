<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Variant;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // منتجات إلكترونية
        $product1 = Product::create([
            'name' => 'هاتف سامسونج Galaxy S23',
            'slug' => 'samsung-galaxy-s23',
            'description' => 'هاتف ذكي متطور بشاشة AMOLED وكاميرا احترافية 50 ميجابكسل',
            'price' => 120000,
            'sale_price' => 99900,
            'image' => 'https://images.unsplash.com/photo-1610945415295-d9bbf067e59c',
            'is_active' => true
        ]);

        // متغيرات المنتج (ألوان)
        Variant::create([
            'product_id' => $product1->id,
            'name' => 'أسود',
            'price' => 99900,
            'stock' => 15
        ]);
        
        Variant::create([
            'product_id' => $product1->id,
            'name' => 'أبيض',
            'price' => 99900,
            'stock' => 10
        ]);
        
        Variant::create([
            'product_id' => $product1->id,
            'name' => 'أخضر',
            'price' => 101900,
            'stock' => 5
        ]);

        // منتج 2: لابتوب
        $product2 = Product::create([
            'name' => 'لابتوب HP Pavilion',
            'slug' => 'hp-pavilion-laptop',
            'description' => 'لابتوب بشاشة 15.6 بوصة، معالج Intel i7، رام 16 جيجا، قرص SSD 512 جيجا',
            'price' => 180000,
            'sale_price' => 159900,
            'image' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed',
            'is_active' => true
        ]);

        Variant::create([
            'product_id' => $product2->id,
            'name' => 'رمادي',
            'price' => 159900,
            'stock' => 8
        ]);

        // منتج 3: ساعة ذكية
        $product3 = Product::create([
            'name' => 'ساعة آبل Watch Series 9',
            'slug' => 'apple-watch-series-9',
            'description' => 'ساعة ذكية مع شاشة ريتينا، قياس 45 ملم، مقاومة للماء',
            'price' => 85000,
            'sale_price' => 79900,
            'image' => 'https://images.unsplash.com/photo-1434493789847-aaa7f0f6f4a8',
            'is_active' => true
        ]);

        Variant::create([
            'product_id' => $product3->id,
            'name' => 'أسود',
            'price' => 79900,
            'stock' => 12
        ]);
        
        Variant::create([
            'product_id' => $product3->id,
            'name' => 'فضي',
            'price' => 79900,
            'stock' => 8
        ]);

        // منتج 4: سماعات
        $product4 = Product::create([
            'name' => 'سماعات سوني WH-1000XM4',
            'slug' => 'sony-wh-1000xm4',
            'description' => 'سماعات لاسلكية مع تقنية إلغاء الضوضاء، بطارية تدوم 30 ساعة',
            'price' => 45000,
            'sale_price' => 39900,
            'image' => 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb',
            'is_active' => true
        ]);

        // منتج 5: تلفزيون
        $product5 = Product::create([
            'name' => 'تلفزيون LG OLED 55 بوصة',
            'slug' => 'lg-oled-55',
            'description' => 'تلفزيون OLED بدقة 4K، معالج ذكي، دعم HDR',
            'price' => 250000,
            'sale_price' => 219900,
            'image' => 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1',
            'is_active' => true
        ]);

        // منتج 6: تابليت
        $product6 = Product::create([
            'name' => 'آيباد برو 12.9',
            'slug' => 'ipad-pro-12-9',
            'description' => 'تابليت بشاشة Liquid Retina، معالج M2، دعم قلم آبل',
            'price' => 185000,
            'sale_price' => 169900,
            'image' => 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0',
            'is_active' => true
        ]);

        // منتج 7: كاميرا
        $product7 = Product::create([
            'name' => 'كاميرا كانون EOS R6',
            'slug' => 'canon-eos-r6',
            'description' => 'كاميرا بدون مرآة بدقة 20 ميجابكسل، تصوير 4K',
            'price' => 380000,
            'sale_price' => 349900,
            'image' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32',
            'is_active' => true
        ]);

        // منتج 8: ماوس
        $product8 = Product::create([
            'name' => 'ماوس لوجيتك G502',
            'slug' => 'logitech-g502',
            'description' => 'ماوس ألعاب بسلك، حساسية 16000 DPI، أزرار قابلة للبرمجة',
            'price' => 15000,
            'sale_price' => 12900,
            'image' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46',
            'is_active' => true
        ]);

        // منتج 9: كيبورد
        $product9 = Product::create([
            'name' => 'كيبورد ميكانيكي Redragon',
            'slug' => 'redragon-mechanical-keyboard',
            'description' => 'كيبورد ألعاب بمفاتيح ميكانيكية، إضاءة RGB',
            'price' => 12000,
            'sale_price' => 9900,
            'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3',
            'is_active' => true
        ]);

        // منتج 10: شاحن متنقل
        $product10 = Product::create([
            'name' => 'شاحن متنقل Anker 20000mAh',
            'slug' => 'anker-powerbank-20000',
            'description' => 'بطارية خارجية بسعة 20000 ميللي أمبير، شحن سريع',
            'price' => 8000,
            'sale_price' => 6500,
            'image' => 'https://images.unsplash.com/photo-1609091839311-d5365f9ff1c5',
            'is_active' => true
        ]);

        echo "تم إضافة 10 منتجات تجريبية بنجاح!\n";
    }
}