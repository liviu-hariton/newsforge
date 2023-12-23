<?php

use App\Models\ContactOptionType;
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
        Schema::create('contact_options', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(ContactOptionType::class)->constrained('contact_option_types');

            $table->string('value');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('active')->default(false);
            $table->integer('sort_order')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_options');
    }
};
