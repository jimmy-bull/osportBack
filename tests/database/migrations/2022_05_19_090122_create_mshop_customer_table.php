<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_customer', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('siteid')->default('');
            $table->string('code');
            $table->string('label');
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
            $table->date('vdate')->nullable();
            $table->string('password');
            $table->smallInteger('status');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->unique(['siteid', 'code'], 'unq_mscus_sid_code');
            $table->index(['siteid', 'langid'], 'idx_mscus_sid_langid');
            $table->index(['siteid', 'lastname', 'firstname'], 'idx_mscus_sid_last_first');
            $table->index(['siteid', 'postal', 'address1'], 'idx_mscus_sid_post_addr1');
            $table->index(['siteid', 'postal', 'city'], 'idx_mscus_sid_post_city');
            $table->index(['siteid', 'city'], 'idx_mscus_sid_city');
            $table->index(['siteid', 'email'], 'idx_mscus_sid_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_customer');
    }
}
