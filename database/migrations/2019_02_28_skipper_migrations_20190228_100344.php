<?php
/* Migrations generated by: Skipper (http://www.skipper18.com) */
/* Migration id: 06c2f912-9507-40a7-8483-86f48d872aa1 */
/* Migration datetime: 2019-02-28 10:03:44.168083 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Migrations20190228100344 extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
  */
  public function up()
  {
      /*
    Schema::create('brands', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->string('name',255)->nullable(true);
      $table->text('description')->nullable(true);
      $table->uuid('manufacturer_id')->nullable(true);
      $table->unique(['id'],'brand_pk');
    });
    Schema::create('device_types', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->char('type',50);
      $table->integer('import_ref')->nullable(true);
      $table->unique(['id'],'device_type_pk');
    });
    Schema::create('devices', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->char('model_name',255);
      $table->text('details')->nullable(true);
      $table->uuid('brand_id')->nullable(true);
      $table->uuid('deviceType_id')->nullable(true);
      $table->char('model_number',200)->nullable(true);
      $table->unique(['id'],'devices_pk');
    });
    Schema::create('parts', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->char('sku',20)->unique();
      $table->text('details')->nullable(true);
      $table->uuid('partCategory_id')->nullable(true);
      $table->uuid('partStatus_id')->nullable(true);
      $table->uuid('partType_id')->nullable(true);
      $table->uuid('partColour_id')->nullable(true);
      $table->dateTime('first_received')->nullable(true);
      $table->char('part_name',255);
      $table->uuid('device_id')->nullable(true);
      $table->uuid('parent_part_id')->nullable(true);
      $table->boolean('is_child')->nullable(true)->default(0);
      $table->unique(['id'],'part_pk');
      $table->unique(['sku'],'sku');
    });
    Schema::create('locations', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->char('location',100)->unique();
      $table->char('location_code',50)->unique();
      $table->text('description')->nullable(true);
      $table->unique(['id'],'location_pk');
    });
    Schema::create('part_statuses', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->char('status',50)->unique();
      $table->text('description')->nullable(true);
      $table->unique(['id'],'part_status_pk');
    });
    Schema::create('part_categories', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->char('category',100)->unique();
      $table->text('details')->nullable(true);
      $table->unique(['id'],'part_category_pk');
    });
    Schema::create('part_types', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->char('part_type',100)->unique();
      $table->text('details')->nullable(true);
      $table->unique(['id'],'part_type_pk');
    });
    Schema::create('part_stocks', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->uuid('part_id');
      $table->integer('stock_qty')->default(0);
      $table->uuid('location_id');
      $table->char('bin_location',100)->nullable(true);
      $table->integer('sold_all_time')->default(0);
      $table->unique(['id'],'part_stock_pk');
      $table->index(['part_id'],'part_id_fk');
    });
    Schema::create('part_prices', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->uuid('part_id')->nullable(true);
      $table->float('last_cost')->default(0.00);
      $table->float('selling_price_b2c')->default(0.00);
      $table->float('selling_price_b2b')->default(0.00);
      $table->unique(['id'],'part_price_pk');
      $table->index(['part_id'],'part_id_fk');
    });
    Schema::create('part_colours', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->char('colour',50)->unique();
      $table->unique(['id'],'part_colour_pk');
    });
    Schema::create('manufacturers', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->char('manufacturer',50)->unique();
      $table->unique(['id'],'manufacturer_pk');
      $table->unique(['manufacturer'],'manufacturer');
    });
    Schema::create('stock_count_statuses', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->char('status',50)->nullable(true)->unique();
      $table->unique(['id'],'stockcount_status_pk');
    });
    Schema::create('stock_counts', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->char('number',30)->unique();
      $table->timestamp('started_at')->useCurrent();
      $table->timestamp('ended_at')->nullable(true);
      $table->uuid('stockCountStatus_id')->nullable(true);
      $table->uuid('location_id')->nullable(true);
      $table->integer('diff_qty')->nullable(true);
      $table->float('diff_value',20)->nullable(true);
      $table->integer('inhand_qty')->nullable(true);
      $table->float('inhand_value',20)->nullable(true);
      $table->integer('count_qty')->nullable(true)->unsigned();
      $table->float('count_value',20)->nullable(true)->unsigned();
      $table->unique(['id'],'stock_count_pk');
    });
    Schema::create('stock_count_items_seqs', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->integer('qty')->nullable(true)->unsigned();
      $table->uuid('part_id')->nullable(true);
      $table->uuid('stockCount_id')->nullable(true);
      $table->timestamp('created_at');
      $table->timestmap('updated_at')->nullable(true);
      $table->unique(['id'],'stock_count_item_seq_pk');
    });
    Schema::create('stock_count_items', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->integer('qty')->nullable(true);
      $table->uuid('stockCount_id')->nullable(true);
      $table->uuid('part_id')->nullable(true);
      $table->float('cost',20)->nullable(true);
      $table->integer('inhand_qty')->nullable(true);
      $table->float('inhand_value',20)->nullable(true)->virtualAs('cost * inhand_qty');
      $table->float('count_value',20)->nullable(true)->virtualAs('cost * qty');
      $table->integer('diff_qty')->nullable(true)->virtualAs('qty - inhand_qty');
      $table->float('diff_value',20)->nullable(true)->virtualAs('(cost * qty) - (cost * inhand_qty)');
      $table->unique(['id'],'stock_count_items_pk');
    });
    Schema::create('suppliers', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->char('name',50)->unique();
      $table->char('country',100)->nullable(true);
      $table->integer('lead_time')->nullable(true);
      $table->text('payment_details')->nullable(true);
      $table->timestmap('created_at')->nullable(true);
      $table->timestmap('updated_at')->nullable(true);
      $table->unique(['id'],'supplier_pk');
    });
    Schema::create('purchase_order_statuses', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->char('status',50);
      $table->char('description',250)->nullable(true);
      $table->timestmap('created_at')->nullable(true);
      $table->timestmap('updated_at')->nullable(true);
      $table->unique(['id'],'purchase_order_status_pk');
    });
    Schema::create('purchase_order_payments', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->dateTime('transaction_date');
      $table->longText('transaction_details');
      $table->float('amount');
      $table->char('currency',10);
      $table->float('exchange_rate_to_CAD',4)->nullable(true);
      $table->unique(['id'],'purchase_order_payment_pk');
    });
    Schema::create('purchase_order_payment_statuses', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->char('status',50);
      $table->char('description',250)->nullable(true);
      $table->timestmap('created_at')->nullable(true);
      $table->timestmap('updated_at')->nullable(true);
      $table->unique(['id'],'purchase_order_payment_status_pk');
    });
    Schema::create('purchase_orders', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->char('number',50);
      $table->uuid('supplier_id')->nullable(true);
      $table->uuid('purchaseOrderStatus_id')->nullable(true);
      $table->uuid('purchaseOrderPayment_id')->nullable(true);
      $table->uuid('purchaseOrderPaymentStatus_id')->nullable(true);
      $table->float('value_CAD')->nullable(true);
      $table->float('value_USD')->nullable(true);
      $table->timestmap('created_at')->nullable(true);
      $table->timestmap('updated_at')->nullable(true);
      $table->unique(['id'],'purchase_order_pk');
      $table->unique(['number'],'purchase_order_identifier');
    });
    Schema::create('purchase_order_items', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->uuid('part_id');
      $table->uuid('purchaseOrder_id');
      $table->integer('qty');
      $table->float('cost');
      $table->char('cost_currency',20);
      $table->integer('qty_received')->nullable(true)->default(0);
      $table->timestmap('created_at')->nullable(true);
      $table->timestmap('updated_at')->nullable(true);
      $table->float('total_cost')->nullable(true)->virtualAs('qty * cost');
      $table->float('actual_cost')->nullable(true)->virtualAs('qty_received * cost');
      $table->unique(['id'],'purchase_order_items_pk');
    });
    Schema::create('purchase_order_cdstatuses', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->char('status',50);
      $table->text('description')->nullable(true);
      $table->timestmap('created_at')->nullable(true);
      $table->timestmap('updated_at')->nullable(true);
      $table->unique(['id'],'purchase_order_credit_debit_status_pk');
    });
    Schema::create('purchase_order_diffs', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->char('number',50);
      $table->integer('qty_diff')->nullable(true)->default(0);
      $table->float('value_diff_CAD')->nullable(true)->default(0);
      $table->float('value_diff_USD')->nullable(true)->default(0);
      $table->text('credit_debit_details')->nullable(true);
      $table->timestmap('created_at')->nullable(true);
      $table->timestmap('updated_at')->nullable(true);
      $table->uuid('purchaseOrder_id')->nullable(true)->unique();
      $table->unique(['id'],'purchase_order_difference_pk');
    });
    Schema::create('purchase_order_diff_items', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->uuid('purchaseOrderDiff_id')->nullable(true);
      $table->uuid('part_id')->nullable(true);
      $table->integer('qty_paid_for')->nullable(true);
      $table->float('cost')->nullable(true);
      $table->char('cost_currency',20)->nullable(true);
      $table->integer('qty_received')->nullable(true);
      $table->integer('qty_diff')->nullable(true)->virtualAs('qty_received - qty_paid_for');
      $table->float('value_diff')->nullable(true)->virtualAs('( (qty_received * cost) - (qty_paid_for*cost) )');
      $table->timestmap('created_at')->nullable(true);
      $table->timestmap('updated_at')->nullable(true);
      $table->unique(['id'],'purchase_order_difference_items_pk');
    });
    Schema::create('part_movements', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->integer('qty');
      $table->timestamp('movement_at')->useCurrent();
      $table->uuid('part_id')->nullable(true);
      $table->text('part_name')->nullable(true);
    });
    Schema::create('part_mvmnt_froms', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->uuid('partMovement_id')->unique();
      $table->uuid('location_id')->nullable(true);
      $table->nullableMorphs('sublocation_type');
      $table->uuid('sublocation_id')->nullable(true);
    });
    Schema::create('part_mvmnt_tos', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->uuid('partMovement_id')->unique();
      $table->uuid('location_id')->nullable(true);
      $table->nullableMorphs('sublocation_type');
      $table->uuid('sublocation_id')->nullable(true);
    });
    Schema::table('brands', function (Blueprint $table) {
      $table->foreign('manufacturer_id')->references('id')->on('manufacturers');
    });
    Schema::table('devices', function (Blueprint $table) {
      $table->foreign('brand_id')->references('id')->on('brands');
    });
    Schema::table('devices', function (Blueprint $table) {
      $table->foreign('deviceType_id')->references('id')->on('device_types');
    });
    Schema::table('parts', function (Blueprint $table) {
      $table->foreign('partCategory_id')->references('id')->on('part_categories');
    });
    Schema::table('parts', function (Blueprint $table) {
      $table->foreign('partStatus_id')->references('id')->on('part_statuses');
    });
    Schema::table('parts', function (Blueprint $table) {
      $table->foreign('partType_id')->references('id')->on('part_types');
    });
    Schema::table('parts', function (Blueprint $table) {
      $table->foreign('partColour_id')->references('id')->on('part_colours');
    });
    Schema::table('parts', function (Blueprint $table) {
      $table->foreign('device_id')->references('id')->on('devices');
    });
    Schema::table('parts', function (Blueprint $table) {
      $table->foreign('parent_part_id')->references('id')->on('parts');
    });
    Schema::table('part_stocks', function (Blueprint $table) {
      $table->foreign('part_id')->references('id')->on('parts');
    });
    Schema::table('part_stocks', function (Blueprint $table) {
      $table->foreign('location_id')->references('id')->on('locations');
    });
    Schema::table('part_prices', function (Blueprint $table) {
      $table->foreign('part_id')->references('id')->on('parts');
    });
    Schema::table('stock_counts', function (Blueprint $table) {
      $table->foreign('stockCountStatus_id')->references('id')->on('stock_count_statuses');
    });
    Schema::table('stock_counts', function (Blueprint $table) {
      $table->foreign('location_id')->references('id')->on('locations');
    });
    Schema::table('stock_count_items_seqs', function (Blueprint $table) {
      $table->foreign('part_id')->references('id')->on('parts');
    });
    Schema::table('stock_count_items_seqs', function (Blueprint $table) {
      $table->foreign('stockCount_id')->references('id')->on('stock_counts');
    });
    Schema::table('stock_count_items', function (Blueprint $table) {
      $table->foreign('stockCount_id')->references('id')->on('stock_counts');
    });
    Schema::table('stock_count_items', function (Blueprint $table) {
      $table->foreign('part_id')->references('id')->on('parts');
    });
    Schema::table('purchase_orders', function (Blueprint $table) {
      $table->foreign('supplier_id')->references('id')->on('suppliers');
    });
    Schema::table('purchase_orders', function (Blueprint $table) {
      $table->foreign('purchaseOrderStatus_id')->references('id')->on('purchase_order_statuses');
    });
    Schema::table('purchase_orders', function (Blueprint $table) {
      $table->foreign('purchaseOrderPayment_id')->references('id')->on('purchase_order_payments');
    });
    Schema::table('purchase_orders', function (Blueprint $table) {
      $table->foreign('purchaseOrderPaymentStatus_id')->references('id')->on('purchase_order_payment_statuses');
    });
    Schema::table('purchase_order_items', function (Blueprint $table) {
      $table->foreign('part_id')->references('id')->on('parts');
    });
    Schema::table('purchase_order_items', function (Blueprint $table) {
      $table->foreign('purchaseOrder_id')->references('id')->on('purchase_orders');
    });
    Schema::table('purchase_order_diffs', function (Blueprint $table) {
      $table->foreign('purchaseOrder_id')->references('id')->on('purchase_orders');
    });
    Schema::table('purchase_order_diff_items', function (Blueprint $table) {
      $table->foreign('part_id')->references('id')->on('parts');
    });
    Schema::table('purchase_order_diff_items', function (Blueprint $table) {
      $table->foreign('purchaseOrderDiff_id')->references('id')->on('purchase_order_diffs');
    });
    Schema::table('part_movements', function (Blueprint $table) {
      $table->foreign('part_id')->references('id')->on('parts');
    });
    Schema::table('part_mvmnt_froms', function (Blueprint $table) {
      $table->foreign('partMovement_id')->references('id')->on('part_movements');
    });
    Schema::table('part_mvmnt_froms', function (Blueprint $table) {
      $table->foreign('location_id')->references('id')->on('locations');
    });
    Schema::table('part_mvmnt_tos', function (Blueprint $table) {
      $table->foreign('partMovement_id')->references('id')->on('part_movements');
    });
    Schema::table('part_mvmnt_tos', function (Blueprint $table) {
      $table->foreign('location_id')->references('id')->on('locations');
    });
      */
  }
  /**
   * Reverse the migrations.
   *
   * @return void
  */
  public function down()
  {
    Schema::table('part_mvmnt_tos', function (Blueprint $table) {
      $table->dropForeign(['location_id']);
    });
    Schema::table('part_mvmnt_tos', function (Blueprint $table) {
      $table->dropForeign(['partMovement_id']);
    });
    Schema::table('part_mvmnt_froms', function (Blueprint $table) {
      $table->dropForeign(['location_id']);
    });
    Schema::table('part_mvmnt_froms', function (Blueprint $table) {
      $table->dropForeign(['partMovement_id']);
    });
    Schema::table('part_movements', function (Blueprint $table) {
      $table->dropForeign(['part_id']);
    });
    Schema::table('purchase_order_diff_items', function (Blueprint $table) {
      $table->dropForeign(['purchaseOrderDiff_id']);
    });
    Schema::table('purchase_order_diff_items', function (Blueprint $table) {
      $table->dropForeign(['part_id']);
    });
    Schema::table('purchase_order_diffs', function (Blueprint $table) {
      $table->dropForeign(['purchaseOrder_id']);
    });
    Schema::table('purchase_order_items', function (Blueprint $table) {
      $table->dropForeign(['purchaseOrder_id']);
    });
    Schema::table('purchase_order_items', function (Blueprint $table) {
      $table->dropForeign(['part_id']);
    });
    Schema::table('purchase_orders', function (Blueprint $table) {
      $table->dropForeign(['purchaseOrderPaymentStatus_id']);
    });
    Schema::table('purchase_orders', function (Blueprint $table) {
      $table->dropForeign(['purchaseOrderPayment_id']);
    });
    Schema::table('purchase_orders', function (Blueprint $table) {
      $table->dropForeign(['purchaseOrderStatus_id']);
    });
    Schema::table('purchase_orders', function (Blueprint $table) {
      $table->dropForeign(['supplier_id']);
    });
    Schema::table('stock_count_items', function (Blueprint $table) {
      $table->dropForeign(['part_id']);
    });
    Schema::table('stock_count_items', function (Blueprint $table) {
      $table->dropForeign(['stockCount_id']);
    });
    Schema::table('stock_count_items_seqs', function (Blueprint $table) {
      $table->dropForeign(['stockCount_id']);
    });
    Schema::table('stock_count_items_seqs', function (Blueprint $table) {
      $table->dropForeign(['part_id']);
    });
    Schema::table('stock_counts', function (Blueprint $table) {
      $table->dropForeign(['location_id']);
    });
    Schema::table('stock_counts', function (Blueprint $table) {
      $table->dropForeign(['stockCountStatus_id']);
    });
    Schema::table('part_prices', function (Blueprint $table) {
      $table->dropForeign(['part_id']);
    });
    Schema::table('part_stocks', function (Blueprint $table) {
      $table->dropForeign(['location_id']);
    });
    Schema::table('part_stocks', function (Blueprint $table) {
      $table->dropForeign(['part_id']);
    });
    Schema::table('parts', function (Blueprint $table) {
      $table->dropForeign(['parent_part_id']);
    });
    Schema::table('parts', function (Blueprint $table) {
      $table->dropForeign(['device_id']);
    });
    Schema::table('parts', function (Blueprint $table) {
      $table->dropForeign(['partColour_id']);
    });
    Schema::table('parts', function (Blueprint $table) {
      $table->dropForeign(['partType_id']);
    });
    Schema::table('parts', function (Blueprint $table) {
      $table->dropForeign(['partStatus_id']);
    });
    Schema::table('parts', function (Blueprint $table) {
      $table->dropForeign(['partCategory_id']);
    });
    Schema::table('devices', function (Blueprint $table) {
      $table->dropForeign(['deviceType_id']);
    });
    Schema::table('devices', function (Blueprint $table) {
      $table->dropForeign(['brand_id']);
    });
    Schema::table('brands', function (Blueprint $table) {
      $table->dropForeign(['manufacturer_id']);
    });
    Schema::dropIfExists('part_mvmnt_tos');
    Schema::dropIfExists('part_mvmnt_froms');
    Schema::dropIfExists('part_movements');
    Schema::dropIfExists('purchase_order_diff_items');
    Schema::dropIfExists('purchase_order_diffs');
    Schema::dropIfExists('purchase_order_cdstatuses');
    Schema::dropIfExists('purchase_order_items');
    Schema::dropIfExists('purchase_orders');
    Schema::dropIfExists('purchase_order_payment_statuses');
    Schema::dropIfExists('purchase_order_payments');
    Schema::dropIfExists('purchase_order_statuses');
    Schema::dropIfExists('suppliers');
    Schema::dropIfExists('stock_count_items');
    Schema::dropIfExists('stock_count_items_seqs');
    Schema::dropIfExists('stock_counts');
    Schema::dropIfExists('stock_count_statuses');
    Schema::dropIfExists('manufacturers');
    Schema::dropIfExists('part_colours');
    Schema::dropIfExists('part_prices');
    Schema::dropIfExists('part_stocks');
    Schema::dropIfExists('part_types');
    Schema::dropIfExists('part_categories');
    Schema::dropIfExists('part_statuses');
    Schema::dropIfExists('locations');
    Schema::dropIfExists('parts');
    Schema::dropIfExists('devices');
    Schema::dropIfExists('device_types');
    Schema::dropIfExists('brands');
  }
}
