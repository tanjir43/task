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
            'permissions'   =>  '[1,2,3,4,5,6,70,71,72,100,101,102,200,201,202,203,204]',
            'created_by'    => '0'
        ],
        [
            'name'          =>  'User',
            'permissions'   =>  '[1,2,3,4,5,6,209,210,211]',
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
