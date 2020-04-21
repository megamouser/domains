<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParamsToDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('domains', function (Blueprint $table) {
            $table->string("name")->unique()->change();
            $table->integer("da")->after("name")->nullable()->default(null);
            $table->integer("pa")->after("da")->nullable()->default(null);
            $table->float("mozrank")->after("pa")->nullable()->default(null);
            $table->integer("links")->after("mozrank")->nullable()->default(null);
            $table->integer("equity")->after("links")->nullable()->default(null);
            $table->json("json_params")->after("equity")->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('domains', function (Blueprint $table) {
            $table->dropColumn("da");
            $table->dropColumn("pa");
            $table->dropColumn("mozrank");
            $table->dropColumn("links");
            $table->dropColumn("equity");
            $table->dropColumn("json_params");
        });
    }
}
