<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        * {
            font-family: 'Courier New', Courier, monospace;
        }
        body {
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
        }
        .container {
            width: 100%;
            max-width: 800px;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .text-center {
            text-align: center;
        }
        .border-bottom {
            border-bottom: 2px solid #d1d5db;
            margin-bottom: 20px;
            padding-bottom: 8px;
        }
        .uppercase {
            text-transform: uppercase;
        }
        h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 500;
            color: #4b5563;
        }
        .my-8 {
            margin: 32px 0;
        }
        .flex {
            display: flex;
            justify-content: space-between;
        }
        .font-semibold {
            font-weight: 600;
        }
        .text-gray-600 {
            color: #4b5563;
        }
        .bg-gray-200 {
            background-color: #e5e7eb;
        }
        .p-2, .p-3 {
            padding: 8px;
        }
        .px-3 {
            padding-left: 12px;
            padding-right: 12px;
        }
        .py-2 {
            padding-top: 8px;
            padding-bottom: 8px;
        }
        .border {
            border: 1px solid #d1d5db;
        }
        .border-t {
            border-top: 1px solid #d1d5db;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 8px;
            border: 1px solid #d1d5db;
        }
        .table th {
            background-color: #e5e7eb;
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .text-base {
            font-size: 16px;
        }
        .font-bold {
            font-weight: bold;
        }
        .font-medium {
            font-weight: 500;
        }
        .grand-total {
            font-size: 18px;
            font-weight: bold;
            background-color: #f3f4f6;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Invoice Header -->
        <div class="text-center border-bottom uppercase">
            <h1>Invoice</h1>
            <h2>#{{ $reservation->invoice->invoice_number }}</h2>
        </div>

        <!-- Guest Information -->
        <div class="my-8">
            <strong>Informasi Tamu</strong>
            <div class="flex mt-3">
                <div>
                    <div>
                        <strong>Nama</strong>
                        <p>{{ $reservation->user->full_name }}</p>
                    </div>
                    <div>
                        <strong>Email</strong>
                        <p>{{ $reservation->user->email }}</p>
                    </div>
                </div>
                <div>
                    <div>
                        <strong>Telepon</strong>
                        <p>{{ $reservation->user->phone_number }}</p>
                    </div>
                    <div>
                        <strong>Tanggal: </strong> 
                        <p>{{ \Carbon\Carbon::parse($reservation->check_in_date)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($reservation->check_out_date)->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <table class="table">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3">Keterangan</th>
                    <th class="p-3 text-right">Harga</th>
                    <th class="p-3">Qty</th>
                    <th class="p-3 text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b font-semibold text-gray-600">
                    <td class="px-3 py-2" colspan="4">Kamar</td>
                </tr>
                <tr>
                    <td class="px-3 py-2">{{ $reservation->roomType->tipe_kamar }}</td>
                    <td class="px-3 py-2 text-right">IDR {{ number_format($reservation->roomType->harga, '0', ',', ',') }}</td>
                    <td class="px-3 py-2">
                        {{ $reservation->total_room }} Kamar x {{ $nights }} Malam
                    </td>
                    <td class="px-3 py-2 text-right">IDR {{ number_format($reservation->payment->amount, '0', ',', ',') }}</td>
                </tr>
                <tr class="border-b font-semibold text-gray-600">
                    <td class="px-3 py-2" colspan="4">Layanan</td>
                </tr>
                @foreach ($reservation->serviceOrders as $serviceOrder)
                <tr>
                    <td class="px-3 py-2">{{ $serviceOrder->service->name }}</td>
                    <td class="px-3 py-2 text-right">IDR {{ number_format($serviceOrder->service->price, '0', ',', ',') }}</td>
                    <td class="px-3 py-2">{{ $serviceOrder->quantity }}</td>
                    <td class="px-3 py-2 text-right">IDR {{ number_format($serviceOrder->total_price, '0', ',', ',') }}</td>
                </tr>
                @endforeach
                <tr class="font-semibold text-gray-800 border-t">
                    <td class="p-2 text-right" colspan="3">Total Layanan</td>
                    <td class="p-2 text-right">IDR {{ number_format($serviceOrderTotal, '0', ',', ',') }}</td>
                </tr>
                <tr class="grand-total">
                    <td class="p-2 text-right" colspan="3">Grand Total</td>
                    <td class="p-2 text-right">IDR {{ number_format($grandTotal, '0', ',', ',') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>
