<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesan Kontak Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .content {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
        }
        .field {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            color: #495057;
        }
        .value {
            margin-top: 5px;
            padding: 8px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
        .message-content {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 4px;
            border-left: 4px solid #007bff;
        }
        .footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            font-size: 12px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>🔔 Pesan Kontak Baru dari Website MSAPT</h2>
        <p>Anda menerima pesan kontak baru pada {{ $contact->created_at->format('d F Y, H:i') }} WIB</p>
    </div>

    <div class="content">
        <div class="field">
            <div class="label">👤 Nama:</div>
            <div class="value">{{ $contact->name }}</div>
        </div>

        <div class="field">
            <div class="label">📧 Email:</div>
            <div class="value">{{ $contact->email }}</div>
        </div>

        <div class="field">
            <div class="label">📞 Telepon:</div>
            <div class="value">{{ $contact->phone }}</div>
        </div>

        @if($contact->company)
        <div class="field">
            <div class="label">🏢 Perusahaan:</div>
            <div class="value">{{ $contact->company }}</div>
        </div>
        @endif

        <div class="field">
            <div class="label">📋 Subjek:</div>
            <div class="value">{{ $contact->subject }}</div>
        </div>

        <div class="field">
            <div class="label">💬 Pesan:</div>
            <div class="message-content">{{ $contact->message }}</div>
        </div>
    </div>

    <div class="footer">
        <p><strong>PT. Mitra Jaya Selaras Abadi</strong></p>
        <p>Email ini dikirim otomatis dari sistem website www.msapt.co.id</p>
        <p>Silakan balas langsung ke email pengirim: {{ $contact->email }}</p>
    </div>
</body>
</html>
