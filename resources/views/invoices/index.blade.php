@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded border border-green-200">
            {{ session('success') }}
        </div>
    @endif
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <h1 class="text-3xl font-extrabold text-gray-800">Liste des factures</h1>
        <a href="{{ route('invoices.create') }}" class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-6 py-2 rounded shadow hover:from-blue-600 hover:to-indigo-600 transition">+ Nouvelle facture</a>
    </div>
    <div class="overflow-x-auto rounded shadow">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-4 border-b font-semibold text-gray-700">Numéro</th>
                    <th class="py-3 px-4 border-b font-semibold text-gray-700">Client</th>
                    <th class="py-3 px-4 border-b font-semibold text-gray-700">Date d'échéance</th>
                    <th class="py-3 px-4 border-b font-semibold text-gray-700">Montant</th>
                    <th class="py-3 px-4 border-b font-semibold text-gray-700">Statut</th>
                    <th class="py-3 px-4 border-b font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invoices as $invoice)
                <tr class="hover:bg-gray-50 transition">
                    <td class="py-2 px-4 border-b">{{ $invoice->number }}</td>
                    <td class="py-2 px-4 border-b">{{ $invoice->client }}</td>
                    <td class="py-2 px-4 border-b">{{ $invoice->due_date }}</td>
                    <td class="py-2 px-4 border-b">{{ number_format($invoice->amount, 2, ',', ' ') }} €</td>
                    <td class="py-2 px-4 border-b">
                        <span class="px-2 py-1 rounded text-xs font-bold
                            @if($invoice->status == 'payée') bg-green-100 text-green-700
                            @elseif($invoice->status == 'annulée') bg-red-100 text-red-700
                            @else bg-yellow-100 text-yellow-700 @endif">
                            {{ ucfirst($invoice->status) }}
                        </span>
                    </td>
                    <td class="py-2 px-4 border-b flex flex-col sm:flex-row gap-2">
                        <a href="{{ route('invoices.show', $invoice) }}" class="text-blue-600 hover:underline">Voir</a>
                        <a href="{{ route('invoices.edit', $invoice) }}" class="text-yellow-600 hover:underline">Éditer</a>
                        <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Supprimer cette facture ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-4 text-center text-gray-500">Aucune facture trouvée.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection 