<html>
<head>
    <meta charset="utf-8">
    <title>Facture {{ $invoice->number }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>
    <h2>Facture n°{{ $invoice->number }}</h2>
    <table>
        <tr><th>Client</th><td>{{ $invoice->client }}</td></tr>
        <tr><th>Date d'échéance</th><td>{{ $invoice->due_date }}</td></tr>
        <tr><th>Montant</th><td>{{ number_format($invoice->amount, 2, ',', ' ') }} €</td></tr>
        <tr><th>Statut</th><td>{{ ucfirst($invoice->status) }}</td></tr>
        <tr><th>Description</th><td>{{ $invoice->description }}</td></tr>
    </table>
</body>
</html> 