<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopSupplierAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_supplier_address', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('parentid');
            $table->string('siteid');
            $table->string('company', 100);
            $table->string('vatid', 32);
            $table->string('salutation', 8);
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
            $table->smallInteger('pos');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->index(['siteid', 'parentid'], 'idx_mssupad_sid_rid');
            $table->foreign('parentid', 'fk_mssupad_pid')->references('id')->on('mshop_supplier')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_supplier_address');
    }
}
