<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'model',
        'category',
        'description',
        'features',
        'specs',
        'applications',
        'price_range',
        'image',
        'images',
        'is_active'
    ];

    protected $casts = [
        'features' => 'array',
        'specs' => 'array',
        'applications' => 'array',
        'images' => 'array',
        'is_active' => 'boolean'
    ];

    // Scope untuk produk aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk kategori tertentu
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Accessor untuk nama kategori yang readable
    public function getCategoryNameAttribute()
    {
        $categories = [
            'alat-kesehatan-laboratorium' => 'Alat Kesehatan & Laboratorium',
            'produk-konsumabel' => 'Produk Konsumabel',
            'linen-apparel-rs' => 'Linen & Apparel RS',
            'jasa-konsultan-maintenance' => 'Jasa Konsultan & Maintenance'
        ];

        return $categories[$this->category] ?? $this->category;
    }

    // Method untuk mendapatkan icon kategori
    public function getCategoryIconAttribute()
    {
        $icons = [
            'alat-kesehatan-laboratorium' => 'fas fa-microscope',
            'produk-konsumabel' => 'fas fa-vial',
            'linen-apparel-rs' => 'fas fa-tshirt',
            'jasa-konsultan-maintenance' => 'fas fa-tools'
        ];

        return $icons[$this->category] ?? 'fas fa-box';
    }

    // Method untuk search
    public static function search($query)
    {
        return self::where('name', 'LIKE', "%{$query}%")
                   ->orWhere('brand', 'LIKE', "%{$query}%")
                   ->orWhere('model', 'LIKE', "%{$query}%")
                   ->orWhere('description', 'LIKE', "%{$query}%")
                   ->active();
    }
}
