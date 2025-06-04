<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to the Organization</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px; color: #333;">

    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; padding: 30px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        
        <h2 style="color: #0d6efd;">Welcome, {{ $employee->first_name }} {{ $employee->last_name }}!</h2>

        <p style="font-size: 16px;">We are excited to have you join our team at EMS. Below are your login credentials to access the employee portal:</p>
        
        <p style="font-size: 16px;"><strong>Login Credentials:</strong></p>
        <ul style="font-size: 16px; line-height: 1.6;">
            <li><strong>Email:</strong> {{ $employee->email }}</li>
            <li><strong>Password:</strong> {{ $plainPassword }}</li>
        </ul>

        <p style="font-size: 16px;">Please log in and change your password immediately for security reasons.</p>

        <p style="font-size: 16px;">Best regards,<br>
        <strong>{{ $admin->name }}</strong></p>
    </div>

</body>
</html>

