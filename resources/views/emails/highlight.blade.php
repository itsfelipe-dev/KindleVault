<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Daily Highlight</title>
    <style>
        body {
            font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 20px;
            color: #334155;
            line-height: 1.6;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .email-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .email-header h1 {
            font-size: 28px;
            color: #4f46e5;
            margin: 0;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .email-header p {
            color: #64748b;
            margin-top: 8px;
            font-size: 16px;
        }

        .highlight {
            font-size: 18px;
            color: #475569;
            line-height: 1.8;
            font-weight: 400;
            margin: 30px 0;
            background-color: #f8fafc;
            padding: 25px;
            border-radius: 8px;
            position: relative;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .highlight:before {
            content: '"';
            font-size: 60px;
            color: #e0e7ff;
            position: absolute;
            top: 10px;
            left: 10px;
            font-family: Georgia, serif;
            line-height: 1;
        }

        .highlight p {
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .author {
            text-align: right;
            font-style: italic;
            color: #64748b;
            margin-top: 15px;
            font-size: 16px;
        }

        .author:before {
            content: "— ";
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #94a3b8;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
        }

        .footer a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .book-meta {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
            font-size: 14px;
            color: #64748b;
        }

        .book-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .book-meta svg {
            width: 14px;
            height: 14px;
            fill: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Today's Reading Highlight</h1>
            <p>A little wisdom for your day</p>
        </div>

        <div class="highlight">
            <p>{{ $highlightText }}</p>
            <div class="author">By: {{ $book->author }}</div>
        </div>

        <div class="book-meta">
            <span>
                {{ $book->title }}
            </span>
        </div>

        <div class="footer">
            <p>Thank you for reading your daily highlight. Stay inspired!</p>
            <p><a href="#">Manage your preferences</a> | <a href="#">Unsubscribe</a></p>
        </div>
    </div>
</body>
</html>