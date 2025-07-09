<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appointment Confirmation</title>
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
            padding: 5px;
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
            font-size: 20px;
            font-weight: bold;
            color: #1565c0;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            border-bottom: 1px solid #ccc;
            margin-top: 30px;
            margin-bottom: 10px;
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
            margin-top:5px;
            margin-bottom: 5px;
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
                        @if(file_exists(public_path($logo_path)))
                            <img src="{{ public_path($logo_path) }}" alt="Hospital Logo" class="logo">
                        @endif
                        <h4 style="margin: 5px 0;">{{ $hospital_name }}</h4>
                        <p style="margin: 0;">{{ $hospital_address }}<br>Phone: {{ $hospital_phone }}<br>Email: swagathospital@gmail.com</p>
                    </td>
                    <td width="40%" align="right" valign="top">
                        <div class="title">Appointment Confirmation</div>
                        <div class="box">{{ $booking_id }}</div><br>
                        <small><strong>Issue Date:</strong> {{ \Carbon\Carbon::parse($created_at)->format('d M Y') }}</small>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Patient Details -->
        <div class="section-title">Patient Details</div>
        <div class="info">
            <p><strong>Name:</strong> {{ $patient_full_name }}</p>
            <p><strong>D.O.B:</strong> {{ $dob }}</p>
            <p><strong>Gender:</strong> {{ $gender }}</p>
            <p><strong>Mobile:</strong> {{ $patient_phone }}</p>
            <p><strong>Email:</strong> {{ $patient_email }}</p>
        </div>

        <!-- Doctor Details -->
        <div class="section-title">Doctor Details</div>
        <div class="info">
            <p><strong>Doctor:</strong> Dr. {{ $doctor_name }}</p>
            <p><strong>Department:</strong> {{ $department }}</p>
            <p><strong>Appointment Date:</strong> {{ $opd_date }}</p>
            <p><strong>Time:</strong> {{ $opd_time }}</p>
            <p><strong>Type:</strong> {{ ucfirst($opd_mode) }} - In-Person Consultation</p>
        </div>

        <!-- Note -->
        <div class="note">
            <strong>Note:</strong> Please present this confirmation at the hospital counter during your visit.
        </div>
    </div>
</body>
</html>

