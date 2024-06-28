<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $data = [
        [
            'name'          => 'Administrator',
            'permissions'   =>  '[1,2,3,4,5,6,70,71,72,73,74,100,101,102,103,150,151,152,153,200,201,202,1000,1001,1002,2000,2001,2002,2003,2004,2005,2006,3000,3001,3002,3003,3004,3005,4000,4001,4002,4003,4004,4005,4006,4007,5000,5001,5002,5003,5004,5005,5006,5007,5008,5009,5010,5011,5012,5013,5014,6000,6001]',
            'created_by'    => '0'
        ],
        [
            'name'          =>  'User',
            'permissions'   =>  '[1,2,3,4,5,6,71,72,73,74,100,101,102,103,150,151,152,153,200,201,202,1000,1001,1002,2000,2001,2002,2003,2004,2005,2006,3000,3001,3002,3003,3004,3005,4000,4001,4002,4003,4004,4005,4006,4007,5000,5001,5002,5003,5004,5005,5006,5007,5008,5009,5010,5011,5012,5013,5014,6000,6001]',
            'created_by'    =>  '0'
        ],
    ];
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->collation('utf16_general_ci');
            $table->text('permissions')->nullable();

            $table->integer('created_by')->references('id')->on('users');
            $table->integer('updated_by')->nullable()->references('id')->on('users');
            $table->integer('deleted_by')->nullable()->references('id')->on('users');
            
            $table->softDeletes();
            $table->timestamps();
        });
        DB::table('roles')->insert($this->data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
