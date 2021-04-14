<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Codificar\ZipCode\Models\ZipCodeProfile;
use Illuminate\Database\Migrations\Migration;
use Codificar\ZipCode\Models\ZipCodePermission;

class AddZipCodeMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permission = ZipCodePermission::updateOrCreate(
            ['name' => 'ZipCode'],
            [
			'name' => 'ZipCode',
			'parent_id' => 2319,
			'order' => 917,
			'is_menu' => 1,
			'url' => '/admin/libs/zipcode/settings',
			'icon' => 'fa fa-address-card '
            ]
        );
       
		if($permission){
			$adminProfile = ZipCodeProfile::find(4);
			if($adminProfile) $adminProfile->permissions()->attach($permission->id);			
		}
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
