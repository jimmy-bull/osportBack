<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('catID');
            $table->string('attribute_type');
            $table->string('values');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_attributes');
    }
}

/** table Attribute-ways;
 * unique data,many data, Let User Enter Data;
 *    final send {
 *    {category:'cars'
 *    attribute: 'Brand',
 *    ways: 'unique data',
 *    values:['oo'ooo']},
 * }
 */
