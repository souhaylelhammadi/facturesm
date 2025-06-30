@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 max-w-2xl">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6">Détail de la facture</h1>
    <div class="bg-white p-8 rounded shadow-md space-y-4">
        <div class="flex justify-between items-center mb-4">
            <span class="text-lg font-bold text-gray-700">Facture n°{{ $invoice->number }}</span>
            <span class="px-3 py-1 rounded text-xs font-bold
                @if($invoice->status == 'payée') bg-green-100 text-green-700
                @elseif($invoice->status == 'annulée') bg-red-100 text-red-700
                @else bg-yellow-100 text-yellow-700 @endif">
                {{ ucfirst($invoice->status) }}
            </span>
        </div>
        <p><span class="font-semibold text-gray-600">Client :</span> {{ $invoice->client }}</p>
        <p><span class="font-semibold text-gray-600">Date d'échéance :</span> {{ $invoice->due_date }}</p>
        <p><span class="font-semibold text-gray-600">Montant :</span> <span class="text-blue-700 font-bold">{{ number_format($invoice->amount, 2, ',', ' ') }} €</span></p>
        <p><span class="font-semibold text-gray-600">Description :</span> {{ $invoice->description }}</p>
    </div>
    <div class="mt-6 flex flex-wrap gap-4">
        <a href="{{ route('invoices.edit', $invoice) }}" class="bg-yellow-400 text-white px-6 py-2 rounded shadow hover:bg-yellow-500 transition">Éditer</a>
        <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" onsubmit="return confirm('Supprimer cette facture ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded shadow hover:bg-red-600 transition">Supprimer</button>
        </form>
        <a href="{{ route('invoices.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300 transition">Retour à la liste</a>
        <button onclick="window.print()" class="bg-blue-500 text-white px-6 py-2 rounded shadow hover:bg-blue-600 transition">Imprimer</button>
    </div>
</div>
@endsection 