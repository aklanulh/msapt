<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            // Check if columns exist before dropping them
            if (Schema::hasColumn('contacts', 'email_sent')) {
                $table->dropColumn('email_sent');
            }
            if (Schema::hasColumn('contacts', 'whatsapp_sent')) {
                $table->dropColumn('whatsapp_sent');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->boolean('email_sent')->default(false);
            $table->boolean('whatsapp_sent')->default(false);
        });
    }
};
