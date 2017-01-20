<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoldingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holding_items', function($table) {
            $table->increments('id'); // id INT AUTO_INCREMENT PRIMARY KEY
            $table->string('ip', 50); // ip VARCHAR(100)
            $table->integer('price'); // price integer
            $table->integer('share'); // share integer
            $table->timestamps(); // created_at TIMESTAMP, updated_at TIMESTAMP
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('holding_items'); // DROP TABLE posts
    }
}
