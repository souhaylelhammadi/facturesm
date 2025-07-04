@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4  ">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Factures actuelles</h2>
        <a href="{{ route('invoices.export.pdf') }}" class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-6 py-2 rounded shadow hover:from-blue-600 hover:to-indigo-600 transition">Exporter tout en PDF</a>
    </div>
    <h1 class="text-3xl font-extrabold text-gray-800 mb-8">Dashboard</h1>
    <div class="flex flex-row gap-6 mb-8 flex-wrap sm:flex-nowrap">
        <div class="bg-white p-6 rounded shadow text-center flex-1 min-w-[180px]">
            <div class="text-gray-500">Total factures</div>
            <div class="text-2xl font-bold text-blue-600">{{ $total }}</div>
        </div>
        <div class="bg-white p-6 rounded shadow text-center flex-1 min-w-[180px]">
            <div class="text-gray-500">Montant total</div>
            <div class="text-2xl font-bold text-green-600">{{ number_format($totalAmount, 2, ',', ' ') }} €</div>
        </div>
        <div class="bg-white p-6 rounded shadow text-center flex-1 min-w-[180px]">
            <div class="text-gray-500">Payées</div>
            <div class="text-2xl font-bold text-green-500">{{ $paid }}</div>
        </div>
        <div class="bg-white p-6 rounded shadow text-center flex-1 min-w-[180px]">
            <div class="text-gray-500">En attente</div>
            <div class="text-2xl font-bold text-yellow-500">{{ $pending }}</div>
        </div>
    
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
                        <a href="{{ route('invoices.export.pdf.single', $invoice) }}" class="text-green-600 hover:underline">Exporter PDF</a>
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
@endsection
