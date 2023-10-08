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
        Schema::create('categoria', function(Blueprint $table) {
            $table->uuid('id')
                ->default(DB::raw('gen_random_uuid()'))
                ->primary()
            ;

            $table->uuid('categoria_pai_id')->nullable();
            $table->string('nome', 50);
            $table->timestamps();
        });

        Schema::table('categoria', function(Blueprint $table) {
            $table->foreign('categoria_pai_id')
                ->references('id')
                ->on('categoria')
                ->restrictOnDelete()
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria');
    }
};
