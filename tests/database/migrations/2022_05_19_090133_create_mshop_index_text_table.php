<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopIndexTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_index_text', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('prodid');
            $table->string('siteid');
            $table->string('langid', 5)->nullable();
            $table->string('url');
            $table->string('name');
            $table->mediumText('content');
            $table->dateTime('mtime');
            
            $table->unique(['prodid', 'siteid', 'langid', 'url'], 'unq_msindte_pid_sid_lid_url');
            $table->index(['prodid', 'siteid', 'langid', 'name'], 'idx_msindte_pid_sid_lid_name');
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_index_text');
    }
}
