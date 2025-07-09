{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Appointment Booking Details</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing: border-box;
        }
        .booking-details-pdf{
            /* background-color: aliceblue; */
            width: 800px;
            position: absolute;
            left: 50%;
            transform: translate(-50%);
            border: .0625rem solid #002d39;
            margin-bottom: 30px;
            margin-top:10px;
        }
        .booking-details-pdf .header{
            padding: 30px;
            text-align: center;
            background-color: rgb(239, 241, 248);
        }

        .booking-details-pdf .header .logo{
            /* padding-top:20px; */
        }

        .booking-details-pdf .header .title{
            margin-top:30px;
        }
        .divider{
            margin-top: 20px;
            height: 3px;
            /* background-color: rgb(222, 222, 222); */
        }
        .created-at-div{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            padding:10px 30px;
        }
        .created-at-div p{
           font-size: 14px;
           font-weight: 500;
        }
        .created-at-div .note-text{
            color: crimson;
        }
        .booking-details-pdf .content{
            padding: 10px 30px;
        }

        .booking-details-pdf .content .heading{
            font-size: 16px;
            margin-bottom: 10px;
        }

        .booking-details-pdf .content p{
            margin-bottom:7px;
        }

        .booking-details-pdf .content .hospital-details{
            margin-bottom: 30px;
            border: .0625rem solid #e5e5e5;
            padding: 20px;
            border-radius: 7px;
        }

        .booking-details-pdf .content .user{
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .booking-details-pdf .content .user  .info{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .booking-details-pdf .content .user .appointment-details, .patient-details{
            margin-bottom: 30px;
            border: .0625rem solid #e5e5e5;
            width: 400px;
            padding: 20px;
            border-radius: 7px;
        }


    </style>
</head>
<body>
    <div class="booking-details-pdf">
        <div class="header">
            <div class="logo">
                <img src="{{asset('assets/img/logo/swagat-logo-old.png')}}" alt="hospital logo" />
            </div>
            <div class="title">
                <h3>APPOINTMENT CONFIRMATION RECEIPT</h3>
            </div>
        </div>
        <div class="divider"></div>
        <div class="created-at-div">
            <p><span class="note-text">Note:</span> Kindly present this receipt at the counter upon arrival</p>
            <p>Created At: 2025-06-13 20:00:12</p>
        </div>
        <div class="content">
            <div class="hospital-details">
                <h5 class="heading">Swagat Super Speciality Hospital and Surgical institute</h5>
                <p>Gate No. 4, Mahapurush Srimanta Damodar Dev Path, near Railway Colony, Maligaon, Guwahati, Assam 781011</p>
                <p>7896541235</p>
                <p>swagathospital@gmail.com</p>
            </div>
            <div class="user">
                <div class="appointment-details">
                    <h5 class="heading">Appointment Details: </h5>
                    <div class="info">
                        <label>Unique ID: </label>
                        <p>BK-SWGH-20250613-00001</p>
                    </div>
                    <div class="info">
                        <label>Doctor: </label>
                        <p>Arnab Kalita</p>
                    </div>
                    <div class="info">
                        <label>Department: </label>
                        <p>Nephrology</p>
                    </div>
                    <div class="info">
                        <label>OPD Date: </label>
                        <p>June 6, 2025</p>
                    </div>
                    <div class="info">
                        <label>OPD Time: </label>
                        <p>10 AM - 2 PM</p>
                    </div>
                    <div class="info">
                        <label>OPD Mode: </label>
                        <p>Offline</p>
                    </div>
                </div>
                <div class="patient-details">
                    <h5 class="heading">Patient Details</h5>
                    <div class="info">
                        <label>Full Name: </label>
                        <p>Jhon Das</p>
                    </div>
                    <div class="info">
                        <label>Email: </label>
                        <p>jhondas@gmail.com</p>
                    </div>
                    <div class="info">
                        <label>Phone Number: </label>
                        <p>7002975463</p>
                    </div>
                    <div class="info">
                        <label>Date of Birth: </label>
                        <p>1995-02-25</p>
                    </div>
                    <div class="info">
                        <label>Gender: </label>
                        <p>Male</p>
                    </div>
                    <div class="info">
                        <label>Zip Code: </label>
                        <p>789654</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Appointment Confirmation</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

  <!-- Google Font: Figtree -->
  <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    /* A4 Page Setup */
    @page {
      size: A4;
      margin: 0;
    }

    body {
      font-family: 'Figtree', sans-serif;
      background-color: #f4f6f9;
      margin: 0;
      padding: 0;
    }

    .receipt-container {
      width: 210mm;
      min-height: 297mm;
      margin: 0 auto;
      padding: 20mm;
      background-color: #ffffff;
      box-sizing: border-box;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
      border-radius: 6px;
    }

    .receipt-header {
      background-color: #e3f2fd;
      padding: 20px 30px;
      border-radius: 6px;
      margin-bottom: 30px;
    }

    .receipt-title {
      font-size: 24px;
      font-weight: 700;
      color: #1565c0;
    }

    .appointment-number-box {
      border: 2px solid #1565c0;
      padding: 8px 14px;
      display: inline-block;
      border-radius: 4px;
      background-color: #ffffff;
      font-weight: 600;
      font-size: 15px;
      color: #1565c0;
      margin-bottom: 5px;
    }

    .section-title {
      font-weight: 600;
      font-size: 18px;
      margin-top: 30px;
      margin-bottom: 15px;
      color: #37474f;
      border-bottom: 2px solid #e0e0e0;
      padding-bottom: 5px;
    }

    .details p {
      margin-bottom: 8px;
      font-size: 15px;
    }

    .note-box {
      margin-top: 40px;
      padding: 20px;
      background: #fff3cd;
      border: 1px solid #ffeeba;
      border-radius: 4px;
      color: #856404;
      font-size: 15px;
    }

    .logo {
      max-width: 120px;
    }

    @media print {
      body {
        margin: 0;
        padding: 0;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
        background: white;
      }

      .no-print {
        display: none !important;
      }

      .receipt-container {
        box-shadow: none;
        border-radius: 0;
      }

      .receipt-header {
        background-color: #e3f2fd !important;
      }

      .appointment-number-box {
        border-color: #1565c0 !important;
        color: #1565c0 !important;
      }

      .note-box {
        background-color: #fff3cd !important;
        color: #856404 !important;
        border-color: #ffeeba !important;
      }
    }
  </style>
</head>
<body>

  <div class="receipt-container">

    <!-- Header -->
    <div class="receipt-header d-flex justify-content-between align-items-center flex-wrap">
      <div class="mb-2">
        <img src="{{asset('assets/img/logo/swagat-logo-old.png')}}" alt="Hospital Logo" class="logo mb-2" />
        <h5 class="mt-1 mb-0 font-weight-bold">{{$hospital_name}}</h5>
        <small>{{$hospital_address}}<br>Phone: {{$hospital_phone}} · swagathospital@gmail.com</small>
      </div>
      <div class="text-right">
        <h4 class="receipt-title">Appointment Confirmation</h4>
        <div class="appointment-number-box">{{$booking_id}}</div><br>
        <small><strong>Issue Date:</strong>{{$created_at}}</small>
      </div>
    </div>

    <!-- Patient Details -->
    <div class="details">
      <div class="section-title">Patient Details</div>
      <p><strong>Name:</strong> {{$patient_full_name}}</p>
      <p><strong>D.O.B:</strong> {{$dob}}</p>
      <p><strong>Gender:</strong> {{$gender}}</p>
      <p><strong>Mobile:</strong> {{$patient_phone}}</p>
      <p><strong>Email:</strong> {{$patient_email}}</p>
    </div>

    <!-- Doctor Details -->
    <div class="details">
      <div class="section-title">Doctor Details</div>
      <p><strong>Doctor:</strong> Dr. {{$doctor_name}}</p>
      <p><strong>Department:</strong> {{$department}}</p>
      <p><strong>Appointment Date:</strong> {{$opd_date}}</p>
      <p><strong>Time:</strong> {{$opd_time}}</p>
      <p><strong>Type:</strong> {{$opd_mode}} - In-Person Consultation</p>
    </div>

    <!-- Note -->
    <div class="note-box text-center mt-5">
      <strong>Note:</strong> Please present this confirmation at the hospital counter during your visit.
    </div>

    <!-- Print Button -->
    <div class="text-center mt-4 no-print">
      <button class="btn btn-primary" onclick="window.print()">Print Confirmation</button>
    </div>
  </div>

</body>
</html>
