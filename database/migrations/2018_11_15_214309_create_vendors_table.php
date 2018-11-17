<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        Schema::table('expenses', function (Blueprint $table) {
            $table->unsignedSmallInteger('vendor_id');
        });
        $vendors = DB::table('expenses')
        ->selectRaw('DISTINCT vendor')->get()->pluck('vendor');
        foreach ($vendors  as $key => $vendor) {
            DB::table('vendors')->insert(['name' => $vendor]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropColumn('vendor_id');
        });
        Schema::dropIfExists('vendors');
    }
}
