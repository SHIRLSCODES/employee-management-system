<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SavePaymentRequest;
use App\Models\PaymentRequest;
use App\Models\Employee;

class PaymentRequestController extends Controller
{
    public function index()
    {
        $paymentRequests = PaymentRequest::paginate(5);

        return view('admin.payments.index', compact('paymentRequests'));
    }

    public function create()
    {
        return view('admin.payments.create');
    }
 
    public function store(SavePaymentRequest $request)
    {
        $data = $request->validated();

        $data['admin_id'] = auth()->id();

        $paymentRequests = PaymentRequest::create($data);

        return redirect()->route('admin.payments.index')->with('success', 'Payment request created successfully.');
    }

    public function show(PaymentRequest $paymentRequest)
    {
        if ($paymentRequest->admin_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.payments.show', compact('paymentRequest'));
    }

    public function edit(PaymentRequest $paymentRequest)
    {
        if ($paymentRequest->admin_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.payments.edit', compact('paymentRequest'));
    }

    public function update(SavePaymentRequest $request, PaymentRequest $paymentRequest)
    {
        if ($paymentRequest->admin_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $data = $request->validated();

        $paymentRequest->update($data);

        return redirect()->route('admin.payments.index')->with('success', 'Payment request updated successfully.');
    }

    public function approve(PaymentRequest $paymentRequest) 
    {
        if ($paymentRequest->admin_id === auth()->id()) {
            abort(403, 'You cannot approve your own payment request.');
        }
        
        $paymentRequest->status = 'approved_by_admin';
        $paymentRequest->save();
        
        return redirect()->route('admin.payments.index')->with('success', 'Payment request approved successfully, Notify finance department.');
    }

    public function deny(PaymentRequest $paymentRequest) 
    {
        if ($paymentRequest->admin_id === auth()->id()) {
            abort(403, 'You cannot deny your own payment request.');
        }
        
        $paymentRequest->status = 'denied_by_admin';
        $paymentRequest->save();
        
        return redirect()->route('admin.payments.index')->with('success', 'Payment request denied successfully.');
    }
    
   public function approveFinance(PaymentRequest $paymentRequest)
    {
        if (auth()->user()->department_id !== 7) {
            abort(403, 'Unauthorized action. Only finance department can give final approval for payment requests.');
        }
        if (!in_array($paymentRequest->status, ['approved_by_admin', 'denied_by_admin'])) {
        abort(403, 'Payment request must be processed by admin first.');
        }
        
        $paymentRequest->status = 'approved_by_finance';
        $paymentRequest->save();
        
        return redirect()->route('admin.payments.index')->with('success', 'Payment request approved by finance department successfully.');
    }

    public function denyFinance(PaymentRequest $paymentRequest)
    {
        if (auth()->user()->department_id !== 7) {
            abort(403, 'Unauthorized action.');
        }
        if (!in_array($paymentRequest->status, ['approved_by_admin', 'denied_by_admin'])) {
        abort(403, 'Payment request must be processed by admin first.');
        }
        $paymentRequest->status = 'denied_by_finance';
        $paymentRequest->save();
        
        return redirect()->route('admin.payments.index')->with('success', 'Payment request denied by finance department successfully.');
    }

    public function destroy(PaymentRequest $paymentRequest)
    {
        if ($paymentRequest->admin_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $paymentRequest->delete();

        return redirect()->route('admin.payments.index')->with('success', 'Payment request deleted successfully.');
    }

}

