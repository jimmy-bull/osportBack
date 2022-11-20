<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopIndexCatalogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_index_catalog', function (Blueprint $table) {
            $table->integer('prodid');
            $table->string('siteid');
            $table->varbinary('catid', 36);
            $table->varbinary('listtype', 64);
            $table->integer('pos');
            $table->dateTime('mtime');
            
            $table->unique(['prodid', 'siteid', 'catid', 'listtype', 'pos'], 'unq_msindca_p_s_cid_lt_po');
            $table->index(['siteid', 'catid', 'listtype', 'pos'], 'idx_msindca_s_ca_lt_po');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_index_catalog');
    }
}
