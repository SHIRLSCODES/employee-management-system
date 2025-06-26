<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockReturn;
use App\Models\StockItem;
use App\Models\StockRequisition;
use App\Http\Requests\SaveStockReturnRequest;

class StockReturnController extends Controller
{
    public function index()
    {
        $stockReturns = StockReturn::where('returnable_id', auth()->id())->where('returnable_type', get_class(auth()->user()))->latest()
                                ->with('requisition.stockItem')
                                ->latest()->paginate(5);

        return view('stockReturns.index', compact('stockReturns'));
    }

    public function create()
    {
        $stockItems = StockItem::where('is_returnable', true)->get();
        $stockRequisitions = StockRequisition::where('requestable_id', auth()->id())
            ->where('requestable_type', get_class(auth()->user()))
            ->get();

        return view('stockReturns.create', compact('stockItems', 'stockRequisitions'));
    }

    public function store(SaveStockReturnRequest $request)
    {
        $user = auth()->user();

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

        return redirect()->route('stockReturns.index')->with('success', 'Stock return submitted.');
    }

    public function show(StockReturn $stockReturn){

        if ($stockReturn->returnable_id !== auth()->id()) 
        {
        abort(403, 'Unauthorized action.');
        }
        return view('stockReturns.show', compact('stockReturn'));
    }

    public function edit(StockReturn $stockReturn)
    {
        if ($stockReturn->returnable_id !== auth()->id() || $stockReturn->status !== 'pending') {
            abort(403, 'Unauthorized action.');
        }

        $stockItems = StockItem::where('is_returnable', true)->get();
        $stockRequisitions = StockRequisition::where('requestable_id', auth()->id())
            ->where('requestable_type', get_class(auth()->user()))
            ->get();

        return view('stockReturns.edit', compact('stockReturn', 'stockItems', 'stockRequisitions'));
    }

    public function update(SaveStockReturnRequest $request, StockReturn $stockReturn)
    {
        if ($stockReturn->returnable_id !== auth()->id() || $stockReturn->status !== 'pending') {
            abort(403, 'Unauthorized action.');
        }

        $stockReturn->update([
            'stock_item_id' => $request->stock_item_id,
            'stock_requisition_id' => $request->stock_requisition_id,
            'quantity' => $request->quantity,
            'condition' => $request->condition,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('stockReturns.index')->with('success', 'Stock return updated.');
    }

    public function destroy(StockReturn $stockReturn)
    {
        if ($stockReturn->returnable_id !== auth()->id() || $stockReturn->status !== 'pending') {
            abort(403, 'Unauthorized action.');
        }

        $stockReturn->delete();

        return redirect()->route('stockReturns.index')->with('success', 'Stock return deleted.');
    }
}
