<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopLocaleSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_locale_site', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('parentid')->nullable();
            $table->string('siteid')->default('')->unique();
            $table->varbinary('code', 255)->default('')->unique('unq_mslocsi_code');
            $table->string('label')->default('')->index('idx_mslocsi_label');
            $table->string('icon')->default('');
            $table->string('logo')->default('{}');
            $table->text('config');
            $table->varbinary('supplierid', 36)->default('');
            $table->string('theme', 32)->default('');
            $table->smallInteger('level');
            $table->integer('nleft');
            $table->integer('nright');
            $table->smallInteger('status');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->index(['nleft', 'nright', 'level', 'parentid'], 'idx_mslocsi_nlt_nrt_lvl_pid');
            $table->index(['level', 'status'], 'idx_mslocsi_level_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_locale_site');
    }
}
