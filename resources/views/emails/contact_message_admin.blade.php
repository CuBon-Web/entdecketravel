<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ mới</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.5; color: #333;">
    <h2 style="margin-bottom: 8px;">Tin nhắn liên hệ mới</h2>
    <p style="margin-top: 0;">Mã: <strong>#{{ $contact->id }}</strong></p>

    <table cellpadding="8" cellspacing="0" border="0" style="border-collapse: collapse; max-width: 560px;">
        <tr><td style="border-bottom: 1px solid #eee;"><strong>Họ tên</strong></td><td style="border-bottom: 1px solid #eee;">{{ $contact->name }}</td></tr>
        <tr><td style="border-bottom: 1px solid #eee;"><strong>Email</strong></td><td style="border-bottom: 1px solid #eee;">{{ $contact->email ?: '—' }}</td></tr>
        <tr><td style="border-bottom: 1px solid #eee;"><strong>Điện thoại</strong></td><td style="border-bottom: 1px solid #eee;">{{ $contact->phone ?: '—' }}</td></tr>
        <tr><td colspan="2" style="padding-top: 12px;"><strong>Nội dung</strong><br>{!! nl2br(e($contact->mess)) !!}</td></tr>
    </table>
</body>
</html>
