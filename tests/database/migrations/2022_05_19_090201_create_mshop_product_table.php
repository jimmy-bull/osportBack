<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_product', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('siteid');
            $table->string('dataset', 64)->default('');
            $table->varbinary('type', 64);
            $table->varbinary('code', 64);
            $table->string('label')->default('');
            $table->string('url')->default('');
            $table->text('config');
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->double('scale')->default(1);
            $table->decimal('rating', 4, 2)->default(0.00);
            $table->integer('ratings')->default(0);
            $table->smallInteger('instock')->default(0);
            $table->smallInteger('status');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            $table->string('target');
            
            $table->unique(['siteid', 'code'], 'unq_mspro_siteid_code');
            $table->index(['id', 'siteid', 'status', 'start', 'end', 'rating'], 'idx_mspro_id_sid_stat_st_end_rt');
            $table->index(['siteid', 'status', 'start', 'end', 'rating'], 'idx_mspro_sid_stat_st_end_rt');
            $table->index(['siteid', 'rating'], 'idx_mspro_sid_rating');
            $table->index(['siteid', 'label'], 'idx_mspro_sid_label');
            $table->index(['siteid', 'start'], 'idx_mspro_sid_start');
            $table->index(['siteid', 'end'], 'idx_mspro_sid_end');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_product');
    }
}
