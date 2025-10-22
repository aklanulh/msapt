<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactFormSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function index()
    {
        $contact_info = [
            'address' => 'Ruko Maison Avenue MA.19, Kota Wisata, Cibubur, Kabupaten Bogor, 16820',
            'whatsapp' => '0811 9466 470',
            'email' => 'mitrajayaselarasabadi@gmail.com',
            'email_cs' => '',
            'email_alt' => '',
            'website' => 'www.msapt.co.id',
            'office_hours' => 'Senin - Jumat: 08:00 - 17:00 WIB',
            'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.748684284785!2d106.96004352475438!3d-6.381105261549892!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6995cd270379f1%3A0xc9fa186bdf6bb544!2sPT.%20MITRAJAYA%20SELARAS%20ABADI!5e0!3m2!1sen!2sid!4v1726110123456'
        ];

        return view('contact', compact('contact_info'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        try {
            // Step 1: Save to Database
            $contact = Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'company' => $request->company,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);

            // Step 2: Send Email Notification
            try {
                Mail::to('mitrajayaselarasabadi@gmail.com')
                    ->send(new ContactFormSubmitted($contact));
                
                $contact->update(['email_sent' => true]);
                Log::info('Contact email sent successfully', ['contact_id' => $contact->id]);
            } catch (\Exception $e) {
                Log::error('Failed to send contact email', [
                    'contact_id' => $contact->id,
                    'error' => $e->getMessage()
                ]);
            }

            // Step 3: Send WhatsApp Notification (if configured)
            $this->sendWhatsAppNotification($contact);

            return redirect()->route('contact')->with('success', 'Pesan Anda telah berhasil dikirim. Tim kami akan segera menghubungi Anda.');

        } catch (\Exception $e) {
            Log::error('Failed to save contact form', [
                'error' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return redirect()->route('contact')
                ->with('error', 'Maaf, terjadi kesalahan saat mengirim pesan. Silakan coba lagi.')
                ->withInput();
        }
    }

    private function sendWhatsAppNotification(Contact $contact)
    {
        try {
            // Check if WhatsApp API is configured
            $whatsappToken = env('WHATSAPP_API_TOKEN');
            $whatsappUrl = env('WHATSAPP_API_URL');
            $whatsappNumber = '6281194664700'; // 0811 9466 470 in international format

            if (!$whatsappToken || !$whatsappUrl) {
                Log::info('WhatsApp API not configured, skipping notification');
                return;
            }

            $message = "🔔 *Pesan Kontak Baru MSAPT*\n\n" .
                      "👤 *Nama:* {$contact->name}\n" .
                      "🏢 *Perusahaan:* " . ($contact->company ?: 'Tidak disebutkan') . "\n" .
                      "📞 *Telepon:* {$contact->phone}\n" .
                      "📧 *Email:* {$contact->email}\n" .
                      "📋 *Subjek:* {$contact->subject}\n\n" .
                      "💬 *Pesan:*\n{$contact->message}\n\n" .
                      "⏰ Diterima: " . $contact->created_at->format('d/m/Y H:i') . " WIB";

            // Example for Fonnte.com API (adjust based on your chosen provider)
            $response = Http::post($whatsappUrl, [
                'target' => $whatsappNumber,
                'message' => $message,
                'token' => $whatsappToken
            ]);

            if ($response->successful()) {
                $contact->update(['whatsapp_sent' => true]);
                Log::info('WhatsApp notification sent successfully', ['contact_id' => $contact->id]);
            } else {
                Log::error('Failed to send WhatsApp notification', [
                    'contact_id' => $contact->id,
                    'response' => $response->body()
                ]);
            }

        } catch (\Exception $e) {
            Log::error('WhatsApp notification error', [
                'contact_id' => $contact->id,
                'error' => $e->getMessage()
            ]);
        }
    }
}
