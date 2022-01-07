<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\Counter;
use DB;

class InventoryController extends Controller
{
    public function showItemList()
    {
        $items = Items::all();
        return view('fifo.inventoryin', [
            'items' => $items
        ]);
    }

    public function inventoryIn(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,item_id',
            'kode_supplier' => 'required',
            'nomor_truk' => 'required|numeric',
            'kode_gudang' => 'required',
            'qty' => 'required|numeric'
        ]);

        $kode_supplier = $request->kode_supplier;
        $nomor_truk = $request->nomor_truk;
        $kode_gudang = $request->kode_gudang;
        $today = date('Ymd');
        $lot_id = strtoupper($kode_supplier) . '-' . $today . '-' . $nomor_truk . '-' . strtoupper($kode_gudang);

        $inventory = Inventory::create([
            'item_id' => $request->item_id,
            'lot_id' => $lot_id,
            'qty' => $request->qty,
            'kode_rak' => $request->kode_rak
        ]);

        return redirect()->route('inventoryin.create')
            ->with('success', 'Inventory berhasil masuk.');
    }

    public function inventoryList($id)
    {
        $inventories = Inventory::where('item_id', $id)
            ->orderBy('created_at','asc')
            ->paginate(50);
        
        $totalQty = $inventories->sum('qty');

        $inventoryName = Items::where('item_id', $id)->first();
        $inventoryName = $inventoryName->item_name;

        return view('fifo.inventorylist', [
            'inventories' => $inventories,
            'totalQty' => $totalQty,
            'inventoryName' => $inventoryName,
            'inventoryId' => $id
        ]);
    }

    public function showOutItemList()
    {
        $items = Items::all();
        return view('fifo.inventoryout', [
            'items' => $items
        ]);
    }

    public function inventoryOut(Request $request)
    {
        $itemData = Items::where('item_id', $request->item_id)->first();
        $inventoryData = Inventory::where('item_id', $request->item_id)->orderBy('created_at', 'asc')->first();

        $currLotQty = 0;
        $currLotId = "";
        $deductQty = 0;
        $orderId = "";
        $counter = Counter::where('id', 1)->first();
        $currCounter = $counter->counter;
        $nextCounter = $currCounter + 1;
        $counter->update([
            'counter' => $nextCounter
        ]);
        $queue = 0;

        $want = $request->qty;
        $totalQty = Inventory::where('item_id', $request->item_id)->orderBy('created_at', 'asc')->sum('qty');
        if($want>$totalQty){
            return redirect()->route('inventoryout.create')->with('error', 'Jumlah yang ingin dikeluarkan melebihi total stok('.$currLotQty.')!');
        }

        $orderId = "ORDER-" . $nextCounter;
        while($want > 0){
            $inventoryData = Inventory::where('item_id', $request->item_id)->orderBy('created_at', 'asc')->first();
            $currLotId = $inventoryData->lot_id;
            $kodeRak = $inventoryData->kode_rak;
            $currLotQty = $inventoryData->qty;
            if($currLotQty > $want){
                $deductQty = $want;
                $currLotQty = $currLotQty - $deductQty;
                $want = $want - $deductQty;
                $updateInventory = Inventory::where('lot_id', $currLotId)->first();
                $updateInventory->update([
                    'qty' => $currLotQty
                ]);
                $queue = $queue + 1;
                $log = Order::create([
                    'order_id' => $orderId,
                    'queue_no' => $queue,
                    'item_id' => $request->item_id,
                    'lot_id' => $currLotId,
                    'kode_rak' => $kodeRak,
                    'qty' => $deductQty,
                    'out_detail' => $request->out_detail
                ]);
            }elseif($currLotQty == $want){
                $deductQty = $want;
                $currLotQty = $currLotQty - $deductQty;
                $want = $want - $deductQty;
                $updateInventory = Inventory::where('lot_id', $currLotId)->delete();
                $queue = $queue + 1;
                $log = Order::create([
                    'order_id' => $orderId,
                    'queue_no' => $queue,
                    'item_id' => $request->item_id,
                    'lot_id' => $currLotId,
                    'kode_rak' => $kodeRak,
                    'qty' => $deductQty,
                    'out_detail' => $request->out_detail
                ]);
            }elseif($currLotQty < $want){
                $deductQty = $currLotQty;
                $currLotQty = $currLotQty - $deductQty;
                $want = $want - $deductQty;
                $updateInventory = Inventory::where('lot_id', $currLotId)->delete();
                $queue = $queue + 1;
                $log = Order::create([
                    'order_id' => $orderId,
                    'queue_no' => $queue,
                    'item_id' => $request->item_id,
                    'lot_id' => $currLotId,
                    'kode_rak' => $kodeRak,
                    'qty' => $deductQty,
                    'out_detail' => $request->out_detail
                ]);
            }
        }
        return redirect()->route('orderdetail.show', $orderId);
    }

    public function orderList()
    {
        $orders = Order::groupBy('order_id')->select('order_id', 'created_at')->paginate(50);
        return view('fifo.orderlist', [
            'orders' => $orders
        ]);
    }

    public function orderDetail($id)
    {
        $orders = Order::where('order_id', $id)->orderBy('queue_no')->paginate(50);
        $item_id = Order::where('order_id', $id)->select('item_id')->first();
        $totalQty = $orders->sum('qty');
        $item_id = $item_id->item_id;
        $inventoryDetail = Items::where('item_id', $item_id)->first();
        $inventoryName = $inventoryDetail->item_name;
        return view('fifo.orderdetail',[
            'orders' => $orders,
            'inventoryName' => $inventoryName,
            'itemId' => $item_id,
            'orderId' => $id,
            'totalQty' => $totalQty
        ]);
    }

    public function showTargetedItemIn($id)
    {
        $item = Items::where('item_id', $id)->first();
        
        if(is_null($item)){
            return redirect()->route('inventoryin.create')
            ->with('error', 'ID Item tidak terdaftar!');
        }

        return view('fifo.targetedinventoryin', [
            'item' => $item
        ]);
    }

    public function showTargetedItemOut($id)
    {
        $item = Items::where('item_id', $id)->first();
        
        if(is_null($item)){
            return redirect()->route('inventoryout.create')
            ->with('error', 'ID Item tidak terdaftar!');
        }

        return view('fifo.targetedinventoryout', [
            'item' => $item
        ]);
    }

    public function editInventoryIn($id)
    {
        $inventory = Inventory::where('id', $id)->first();

        return view('fifo.editinventory', [
            'inventory' => $inventory
        ]);
    }

    public function updateInventoryin(Request $request, $id)
    {
        $request->validate([
            'kode_rak' => 'required',
            'lot_id' => 'required',
            'qty' => 'required|numeric'
        ]);

        $inventory = Inventory::find($id)->update($request->except(['_token', '_method']));

        return redirect()->route('inventoryin.list', $request->item_id)
            ->with('success', 'Item berhasil diedit.');
    }

    public function destroyInventory($id)
    {
        $inventory = Inventory::where('id', $id)->first();
        $inventory_id = $inventory->item_id;
        $inventory = Inventory::where('id', $id)->delete();
        return redirect()->route('inventoryin.list', $inventory_id)
            ->with('success', 'Lot berhasil dihapus.');   
    }

    public function searchItem(Request $request)
    {
        $items = Items::where('item_name', 'like', '%'.$request->search_string.'%')->paginate(50);
        return view('fifo.allitem', [
            'items' => $items
        ])->with('success', 'Pencarian selesai.');
    }

    public function searchOrder(Request $request)
    {
        $orders = Order::where('created_at', 'like', '%'.$request->date.'%')->groupBy('order_id')->paginate(50);
        return view('fifo.orderlist', [
            'orders' => $orders
        ])->with('success', 'Pencarian selesai.');
    }
}
