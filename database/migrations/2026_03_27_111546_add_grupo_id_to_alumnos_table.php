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
    Schema::table('alumnos', function (Blueprint $table) {
        // Añadimos la llave foránea que apunta a la tabla grupos
        $table->foreignId('grupo_id')->nullable()->constrained('grupos')->onDelete('set null');
    });
}

public function down(): void
{
    Schema::table('alumnos', function (Blueprint $table) {
        $table->dropForeign(['grupo_id']);
        $table->dropColumn('grupo_id');
    });
}
};
