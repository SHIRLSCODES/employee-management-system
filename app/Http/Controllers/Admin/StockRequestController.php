<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StockRequisition;
use App\Models\StockItem;
use App\Models\Employee;
use App\Models\StockTransaction;
use App\Http\Requests\SaveStockRequest;
use App\Http\Requests\SaveStockRequestUpdate;
use Illuminate\Support\Facades\Auth;

class StockRequestController extends Controller
{
    public function index()
    {
        $requisitions = StockRequisition::with('requestable')->latest()->paginate(5);

        return view('admin.stockRequisitions.index', compact('requisitions'));
    }

    public function adminIndex(){

       $admin = auth('admin')->user();
        $userType = 'App\Models\Admin';

        $requisitions = StockRequisition::where('requestable_type', $userType)
                                      ->where('requestable_id', $admin->id)
                                      ->paginate(5);

        return view('admin.stockRequisitions.adminIndex', compact('requisitions'));
    }

    public function create()
    {
        $stockItems = StockItem::where('quantity', '>', 0)->get();

        return view('admin.stockRequisitions.create', compact('stockItems'));
    }

    public function store(SaveStockRequest $request)
    {
        $user = auth('admin')->user();
        $userType = \App\Models\Admin::class;

        $validated = $request->validated();

        $validated['requestable_type'] = $userType;
        $validated['requestable_id'] = $user->id;
        $validated['status'] = 'pending';

        StockRequisition::create($validated);

        return redirect()->route('admin.stockRequisitions.index')->with('success', 'Stock requisition submitted successfully');
    }

    public function edit(StockRequisition $stockRequisition)
    {
        $stockItems = StockItem::all();
        if ($stockRequisition->requestable_id !== auth('admin')->id()) {
            return redirect()->route('admin.stockRequisitions.index')->with('error', 'You do not have permission to edit this requisition');
        }
        return view('admin.stockRequisitions.edit', compact('stockRequisition', 'stockItems'));
    }

    public function update(SaveStockRequestUpdate $request, StockRequisition $stockRequisition)
    {
        $validated = $request->validated();

        $stockRequisition->update($validated);

        return redirect()->route('admin.stockRequisitions.index')->with('success', 'Stock requisition updated successfully');
    }

    public function show(StockRequisition $stockRequisition)
    {
        if ($stockRequisition->requestable_id !== auth('admin')->id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.stockRequisitions.show', compact('stockRequisition'));
    }

    public function destroy(StockRequisition $stockRequisition)
    {
        if ($stockRequisition->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending requisitions can be deleted.');
        }

        $stockRequisition->delete();

        return redirect()->route('admin.stockRequisitions.index')->with('success', 'Requisition deleted successfully.');
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

    public function approve(StockRequisition $stockRequisition)
    {
        if (!auth('admin')->user()->can('approve stock requisitions')) {
        abort(403, 'You do not have access to approve this stock request');
        }

        if ($stockRequisition->status === 'approved') {
            return redirect()->back()->with('error', 'Request already approved');
        }

        $stockItem = $stockRequisition->stockItem;
        if ($stockItem->quantity < $stockRequisition->quantity) {
            return redirect()->back()->with('error', 'Insufficient stock available');
        }

        try {
            \DB::transaction(function () use ($stockRequisition, $stockItem) {
                $stockRequisition->update(['status' => 'approved']);
                
                $stockItem->adjustQuantity(
                    $stockRequisition->quantity, 
                    'out', 
                    auth('admin')->user(), 
                    "Stock requisition approved for {$stockRequisition->getDisplayNameAttribute()}"
                );
            });

            return redirect()->back()->with('success', 'Stock requisition approved successfully');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error approving requisition: ' . $e->getMessage());
        }
    }

    public function deny(StockRequisition $stockRequisition)
    {
        if (!auth('admin')->user()->can('deny stock requisitions')) {
        abort(403, 'You do not have access to deny this stock request');
        }
        
        $stockRequisition->update(['status' => 'denied']);

        return redirect()->back()->with('success', 'Stock requisition denied');
    }


}
