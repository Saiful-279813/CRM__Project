<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('site_title')->nullable();
            $table->string('logo')->nullable();
            $table->string('default_image')->nullable();
            $table->string('copyright_message')->nullable();
            $table->string('copyright_name')->nullable();
            $table->string('copyright_url')->nullable();
            $table->string('design_develop_by_text')->nullable();
            $table->string('design_develop_by_name')->nullable();
            $table->string('design_develop_by_url')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('email')->nullable();
            $table->string('email2')->nullable();
            $table->text('address')->nullable();
            $table->string('website_link')->nullable();
            $table->string('default_url')->nullable();
            $table->string('fav_icon')->nullable();
            $table->string('_token')->nullable();
            $table->string('ab_page_title')->nullable();
            $table->longText('ab_page_description')->nullable();
            $table->string('ab_page_image')->nullable();
            $table->timestamps();
        });

        // insert data in database
        Setting::insert([
          'site_name' => 'Sowaq Ecommace'
        ]);
        // insert data in database
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
