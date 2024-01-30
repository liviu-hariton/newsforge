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
        Schema::table('contact_replies', function (Blueprint $table) {
            $table->boolean('is_draft')->after('attachments')->default(0);
            $table->timestamp('sent_at')->nullable()->after('is_draft');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_replies', function (Blueprint $table) {
            $table->dropColumn('is_draft');
            $table->dropColumn('sent_at');
        });
    }
};
