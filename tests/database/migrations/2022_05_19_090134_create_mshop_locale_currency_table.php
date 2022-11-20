<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopLocaleCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_locale_currency', function (Blueprint $table) {
            $table->string('id', 3)->primary();
            $table->string('label')->index('idx_msloccu_label');
            $table->smallInteger('status')->index('idx_msloccu_status');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_locale_currency');
    }
}
