<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopCustomerAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_customer_address', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('parentid');
            $table->string('siteid')->default('');
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
            $table->string('langid', 5)->nullable()->index('idx_mscusad_langid');
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
            
            $table->index(['siteid', 'lastname', 'firstname'], 'idx_mscusad_sid_last_first');
            $table->index(['siteid', 'postal', 'address1'], 'idx_mscusad_sid_post_addr1');
            $table->index(['siteid', 'postal', 'city'], 'idx_mscusad_sid_post_ci');
            $table->index(['siteid', 'city'], 'idx_mscusad_sid_city');
            $table->index(['siteid', 'email'], 'idx_mscusad_sid_email');
            $table->foreign('parentid', 'fk_mscusad_pid')->references('id')->on('mshop_customer')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_customer_address');
    }
}
