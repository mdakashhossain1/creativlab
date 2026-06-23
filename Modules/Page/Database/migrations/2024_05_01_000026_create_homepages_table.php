<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('homepages', function (Blueprint $table) {
            $table->id();
            $table->string('intro_banner_one')->nullable();
            $table->string('intro_banner_two')->nullable();
            $table->string('customer_image')->nullable();
            $table->string('explore_image')->nullable();
            $table->string('explore_total_customer')->nullable();
            $table->string('explore_total_service')->nullable();
            $table->string('explore_total_job')->nullable();
            $table->string('join_seller_image')->nullable();
            $table->string('mobile_app_image')->nullable();
            $table->string('working_step_icon1')->nullable();
            $table->string('working_step_icon2')->nullable();
            $table->string('working_step_icon3')->nullable();
            $table->string('working_step_icon4')->nullable();
            $table->string('mobile_playstore')->nullable();
            $table->string('mobile_appstore')->nullable();
            $table->string('feature_icon1')->nullable();
            $table->string('feature_icon2')->nullable();
            $table->string('feature_icon3')->nullable();
            $table->string('feature_icon4')->nullable();
            $table->string('feature_icon5')->nullable();
            $table->string('home2_intro_bg')->nullable();
            $table->string('home2_intro_forground')->nullable();
            $table->text('home2_intro_tags')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('homepages'); }
};
