<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopOrderBaseAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_order_base_address', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('baseid');
            $table->string('siteid');
            $table->varbinary('addrid', 36);
            $table->varbinary('type', 64);
            $table->string('salutation', 8);
            $table->string('company', 100);
            $table->string('vatid', 32);
            $table->string('title', 64);
            $table->string('firstname', 64);
            $table->string('lastname', 64);
            $table->string('address1', 200);
            $table->string('address2', 200);
            $table->string('address3', 200);
            $table->string('postal', 16);
            $table->string('city', 200);
            $table->string('state', 200);
            $table->string('langid', 5)->nullable();
            $table->string('countryid', 2)->nullable();
            $table->string('telephone', 32);
            $table->string('telefax', 32);
            $table->string('email');
            $table->string('website');
            $table->double('longitude')->nullable();
            $table->double('latitude')->nullable();
            $table->date('birthday')->nullable();
            $table->integer('pos');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->unique(['baseid', 'type'], 'unq_msordbaad_bid_type');
            $table->index(['siteid', 'baseid', 'type'], 'idx_msordbaad_sid_bid_typ');
            $table->index(['baseid', 'siteid', 'lastname'], 'idx_msordbaad_bid_sid_lname');
            $table->index(['baseid', 'siteid', 'address1'], 'idx_msordbaad_bid_sid_addr1');
            $table->index(['baseid', 'siteid', 'postal'], 'idx_msordbaad_bid_sid_postal');
            $table->index(['baseid', 'siteid', 'city'], 'idx_msordbaad_bid_sid_city');
            $table->index(['baseid', 'siteid', 'email'], 'idx_msordbaad_bid_sid_email');
            $table->foreign('baseid', 'fk_msordbaad_baseid')->references('id')->on('mshop_order_base')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_order_base_address');
    }
}
