<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('roleName', 50)->unique();
            $table->string('description',100)->nullable();
            $table->timestamps();
        });
        DB::table('roles')->insert(
            array(
                'roleName' => 'Administrator',
                'description' => "Administrator user with all privileges",
                'created_at'=>now(),
                'updated_at'=>now(),
            ),
        );
        DB::table('roles')->insert(
            array(
                'roleName' => 'Consultant',
                'description' => "A Consultant/Councellor for people with different problems",
                'created_at'=>now(),
                'updated_at'=>now(),
            ),
        );
        DB::table('roles')->insert(
            array(
                'roleName' => 'Visitor',
                'description' => "A Visitor user, mostly in seek of support for problems",
                'created_at'=>now(),
                'updated_at'=>now(),
            ),
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
