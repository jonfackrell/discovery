<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscoveryApiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discovery_settings', function (Blueprint $table) {
            $table->id();
            $table->string('auth_token')->nullable();
            $table->datetime('auth_token_expires_at')->nullable();
            $table->json('info')->nullable();
            $table->timestamps();
        });

        $settings = new \JonFackrell\DiscoveryApi\Models\DiscoverySetting();
        $settings->auth_token_expires_at = now();
        $settings->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discovery_settings');
    }
}
