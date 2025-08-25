<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'Alat Kesehatan & Laboratorium',
                'slug' => 'alat-kesehatan-laboratorium',
                'description' => 'Peralatan medis dan laboratorium berkualitas tinggi untuk rumah sakit dan klinik',
                'icon' => 'fas fa-microscope',
                'image' => 'https://via.placeholder.com/400x300',
                'product_count' => Product::byCategory('alat-kesehatan-laboratorium')->active()->count()
            ],
            [
                'id' => 2,
                'name' => 'Produk Konsumabel',
                'slug' => 'produk-konsumabel',
                'description' => 'Produk habis pakai untuk kebutuhan medis dan laboratorium',
                'icon' => 'fas fa-vial',
                'image' => 'https://via.placeholder.com/400x300',
                'product_count' => Product::byCategory('produk-konsumabel')->active()->count()
            ],
            [
                'id' => 3,
                'name' => 'Linen & Apparel RS',
                'slug' => 'linen-apparel-rs',
                'description' => 'Tekstil dan pakaian medis untuk rumah sakit',
                'icon' => 'fas fa-tshirt',
                'image' => 'https://via.placeholder.com/400x300',
                'product_count' => Product::byCategory('linen-apparel-rs')->active()->count()
            ],
            [
                'id' => 4,
                'name' => 'Jasa Konsultan & Maintenance',
                'slug' => 'jasa-konsultan-maintenance',
                'description' => 'Layanan konsultasi dan pemeliharaan peralatan medis',
                'icon' => 'fas fa-tools',
                'image' => 'https://via.placeholder.com/400x300',
                'product_count' => Product::byCategory('jasa-konsultan-maintenance')->active()->count()
            ]
        ];

        return view('products.index', compact('categories'));
    }

    public function category($category)
    {
        $categoryName = $this->getCategoryName($category);
        $products = $this->getProductsByCategory($category);
        
        return view('products.category', compact('category', 'categoryName', 'products'));
    }

    public function show($id)
    {
        $product = $this->getProductById($id);
        
        if (!$product) {
            abort(404);
        }
        
        $relatedProducts = $this->getRelatedProducts($product->category, $id);
        
        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $products = $this->searchProducts($query);
        
        return view('products.search', compact('products', 'query'));
    }

    public function getProductsByCategory($category)
    {
        // Get products from database
        return Product::byCategory($category)->active()->get()->toArray();
    }

    private function getProductById($id)
    {
        // Get product from database
        return Product::find($id);
    }

    private function getRelatedProducts($category, $excludeId)
    {
        // Get related products from database
        return Product::byCategory($category)->active()
            ->where('id', '!=', $excludeId)
            ->limit(4)
            ->get()
            ->toArray();
    }

    private function searchProducts($query)
    {
        // Search products in database
        return Product::active()
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('brand', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->get()
            ->toArray();
    }

    private function getCategoryName($category)
    {
        $names = [
            'alat-kesehatan-laboratorium' => 'Alat Kesehatan & Laboratorium',
            'produk-konsumabel' => 'Produk Konsumabel',
            'linen-apparel-rs' => 'Linen & Apparel RS',
            'jasa-konsultan-maintenance' => 'Jasa Konsultan & Maintenance'
        ];

        return $names[$category] ?? 'Kategori';
    }
}
