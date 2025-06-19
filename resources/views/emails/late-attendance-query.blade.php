<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Notice</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 300;
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        
        .notice-box {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-left: 4px solid #f39c12;
            padding: 20px;
            margin: 25px 0;
            border-radius: 4px;
        }
        
        .notice-text {
            margin: 0;
            color: #856404;
            font-weight: 500;
        }
        
        .action-required {
            background-color: #f8f9fa;
            border-left: 4px solid #dc3545;
            padding: 20px;
            margin: 25px 0;
            border-radius: 4px;
        }
        
        .action-required p {
            margin: 0;
            color: #721c24;
            font-weight: 500;
        }
        
        .footer {
            background-color: #f8f9fa;
            padding: 25px 30px;
            border-top: 1px solid #e9ecef;
        }
        
        .issued-by {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 15px;
        }
        
        .signature {
            font-weight: 600;
            color: #495057;
        }
        
        .hr-line {
            border: none;
            height: 1px;
            background: linear-gradient(to right, transparent, #ddd, transparent);
            margin: 20px 0;
        }
        
        @media (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 0;
            }
            
            .content {
                padding: 30px 20px;
            }
            
            .header {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Attendance Notice</h1>
        </div>
        
        <div class="content">
            <p class="greeting">Dear {{ $employee->first_name }},</p>
            
            <div class="notice-box">
                <p class="notice-text">
                    This is to formally notify you that you have been late <strong>{{ $lateCount }}</strong> times this month.
                </p>
            </div>
            
            <div class="action-required">
                <p>Please take immediate action to address your punctuality. Continued lateness may lead to disciplinary measures.</p>
            </div>
        </div>
        
        <div class="footer">
            <p class="issued-by">Issued by: {{ $admin->name }}</p>
            
            <hr class="hr-line">
            
            <div class="signature">
                Regards,<br>
                HR Department
            </div>
        </div>
    </div>
</body>
</html>