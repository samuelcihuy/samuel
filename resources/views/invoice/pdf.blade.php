<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 0;
            background: #f9fafb;
        }
        .container {
            width: 95%;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .title {
            font-size: 28px;
            font-weight: bold;
            color: #10b981;
        }
        .info {
            text-align: right;
            font-size: 12px;
        }
        hr {
            border: none;
            border-top: 1px solid #e5e7eb;
            margin: 20px 0;
        }
        .customer-info {
            margin-bottom: 20px;
            font-size: 13px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 12px;
        }
        th {
            background: #e0f2fe;
            padding: 10px;
            text-align: left;
            border-bottom: 2px solid #cbd5e1;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
        }
        tr:nth-child(even) {
            background: #f9fafb;
        }
        .right {
            text-align: right;
        }
        .total-box {
            margin-top: 25px;
            text-align: right;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
            color: #10b981;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #9ca3af;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            font-size: 11px;
            font-weight: bold;
            color: #fff;
            background: #3b82f6;
            border-radius: 6px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div class="title">INVOICE</div>
        <div class="info">
            <div><strong>No:</strong> INV-{{ $order->id }}</div>
            <div><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y') }}</div>
        </div>
    </div>

    <hr>

    <div class="customer-info">
        <strong>Nama:</strong> {{ $order->customer_name }}<br>
        <strong>Email:</strong> {{ $order->customer_email }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th class="right">Qty</th>
                <th class="right">Harga</th>
                <th class="right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>Produk #{{ $item->product_id }} 
                    @if($item->discount ?? false)
                        <span class="badge">-{{ $item->discount }}%</span>
                    @endif
                </td>
                <td class="right">{{ $item->qty }}</td>
                <td class="right">Rp{{ number_format($item->price) }}</td>
                <td class="right">Rp{{ number_format($item->price * $item->qty) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-box">
        <div>Total Pembayaran</div>
        <div class="total">Rp{{ number_format($order->total) }}</div>
    </div>

    <div class="footer">
        Terima kasih telah berbelanja di toko kami 🙏<br>
        www.tokosaya.com
    </div>
</div>
</body> 
</html>
