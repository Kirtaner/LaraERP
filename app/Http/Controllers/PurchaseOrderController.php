<?php
namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderPaymentStatus;
use App\Models\PurchaseOrderStatus;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchase_orders = PurchaseOrder::all();
        return view('order.purchase.index')->with('purchase_orders',$purchase_orders);
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('order.purchase.create')->with('suppliers',$suppliers);
    }

    public function insert(Request $request)
    {
        $purchase_order = new PurchaseOrder();
        $supplier = Supplier::findOrFail($request->input('poSupplier'));
        $purchase_order_status = PurchaseOrderStatus::where('status','Created')->firstOrFail();
        $purchase_order_payment_status = PurchaseOrderPaymentStatus::where('status','In Queue')->firstOrFail();

        $purchase_order->Supplier()->associate($supplier);
        $purchase_order->PurchaseOrderStatus()->associate($purchase_order_status);
        $purchase_order->PurchaseOrderPaymentStatus()->associate($purchase_order_payment_status);

        $purchase_order->save();

        return $this->index();


    }

    public function view($id)
    {

    }

    public function edit($id)
    {
        $purchase_order = PurchaseOrder::findOrFail($id);

        $suppliers = Supplier::all();
        $purchase_order_statuses = PurchaseOrderStatus::all();
        $purchase_order_payment_statuses = PurchaseOrderPaymentStatus::all();

        return view('order.purchase.edit',[
            'purchase_order' => $purchase_order,
            'suppliers' => $suppliers,
            'purchase_order_statuses' => $purchase_order_statuses,
            'purchase_order_payment_statuses' => $purchase_order_payment_statuses
        ]);
    }

    public function update()
    {

    }

    public function delete($id)
    {

    }
}
