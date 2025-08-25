<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Product;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Simple hardcoded admin credentials for demo
        if ($credentials['username'] === 'admin' && $credentials['password'] === 'admin123') {
            session(['admin_authenticated' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function dashboard()
    {
        $stats = [
            'total_products' => Product::active()->count(),
            'alat_kesehatan' => Product::active()->byCategory('alat-kesehatan-laboratorium')->count(),
            'konsumabel' => Product::active()->byCategory('produk-konsumabel')->count(),
            'linen_apparel' => Product::active()->byCategory('linen-apparel-rs')->count(),
            'jasa_konsultan' => Product::active()->byCategory('jasa-konsultan-maintenance')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function products()
    {
        $categories = [
            'alat-kesehatan-laboratorium' => 'Alat Kesehatan & Laboratorium',
            'produk-konsumabel' => 'Produk Konsumabel',
            'linen-apparel-rs' => 'Linen & Apparel RS',
            'jasa-konsultan-maintenance' => 'Jasa Konsultan & Maintenance'
        ];

        $allProducts = Product::active()->orderBy('category')->orderBy('name')->get();

        return view('admin.products.index', compact('allProducts', 'categories'));
    }

    public function productsByCategory($category)
    {
        $products = Product::active()->byCategory($category)->orderBy('name')->get();
        
        $categoryNames = [
            'alat-kesehatan-laboratorium' => 'Alat Kesehatan & Laboratorium',
            'produk-konsumabel' => 'Produk Konsumabel',
            'linen-apparel-rs' => 'Linen & Apparel RS',
            'jasa-konsultan-maintenance' => 'Jasa Konsultan & Maintenance'
        ];

        $categoryName = $categoryNames[$category] ?? 'Kategori';

        return view('admin.products.category', compact('products', 'category', 'categoryName'));
    }

    public function showProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    public function createProduct()
    {
        $categories = [
            'alat-kesehatan-laboratorium' => 'Alat Kesehatan & Laboratorium',
            'produk-konsumabel' => 'Produk Konsumabel',
            'linen-apparel-rs' => 'Linen & Apparel RS',
            'jasa-konsultan-maintenance' => 'Jasa Konsultan & Maintenance'
        ];
        
        return view('admin.products.create', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'brand' => 'nullable|string|max:255',
                'model' => 'nullable|string|max:255',
                'category' => 'required|string',
                'description' => 'nullable|string',
                'features' => 'nullable|string',
                'specs' => 'nullable|string',
                'applications' => 'nullable|string',
                'price_range' => 'nullable|string|max:255',
                'images' => 'nullable|array',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'is_active' => 'nullable|boolean'
            ]);

            // Convert textarea inputs to arrays
            if (!empty($validated['features'])) {
                $validated['features'] = array_filter(array_map('trim', explode("\n", $validated['features'])));
            } else {
                $validated['features'] = null;
            }
            
            if (!empty($validated['applications'])) {
                $validated['applications'] = array_filter(array_map('trim', explode("\n", $validated['applications'])));
            } else {
                $validated['applications'] = null;
            }
            
            if (!empty($validated['specs'])) {
                $specs = [];
                $lines = array_filter(array_map('trim', explode("\n", $validated['specs'])));
                foreach ($lines as $line) {
                    if (strpos($line, ':') !== false) {
                        [$key, $value] = explode(':', $line, 2);
                        $specs[trim($key)] = trim($value);
                    }
                }
                $validated['specs'] = !empty($specs) ? $specs : null;
            } else {
                $validated['specs'] = null;
            }

            // Handle image uploads
            if ($request->hasFile('images')) {
                $imagePaths = [];
                foreach ($request->file('images') as $image) {
                    $path = $image->store('products', 'public');
                    $imagePaths[] = $path;
                }
                $validated['images'] = $imagePaths;
            } else {
                $validated['images'] = null;
            }

            $validated['is_active'] = (bool) $request->input('is_active', 0);

            $product = Product::create($validated);

            return redirect()->route('admin.products')->with('success', 'Produk berhasil ditambahkan!');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating product: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan produk: ' . $e->getMessage())->withInput();
        }
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = [
            'alat-kesehatan-laboratorium' => 'Alat Kesehatan & Laboratorium',
            'produk-konsumabel' => 'Produk Konsumabel',
            'linen-apparel-rs' => 'Linen & Apparel RS',
            'jasa-konsultan-maintenance' => 'Jasa Konsultan & Maintenance'
        ];
        
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'specs' => 'nullable|string',
            'applications' => 'nullable|string',
            'price_range' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'nullable|boolean'
        ]);

        // Convert textarea inputs to arrays
        if ($validated['features']) {
            $validated['features'] = array_filter(array_map('trim', explode("\n", $validated['features'])));
        }
        if ($validated['applications']) {
            $validated['applications'] = array_filter(array_map('trim', explode("\n", $validated['applications'])));
        }
        if ($validated['specs']) {
            $specs = [];
            $lines = array_filter(array_map('trim', explode("\n", $validated['specs'])));
            foreach ($lines as $line) {
                if (strpos($line, ':') !== false) {
                    [$key, $value] = explode(':', $line, 2);
                    $specs[trim($key)] = trim($value);
                }
            }
            $validated['specs'] = $specs;
        }

        // Handle image uploads for update
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
            $validated['images'] = $imagePaths;
        } else {
            // Keep existing images if no new images uploaded
            unset($validated['images']);
        }

        $validated['is_active'] = (bool) $request->input('is_active', 0);

        $product->update($validated);

        return redirect()->route('admin.products')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Produk berhasil dihapus!');
    }

    public function logout()
    {
        session()->forget('admin_authenticated');
        return redirect()->route('admin.login');
    }

}
