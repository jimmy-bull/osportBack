<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopIndexSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_index_supplier', function (Blueprint $table) {
            $table->integer('prodid');
            $table->string('siteid');
            $table->varbinary('supid', 36);
            $table->varbinary('listtype', 64);
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->integer('pos');
            $table->dateTime('mtime');
            
            $table->unique(['prodid', 'siteid', 'supid', 'listtype', 'pos'], 'unq_msindsup_p_sid_supid_lt_po');
            $table->index(['prodid', 'latitude', 'longitude', 'siteid'], 'idx_msindsup_p_lat_lon_sid');
            $table->index(['siteid', 'supid', 'listtype', 'pos'], 'idx_msindsup_sid_supid_lt_po');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_index_supplier');
    }
}
