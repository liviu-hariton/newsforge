<?php

use App\Models\ContactFieldType;
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
        Schema::create('contact_forms', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->boolean('name_as_placeholder')->default(false);
            $table->text('description')->nullable();
            $table->text('notes')->nullable();

            $table->foreignIdFor(ContactFieldType::class)->constrained('contact_field_types');

            $table->boolean('required')->default(false);
            $table->integer('max_length')->default('100');
            $table->string('extensions')->nullable();
            $table->integer('columns')->default('1');
            $table->boolean('active')->default(false);
            $table->integer('sort_order')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_forms');
    }
};
