<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopAttributePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_attribute_property', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('parentid');
            $table->string('siteid');
            $table->varbinary('key', 103)->default('');
            $table->varbinary('type', 64);
            $table->string('langid', 5)->nullable();
            $table->string('value');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->unique(['parentid', 'siteid', 'type', 'langid', 'value'], 'unq_msattpr_sid_ty_lid_value');
            $table->index(['key', 'siteid'], 'fk_msattpr_key_sid');
            $table->foreign('parentid', 'fk_msattpr_pid')->references('id')->on('mshop_attribute')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_attribute_property');
    }
}
