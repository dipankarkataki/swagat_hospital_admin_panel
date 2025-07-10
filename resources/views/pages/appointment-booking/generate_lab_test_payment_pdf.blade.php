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
                        <div class="box">Invoice #INV-1001</div><br>
                        <small><strong>Issue Date:</strong> 10 Jul 2025</small><br>
                        <small><strong>Due Date:</strong> 10 Jul 2025</small>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Bill To -->
        <div class="section-title">Bill To</div>
        <div class="info">
            <p><strong>Name:</strong> Dipankar kataki</p>
            <p><strong>Address:</strong> 456 Patient Road, Wellness Town, ST 654321</p>
            <p><strong>Phone:</strong> (987) 654-3210</p>
        </div>

        <!-- Invoice Items -->
        <div class="section-title">Invoice Items</div>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 50%;">Item Description</th>
                    <th style="width: 15%;">Quantity</th>
                    <th style="width: 15%;">Unit Price (₹)</th>
                    <th style="width: 15%;">Total (₹)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Liver Test</td>
                    <td>1</td>
                    <td>500.00</td>
                    <td>500.00</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>X-Ray - Chest</td>
                    <td>1</td>
                    <td>800.00</td>
                    <td>800.00</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Blood Test (Complete Profile)</td>
                    <td>1</td>
                    <td>1200.00</td>
                    <td>1200.00</td>
                </tr>
            </tbody>
        </table>

        <!-- Summary Totals -->
        <table class="summary-table">
            <tr>
                <td class="text-right" colspan="4">Subtotal</td>
                <td class="text-right">₹2500.00</td>
            </tr>
            <tr>
                <td class="text-right" colspan="4">Tax (5%)</td>
                <td class="text-right">₹125.00</td>
            </tr>
            <tr>
                <td class="text-right" colspan="4">Total</td>
                <td class="text-right">₹2625.00</td>
            </tr>
        </table>

        <!-- Footer -->
        <div class="thanks">
            Thank you for choosing CityCare Hospital. Get well soon!

            <!-- Note -->
            <div class="note">
                <strong>Note:</strong> Please present this confirmation at the hospital counter during your visit.
            </div>
        </div>
    </div>
</body>
</html>
