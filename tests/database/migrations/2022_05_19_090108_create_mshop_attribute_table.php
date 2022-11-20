<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_attribute', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('siteid');
            $table->varbinary('key', 32)->default('');
            $table->varbinary('type', 64);
            $table->string('domain', 32);
            $table->varbinary('code', 255);
            $table->string('label');
            $table->integer('pos');
            $table->smallInteger('status');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->unique(['domain', 'siteid', 'type', 'code'], 'unq_msatt_dom_sid_type_code');
            $table->index(['domain', 'siteid', 'status', 'type', 'pos'], 'idx_msatt_dom_sid_stat_typ_pos');
            $table->index(['siteid', 'status'], 'idx_msatt_sid_status');
            $table->index(['siteid', 'label'], 'idx_msatt_sid_label');
            $table->index(['siteid', 'code'], 'idx_msatt_sid_code');
            $table->index(['siteid', 'type'], 'idx_msatt_sid_type');
            $table->index(['key', 'siteid'], 'idx_msatt_key_sid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_attribute');
    }
}
