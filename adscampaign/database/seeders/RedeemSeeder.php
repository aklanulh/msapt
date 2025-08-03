<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Redeem;
use App\Models\User;

class RedeemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ambil semua data pengguna
        $users = User::all();

        // Daftar nama bank
        $bankNames = ['BCA', 'BRI', 'BNI', 'MANDIRI', 'GOPAY', 'SHOPEEPAY'];

        // Loop melalui setiap pengguna dan buat 3 entri redeem untuk setiap pengguna
        foreach ($users as $user) {
            // Untuk setiap pengguna, kita akan buat satu penarikan dengan status 'pending', 'approve', dan 'reject'
            for ($i = 1; $i <= 3; $i++) {
                // Ambil nama bank secara acak
                $bankName = $bankNames[array_rand($bankNames)];

                // Buat nomor rekening acak
                $accountNumber = mt_rand(1000000000, 9999999999);

                // Buat jumlah acak antara 50 dan 70
                $amount = mt_rand(50, 70);

                // Ambil status secara acak
                $statusOptions = ['pending', 'approve', 'reject'];
                $status = $statusOptions[$i - 1];

                // Buat entri penarikan
                Redeem::create([
                    'user_id' => $user->id,
                    'owner_name' => $user->name,
                    'bank_name' => $bankName,
                    'account_number' => $accountNumber,
                    'amount' => $amount,
                    'status' => $status,
                ]);
            }
        }
    }
}
