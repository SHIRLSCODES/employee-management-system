<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StockRequisition;
use App\Models\StockItem;
use App\Models\StockTransaction;
use App\Http\Requests\SaveStockRequest;
use App\Http\Requests\SaveStockRequestUpdate;
use Illuminate\Support\Facades\Auth;

class StockRequestController extends Controller
{
    public function index()
    {
        $requisitions = Auth::user()->stockRequisitions()->with(['stockItem'])->latest()->paginate(5);

        return view('stockRequisitions.index', compact('requisitions'));
    }

    public function create()
    {
        $stockItems = StockItem::where('quantity', '>', 0)->get();

        return view('stockRequisitions.create', compact('stockItems'));
    }

    public function store(SaveStockRequest $request)
    {
        $user = auth()->user();
        $userType = \App\Models\Employee::class;

        $validated = $request->validated();

        $validated['requestable_type'] = $userType;
        $validated['requestable_id'] = $user->id;
        $validated['status'] = 'pending';

        StockRequisition::create($validated);

        return redirect()->route('stockRequisitions.index')->with('success', 'Stock requisition submitted successfully');
    }

    public function edit(StockRequisition $stockRequisition)
    {
        $stockItems = StockItem::all();
        if ($stockRequisition->requestable_type !== \App\Models\Employee::class || $stockRequisition->requestable_id !== auth()->id()) {
            return redirect()->route('stockRequisitions.index')->with('error', 'You do not have permission to edit this requisition');
        }
        return view('stockRequisitions.edit', compact('stockRequisition', 'stockItems'));
    }

    public function update(SaveStockRequestUpdate $request, StockRequisition $stockRequisition)
    {
        $validated = $request->validated();

        $stockRequisition->update($validated);

        return redirect()->route('stockRequisitions.index')->with('success', 'Stock requisition updated successfully');
    }

    public function show(StockRequisition $stockRequisition)
    {
        if ($stockRequisition->requestable_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('stockRequisitions.show', compact('stockRequisition'));
    }

    public function destroy(StockRequisition $stockRequisition)
    {
        if ($stockRequisition->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending requisitions can be deleted.');
        }

        $stockRequisition->delete();

        return redirect()->route('stockRequisitions.index')->with('success', 'Requisition deleted successfully.');
    }

    public function getStockItem(StockItem $stockItem)
    {
        return response()->json([
            'id' => $stockItem->id,
            'name' => $stockItem->name,
            'category' => $stockItem->category,
            'quantity' => $stockItem->quantity,
            'unit' => $stockItem->unit,
            'description' => $stockItem->description
        ]);
    }
}
