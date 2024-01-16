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
        Schema::create('contact_field_types', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('type');
            $table->string('icon')->nullable();
        });

        // Seed the table with the predefined contact field types
        $this->seedFieldTypes();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_field_types');
    }

    private function seedFieldTypes(): void
    {
        $data = [
            [
                'name' => 'Text',
                'type' => 'text',
                'icon' => 'fas fa-i-cursor',
            ],
            [
                'name' => 'Date & time',
                'type' => 'datetime-local',
                'icon' => 'fas fa-business-time',
            ],
            [
                'name' => 'Date',
                'type' => 'date',
                'icon' => 'fas fa-calendar-alt',
            ],
            [
                'name' => 'Time',
                'type' => 'time',
                'icon' => 'fas fa-clock',
            ],
            [
                'name' => 'Number',
                'type' => 'number',
                'icon' => 'fas fa-sort-numeric-up-alt',
            ],
            [
                'name' => 'Email address',
                'type' => 'email',
                'icon' => 'fas fa-at',
            ],
            [
                'name' => 'Website',
                'type' => 'url',
                'icon' => 'fas fa-globe',
            ],
            [
                'name' => 'Phone',
                'type' => 'tel',
                'icon' => 'fas fa-phone-square',
            ],
            [
                'name' => 'Color',
                'type' => 'color',
                'icon' => 'fas fa-palette',
            ],
            [
                'name' => 'File',
                'type' => 'file',
                'icon' => 'fas fa-file',
            ],
            [
                'name' => 'Password',
                'type' => 'password',
                'icon' => 'fas fa-key',
            ],
            [
                'name' => 'Text area',
                'type' => 'textarea',
                'icon' => 'fas fa-paragraph',
            ],
            [
                'name' => 'Radio',
                'type' => 'radio',
                'icon' => 'far fa-dot-circle',
            ],
            [
                'name' => 'Checkbox',
                'type' => 'checkbox',
                'icon' => 'far fa-check-square',
            ],
            [
                'name' => 'Select list',
                'type' => 'select',
                'icon' => 'fas fa-stream',
            ],
        ];

        foreach($data as $item) {
            DB::table('contact_field_types')->insert($item);
        }
    }
};
