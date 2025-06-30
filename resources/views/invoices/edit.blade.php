@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 max-w-xl">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6">Modifier la facture</h1>
    <form action="{{ route('invoices.update', $invoice) }}" method="POST" class="bg-white p-8 rounded shadow-md space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Numéro</label>
            <input type="text" name="number" value="{{ old('number', $invoice->number) }}" class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-2 focus:ring-blue-400" required>
        </div>
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Client</label>
            <input type="text" name="client" value="{{ old('client', $invoice->client) }}" class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-2 focus:ring-blue-400" required>
        </div>
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Date d'échéance</label>
            <input type="date" name="due_date" value="{{ old('due_date', $invoice->due_date) }}" class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-2 focus:ring-blue-400" required>
        </div>
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Montant (€)</label>
            <input type="number" step="0.01" name="amount" value="{{ old('amount', $invoice->amount) }}" class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-2 focus:ring-blue-400" required>
        </div>
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Statut</label>
            <select name="status" class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-2 focus:ring-blue-400">
                <option value="en attente" @if($invoice->status == 'en attente') selected @endif>En attente</option>
                <option value="payée" @if($invoice->status == 'payée') selected @endif>Payée</option>
                <option value="annulée" @if($invoice->status == 'annulée') selected @endif>Annulée</option>
            </select>
        </div>
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Description</label>
            <textarea name="description" class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-2 focus:ring-blue-400">{{ old('description', $invoice->description) }}</textarea>
        </div>
        <div class="flex gap-4">
            <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-6 py-2 rounded shadow hover:from-blue-600 hover:to-indigo-600 transition">Mettre à jour</button>
            <a href="{{ route('invoices.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300 transition">Annuler</a>
        </div>
    </form>
</div>
@endsection 