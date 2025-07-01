<html>
<head>
    <meta charset="utf-8">
    <title>Liste des factures</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>
    <h2>Liste des factures</h2>
    <table>
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Client</th>
                <th>Date d'échéance</th>
                <th>Montant</th>
                <th>Statut</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->number }}</td>
                <td>{{ $invoice->client }}</td>
                <td>{{ $invoice->due_date }}</td>
                <td>{{ number_format($invoice->amount, 2, ',', ' ') }} €</td>
                <td>{{ ucfirst($invoice->status) }}</td>
                <td>{{ ($invoice->description) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html> 