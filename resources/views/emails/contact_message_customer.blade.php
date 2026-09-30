<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận liên hệ</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.5; color: #333;">
    <h2 style="margin-bottom: 8px;">Cảm ơn bạn đã liên hệ</h2>
    <p>Chúng tôi đã nhận được tin nhắn của bạn và sẽ phản hồi sớm nhất có thể.</p>
    <p>Mã tham chiếu: <strong>#{{ $contact->id }}</strong></p>

    <table cellpadding="8" cellspacing="0" border="0" style="border-collapse: collapse; max-width: 560px;">
        <tr><td style="border-bottom: 1px solid #eee;"><strong>Họ tên</strong></td><td style="border-bottom: 1px solid #eee;">{{ $contact->name }}</td></tr>
        <tr><td colspan="2" style="padding-top: 12px;"><strong>Nội dung đã gửi</strong><br>{!! nl2br(e($contact->mess)) !!}</td></tr>
    </table>

    <p style="margin-top: 24px; font-size: 14px; color: #666;">Trân trọng,<br>{{ config('app.name') }}</p>
</body>
</html>
