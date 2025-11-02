<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'Georgia', serif;
            background-color: #f8f5f1;
            padding: 20px;
            color: #2c1810;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 1px solid #e8e1d9;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #8b4513;
            font-family: 'Playfair Display', Georgia, serif;
            margin-bottom: 10px;
        }

        .divider {
            border-top: 2px solid #e8e1d9;
            margin: 20px 0;
            position: relative;
        }

        .divider::before {
            content: "📚";
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: #ffffff;
            padding: 0 15px;
        }

        h2 {
            color: #8b4513;
            font-family: 'Playfair Display', Georgia, serif;
            text-align: center;
            margin-bottom: 25px;
        }

        .otp-code {
            font-size: 36px;
            font-weight: bold;
            color: #8b4513;
            text-align: center;
            padding: 25px;
            background-color: #f8f5f1;
            border-radius: 8px;
            letter-spacing: 8px;
            margin: 25px 0;
            border: 2px dashed #d4b59e;
        }

        p {
            line-height: 1.6;
            margin-bottom: 15px;
            text-align: center;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #6c584c;
            margin-top: 30px;
        }

        .quote {
            font-style: italic;
            color: #6c584c;
            text-align: center;
            margin: 25px 0;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">Book Heaven</div>
            <p>Your Gateway to Literary Paradise</p>
        </div>

        <div class="divider"></div>

        <h2>Verification Required</h2>

        <p>Welcome to our literary community! To ensure the security of your account, please use the following One-Time
            Password:</p>

        <div class="otp-code">{{ $otp }}</div>

        <p>This magical code will expire in 10 minutes.</p>

        <div class="quote">"There is no friend as loyal as a book."<br>- Ernest Hemingway</div>

        <div class="divider"></div>

        <div class="footer">
            <p>If you didn't request this verification code, please disregard this email.</p>
            <p>Happy Reading! 📚</p>
        </div>
    </div>
</body>

</html>
