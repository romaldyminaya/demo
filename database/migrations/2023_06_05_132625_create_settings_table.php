<?php

use App\Models\Settings;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('slogan')->nullable();
            $table->string('nif_type')->nullable();
            $table->string('nif')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number_1')->nullable();
            $table->string('phone_number_2')->nullable();
            $table->string('logo')->nullable();
            $table->string('city')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('local_currency')->default('DOP')->nullable();
            $table->string('functional_currency')->default('DOP')->nullable();
            $table->string('default_ar_control_account')->nullable();
            $table->string('default_ap_control_account')->nullable();
            $table->string('default_bank_control_account')->nullable();
            $table->string('default_cashbox_control_account')->nullable();
            $table->string('quotation_due_days')->default(30)->nullable();
            $table->string('primary_color')->default('#0f172a')->nullable();
            $table->string('secondary_color')->default('#64748b')->nullable();
            $table->string('primary_color_light')->default('#f1f5f9')->nullable();
            $table->text('sales_invoice_footer')->nullable();
            $table->text('quotation_footer')->nullable();
            $table->boolean('disable_logo')->default(false);
            $table->boolean('disable_tax')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });

        $settings = new Settings();

        $settings->save();
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
};
