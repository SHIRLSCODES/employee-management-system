<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SavePaymentRequest;
use App\Models\PaymentRequest;

class PaymentRequestController extends Controller
{
    public function index()
    {
        $paymentRequests = PaymentRequest::where('employee_id', auth()->id())->latest()->paginate(5);

        return view('payments.index', compact('paymentRequests'));
    }

    public function create()
    {
        return view('payments.create');
    }
 
    public function store(SavePaymentRequest $request)
    {
        $data = $request->validated();

        $data['employee_id'] = auth()->id();

        $paymentRequests = PaymentRequest::create($data);

        return redirect()->route('payments.index')->with('success', 'Payment request created successfully.');
    }

    public function show(PaymentRequest $paymentRequest)
    {
        if ($paymentRequest->employee_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('payments.show', compact('paymentRequest'));
    }

    public function edit(PaymentRequest $paymentRequest)
    {
        if ($paymentRequest->employee_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('payments.edit', compact('paymentRequest'));
    }

    public function update(SavePaymentRequest $request, PaymentRequest $paymentRequest)
    {
        if ($paymentRequest->employee_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $data = $request->validated();

        $paymentRequest->update($data);

        return redirect()->route('payments.index')->with('success', 'Payment request updated successfully.');
    }
    
    public function destroy(PaymentRequest $paymentRequest)
    {
        if ($paymentRequest->employee_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $paymentRequest->delete();

        return redirect()->route('payments.index')->with('success', 'Payment request deleted successfully.');
    }
}
