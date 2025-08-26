<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class ExportProducts extends Command
{
    protected $signature = 'export:products';
    protected $description = 'Export products from local database to seeder format';

    public function handle()
    {
        $products = Product::all();
        
        if ($products->isEmpty()) {
            $this->error('No products found in local database!');
            return;
        }

        $this->info("Found {$products->count()} products in local database");
        
        $exportData = [];
        foreach ($products as $product) {
            $exportData[] = [
                'name' => $product->name,
                'brand' => $product->brand,
                'model' => $product->model,
                'category' => $product->category,
                'description' => $product->description,
                'features' => $product->features,
                'specs' => $product->specs,
                'applications' => $product->applications,
                'price_range' => $product->price_range,
                'images' => $product->images,
                'is_active' => $product->is_active ?? true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Write to seeder file
        $seederContent = "<?php\n\nnamespace Database\Seeders;\n\nuse Illuminate\Database\Seeder;\nuse App\Models\Product;\n\nclass ProductSeeder extends Seeder\n{\n    public function run(): void\n    {\n        // Clear existing products\n        Product::truncate();\n\n        \$products = " . var_export($exportData, true) . ";\n\n        // Insert all products\n        foreach (\$products as \$product) {\n            Product::create(\$product);\n        }\n    }\n}\n";

        file_put_contents(database_path('seeders/ProductSeeder.php'), $seederContent);
        
        $this->info('Products exported to ProductSeeder.php successfully!');
        $this->info("Exported {$products->count()} products");
    }
}
