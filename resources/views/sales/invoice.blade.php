<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $sale->id }} — MediTrack</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #f0f5f8;
            padding: 30px;
            color: #2c3e50;
        }

        .invoice-wrapper {
            max-width: 780px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.10);
            overflow: hidden;
        }

        /* ── Header ── */
        .invoice-header {
            background: linear-gradient(135deg, #1e2a3a, #2e7d8c);
            color: #ffffff;
            padding: 36px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .invoice-header .brand {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .invoice-header .brand span {
            color: #7ecfdb;
        }
        .invoice-header .brand-sub {
            font-size: 0.8rem;
            color: #a8c4d0;
            margin-top: 4px;
        }
        .invoice-header .invoice-meta {
            text-align: right;
        }
        .invoice-header .invoice-meta h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #7ecfdb;
            letter-spacing: 2px;
        }
        .invoice-header .invoice-meta p {
            font-size: 0.85rem;
            color: #a8c4d0;
            margin-top: 4px;
        }

        /* ── Status Badge ── */
        .status-bar {
            background: #f7fbfc;
            border-bottom: 1px solid #e8f0f5;
            padding: 10px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .status-completed { background: #d4edda; color: #1e6b30; }
        .status-pending   { background: #fff3cd; color: #856404; }
        .status-cancelled { background: #f8d7da; color: #842029; }

        /* ── Info Grid ── */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            border-bottom: 1px solid #e8f0f5;
        }
        .info-box {
            padding: 28px 40px;
        }
        .info-box:first-child {
            border-right: 1px solid #e8f0f5;
        }
        .info-box h4 {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #2e7d8c;
            margin-bottom: 12px;
        }
        .info-box p {
            font-size: 0.9rem;
            color: #2c3e50;
            margin-bottom: 5px;
            line-height: 1.6;
        }
        .info-box .name {
            font-size: 1.05rem;
            font-weight: 600;
            color: #1e2a3a;
        }

        /* ── Items Table ── */
        .items-section { padding: 28px 40px; }
        .items-section h4 {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #2e7d8c;
            margin-bottom: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead th {
            background: linear-gradient(135deg, #1e2a3a, #2c3e50);
            color: #c8dfe8;
            padding: 10px 14px;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        thead th:first-child { border-radius: 8px 0 0 8px; }
        thead th:last-child  { border-radius: 0 8px 8px 0; text-align: right; }
        tbody td {
            padding: 12px 14px;
            font-size: 0.9rem;
            border-bottom: 1px solid #f0f5f8;
            color: #2c3e50;
        }
        tbody td:last-child { text-align: right; }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: #f7fbfc; }
        .medicine-name { font-weight: 600; color: #1e2a3a; }
        .medicine-sub  { font-size: 0.78rem; color: #6c8a96; margin-top: 2px; }

        /* ── Totals ── */
        .totals-section {
            padding: 0 40px 28px;
            display: flex;
            justify-content: flex-end;
        }
        .totals-box {
            width: 280px;
            background: #f7fbfc;
            border-radius: 10px;
            padding: 18px 20px;
            border: 1px solid #e8f0f5;
        }
        .totals-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            font-size: 0.88rem;
            color: #4a6274;
            border-bottom: 1px solid #e8f0f5;
        }
        .totals-row:last-child { border-bottom: none; }
        .totals-row.discount { color: #e74c3c; }
        .totals-row.grand {
            font-size: 1.05rem;
            font-weight: 700;
            color: #1e2a3a;
            padding-top: 10px;
        }
        .totals-row.grand span:last-child { color: #2e7d8c; }

        /* ── Payment & Notes ── */
        .bottom-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            border-top: 1px solid #e8f0f5;
            padding: 24px 40px;
        }
        .bottom-section h4 {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #2e7d8c;
            margin-bottom: 10px;
        }
        .payment-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            background: linear-gradient(135deg, #2e7d8c, #1a6b7a);
            color: white;
        }

        /* ── Footer ── */
        .invoice-footer {
            background: linear-gradient(135deg, #1e2a3a, #2e7d8c);
            color: #a8c4d0;
            text-align: center;
            padding: 18px 40px;
            font-size: 0.8rem;
        }
        .invoice-footer strong { color: #7ecfdb; }

        /* ── Action Buttons (hidden on print) ── */
        .action-buttons {
            max-width: 780px;
            margin: 20px auto;
            display: flex;
            gap: 12px;
        }
        .btn-print {
            background: linear-gradient(135deg, #2e7d8c, #1a6b7a);
            color: white;
            border: none;
            padding: 10px 28px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-back {
            background: #6c8a96;
            color: white;
            border: none;
            padding: 10px 28px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* ── Print Styles ── */
        @media print {
            body {
                background: white;
                padding: 0;
            }
            .action-buttons { display: none !important; }
            .invoice-wrapper {
                box-shadow: none;
                border-radius: 0;
            }
            @page {
                margin: 0.5cm;
                size: A4;
            }
        }
    </style>
</head>
<body>

    {{-- Action Buttons --}}
    <div class="action-buttons">
        <button onclick="window.print()" class="btn-print">
            🖨️ Print Invoice
        </button>
        <a href="{{ route('sales.show', $sale) }}" class="btn-back">
            ← Back to Sale
        </a>
        <a href="{{ route('sales.index') }}" class="btn-back">
            ← All Sales
        </a>
    </div>

    <div class="invoice-wrapper">

        {{-- Header --}}
        <div class="invoice-header">
            <div>
                <div class="brand">
                    💊 Medi<span>Track</span>
                </div>
                <div class="brand-sub">Pharmacy Management System</div>
                <div class="brand-sub" style="margin-top:8px">
                    📍 Dhaka, Bangladesh<br>
                    📞 01700-000000 &nbsp;|&nbsp; ✉️ info@meditrack.com
                </div>
            </div>
            <div class="invoice-meta">
                <h2>INVOICE</h2>
                <p># {{ str_pad($sale->id, 6, '0', STR_PAD_LEFT) }}</p>
                <p>📅 {{ $sale->created_at->format('d M Y, h:i A') }}</p>
                <p>Served by: {{ $sale->user->name ?? '—' }}</p>
            </div>
        </div>

        {{-- Status Bar --}}
        <div class="status-bar">
            <span style="font-size:0.85rem;color:#6c8a96">
                Payment Method:
                <strong style="color:#1e2a3a">
                    {{ ucfirst(str_replace('_', ' ', $sale->payment_method)) }}
                </strong>
            </span>
            <span class="status-badge status-{{ $sale->status }}">
                {{ strtoupper($sale->status) }}
            </span>
        </div>

        {{-- Customer & Sale Info --}}
        <div class="info-grid">
            <div class="info-box">
                <h4>📋 Bill To</h4>
                @if($sale->customer)
                    <p class="name">{{ $sale->customer->name }}</p>
                    <p>📞 {{ $sale->customer->phone ?? '—' }}</p>
                    <p>✉️ {{ $sale->customer->email ?? '—' }}</p>
                    <p>📍 {{ $sale->customer->address ?? '—' }}</p>
                @else
                    <p class="name">Walk-in Customer</p>
                    <p style="color:#6c8a96">No customer details recorded.</p>
                @endif
            </div>
            <div class="info-box">
                <h4>🧾 Invoice Details</h4>
                <p>
                    <strong>Invoice No:</strong>
                    #{{ str_pad($sale->id, 6, '0', STR_PAD_LEFT) }}
                </p>
                <p><strong>Date:</strong> {{ $sale->created_at->format('d M Y') }}</p>
                <p><strong>Time:</strong> {{ $sale->created_at->format('h:i A') }}</p>
                @if($sale->prescription)
                    <p>
                        <strong>Doctor:</strong>
                        {{ $sale->prescription->doctor_name }}
                    </p>
                @endif
            </div>
        </div>

        {{-- Items Table --}}
        <div class="items-section">
            <h4>💊 Medicines Sold</h4>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Medicine</th>
                        <th>Dosage</th>
                        <th>Qty</th>
                        <th>Unit Price (৳)</th>
                        <th>Subtotal (৳)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sale->saleItems as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>
                            <div class="medicine-name">{{ $item->medicine->name }}</div>
                            @if($item->medicine->generic_name)
                                <div class="medicine-sub">{{ $item->medicine->generic_name }}</div>
                            @endif
                        </td>
                        <td>
                            <span style="font-size:0.82rem;color:#6c8a96">
                                {{ ucfirst($item->medicine->dosage_form) }}
                                {{ $item->medicine->strength ? '— '.$item->medicine->strength : '' }}
                            </span>
                        </td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->unit_price, 2) }}</td>
                        <td><strong>{{ number_format($item->subtotal, 2) }}</strong></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Totals --}}
        <div class="totals-section">
            <div class="totals-box">
                <div class="totals-row">
                    <span>Subtotal</span>
                    <span>৳ {{ number_format($sale->total_amount, 2) }}</span>
                </div>
                @if($sale->discount > 0)
                <div class="totals-row discount">
                    <span>Discount</span>
                    <span>− ৳ {{ number_format($sale->discount, 2) }}</span>
                </div>
                @endif
                <div class="totals-row grand">
                    <span>Total Paid</span>
                    <span>৳ {{ number_format($sale->paid_amount, 2) }}</span>
                </div>
            </div>
        </div>

        {{-- Payment & Thank You --}}
        <div class="bottom-section">
            <div>
                <h4>💳 Payment Method</h4>
                <span class="payment-badge">
                    {{ ucfirst(str_replace('_', ' ', $sale->payment_method)) }}
                </span>
            </div>
            <div>
                <h4>📝 Note</h4>
                <p style="font-size:0.85rem;color:#6c8a96;line-height:1.6">
                    Please keep this invoice for your records.<br>
                    Return policy: within 3 days with receipt.
                </p>
            </div>
        </div>

        {{-- Footer --}}
        <div class="invoice-footer">
            Thank you for choosing <strong>MediTrack Pharmacy</strong>!
            &nbsp;|&nbsp;
            Get well soon 💊
            &nbsp;|&nbsp;
            {{ $sale->created_at->format('Y') }} © MediTrack
        </div>

    </div>

</body>
</html>