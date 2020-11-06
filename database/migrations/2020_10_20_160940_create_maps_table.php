<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('maps.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/maps.php not loaded. Run [php artisan config:clear] and try again.');
        }

        Schema::create($tableNames['libraries'], function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create($tableNames['floors'], function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('library_id');
            $table->string('name');
            $table->string('url');
            $table->string('width');
            $table->string('height');
            $table->boolean('is_main')->default(false);
            $table->timestamps();

            $table->foreign('library_id')
                ->references('id')
                ->on('libraries')
                ->onDelete('cascade');
        });

        Schema::create($tableNames['range_groups'], function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('floor_id');
            $table->timestamps();

            $table->foreign('floor_id')
                ->references('id')
                ->on('floors')
                ->onDelete('cascade');
        });

        Schema::create($tableNames['ranges'], function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('floor_id')->nullable();
            $table->unsignedBigInteger('range_group_id')->nullable();
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();

            $table->foreign('floor_id')
                ->references('id')
                ->on('floors')
                ->onDelete('cascade');

            $table->foreign('range_group_id')
                ->references('id')
                ->on('range_groups')
                ->onDelete('cascade');
        });

        Schema::create($tableNames['categories'], function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create($tableNames['locations'], function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('room')->nullable();
            $table->unsignedBigInteger('floor_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->float('x')->nullable();
            $table->float('y')->nullable();
            $table->timestamps();

            $table->foreign('floor_id')
                ->references('id')
                ->on('floors')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });

        Schema::create($tableNames['amenities'], function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->timestamps();
        });

        Schema::create($tableNames['amenity_location'], function (Blueprint $table) {
            $table->string('amenity_id');
            $table->string('location_id');
            $table->timestamps();

            $table->primary(['amenity_id', 'location_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('maps.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/maps.php not loaded. Run [php artisan config:clear] and try again.');
        }

        Schema::dropIfExists($tableNames['categories']);
        Schema::dropIfExists($tableNames['locations']);
        Schema::dropIfExists($tableNames['ranges']);
        Schema::dropIfExists($tableNames['range_groups']);
        Schema::dropIfExists($tableNames['floors']);
        Schema::dropIfExists($tableNames['libraries']);
    }
}
