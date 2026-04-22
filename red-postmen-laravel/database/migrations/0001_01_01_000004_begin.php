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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'coach', 'user']);
        });

        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('label', length: 255);
            $table->string('description', length: 2000)->nullable();
            $table->geometry('delimitation', subtype: 'polygon', srid: 4326)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
        Schema::dropIfExists('areas');
    }
};
