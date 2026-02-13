<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { background: #7c3aed; color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { padding: 30px; background: #fdfdfd; }
        .status-badge { display: inline-block; padding: 8px 15px; border-radius: 5px; font-weight: bold; text-transform: uppercase; background: #e0e7ff; color: #4338ca; }
        .footer { text-align: center; padding: 20px; font-size: 0.8rem; color: #999; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>NOBLER</h1>
        </div>
        <div class="content">
            <h2>Order Update!</h2>
            <p>Hello {{ $order->user->name }},</p>
            <p>The status of your order <strong>#{{ $order->id }}</strong> has been updated to:</p>
            <div style="text-align: center; margin: 20px 0;">
                <span class="status-badge">{{ $order->status }}</span>
            </div>
            <p>You can track your order live on your dashboard.</p>
            <p>Thank you for shopping with NOBLER!</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} NOBLER | Created by syedDev
        </div>
    </div>
</body>
</html>
