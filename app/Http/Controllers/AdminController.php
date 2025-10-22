<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Product;
use App\Models\AdminLog;
use App\Models\ProjectGallery;
use App\Models\TrustedClient;
use App\Models\Contact;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Use database authentication with User model
        $user = User::where('email', $credentials['email'])->first();
        
        if ($user && Hash::check($credentials['password'], $user->password)) {
            session(['admin_authenticated' => true]);
            session(['admin_user' => $user->toArray()]);
            
            // Log admin login
            AdminLog::logActivity('login', 'Admin berhasil login ke sistem: ' . $user->email);
            
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
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
            'total_contacts' => Contact::count(),
            'unread_contacts' => Contact::whereNull('read_at')->count(),
            'contacts_today' => Contact::whereDate('created_at', today())->count(),
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
    public function projectGalleries(Request $request)
    {
        $sortBy = $request->get('sort', 'year');
        $sortDirection = $request->get('direction', 'desc');
        
        // Validate sort parameters
        $allowedSorts = ['id', 'client', 'category', 'year'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'year';
        }
        
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }
        
        $galleries = ProjectGallery::orderBy($sortBy, $sortDirection)->get();
        
        return view('admin.project-galleries.index', compact('galleries', 'sortBy', 'sortDirection'));
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
    public function trustedClients(Request $request)
    {
        $sortBy = $request->get('sort', 'hospital_name');
        $sortDirection = $request->get('direction', 'asc');
        
        // Validate sort parameters
        $allowedSorts = ['id', 'hospital_name', 'created_at'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'hospital_name';
        }
        
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }
        
        $clients = TrustedClient::orderBy($sortBy, $sortDirection)->get();
        
        return view('admin.trusted-clients.index', compact('clients', 'sortBy', 'sortDirection'));
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

    // Contact Messages Management
    public function contacts(Request $request)
    {
        $query = Contact::query();
        
        // Filter by status
        $status = $request->get('status', 'all');
        if ($status === 'unread') {
            $query->whereNull('read_at');
        } elseif ($status === 'read') {
            $query->whereNotNull('read_at');
        }
        
        // Search functionality
        $search = $request->get('search');
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }
        
        // Sort by newest first
        $contacts = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.contacts.index', compact('contacts', 'status', 'search'));
    }

    public function showContact($id)
    {
        $contact = Contact::findOrFail($id);
        
        // Mark as read if not already read
        if (!$contact->isRead()) {
            $contact->markAsRead();
            
            AdminLog::logActivity(
                'read', 
                "Membaca pesan kontak dari: {$contact->name}",
                'contact',
                $contact->id,
                $contact->name
            );
        }
        
        return view('admin.contacts.show', compact('contact'));
    }

    public function markContactAsRead($id)
    {
        $contact = Contact::findOrFail($id);
        
        if (!$contact->isRead()) {
            $contact->markAsRead();
            
            AdminLog::logActivity(
                'read', 
                "Menandai pesan kontak sebagai dibaca: {$contact->name}",
                'contact',
                $contact->id,
                $contact->name
            );
        }
        
        return response()->json(['success' => true]);
    }

    public function markContactAsUnread($id)
    {
        $contact = Contact::findOrFail($id);
        
        $contact->update(['read_at' => null]);
        
        AdminLog::logActivity(
            'unread', 
            "Menandai pesan kontak sebagai belum dibaca: {$contact->name}",
            'contact',
            $contact->id,
            $contact->name
        );
        
        return response()->json(['success' => true]);
    }

    public function destroyContact($id)
    {
        $contact = Contact::findOrFail($id);
        $contactName = $contact->name;
        
        AdminLog::logActivity(
            'delete', 
            "Menghapus pesan kontak dari: {$contactName}",
            'contact',
            $contact->id,
            $contactName,
            $contact->toArray(),
            null
        );
        
        $contact->delete();
        
        return redirect()->route('admin.contacts')->with('success', 'Pesan kontak berhasil dihapus!');
    }

    public function bulkActionContacts(Request $request)
    {
        $action = $request->get('action');
        $contactIds = $request->get('contact_ids', []);
        
        if (empty($contactIds)) {
            return back()->with('error', 'Pilih minimal satu pesan kontak.');
        }
        
        $contacts = Contact::whereIn('id', $contactIds)->get();
        
        switch ($action) {
            case 'mark_read':
                foreach ($contacts as $contact) {
                    if (!$contact->isRead()) {
                        $contact->markAsRead();
                    }
                }
                AdminLog::logActivity('bulk_read', "Menandai " . count($contacts) . " pesan kontak sebagai dibaca");
                return back()->with('success', count($contacts) . ' pesan kontak berhasil ditandai sebagai dibaca.');
                
            case 'mark_unread':
                foreach ($contacts as $contact) {
                    $contact->update(['read_at' => null]);
                }
                AdminLog::logActivity('bulk_unread', "Menandai " . count($contacts) . " pesan kontak sebagai belum dibaca");
                return back()->with('success', count($contacts) . ' pesan kontak berhasil ditandai sebagai belum dibaca.');
                
            case 'delete':
                $contactNames = $contacts->pluck('name')->implode(', ');
                $contacts->each->delete();
                AdminLog::logActivity('bulk_delete', "Menghapus " . count($contacts) . " pesan kontak: {$contactNames}");
                return back()->with('success', count($contacts) . ' pesan kontak berhasil dihapus.');
                
            default:
                return back()->with('error', 'Aksi tidak valid.');
        }
    }

}
