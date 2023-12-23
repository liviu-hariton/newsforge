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
        Schema::create('contact_option_types', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('icon')->nullable();
        });

        // Seed the table with the predefined contact option types
        $this->seedContactOptionTypes();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_option_types');
    }

    private function seedContactOptionTypes(): void
    {
        $data = [
            [
                'name' => 'Email',
                'icon' => 'fas fa-envelope',
            ],
            [
                'name' => 'Landline',
                'icon' => 'fas fa-phone-square',
            ],
            [
                'name' => 'Mobile phone',
                'icon' => 'fas fa-mobile-alt',
            ],
            [
                'name' => 'Fax',
                'icon' => 'fas fa-fax',
            ],
            [
                'name' => 'Pager',
                'icon' => 'fas fa-pager',
            ],
            [
                'name' => 'WhatsApp Messenger',
                'icon' => 'fab fa-whatsapp',
            ],
            [
                'name' => 'Facebook Messenger',
                'icon' => 'fab fa-facebook-messenger',
            ],
            [
                'name' => 'Telegram',
                'icon' => 'fab fa-telegram',
            ],
            [
                'name' => 'Website',
                'icon' => 'fas fa-globe',
            ],
            [
                'name' => 'Postal address',
                'icon' => 'far fa-building',
            ],
        ];

        foreach($data as $item) {
            DB::table('contact_option_types')->insert($item);
        }
    }
};
