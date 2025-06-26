<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\StockReturn;
use App\Models\Admin;
use App\Models\StockItem;
use App\Http\Controllers\Controller;
use App\Models\StockRequisition;
use App\Models\StockTransaction;
use App\Http\Requests\SaveStockReturnRequest;

class StockReturnController extends Controller
{
    public function adminIndex()
    {
        $stockReturns = StockReturn::where('returnable_id', auth('admin')->id())->where('returnable_type', get_class(auth('admin')->user()))->latest()
                                ->with('requisition.stockItem')
                                ->latest()->paginate(5);

        return view('admin.stockReturns.adminIndex', compact('stockReturns'));
    }

    public function index()
    {
        $returns = StockReturn::with(['returnable', 'stockItem', 'stockItemFromRequisition'])
            ->latest()
            ->paginate(5);

        return view('admin.stockReturns.index', compact('returns'));
    }

    public function create()
    {
        $stockItems = StockItem::where('is_returnable', true)->get();
        $stockRequisitions = StockRequisition::where('requestable_id', auth('admin')->id())
            ->where('requestable_type', get_class(auth('admin')->user()))
            ->get();

        return view('admin.stockReturns.create', compact('stockItems', 'stockRequisitions'));
    }

    public function store(SaveStockReturnRequest $request)
    {
        $user = auth('admin')->user();

        $return = StockReturn::create([
            'stock_item_id' => $request->stock_item_id,
            'stock_requisition_id' => $request->stock_requisition_id,
            'quantity' => $request->quantity,
            'condition' => $request->condition,
            'remarks' => $request->remarks,
            'status' => 'pending',
            'returnable_type' => get_class($user),
            'returnable_id' => $user->id,
        ]);

        return redirect()->route('admin.stockReturns.adminIndex')->with('success', 'Stock return submitted.');
    }

    public function show(StockReturn $stockReturn){

        if ($stockReturn->returnable_id !== auth('admin')->id()) 
        {
        abort(403, 'Unauthorized action.');
        }
        return view('admin.stockReturns.show', compact('stockReturn'));
    }

    public function edit(StockReturn $stockReturn)
    {
        if ($stockReturn->returnable_id !== auth('admin')->id() || $stockReturn->status !== 'pending') {
            abort(403, 'Unauthorized action.');
        }

        $stockItems = StockItem::where('is_returnable', true)->get();
        $stockRequisitions = StockRequisition::where('requestable_id', auth('admin')->id())
            ->where('requestable_type', get_class(auth('admin')->user()))
            ->get();

        return view('admin.stockReturns.edit', compact('stockReturn', 'stockItems', 'stockRequisitions'));
    }

    public function update(SaveStockReturnRequest $request, StockReturn $stockReturn)
    {
        if ($stockReturn->returnable_id !== auth('admin')->id() || $stockReturn->status !== 'pending') {
            abort(403, 'Unauthorized action.');
        }

        $stockReturn->update([
            'stock_item_id' => $request->stock_item_id,
            'stock_requisition_id' => $request->stock_requisition_id,
            'quantity' => $request->quantity,
            'condition' => $request->condition,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('admin.stockReturns.adminIndex')->with('success', 'Stock return updated.');
    }

    public function delete(StockReturn $stockReturn)
    {
        if ($stockReturn->returnable_id !== auth('admin')->id() || $stockReturn->status !== 'pending') {
            abort(403, 'Unauthorized action.');
        }

        $stockReturn->delete();

        return redirect()->route('admin.stockReturns.adminIndex')->with('success', 'Stock return deleted.');
    }

    public function approve(StockReturn $stockReturn)
    {
        if ($stockReturn->status !== 'pending') {
            return back()->with('error', 'This return has already been processed.');
        }

        $stockItem = $stockReturn->resolved_stock_item;

        if (!$stockItem || !$stockItem->is_returnable) {
            return back()->with('error', 'This stock item is not returnable.');
        }

        $stockItem->adjustQuantity($stockReturn->quantity, 'in', auth()->user(), 'Stock return approved.');

        $stockReturn->update(['status' => 'approved']);

        return back()->with('success', 'Stock return approved successfully.');
    }

    public function deny(StockReturn $stockReturn)
    {
        if ($stockReturn->status !== 'pending') {
            return back()->with('error', 'This return has already been processed.');
        }

        $stockReturn->update(['status' => 'denied']);

        return back()->with('success', 'Stock return denied successfully.');
    }
}
