<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockItem;
use App\Http\Requests\SaveNewStockRequest;

class StockController extends Controller
{
    public function index(){

    }

    public function create(){
        return view('admin.stocks.create');
    }

    public function store(SaveNewStockRequest $request){

        $validated = $request->validated();

        $validated['is_returnable'] = $request->has('is_returnable');

        StockItem::create($validated);

        return redirect()->route('admin.stocks.create')->with('success', 'Stock item created successfully.');
    }
}
