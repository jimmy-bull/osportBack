<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopIndexAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_index_attribute', function (Blueprint $table) {
            $table->integer('prodid');
            $table->integer('artid')->nullable();
            $table->string('siteid');
            $table->varbinary('attrid', 36);
            $table->varbinary('listtype', 64);
            $table->varbinary('type', 64);
            $table->varbinary('code', 255);
            $table->dateTime('mtime');
            
            $table->unique(['prodid', 'siteid', 'attrid', 'listtype'], 'unq_msindat_p_s_aid_lt');
            $table->index(['prodid', 'siteid', 'listtype', 'type', 'code'], 'idx_msindat_p_s_lt_t_c');
            $table->index(['siteid', 'attrid', 'listtype'], 'idx_msindat_s_at_lt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_index_attribute');
    }
}
