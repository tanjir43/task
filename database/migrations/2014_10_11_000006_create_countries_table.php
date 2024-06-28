<?php

use App\Models\Country;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('native');
            $table->string('phone');
            $table->string('continent');
            $table->string('capital');
            $table->string('currency');
            $table->string('languages');
            $table->timestamps();
        });

        $datas = [
            
            ['BD', 'Bangladesh', 'Bangladesh', '880', 'AS', 'Dhaka', 'BDT', 'bn'],
            ['SG', 'Singapore', 'Singapore', '65', 'AS', 'Singapore', 'SGD', 'en,ms,ta,zh'],
        ];

        foreach($datas as $data){
            $new = new Country();
            $new->code      = $data[0];
            $new->name      = $data[1];
            $new->native    = $data[2];
            $new->phone     = $data[3];
            $new->continent = $data[4];
            $new->capital   = $data[5];
            $new->currency  = $data[6];
            $new->languages = $data[7];
            $new->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
