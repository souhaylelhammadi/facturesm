<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::withTrashed()->orderByDesc('created_at')->get();
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|unique:invoices,number',
            'client' => 'required',
            'due_date' => 'required|date',
            'amount' => 'required|numeric',
            'status' => 'required',
            'description' => 'nullable',
        ]);
        Invoice::create($validated);
        return redirect()->route('invoices.index')->with('success', 'Facture créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        return view('invoices.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'number' => 'required|unique:invoices,number,' . $invoice->id,
            'client' => 'required',
            'due_date' => 'required|date',
            'amount' => 'required|numeric',
            'status' => 'required',
            'description' => 'nullable',
        ]);
        $invoice->update($validated);
        return redirect()->route('invoices.index')->with('success', 'Facture mise à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Facture supprimée.');
    }

    public function dashboard()
    {
        $total = Invoice::count();
        $totalAmount = Invoice::sum('amount');
        $paid = Invoice::where('status', 'payée')->count();
        $pending = Invoice::where('status', 'en attente')->count();
        $cancelled = Invoice::where('status', 'annulée')->count();
        $invoices = Invoice::orderByDesc('created_at')->get();
        return view('dashboard', compact('total', 'totalAmount', 'paid', 'pending', 'cancelled', 'invoices'));
    }

    public function exportPdf()
    {
        $invoices = Invoice::all();
        $pdf = Pdf::loadView('invoices.pdf', compact('invoices'));
        return $pdf->download('factures.pdf');
    }

    public function exportPdfSingle(Invoice $invoice)
    {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('invoices.pdf_single', compact('invoice'));
        return $pdf->download('facture_' . $invoice->number . '.pdf');
    }
}
