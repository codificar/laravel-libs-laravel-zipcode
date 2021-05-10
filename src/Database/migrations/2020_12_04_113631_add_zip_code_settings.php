<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Codificar\ZipCode\Factory\ZipCodeFactory;

//Internal Uses
use Codificar\ZipCode\Models\ZipCodeSettings;
use Illuminate\Database\Migrations\Migration;

class AddZipCodeSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $settingCategory = ZipCodeSettings::getZipCodeCategory();

        ZipCodeSettings::updateOrCreate(array('key' => 'zipcode_provider'), array('value' => ZipCodeFactory::Canducci, 'page' => 1, 'category' => $settingCategory));
        ZipCodeSettings::updateOrCreate(array('key' => 'zipcode_key'), array('value' => '', 'page' => 1, 'category' => $settingCategory));

        ZipCodeSettings::updateOrCreate(array('key' => 'zipcode_redundancy'), array('value' => '1', 'page' => 1, 'category' => $settingCategory));

        ZipCodeSettings::updateOrCreate(array('key' => 'zipcode_redundancy_provider'), array('value' => ZipCodeFactory::CepAberto, 'page' => 1, 'category' => $settingCategory));
        ZipCodeSettings::updateOrCreate(array('key' => 'zipcode_redundancy_key'), array('value' => '639f483b151675817ee8e39aea195eb5', 'page' => 1, 'category' => $settingCategory));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
