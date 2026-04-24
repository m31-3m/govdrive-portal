<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ServiceRequestController extends Controller
{
    use AuthorizesRequests; 

    public function index()
    {
        $requests = (auth()->user()->role === 1) 
            ? ServiceRequest::with('user')->latest()->get() 
            : auth()->user()->serviceRequests()->latest()->get();

        return view('requests.index', compact('requests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'description' => 'required',
            'document' => 'nullable|mimes:pdf,jpg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('document')) {
            $data['document_path'] = $request->file('document')->store('documents', 'public');
        }

        auth()->user()->serviceRequests()->create($data);

        return redirect()->back()->with('success', 'Application submitted to the secure vault.');
    }

    public function updateStatus(Request $request, ServiceRequest $serviceRequest)
    {
        $this->authorize('updateStatus', ServiceRequest::class);
        
        $request->validate(['status' => 'required|in:approved,rejected']);
        $serviceRequest->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status updated to ' . $request->status);
    }

    public function destroy(ServiceRequest $serviceRequest)
    {
        $this->authorize('delete', $serviceRequest);
        $serviceRequest->delete();
        return redirect()->back()->with('success', 'Record archived.');
    }
}