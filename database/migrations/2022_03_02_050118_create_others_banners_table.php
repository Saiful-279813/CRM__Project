<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\OthersBanner;

class CreateOthersBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('others_banners', function (Blueprint $table) {
            $table->id();
            $table->string('special_offer_banner')->nullable();
            $table->string('special_offer_banner_title')->nullable();
            $table->string('newslatter_banner')->nullable();
            $table->string('newslatter_banner_backgournd')->nullable();
            $table->string('newslatter_banner_title')->nullable();
            $table->string('newslatter_banner_content')->nullable();
            $table->string('newslatter_banner_url')->nullable();
            $table->timestamps();
        });

        OthersBanner::insert([
          'special_offer_banner' => 'Update Others Banner Information'
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('others_banners');
    }
}
