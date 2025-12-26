<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        DB::statement(
            'ALTER TABLE comentarios ADD CONSTRAINT chk_calificacion_range CHECK (calificacion BETWEEN 0 AND 10)'
        );
    }

    public function down()
    {
        DB::statement(
            'ALTER TABLE comentarios DROP CHECK chk_calificacion_range'
        );
    }
};
