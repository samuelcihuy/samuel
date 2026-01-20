<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
</head>
<body>
<div class="container">
    <div class="header">
        <div>
            <div class="title">Nota Pembelian</div>
        </div>
        <div class="info">
            <div><strong>No:</strong> INV-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
            <div><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y H:i') }}</div>
         
        </div>
    </div>

    <hr>

    <div class="customer-info">
        <div><strong>Pelanggan</strong></div>
        <div>{{ $order->customer_name }}</div>
        <div class="text-xs text-gray">{{ $order->customer_email }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:55%;">Produk</th>
                <th class="right" style="width:10%;">Qty</th>
                <th class="right" style="width:15%;">Harga</th>
                <th class="right" style="width:20%;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>
                    <div style="display:flex; gap:8px; align-items:center;">
                        @if(isset($item->product) && ($item->product->image_url ?? false))
                        <img src="{{ $item->product->image_url }}" style="width:48px;height:48px;object-fit:cover;border-radius:6px;" />
                        @endif
                        <div>
                          <div style="font-weight:600;">{{ $item->product->name ?? ('Produk #' . $item->product_id) }}</div>
                          @if(isset($item->product) && ($item->product->description ?? false))
                            <div style="font-size:11px;color:#6b7280">{{ 
                              Str::limit($item->product->description, 60) }}</div>
                          @endif
                        </div>
                    </div>
                </td>
                <td class="right">{{ $item->qty }}</td>
                <td class="right">Rp{{ number_format($item->price) }}</td>
                <td class="right">Rp{{ number_format($item->price * $item->qty) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="display:flex; justify-content:space-between; align-items:center; margin-top:22px;">
        <div style="font-size:12px;color:#6b7280">Catatan: Harap simpan invoice ini sebagai bukti pembayaran.</div>
        <div style="text-align:right;">
            <div class="text-sm" style="color:#6b7280">Subtotal</div>
            <div class="total">Rp{{ number_format($order->total) }}</div>
        </div>
    </div>

    <div class="footer">
        <div>Terima kasih telah berbelanja di <strong>Toko1</strong> 🙏</div>
        <div>Kontak: samuel67 · +62 812-3456-7890</div>
    </div>
</div>
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
</body> 
</html>
