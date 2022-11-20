<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopLocaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_locale', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('siteid');
            $table->string('langid', 5);
            $table->string('currencyid', 3);
            $table->integer('pos');
            $table->smallInteger('status');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->unique(['siteid', 'langid', 'currencyid'], 'unq_msloc_sid_lang_curr');
            $table->index(['siteid', 'currencyid'], 'idx_msloc_sid_curid');
            $table->index(['siteid', 'status'], 'idx_msloc_sid_status');
            $table->index(['siteid', 'pos'], 'idx_msloc_sid_pos');
            $table->foreign('currencyid', 'fk_msloc_currid')->references('id')->on('mshop_locale_currency')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('langid', 'fk_msloc_langid')->references('id')->on('mshop_locale_language')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('siteid', 'fk_msloc_siteid')->references('siteid')->on('mshop_locale_site')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_locale');
    }
}
