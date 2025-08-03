<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMA - Agensi Manajemen Kampanye</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-900 via-purple-900 to-indigo-900 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white/10 backdrop-blur-md border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-white">COMA</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-white hover:text-blue-200 transition">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-6">
                    Dapatkan Uang Melalui
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                        Kampanye
                    </span>
                </h1>
                <p class="text-xl text-gray-300 mb-8 max-w-3xl mx-auto">
                    Bergabunglah dengan platform agensi periklanan modern kami. Selesaikan tugas kampanye, dapatkan poin, dan konversi menjadi uang nyata. Mulai perjalanan Anda hari ini!
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-4 rounded-lg text-lg font-semibold transition transform hover:scale-105">
                        Mulai Gratis
                    </a>
                    <a href="#features" class="border border-white/30 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white/10 transition">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="py-24 bg-white/5 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white mb-4">Mengapa Memilih COMA?</h2>
                <p class="text-gray-300 text-lg">Semua yang Anda butuhkan untuk menghasilkan uang melalui partisipasi kampanye</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-xl border border-white/20 hover:bg-white/20 transition">
                    <div class="text-blue-400 text-4xl mb-4">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-4">Tugas Kampanye</h3>
                    <p class="text-gray-300">Selesaikan berbagai kampanye periklanan dan tugas pemasaran untuk mendapatkan poin</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-xl border border-white/20 hover:bg-white/20 transition">
                    <div class="text-purple-400 text-4xl mb-4">
                        <i class="fas fa-coins"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-4">Sistem Poin</h3>
                    <p class="text-gray-300">Dapatkan poin untuk setiap tugas yang diselesaikan. 1 poin = Rp1.000 uang nyata</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-xl border border-white/20 hover:bg-white/20 transition">
                    <div class="text-green-400 text-4xl mb-4">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-4">Dompet Digital</h3>
                    <p class="text-gray-300">Konversi poin Anda menjadi uang digital dan tarik ke rekening bank Anda</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-24">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-white mb-4">Siap Mulai Menghasilkan?</h2>
            <p class="text-gray-300 text-lg mb-8">Bergabunglah dengan ribuan pengguna yang sudah menghasilkan uang melalui platform kami</p>
            <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-4 rounded-lg text-lg font-semibold transition transform hover:scale-105 inline-block">
                Mulai Menghasilkan Sekarang
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-black/20 border-t border-white/20 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-400">&copy; 2024 COMA. Semua hak dilindungi.</p>
        </div>
    </footer>
</body>
</html>
