<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
			$table->string('address')->nullable();
			$table->string('mobile_no', 11)->nullable();
			$table->string('telephone', 11)->nullable();
			$table->date('dob')->nullable();
			$table->date('start_date')->nullable();
			$table->date('leave_date')->nullable();
			$table->enum('gender', ['male','female','other'])->nullable();
			$table->enum('marital_status', ['single','married','seperated','divorced','widowed'])->nullable();
			$table->enum('account_status',['enabled','disabled']);
			$table->string('reason_for_disable')->nullable();
			$table->enum('account_types',['U','A','Z']);
			$table->string('company_name');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
