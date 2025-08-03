<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RFQController extends Controller
{
    public function create($product_id = null)
    {
        $product = null;
        if ($product_id) {
            // Get product details for pre-filling form
            $product = $this->getProductById($product_id);
        }

        return view('rfq.create', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'product_category' => 'required|string',
            'product_details' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'budget_range' => 'nullable|string',
            'delivery_timeline' => 'required|string',
            'additional_requirements' => 'nullable|string'
        ]);

        // In a real application, save to database and send notification
        
        return redirect()->route('rfq.create')->with('success', 'Permintaan penawaran Anda telah berhasil dikirim. Tim kami akan menghubungi Anda dalam 1x24 jam.');
    }

    private function getProductById($id)
    {
        // Sample product data - in real app, get from database
        return [
            'id' => $id,
            'name' => 'Monitor Pasien Multiparameter',
            'brand' => 'Philips',
            'model' => 'IntelliVue MX40',
            'category' => 'alat-kesehatan'
        ];
    }
}
