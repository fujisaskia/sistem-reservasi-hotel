<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    /* Table Header */
.header-row {
    background-color: #d1d5db; /* bg-rose-100 */
    border-bottom: 1px solid #D1D5DB; /* border-gray-300 */
}

.header-cell {
    padding: 12px;
    text-align: left;
    font-size: 12px; /* text-xs */
    font-weight: 600; /* font-semibold */
    color: #4B5563; /* text-gray-600 */
}

/* Table Body */
.body-row {
    border-bottom: 1px solid #D1D5DB; /* border-gray-300 */
}

.body-cell {
    padding: 12px;
    font-size: 12px; /* text-xs */
    color: #4B5563; /* text-gray-600 */
}

/* Reservation Status */
.status {
    padding: 4px 8px;
    font-size: 12px;
    color: white;
    border-radius: 9999px;
    text-align: center;
    font-style: italic;
}

.status.pending {
    background-color: #FEF3C7; /* bg-yellow-100 */
    color: #92400E; /* text-yellow-700 */
}

.status.confirmed {
    background-color: #D1FAE5; /* bg-green-100 */
    color: #047857; /* text-green-600 */
}

.status.checked-in {
    background-color: #DBEAFE; /* bg-blue-100 */
    color: #1D4ED8; /* text-blue-600 */
}

.status.checked-out {
    background-color: #FFE4E6; /* bg-rose-100 */
    color: #E11D48; /* text-rose-600 */
}

.status.cancelled {
    background-color: #FEE2E2; /* bg-red-100 */
    color: #B91C1C; /* text-red-700 */
}

/* Buttons */
.btn {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    color: white;
    margin-right: 4px;
    border: none;
    cursor: pointer;
}


</style>
<body>
<h1>Laporan Reservasi</h1>

<div style="margin-bottom: 20px;">
    <p>Status : {{ $status ?? 'Semua Status' }}</p>
    <p>
        @if($bulan)
            {{ \Carbon\Carbon::create()->month((int)$bulan)->translatedFormat('F') }}
        @else
            Semua Bulan
        @endif
            , {{ $tahun ?? 'Semua Tahun' }}
    </p>
</div>


    <table>
        <thead>
            <tr class="header-row">
                <th class="header-cell">No</th>
                <th class="header-cell">Nama Tamu</th>
                <th class="header-cell">invoice</th>
                <th class="header-cell">Tipe Kamar</th>                    
                <th class="header-cell">Harga (IDR)</th>
                <th class="header-cell">Tgl. Reservasi</th>
                <th class="header-cell">Tgl. Check-In</th>
                <th class="header-cell">Tgl. Check-Out</th>
                <th class="header-cell">Status Reservasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $key => $reservation)
            <tr class="body-row">
                <td class="body-cell">{{ $key +1 }}</td>
                <td class="body-cell">{{ $reservation->user->full_name }}</td>
                <td class="body-cell">{{ $reservation->invoice->invoice_number }}</td>
                <td class="body-cell">{{ $reservation->roomType->tipe_kamar }}</td>
                <td class="body-cell">IDR {{ number_format($reservation->total_price, 0, ',', ',') }}</td>
                <td class="body-cell">{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('M d, Y') }}</td>
                <td class="body-cell">{{ \Carbon\Carbon::parse($reservation->check_in_date)->format('M d, Y') }}</td>
                <td class="body-cell">{{ \Carbon\Carbon::parse($reservation->check_out_date)->format('M d, Y') }}</td>
                <td class="body-cell">
                    <p class="status {{ strtolower($reservation->reservation_status) }}">
                        {{ $reservation->reservation_status }}
                    </p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>