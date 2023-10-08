<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuario', function(Blueprint $table) {
            $table->uuid('id')
                ->default(DB::raw('gen_random_uuid()'))
                ->primary()
            ;

            $table->string('email', 100)->unique();
            $table->string('nome', 30);
            $table->string('sobrenome', 60);
            $table->char('senha', 60);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
