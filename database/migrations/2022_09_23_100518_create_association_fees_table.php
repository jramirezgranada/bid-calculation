<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('association_fees', function (Blueprint $table) {
            $table->id();
            $table->double('amount_from');
            $table->double('amount_to')->nullable();
            $table->double('amount_value');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('association_fees');
    }
};
