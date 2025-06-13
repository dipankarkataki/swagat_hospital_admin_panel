<!DOCTYPE html>
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
            width: 900px;
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
</html>
