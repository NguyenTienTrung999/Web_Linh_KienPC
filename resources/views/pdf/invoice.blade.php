<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hóa đơn #{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 13px;
            color: #333;
            line-height: 1.5;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 0;
        }
        .header {
            margin-bottom: 30px;
            border-bottom: 2px solid #0f212f;
            padding-bottom: 10px;
        }
        .header table {
            width: 100%;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #0f212f;
        }
        .invoice-title {
            text-align: right;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .info-section {
            width: 100%;
            margin-bottom: 30px;
        }
        .info-section td {
            vertical-align: top;
            width: 50%;
        }
        .section-title {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11px;
            color: #666;
            margin-bottom: 5px;
            border-bottom: 1px solid #eee;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table th {
            background: #f9f9f9;
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            font-size: 11px;
            text-transform: uppercase;
        }
        .items-table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .totals {
            width: 100%;
        }
        .totals td {
            padding: 5px 0;
        }
        .grand-total {
            font-size: 18px;
            font-weight: bold;
            color: #000;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 11px;
            color: #999;
        }
        .badge {
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            color: white;
        }
        .bg-emerald { background-color: #10b981; }
        .bg-amber { background-color: #f59e0b; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <table>
                <tr>
                    <td class="logo">TECHFLOW</td>
                    <td class="invoice-title">Hóa đơn bán hàng</td>
                </tr>
            </table>
        </div>

        <table class="info-section">
            <tr>
                <td>
                    <div class="section-title">Người bán</div>
                    <strong>Công ty Công nghệ TechFlow</strong><br>
                    Địa chỉ: Khu Công nghệ cao, TP. Thủ Đức, HCM<br>
                    Điện thoại: 0123 456 789<br>
                    Website: techflow.vn
                </td>
                <td style="text-align: right;">
                    <div class="section-title">Thông tin hóa đơn</div>
                    Mã hóa đơn: <strong>#{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</strong><br>
                    Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}<br>
                    Trạng thái: 
                    @if($order->status === 'pending')
                        Đang xử lý
                    @elseif($order->status === 'processing')
                        @if($order->payment_method === 'cod')
                            Chờ thanh toán khi nhận hàng
                        @else
                            Đã thanh toán
                        @endif
                    @elseif($order->status === 'completed')
                        Hoàn tất
                    @else
                        {{ $order->status }}
                    @endif
                </td>
            </tr>
        </table>

        <table class="info-section">
            <tr>
                <td>
                    <div class="section-title">Người mua</div>
                    <strong>{{ $order->customer_name }}</strong><br>
                    SĐT: {{ $order->customer_phone }}<br>
                    Email: {{ $order->customer_email }}
                </td>
                <td style="text-align: right;">
                    <div class="section-title">Địa chỉ nhận hàng</div>
                    {{ $order->shipping_address }}
                </td>
            </tr>
        </table>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th class="text-center">Số lượng</th>
                    <th class="text-right">Đơn giá</th>
                    <th class="text-right">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @php $subtotal = 0; @endphp
                @foreach($order->items as $item)
                @php $itemTotal = $item->price * $item->quantity; $subtotal += $itemTotal; @endphp
                <tr>
                    <td>
                        <strong>{{ $item->product->name }}</strong>
                        @if($item->color)
                            <br><small style="color: #666;">Màu sắc: {{ $item->color }}</small>
                        @endif
                    </td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">{{ number_format($item->price, 0, ',', '.') }}₫</td>
                    <td class="text-right">{{ number_format($itemTotal, 0, ',', '.') }}₫</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table style="width: 100%;">
            <tr>
                <td style="width: 60%; vertical-align: top;">
                    <div class="section-title">Ghi chú</div>
                    <div style="font-style: italic; color: #666;">
                        {{ $order->note ?: 'Không có ghi chú.' }}
                    </div>
                    <div class="section-title" style="margin-top: 15px;">Thanh toán</div>
                    <strong>{{ $order->payment_method === 'cod' ? 'Tiền mặt (COD)' : 'Chuyển khoản SePay' }}</strong>
                </td>
                <td style="width: 40%;">
                    <table class="totals">
                        <tr>
                            <td>Tổng tiền hàng:</td>
                            <td class="text-right">{{ number_format($subtotal, 0, ',', '.') }}₫</td>
                        </tr>
                        <tr>
                            <td>Phí vận chuyển:</td>
                            <td class="text-right">{{ number_format($order->total_price - $subtotal, 0, ',', '.') }}₫</td>
                        </tr>
                        <tr class="grand-total">
                            <td style="padding-top: 10px;">Tổng thanh toán:</td>
                            <td class="text-right" style="padding-top: 10px; color: #0f212f;">{{ number_format($order->total_price, 0, ',', '.') }}₫</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="footer">
            Cảm ơn bạn đã lựa chọn TechFlow!<br>
            Đây là hóa đơn điện tử được tạo tự động.
        </div>
    </div>
</body>
</html>
