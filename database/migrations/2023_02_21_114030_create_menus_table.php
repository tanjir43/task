<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    private $data = [
        [
            'id'        => 1,
            'parent'    => null,
            'name'      => 'Save / Update',
            'web'       => '',
            'app'       => '',
            'web_icon'  => '',
            'app_icon'  => '',
            'note'      => '',
            'note_l'    => '',
        ],
        [
            'id'        => 2,
            'parent'    => null,
            'name'      => 'Block / Unblock',
            'web'       => '',
            'app'       => '',
            'web_icon'  => '',
            'app_icon'  => '',
            'note'      => '',
            'note_l'    => '',
        ],
        [
            'id'        => 3,
            'parent'    => null,
            'name'      => 'Delete',
            'web'       => '',
            'app'       => '',
            'web_icon'  => '',
            'app_icon'  => '',
            'note'      => '',
            'note_l'    => '',
        ],
        [
            'id'        => 4,
            'parent'    => null,
            'name'      => 'Dashboard',
            'web'       => 'dashboard',
            ''       => '',
            'web_icon'  => 'uil uil-home-alt',
            'app_icon'  => '',
            'note'      => '',
            'note_l'    => '',
        ],

        #Employees
        [
            'id'        =>  70,
            'parent'    =>  null,
            'name'      =>  'Users',
            'web'       =>  'users',
            'app'       =>  '',
            'web_icon'  =>  'uil uil-users-alt',
            'app_icon'  =>  '',
            'note'      =>  '',
            'note_l'    =>  '',
        ],

        #Admin Section
        [
            'id'        => 100,
            'parent'    => null,
            'name'      => 'Admin Section',
            'web'       => 'admin-section',
            'app'       => '',
            'web_icon'  => 'uil uil-user',
            'app_icon'  => '',
            'note'      => '',
            'note_l'    => '',
        ],
        [
            'id'        => 101,
            'parent'    => 100,
            'name'      => 'Admission Query',
            'web'       => 'admission-query.index',
            'app'       => '',
            'web_icon'  => 'uil uil-user',
            'app_icon'  => '',
            'note'      => '',
            'note_l'    => '',
        ],
        [
            'id'        => 102,
            'parent'    => 100,
            'name'      => 'Complaint',
            'web'       => 'complaint.index',
            'app'       => '',
            'web_icon'  => 'uil uil-user',
            'app_icon'  => '',
            'note'      => '',
            'note_l'    => '',
        ],
        [
            'id'        => 103,
            'parent'    => 100,
            'name'      => 'Phone Call Log',
            'web'       => 'phone-call-log.index',
            'app'       => '',
            'web_icon'  => 'uil uil-user',
            'app_icon'  => '',
            'note'      => '',
            'note_l'    => '',
        ],
    ];
    #$all_menus_parent_id = [1,2,3,4,5,6,70,71,72,73,74,100,101,102,103,150,151,152,153,200,201,202,1000,1001,1002,2000,2001,2002,2003,2004,2005,2006,3000,3001,3002,3003,3004,3005,4000,4001,4002,4003,4004,4005,4006,4007,5000,5001,5002,5003,5004,5005,5006,5007,5008,5009,5010,5011,5012,5013,5014,6000,6001];
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('parent')->nullable();
            $table->string('name')->collation('utf16_general_ci');

            $table->string('web')->nullable();
            $table->string('web_icon')->nullable();
            
            $table->string('app')->nullable();
            $table->string('app_icon')->nullable();

            $table->string('note')->nullable();
            $table->string('note_l')->nullable();
            $table->timestamps();
        });
        DB::table('menus')->insert($this->data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
