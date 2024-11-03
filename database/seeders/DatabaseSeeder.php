<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Option;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $this->call([RolesAndPermissionsSeeder::class]);

        User::find(1)->update([
            "email" => "admin@nomail.com"
        ]);




       // $attr = Attribute::create(['name' => "Color"]);


        // $colors = [
        //     ['name' => 'MediumOrchid | #BA55D3', 'price' => 20,  'attribute_id' => $attr->id],
        //     ['name' => 'MediumPurple | #9370DB', 'price' => 20, 'attribute_id' => $attr->id],
        //     ['name' => 'MediumSeaGreen | #3CB371', 'price' => 20, 'attribute_id' => $attr->id],
        //     ['name' => 'MediumSlateBlue | #7B68EE', 'price' => 20, 'attribute_id' => $attr->id],
        //     ['name' => 'MediumSpringGreen | #00FA9A', 'price' => 20, 'attribute_id' => $attr->id],

        //     ['name' => 'WhiteSmoke | #F5F5F5', 'price' => 20, 'attribute_id' => $attr->id],
        //     ['name' => 'YellowGreen | #9ACD32', 'price' => 20, 'attribute_id' => $attr->id],
        // ];


        // Option::insert($colors);



        // Define attributes and their options
        // $attributes = [
        //     'Size' => ['XL', 'M', 'S', '3XL'],
        //     'Material' => ['Cotton', 'Polyester', 'Wool', 'Silk'],
        //     'Fit' => ['Regular', 'Slim', 'Loose'],
        //     'Pattern' => ['Striped', 'Checked', 'Solid', 'Graphic'],
        //     'Neckline' => ['Crew Neck', 'V-Neck', 'Collar', 'Scoop Neck'],
        //     'Rise' => ['Regular', 'Low', 'High'],
        //     'Hood' => ['Attached', 'Detachable', 'None'],
        //     'Lining' => ['Fully Lined', 'Partially Lined', 'Unlined'],
        //     'Breathability' => ['High', 'Medium', 'Low'],
        //     'Stretch' => ['Stretch', 'Non-Stretch'],
        //     'Transparency' => ['Opaque', 'Sheer'],

        // ];

        // foreach ($attributes as $attributeName => $options) {
        //     // Get or create the attribute
        //     $attribute = DB::table('attributes')->where('name', $attributeName)->first();

        //     if (!$attribute) {
        //         $attributeId = DB::table('attributes')->insertGetId([
        //             'name' => $attributeName,
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ]);
        //     } else {
        //         $attributeId = $attribute->id;
        //     }

        //     // Insert options for the attribute
        //     foreach ($options as $option) {
        //         DB::table('options')->insert([
        //             'name' => $option,
        //             'in_stock' => rand(5, 20), // Random stock number for example
        //             'in_stock_unlimited' => false,
        //             // 'is_color' => false, // Since we're excluding colors
        //             'price' => rand(50, 150), // Random price for example
        //             'attribute_id' => $attributeId,
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ]);
        //     }
        // }


        // Define sample brands with placeholder image path
        $brands = [
            ['company' => 'Nike', 'path' => 'https://placehold.jp/150x150.png'],
            ['company' => 'Adidas', 'path' => 'https://placehold.jp/150x150.png'],
            ['company' => 'Puma', 'path' => 'https://placehold.jp/150x150.png'],
            ['company' => 'Under Armour', 'path' => 'https://placehold.jp/150x150.png'],
            ['company' => 'Reebok', 'path' => 'https://placehold.jp/150x150.png'],
            ['company' => 'New Balance', 'path' => 'https://placehold.jp/150x150.png'],
            ['company' => 'Converse', 'path' => 'https://placehold.jp/150x150.png'],
            ['company' => 'Vans', 'path' => 'https://placehold.jp/150x150.png'],
            ['company' => 'Asics', 'path' => 'https://placehold.jp/150x150.png'],
            ['company' => 'Skechers', 'path' => 'https://placehold.jp/150x150.png'],
        ];

        // Insert sample data into the brands table
        DB::table('brands')->insert($brands);



        // Seed categories
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics'],
            ['name' => 'Clothing', 'slug' => 'clothing'],
            ['name' => 'Home & Garden', 'slug' => 'home-garden'],
            ['name' => 'Sports & Outdoors', 'slug' => 'sports-outdoors'],
            ['name' => 'Toys & Games', 'slug' => 'toys-games'],
            ['name' => 'Health & Beauty', 'slug' => 'health-beauty'],
            ['name' => 'Automotive', 'slug' => 'automotive'],
            ['name' => 'Books', 'slug' => 'books'],
            ['name' => 'Jewelry', 'slug' => 'jewelry'],
            ['name' => 'Pet Supplies', 'slug' => 'pet-supplies'],
        ];

        foreach ($categories as $category) {
            ProductCategory::updateOrCreate(
                ['slug' => $category['slug']], // Unique key
                ['name' => $category['name']]
            );
        }

        // Seed sub-categories
        $subCategories = [
            ['category_name' => 'Electronics', 'name' => 'Mobile Phones', 'slug' => 'mobile-phones'],
            ['category_name' => 'Electronics', 'name' => 'Laptops', 'slug' => 'laptops'],
            ['category_name' => 'Electronics', 'name' => 'Headphones', 'slug' => 'headphones'],

            ['category_name' => 'Clothing', 'name' => 'Men\'s Clothing', 'slug' => 'mens-clothing'],
            ['category_name' => 'Clothing', 'name' => 'Women\'s Clothing', 'slug' => 'womens-clothing'],
            ['category_name' => 'Clothing', 'name' => 'Kids\' Clothing', 'slug' => 'kids-clothing'],

            ['category_name' => 'Home & Garden', 'name' => 'Furniture', 'slug' => 'furniture'],
            ['category_name' => 'Home & Garden', 'name' => 'Kitchenware', 'slug' => 'kitchenware'],
            ['category_name' => 'Home & Garden', 'name' => 'Garden Tools', 'slug' => 'garden-tools'],

            ['category_name' => 'Sports & Outdoors', 'name' => 'Camping Gear', 'slug' => 'camping-gear'],
            ['category_name' => 'Sports & Outdoors', 'name' => 'Fitness Equipment', 'slug' => 'fitness-equipment'],
            ['category_name' => 'Sports & Outdoors', 'name' => 'Outdoor Apparel', 'slug' => 'outdoor-apparel'],

            ['category_name' => 'Toys & Games', 'name' => 'Board Games', 'slug' => 'board-games'],
            ['category_name' => 'Toys & Games', 'name' => 'Action Figures', 'slug' => 'action-figures'],
            ['category_name' => 'Toys & Games', 'name' => 'Dolls', 'slug' => 'dolls'],

            ['category_name' => 'Health & Beauty', 'name' => 'Skincare', 'slug' => 'skincare'],
            ['category_name' => 'Health & Beauty', 'name' => 'Makeup', 'slug' => 'makeup'],
            ['category_name' => 'Health & Beauty', 'name' => 'Vitamins', 'slug' => 'vitamins'],

            ['category_name' => 'Automotive', 'name' => 'Car Parts', 'slug' => 'car-parts'],
            ['category_name' => 'Automotive', 'name' => 'Car Accessories', 'slug' => 'car-accessories'],
            ['category_name' => 'Automotive', 'name' => 'Motorcycles', 'slug' => 'motorcycles'],

            ['category_name' => 'Books', 'name' => 'Fiction', 'slug' => 'fiction'],
            ['category_name' => 'Books', 'name' => 'Non-Fiction', 'slug' => 'non-fiction'],
            ['category_name' => 'Books', 'name' => 'Children\'s Books', 'slug' => 'childrens-books'],

            ['category_name' => 'Jewelry', 'name' => 'Necklaces', 'slug' => 'necklaces'],
            ['category_name' => 'Jewelry', 'name' => 'Bracelets', 'slug' => 'bracelets'],
            ['category_name' => 'Jewelry', 'name' => 'Rings', 'slug' => 'rings'],

            ['category_name' => 'Pet Supplies', 'name' => 'Dog Food', 'slug' => 'dog-food'],
            ['category_name' => 'Pet Supplies', 'name' => 'Cat Toys', 'slug' => 'cat-toys'],
            ['category_name' => 'Pet Supplies', 'name' => 'Pet Beds', 'slug' => 'pet-beds'],
        ];

        foreach ($subCategories as $subCategory) {
            // Retrieve category ID
            $category = ProductCategory::where('name', $subCategory['category_name'])->first();

            if ($category) {
                ProductSubCategory::updateOrCreate(
                    ['name' => $subCategory['name']], // To avoid duplicates
                    [
                        'category_id' => $category->id,
                        'slug' => $subCategory['slug'],
                    ]
                );
            } else {
                // Handle cases where category does not exist
                // For example, you might log this situation
                echo "Category '{$subCategory['category_name']}' not found.\n";
            }
        }











        // ##################################################### 

        $faker = Faker::create();

        // Fetch all categories and sub-categories
        $categories = ProductCategory::all();
        $brands = Brand::all();
        $users = User::all();

        foreach ($categories as $category) {
            $subCategories = ProductSubCategory::where('category_id', $category->id)->get();

            foreach ($subCategories as $subCategory) {
                for ($i = 0; $i < 2; $i++) {
                    Product::create([
                        // 'name' => $faker->company . ' ' . $faker->word, // Using company name and word for product name
                        // 'product_code' => strtoupper($faker->bothify('???-#####')),
                        'slug' => $faker->slug,
                        'short_description' => $faker->sentence,
                        'description' => $faker->paragraph,
                        'specifications' => $faker->text,
                        'price' => $faker->numberBetween(150, 500),
                        // 'quantity' => $faker->numberBetween(1, 100),
                        'category_id' => $category->id,
                        'sub_category_id' => $subCategory->id,
                        'brand_id' => $brands->random()->id,
                        'coupon_id' => null,
                        'discount_price' => $faker->numberBetween(150, 500),
                        'is_published' => 1,
                        'featured_image' => 'https://placehold.jp/300x300.png',
                        'gallery_image_one' => 'https://placehold.jp/300x300.png',
                        'gallery_image_two' => 'https://placehold.jp/300x300.png',
                        'gallery_image_three' => 'https://placehold.jp/300x300.png',
                        'youtube_link' => 'https://youtube.com/' . $faker->slug,
                        'meta_title' => $faker->sentence,
                        'meta_description' => $faker->paragraph,
                        'user_id' => $users->random()->id,
                    ]);
                }
            }
        }


        $coupons = [];

        for ($i = 0; $i < 13; $i++) {
            $coupons[] = [
                'code' => 'COUPON@' . $i, // Generate a random coupon code
                'discount_amount' => rand(5, 50), // Random discount amount between 5 and 50
                'valid_from' => now()->subDays(rand(30, 60))->toDateString(), // Random start date in the past
                'expiry_date' => now()->addDays(rand(30, 90))->toDateString(), // Random expiry date in the future
                'usage_limit' => rand(1, 10), // Random usage limit between 1 and 10
                'discount_type' => rand(0, 1) ? 'fixed' : 'percentage', // Randomly select discount type
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('coupons')->insert($coupons);




        DB::table('general_settings')->insert([
            'site_title' => 'My eCommerce Store',
            'home_page_title' => 'Welcome to My Store',
            'whatsapp_number' => '+880123456789',
            'store_email' => 'store@example.com',
            'facebook_iframe' => '<iframe src="facebook.com/embed"></iframe>',
            'shop_address' => '123, Dhaka, Bangladesh',
            'site_meta_keywords' => 'eCommerce, online store, shopping',
            'site_meta_description' => 'This is an amazing online store.',
            'facebook_pixel' => 'FB_PIXEL_CODE',
            'tag_manager' => 'TAG_MANAGER_CODE',
            'google_analytics' => 'GA_TRACKING_ID',
            'domain_verification' => 'VERIFICATION_CODE',
            'facebook_url' => 'https://facebook.com/store',
            'instagram_url' => 'https://instagram.com/store',
            'youtube_url' => 'https://youtube.com/store',
            'tiktok_url' => 'https://tiktok.com/store',
            'twitter_url' => 'https://twitter.com/store',
            'primary_color' => '#FF5733',
            'stock_alert_quantity' => 5,
            'delivery_charge_inside_dhaka' => 60,
            'delivery_charge_outside_dhaka' => 120,
            'messenger_bot' => true,
            'whatsapp_bot' => true,
        ]);


        // Define an array of dummy data
        $suppliers = [
            [
                'supplier_name' => 'John Doe',
                'company_name' => 'Doe Enterprises',
                'company_phone' => '123-456-7890',
                'company_address' => '123 Elm Street, Springfield, IL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_name' => 'Jane Smith',
                'company_name' => 'Smith Solutions',
                'company_phone' => '234-567-8901',
                'company_address' => '456 Oak Avenue, Metropolis, NY',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_name' => 'Michael Johnson',
                'company_name' => 'Johnson Industries',
                'company_phone' => '345-678-9012',
                'company_address' => '789 Pine Road, Gotham, NJ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_name' => 'Emily Davis',
                'company_name' => 'Davis & Co.',
                'company_phone' => '456-789-0123',
                'company_address' => '101 Maple Lane, Star City, CA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_name' => 'Robert Brown',
                'company_name' => 'Brown Partners',
                'company_phone' => '567-890-1234',
                'company_address' => '202 Birch Drive, Smalltown, TX',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more dummy records as needed
        ];

        // Insert the data into the suppliers table
        DB::table('suppliers')->insert($suppliers);
        DB::table('purchases')->insert([
            [
                'id' => 1,
                'purchase_name' => 'ABC Corp Bulk Purchase',
                'purchase_date' => '2024-09-03',
                'invoice_number' => 'INV-1001',
                'supplier_id' => 1,
                'document' => '/documents/1725341820_Laravel.pdf',
                'comment' => 'Bulk purchase for office use',
                'created_at' => Carbon::parse('2024-09-02 23:37:00'),
                'updated_at' => Carbon::parse('2024-09-02 23:37:56'),
                'deleted_at' => null,
            ],
            [
                'id' => 2,
                'purchase_name' => 'Sybill Golden',
                'purchase_date' => '2008-07-05',
                'invoice_number' => '553',
                'supplier_id' => 2,
                'document' => null,
                'comment' => 'Cumque voluptas et d',
                'created_at' => Carbon::parse('2024-09-03 01:21:51'),
                'updated_at' => Carbon::parse('2024-09-03 01:21:51'),
                'deleted_at' => null,
            ],
        ]);
        // DB::table('item_purchases')->insert([
        //     [
        //         'id' => 1,
        //         'product_name' => 'Laptop',
        //         'product_code' => 'LP-1001',
        //         'quantity' => 100,
        //         'sold' => 0,
        //         'price' => 1200.00,
        //         'total_price' => 2400.00,
        //         'purchase_id' => 1,
        //         'created_at' => Carbon::parse('2024-09-02 23:39:38'),
        //         'updated_at' => Carbon::parse('2024-09-02 23:39:38'),
        //     ],
        //     [
        //         'id' => 2,
        //         'product_name' => 'Smartphone',
        //         'product_code' => 'SP-1002',
        //         'quantity' => 5,
        //         'sold' => 0,
        //         'price' => 600.00,
        //         'total_price' => 3000.00,
        //         'purchase_id' => 1,
        //         'created_at' => Carbon::parse('2024-09-02 23:40:16'),
        //         'updated_at' => Carbon::parse('2024-09-02 23:40:16'),
        //     ],
        //     [
        //         'id' => 3,
        //         'product_name' => 'Office Chair',
        //         'product_code' => 'OC-1003',
        //         'quantity' => 10,
        //         'sold' => 10,
        //         'price' => 150.00,
        //         'total_price' => 1500.00,
        //         'purchase_id' => 1,
        //         'created_at' => Carbon::parse('2024-09-02 23:40:51'),
        //         'updated_at' => Carbon::parse('2024-09-02 23:40:51'),
        //     ],
        //     [
        //         'id' => 4,
        //         'product_name' => 'Printer',
        //         'product_code' => 'PR-1004',
        //         'quantity' => 3,
        //         'sold' => 0,
        //         'price' => 300.00,
        //         'total_price' => 900.00,
        //         'purchase_id' => 1,
        //         'created_at' => Carbon::parse('2024-09-02 23:41:38'),
        //         'updated_at' => Carbon::parse('2024-09-02 23:41:38'),
        //     ],
        //     [
        //         'id' => 5,
        //         'product_name' => 'Desktop PC',
        //         'product_code' => 'PC-1005',
        //         'quantity' => 4,
        //         'sold' => 0,
        //         'price' => 800.00,
        //         'total_price' => 3200.00,
        //         'purchase_id' => 1,
        //         'created_at' => Carbon::parse('2024-09-02 23:42:25'),
        //         'updated_at' => Carbon::parse('2024-09-02 23:42:25'),
        //     ],
        //     [
        //         'id' => 6,
        //         'product_name' => 'Projector',
        //         'product_code' => 'PJ-1006',
        //         'quantity' => 1,
        //         'sold' => 0,
        //         'price' => 500.00,
        //         'total_price' => 500.00,
        //         'purchase_id' => 1,
        //         'created_at' => Carbon::parse('2024-09-02 23:43:08'),
        //         'updated_at' => Carbon::parse('2024-09-02 23:43:08'),
        //     ],
        //     [
        //         'id' => 7,
        //         'product_name' => 'Mouse & Keyboard',
        //         'product_code' => 'MK-1007',
        //         'quantity' => 15,
        //         'sold' => 0,
        //         'price' => 50.00,
        //         'total_price' => 750.00,
        //         'purchase_id' => 1,
        //         'created_at' => Carbon::parse('2024-09-02 23:44:10'),
        //         'updated_at' => Carbon::parse('2024-09-02 23:44:10'),
        //     ],
        //     [
        //         'id' => 8,
        //         'product_name' => 'External HDD',
        //         'product_code' => 'EH-1008',
        //         'quantity' => 6,
        //         'sold' => 0,
        //         'price' => 100.00,
        //         'total_price' => 600.00,
        //         'purchase_id' => 1,
        //         'created_at' => Carbon::parse('2024-09-02 23:44:40'),
        //         'updated_at' => Carbon::parse('2024-09-02 23:44:40'),
        //     ],
        //     [
        //         'id' => 9,
        //         'product_name' => 'Monitor',
        //         'product_code' => 'MN-1009',
        //         'quantity' => 7,
        //         'sold' => 0,
        //         'price' => 250.00,
        //         'total_price' => 1750.00,
        //         'purchase_id' => 1,
        //         'created_at' => Carbon::parse('2024-09-02 23:45:50'),
        //         'updated_at' => Carbon::parse('2024-09-02 23:45:50'),
        //     ],
        //     [
        //         'id' => 10,
        //         'product_name' => 'Router',
        //         'product_code' => 'RT-1010',
        //         'quantity' => 3,
        //         'sold' => 0,
        //         'price' => 120.00,
        //         'total_price' => 360.00,
        //         'purchase_id' => 1,
        //         'created_at' => Carbon::parse('2024-09-02 23:46:21'),
        //         'updated_at' => Carbon::parse('2024-09-02 23:46:21'),
        //     ],
        //     [
        //         'id' => 11,
        //         'product_name' => 'Penelope Berry',
        //         'product_code' => '123',
        //         'quantity' => 1234,
        //         'sold' => 0,
        //         'price' => 234.00,
        //         'total_price' => 234.00,
        //         'purchase_id' => 2,
        //         'created_at' => Carbon::parse('2024-09-03 01:22:00'),
        //         'updated_at' => Carbon::parse('2024-09-03 01:22:00'),
        //     ],
        // ]);
    }
}
