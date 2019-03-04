<?php
/* Migrations generated by: Skipper (http://www.skipper18.com) */
/* Migration id: be96ad81-ceb5-49dd-8338-686e129178bf */
/* Migration datetime: 2019-03-04 10:47:49.229281 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Migrations20190304104749 extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
  */
  public function up()
  {
    Schema::table('work_orders', function (Blueprint $table) {
      $table->uuid('location_id');
    });
    Schema::table('work_orders', function (Blueprint $table) {
      $table->foreign('location_id')->references('id')->on('locations');
    });
  }
  /**
   * Reverse the migrations.
   *
   * @return void
  */
  public function down()
  {
    Schema::table('work_orders', function (Blueprint $table) {
      $table->dropForeign(['location_id']);
    });
    Schema::table('work_orders', function (Blueprint $table) {
      $table->dropColumn('location_id');
    });
  }
}
