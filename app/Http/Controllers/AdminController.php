<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\AdminLog;
use App\Models\ProjectGallery;
use App\Models\TrustedClient;

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

        // Use database authentication with new admin credentials
        if ($credentials['username'] === 'ptmsaalkeslabbmhp' && $credentials['password'] === 'ptmsa112233') {
            session(['admin_authenticated' => true]);
            
            // Log admin login
            AdminLog::logActivity('login', 'Admin berhasil login ke sistem');
            
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

        $allProducts = Product::orderBy('category')->orderBy('name')->get();

        return view('admin.products.index', compact('allProducts', 'categories'));
    }

    public function productsByCategory($category)
    {
        $products = Product::byCategory($category)->orderBy('name')->get();
        
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

            // Log product creation
            AdminLog::logActivity(
                'create', 
                "Menambahkan produk baru: {$product->name}",
                'product',
                $product->id,
                $product->name,
                null,
                $validated
            );

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
        $oldValues = $product->toArray();
        
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

        // Log product update
        AdminLog::logActivity(
            'update', 
            "Memperbarui produk: {$product->name}",
            'product',
            $product->id,
            $product->name,
            $oldValues,
            $validated
        );

        return redirect()->route('admin.products')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);
        $productName = $product->name;
        
        // Log product deletion
        AdminLog::logActivity(
            'delete', 
            "Menghapus produk: {$productName}",
            'product',
            $product->id,
            $productName,
            $product->toArray(),
            null
        );
        
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Produk berhasil dihapus!');
    }

    public function logout()
    {
        // Log admin logout
        AdminLog::logActivity('logout', 'Admin logout dari sistem');
        
        session()->forget('admin_authenticated');
        return redirect()->route('admin.login');
    }

    public function logs()
    {
        $logs = AdminLog::orderBy('created_at', 'desc')->paginate(50);
        return view('admin.logs.index', compact('logs'));
    }

    // Project Gallery Management
    public function projectGalleries()
    {
        $galleries = ProjectGallery::orderBy('year', 'desc')->orderBy('client')->get();
        return view('admin.project-galleries.index', compact('galleries'));
    }

    public function createProjectGallery()
    {
        $categories = [
            'Alat Kesehatan' => 'Alat Kesehatan',
            'Alat Laboratorium' => 'Alat Laboratorium',
            'Alat Medis' => 'Alat Medis',
            'Jasa Konsultan' => 'Jasa Konsultan'
        ];
        
        return view('admin.project-galleries.create', compact('categories'));
    }

    public function storeProjectGallery(Request $request)
    {
        try {
            $validated = $request->validate([
                'client' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
                'description' => 'required|string',
                'images' => 'required|array|min:1',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'is_active' => 'nullable|boolean'
            ]);

            // Handle image uploads
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('project-galleries', 'public');
                $imagePaths[] = $path;
            }
            $validated['images'] = $imagePaths;
            $validated['is_active'] = (bool) $request->input('is_active', 1);

            $gallery = ProjectGallery::create($validated);

            AdminLog::logActivity(
                'create', 
                "Menambahkan galeri proyek: {$gallery->client}",
                'project_gallery',
                $gallery->id,
                $gallery->client,
                null,
                $validated
            );

            return redirect()->route('admin.project-galleries')->with('success', 'Galeri proyek berhasil ditambahkan!');
            
        } catch (\Exception $e) {
            Log::error('Error creating project gallery: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan galeri proyek: ' . $e->getMessage())->withInput();
        }
    }

    public function editProjectGallery($id)
    {
        $gallery = ProjectGallery::findOrFail($id);
        $categories = [
            'Alat Kesehatan' => 'Alat Kesehatan',
            'Alat Laboratorium' => 'Alat Laboratorium',
            'Alat Medis' => 'Alat Medis',
            'Jasa Konsultan' => 'Jasa Konsultan'
        ];
        
        return view('admin.project-galleries.edit', compact('gallery', 'categories'));
    }

    public function updateProjectGallery(Request $request, $id)
    {
        $gallery = ProjectGallery::findOrFail($id);
        $oldValues = $gallery->toArray();
        
        $validated = $request->validate([
            'client' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'description' => 'required|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'nullable|boolean'
        ]);

        // Handle image uploads for update
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('project-galleries', 'public');
                $imagePaths[] = $path;
            }
            $validated['images'] = $imagePaths;
        } else {
            unset($validated['images']);
        }

        $validated['is_active'] = (bool) $request->input('is_active', 1);
        $gallery->update($validated);

        AdminLog::logActivity(
            'update', 
            "Memperbarui galeri proyek: {$gallery->client}",
            'project_gallery',
            $gallery->id,
            $gallery->client,
            $oldValues,
            $validated
        );

        return redirect()->route('admin.project-galleries')->with('success', 'Galeri proyek berhasil diperbarui!');
    }

    public function destroyProjectGallery($id)
    {
        $gallery = ProjectGallery::findOrFail($id);
        $clientName = $gallery->client;
        
        AdminLog::logActivity(
            'delete', 
            "Menghapus galeri proyek: {$clientName}",
            'project_gallery',
            $gallery->id,
            $clientName,
            $gallery->toArray(),
            null
        );
        
        $gallery->delete();
        return redirect()->route('admin.project-galleries')->with('success', 'Galeri proyek berhasil dihapus!');
    }

    // Trusted Client Management
    public function trustedClients()
    {
        $clients = TrustedClient::orderBy('hospital_name')->get();
        return view('admin.trusted-clients.index', compact('clients'));
    }

    public function createTrustedClient()
    {
        return view('admin.trusted-clients.create');
    }

    public function storeTrustedClient(Request $request)
    {
        try {
            $validated = $request->validate([
                'hospital_name' => 'required|string|max:255',
                'is_active' => 'nullable|boolean'
            ]);

            $validated['is_active'] = (bool) $request->input('is_active', 1);
            $client = TrustedClient::create($validated);

            AdminLog::logActivity(
                'create', 
                "Menambahkan klien terpercaya: {$client->hospital_name}",
                'trusted_client',
                $client->id,
                $client->hospital_name,
                null,
                $validated
            );

            return redirect()->route('admin.trusted-clients')->with('success', 'Klien terpercaya berhasil ditambahkan!');
            
        } catch (\Exception $e) {
            Log::error('Error creating trusted client: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan klien terpercaya: ' . $e->getMessage())->withInput();
        }
    }

    public function editTrustedClient($id)
    {
        $client = TrustedClient::findOrFail($id);
        return view('admin.trusted-clients.edit', compact('client'));
    }

    public function updateTrustedClient(Request $request, $id)
    {
        $client = TrustedClient::findOrFail($id);
        $oldValues = $client->toArray();
        
        $validated = $request->validate([
            'hospital_name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean'
        ]);

        $validated['is_active'] = (bool) $request->input('is_active', 1);
        $client->update($validated);

        AdminLog::logActivity(
            'update', 
            "Memperbarui klien terpercaya: {$client->hospital_name}",
            'trusted_client',
            $client->id,
            $client->hospital_name,
            $oldValues,
            $validated
        );

        return redirect()->route('admin.trusted-clients')->with('success', 'Klien terpercaya berhasil diperbarui!');
    }

    public function destroyTrustedClient($id)
    {
        $client = TrustedClient::findOrFail($id);
        $hospitalName = $client->hospital_name;
        
        AdminLog::logActivity(
            'delete', 
            "Menghapus klien terpercaya: {$hospitalName}",
            'trusted_client',
            $client->id,
            $hospitalName,
            $client->toArray(),
            null
        );
        
        $client->delete();
        return redirect()->route('admin.trusted-clients')->with('success', 'Klien terpercaya berhasil dihapus!');
    }

}
