<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn đặt tour</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.5; color: #333;">
    <h2 style="margin-bottom: 8px;">Đơn đặt tour mới</h2>
    <p style="margin-top: 0;">Mã đơn: <strong>#{{ $bill->id }}</strong></p>

    <table cellpadding="8" cellspacing="0" border="0" style="border-collapse: collapse; max-width: 560px;">
        <tr><td style="border-bottom: 1px solid #eee;"><strong>Tour</strong></td><td style="border-bottom: 1px solid #eee;">{{ $tourTitle }}</td></tr>
        <tr><td style="border-bottom: 1px solid #eee;"><strong>Loại yêu cầu</strong></td><td style="border-bottom: 1px solid #eee;">{{ $bill->request_type === 'quote' ? 'Báo giá' : 'Đặt tour' }}</td></tr>
        <tr><td style="border-bottom: 1px solid #eee;"><strong>Họ tên</strong></td><td style="border-bottom: 1px solid #eee;">{{ $bill->name }}</td></tr>
        <tr><td style="border-bottom: 1px solid #eee;"><strong>Điện thoại</strong></td><td style="border-bottom: 1px solid #eee;">{{ $bill->phone }}</td></tr>
        <tr><td style="border-bottom: 1px solid #eee;"><strong>Email</strong></td><td style="border-bottom: 1px solid #eee;">{{ $bill->email ?: '—' }}</td></tr>
        <tr><td style="border-bottom: 1px solid #eee;"><strong>Quốc tịch</strong></td><td style="border-bottom: 1px solid #eee;">{{ $bill->nationality ?: '—' }}</td></tr>
        <tr><td style="border-bottom: 1px solid #eee;"><strong>Hạng khách sạn</strong></td><td style="border-bottom: 1px solid #eee;">{{ $bill->hotel_category ?: '—' }}</td></tr>
        <tr><td style="border-bottom: 1px solid #eee;"><strong>Số người</strong></td><td style="border-bottom: 1px solid #eee;">{{ $bill->nguoilon }}</td></tr>
        <tr><td style="border-bottom: 1px solid #eee;"><strong>Ngày đi</strong></td><td style="border-bottom: 1px solid #eee;">{{ $bill->date_type === 'flexible' ? 'Linh hoạt' : ($bill->travel_date ?: '—') }}</td></tr>
        <tr><td style="border-bottom: 1px solid #eee;"><strong>Địa chỉ</strong></td><td style="border-bottom: 1px solid #eee;">{{ $bill->address ?: '—' }}</td></tr>
        <tr><td style="border-bottom: 1px solid #eee;"><strong>Tổng tiền</strong></td><td style="border-bottom: 1px solid #eee;">{{ $bill->total }}</td></tr>
        @if ($servicesSummary !== '')
            <tr><td style="border-bottom: 1px solid #eee;"><strong>Dịch vụ (id)</strong></td><td style="border-bottom: 1px solid #eee;">{{ $servicesSummary }}</td></tr>
        @endif
        <tr><td colspan="2" style="padding-top: 12px;"><strong>Ghi chú</strong><br>{{ $bill->note ?: '—' }}</td></tr>
    </table>
</body>
</html>
