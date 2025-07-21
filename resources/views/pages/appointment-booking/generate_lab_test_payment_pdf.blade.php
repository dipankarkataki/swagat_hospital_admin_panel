<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hospital Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 0;
        }

        .page {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            padding: 10px;
            background: #fff;
            box-sizing: border-box;
        }

        .header {
            background-color: #e3f2fd;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .logo {
            max-height: 50px;
            margin-bottom: 10px;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            color: #1565c0;
        }

        .info p {
            margin: 4px 0;
        }

        .box {
            border: 2px solid #1565c0;
            padding: 6px 10px;
            display: inline-block;
            border-radius: 4px;
            font-weight: bold;
            color: #1565c0;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            border-bottom: 1px solid #ccc;
            margin-top: 30px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }

        .summary-table {
            margin-top: 10px;
            width: 100%;
        }

        .summary-table td {
            padding: 6px;
            font-weight: bold;
        }

        .thanks {
            margin-top: 40px;
            text-align: center;
            font-style: italic;
            color: #555;
        }

        .note {
            margin-top: 30px;
            padding: 15px;
            background: #fff3cd;
            border: 1px solid #ffeeba;
            border-radius: 4px;
            color: #856404;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="page">

        <!-- Header Section -->
        <div class="header">
            <table width="100%">
                <tr>
                    <td width="60%" valign="top">
                        @php
                            $logo_path = '/assets/img/logo/swagat-logo-old.png';
                        @endphp
                        @if(file_exists(public_path($logo_path)))
                            <img src="{{ public_path($logo_path) }}" alt="Hospital Logo" class="logo">
                        @endif
                        <h4 style="margin: 5px 0;">Swagat Surgical Super Speciality Hospital</h4>
                        <p style="margin: 0;">
                            Gate No.3, Maligaon, Guwahati<br>
                            Phone: +91 94355 88800<br>
                            Email: swagathospital@gmail.com
                        </p>
                    </td>
                    <td width="40%" align="right" valign="top">
                        <div class="title">Invoice</div>
                        <div class="box">#INV-{{ $invoice_id }}</div><br>
                        <small><strong>Issue Time:</strong> {{ $issue_date }}</small><br>
                        <small><strong>Issue Time:</strong> {{$issue_time}}</small><br>
                        <small><strong>Due Date:</strong> {{ $due_date }}</small>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Bill To -->
        <div class="section-title">Bill To</div>
        <div class="info">
            <p><strong>Name:</strong> {{ $patient_info['patient_name'] ?? '' }}</p>
            <p><strong>Email:</strong> {{ $patient_info['patient_email'] ?? '' }}</p>
            <p><strong>Phone:</strong> {{ $patient_info['patient_phone'] ?? '' }}</p>
        </div>

        <!-- Invoice Items -->
        <div class="section-title">Invoice Items</div>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 50%;">Item Description</th>
                    <th style="width: 15%;">Quantity</th>
                    <th style="width: 15%;">Unit Price</th>
                    <th style="width: 15%;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice_items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item['description'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($item['unit_price'], 2) }}</td>
                        <td>{{ number_format($item['total'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Summary Totals -->
        <table class="summary-table">
            <tr>
                <td class="text-right" colspan="4">Subtotal</td>
                <td class="text-right">Rs {{ $subtotal }}</td>
            </tr>
            <tr>
                <td class="text-right" colspan="4">Tax</td>
                <td class="text-right">Rs {{ $tax }}</td>
            </tr>
            <tr>
                <td class="text-right" colspan="4"><strong>Total</strong></td>
                <td class="text-right"><strong>Rs {{ $total }}</strong></td>
            </tr>
        </table>

        <!-- Footer -->
        <div class="thanks">
            <p>Thank you for choosing Swagat Surgical Super Speciality Hospital. Get well soon!</p>

            <!-- Note -->
            <div class="note" style="margin-top:10px;">
                <strong>Note:</strong> Please present this confirmation at the hospital counter during your visit.
            </div>
        </div>
    </div>
</body>
</html>
