<?php

use App\Models\User;
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
        Schema::create('admin_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class)->constrained();

            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->string('public_name')->nullable();
            $table->string('public_email')->nullable();
            $table->string('public_phone')->nullable();
            $table->string('public_avatar')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_profiles');
    }
};
