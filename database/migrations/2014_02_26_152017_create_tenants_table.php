<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id'); //Plano ID
            $table->string('cnpj')->unique();
            $table->string('name')->unique();
            $table->string('url')->unique();
            $table->string('email')->unique();
            $table->string('logo')->nullable();


            //////////////////////////////////////////////////////////////////////////////
            ///Status tenant (se inativar 'N' ele perde o acesso ao sistema)//////////////
            //////////////////////////////////////////////////////////////////////////////
            $table->enum('active', ['Y', 'N'])->default('Y');


            //////////////////////////////////////////////////////////////////////////////
            ///////////////////////////////Subscrição/////////////////////////////////////
            //////////////////////////////////////////////////////////////////////////////
            $table->date('subscription')->nullable(); //Data que se inscreveu
            $table->date('expires_at')->nullable(); //Data que expirará o acesso
            $table->string('subscription_id', 255)->nullable(); //Indetificador do Gateway
            //$table->integer('subscription_plan')->nullable(); //Plano
            $table->boolean('subscription_active')->default(false); //Assinatura ativa ( porque )
            $table->boolean('subscription_suspended')->default(false); //Assinatura cancelada

            $table->timestamps();


            $table->foreign("plan_id")->references('id')->on('plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenants');
    }
}
