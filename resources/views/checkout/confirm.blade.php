@extends('layouts.app')

@section('title', 'Đặt hàng thành công')

@section('content')
<main class="mx-auto max-w-4xl w-full px-4 md:px-10 py-12">
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-2xl overflow-hidden relative" id="printable-order">
        <!-- Background Decorations (Hidden on print) -->
        <div class="print:hidden absolute -top-24 -right-24 w-64 h-64 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="print:hidden absolute -bottom-24 -left-24 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl"></div>

        <!-- Success Header -->
        <div class="relative px-6 py-12 text-center border-b border-slate-50 dark:border-slate-800/50">
            <div class="w-24 h-24 bg-emerald-500 text-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl shadow-emerald-500/20 animate-bounce-subtle">
                <i class="fa-solid fa-check text-4xl"></i>
            </div>
            <h1 class="text-4xl font-black text-slate-900 dark:text-white mb-4 uppercase tracking-tighter">Đặt hàng thành công!</h1>
            <p class="text-slate-500 dark:text-slate-400 max-w-lg mx-auto leading-relaxed">
                Cảm ơn bạn đã tin tưởng <strong>TechFlow</strong>. Đơn hàng của bạn đã được tiếp nhận và đang trong quá trình xử lý.
            </p>
            
            <div class="mt-8 inline-flex items-center gap-3 px-6 py-2 bg-slate-50 dark:bg-slate-800/50 rounded-full border border-slate-100 dark:border-slate-700">
                <span class="text-[10px] font-black uppercase text-slate-400">Mã đơn hàng:</span>
                <span class="text-lg font-bold text-primary font-mono select-all">#{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</span>
            </div>
        </div>

        <div class="p-6 md:p-10 space-y-10">
            <!-- Order Status Banner (Only for processing/completed) -->
            @if($order->status !== 'pending')
            <div class="bg-emerald-500/10 border border-emerald-500/20 rounded-2xl p-6 flex flex-col md:flex-row items-center gap-6 text-center md:text-left transition-all duration-500">
                <div class="w-16 h-16 bg-emerald-500 text-white rounded-full flex items-center justify-center shadow-lg flex-shrink-0">
                    <i class="fa-solid fa-check-double text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-emerald-600 dark:text-emerald-400 mb-1 capitalize">Đã xác nhận thanh toán!</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 italic">Hệ thống đã nhận được tiền. Đơn hàng đang được chuẩn bị để giao tới bạn trong 2-3 ngày tới.</p>
                </div>
            </div>
            @endif

            <!-- SePay QR Section (Only for banking && pending) -->
            @if($order->payment_method === 'banking' && $order->status === 'pending')
            <div class="print:hidden bg-primary/5 rounded-3xl border-2 border-dashed border-primary/20 p-8 animate-pulse-subtle">
                <div class="flex flex-col lg:flex-row items-center gap-10">
                    <!-- QR Code -->
                    <div class="flex-shrink-0 bg-white p-4 rounded-2xl shadow-2xl border border-slate-100">
                        @php
                            $sepayAcc = env('SEPAY_ACCOUNT', 'YOUR_ACC');
                            $sepayBank = env('SEPAY_BANK', 'YOUR_BANK');
                            $sepayPrefix = env('SEPAY_PREFIX', 'DH');
                            $qrUrl = "https://qr.sepay.vn/img?acc={$sepayAcc}&bank={$sepayBank}&amount={$order->total_price}&des={$sepayPrefix}{$order->id}&template=compact";
                        @endphp
                        <img src="{{ $qrUrl }}" alt="VietQR SePay" class="w-56 h-56 md:w-64 md:h-64 object-contain">
                        <p class="text-[10px] text-center text-slate-400 mt-2 font-bold uppercase tracking-widest">VietQR - Napas247</p>
                    </div>

                    <div class="flex-1 w-full space-y-6">
                        <div class="text-center lg:text-left">
                            <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-2 uppercase italic tracking-tight">Quét mã để thanh toán</h3>
                            <p class="text-sm text-slate-500">Sử dụng ứng dụng Ngân hàng hoặc Ví điện tử để quét mã và thanh toán tự động trong giây lát.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-4 bg-white dark:bg-slate-800 rounded-xl border border-slate-100 dark:border-slate-700 shadow-sm group">
                                <span class="text-[10px] font-black uppercase text-slate-400 block mb-1">Nội dung chuyển khoản</span>
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-black text-primary font-mono">{{ env('SEPAY_PREFIX', 'DH') }}{{ $order->id }}</span>
                                    <button onclick="navigator.clipboard.writeText('{{ env('SEPAY_PREFIX', 'DH') }}{{ $order->id }}'); showToast('Đã sao chép nội dung!')" class="p-2 text-slate-400 hover:text-primary transition-colors">
                                        <i class="fa-solid fa-copy"></i>
                                    </button>
                                </div>
                                <p class="text-[10px] text-amber-600 font-bold uppercase mt-1">
                                    <i class="fa-solid fa-triangle-exclamation mr-1"></i> Giữ nguyên nội dung này
                                </p>
                            </div>
                            <div class="p-4 bg-white dark:bg-slate-800 rounded-xl border border-slate-100 dark:border-slate-700 shadow-sm">
                                <span class="text-[10px] font-black uppercase text-slate-400 block mb-1">Số tiền</span>
                                <span class="text-lg font-black text-slate-900 dark:text-white">{{ number_format($order->total_price, 0, ',', '.') }}₫</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-center lg:justify-start gap-3">
                            <div class="relative flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                            </div>
                            <span class="text-xs font-bold text-slate-500 italic">Hệ thống đang chờ xác nhận từ ngân hàng...</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Shipping Info -->
                <div class="bg-slate-50 dark:bg-slate-800/30 rounded-2xl p-6 border border-slate-100 dark:border-slate-800">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-truck-fast"></i>
                        </div>
                        <h4 class="font-bold text-slate-900 dark:text-white uppercase tracking-wider">Thông tin vận chuyển</h4>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <span class="text-[10px] font-black uppercase text-slate-400 block">Người nhận</span>
                            <p class="text-sm font-bold text-slate-800 dark:text-slate-200">{{ $order->customer_name }}</p>
                        </div>
                        <div>
                            <span class="text-[10px] font-black uppercase text-slate-400 block">Số điện thoại / Email</span>
                            <p class="text-xs text-slate-600 dark:text-slate-400">{{ $order->customer_phone }} • {{ $order->customer_email }}</p>
                        </div>
                        <div>
                            <span class="text-[10px] font-black uppercase text-slate-400 block">Địa chỉ giao hàng</span>
                            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">{{ $order->shipping_address }}</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Info -->
                <div class="bg-slate-50 dark:bg-slate-800/30 rounded-2xl p-6 border border-slate-100 dark:border-slate-800">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-amber-500/10 text-amber-500 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-credit-card"></i>
                        </div>
                        <h4 class="font-bold text-slate-900 dark:text-white uppercase tracking-wider">Thanh toán</h4>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <span class="text-[10px] font-black uppercase text-slate-400 block mb-1">Phương thức</span>
                            <div class="inline-flex items-center gap-2 px-3 py-1 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg">
                                @if($order->payment_method === 'cod')
                                    <i class="fa-solid fa-hand-holding-dollar text-emerald-500"></i>
                                    <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Tiền mặt (COD)</span>
                                @elseif($order->payment_method === 'banking')
                                    <i class="fa-solid fa-building-columns text-primary"></i>
                                    <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Chuyển khoản SePay</span>
                                @else
                                    <i class="fa-solid fa-credit-card text-purple-500"></i>
                                    <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Thẻ tín dụng</span>
                                @endif
                            </div>
                        </div>
                        <div>
                            <span class="text-[10px] font-black uppercase text-slate-400 block mb-2">Trạng thái</span>
                            @php
                                $statusMap = [
                                    'pending' => ['label' => 'Đang chờ thanh toán', 'color' => 'bg-amber-500'],
                                    'processing' => ['label' => 'Đang xử lý', 'color' => 'bg-emerald-500'],
                                    'completed' => ['label' => 'Hoàn tất', 'color' => 'bg-blue-500'],
                                    'cancelled' => ['label' => 'Đã hủy', 'color' => 'bg-red-500'],
                                ];
                                $st = $statusMap[$order->status] ?? ['label' => $order->status, 'color' => 'bg-slate-500'];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-[10px] font-black text-white uppercase {{ $st['color'] }} shadow-sm">
                                {{ $st['label'] }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary Section -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 overflow-hidden shadow-sm">
                <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-700 flex items-center gap-3">
                    <i class="fa-solid fa-shopping-basket text-primary"></i>
                    <h4 class="font-bold text-slate-900 dark:text-white uppercase tracking-widest text-sm">Tóm tắt đơn hàng</h4>
                </div>
                <div class="p-0 overflow-x-auto">
                    <table class="w-full text-left">
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800/50">
                            @foreach($order->items as $item)
                            <tr class="group">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 bg-slate-50 dark:bg-slate-800 rounded-xl p-2 border border-slate-100 dark:border-slate-700 flex-shrink-0">
                                            <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://placehold.co/200x200?text=Product' }}" class="w-full h-full object-contain">
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-900 dark:text-white leading-tight mb-1">{{ $item->product->name }}</p>
                                            <p class="text-xs text-slate-400 font-medium">Số lượng: {{ $item->quantity }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <p class="text-sm font-mono font-bold text-slate-900 dark:text-white">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫</p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-slate-50/50 dark:bg-slate-800/20 divide-y divide-slate-100 dark:divide-slate-800">
                            <tr>
                                <td class="py-3 px-6 text-right">
                                    <span class="text-xs font-bold text-slate-400 uppercase">Tạm tính:</span>
                                </td>
                                <td class="py-3 px-6 text-right">
                                    <span class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ number_format($order->total_price / 1.1, 0, ',', '.') }}₫</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 px-6 text-right">
                                    <span class="text-xs font-bold text-slate-400 uppercase">Thuế VAT (10%):</span>
                                </td>
                                <td class="py-3 px-6 text-right">
                                    <span class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ number_format($order->total_price - ($order->total_price/1.1), 0, ',', '.') }}₫</span>
                                </td>
                            </tr>
                            <tr class="bg-primary/5">
                                <td class="py-4 px-6 text-right">
                                    <span class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-wider">Tổng cộng:</span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <span class="text-2xl font-black text-primary">{{ number_format($order->total_price, 0, ',', '.') }}₫</span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="print:hidden flex flex-col sm:flex-row gap-4 justify-center pt-6">
                <a href="{{ route('home') }}" class="px-8 py-4 bg-slate-900 dark:bg-white dark:text-slate-900 text-white font-black rounded-2xl transition-all hover:scale-105 hover:shadow-xl flex items-center justify-center gap-2">
                    <i class="fa-solid fa-house"></i> TIẾP TỤC MUA SẮM
                </a>
                <button onclick="window.print()" class="px-8 py-4 bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 font-black rounded-2xl transition-all hover:scale-105 hover:bg-slate-50 dark:hover:bg-slate-700 flex items-center justify-center gap-2 text-slate-700 dark:text-white">
                    <i class="fa-solid fa-print"></i> IN ĐƠN HÀNG
                </button>
                <a href="{{ route('order.tracking') }}" class="px-8 py-4 bg-primary/10 text-primary font-black rounded-2xl transition-all hover:scale-105 hover:bg-primary/20 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-magnifying-glass"></i> TRA CỨU ĐƠN HÀNG
                </a>
            </div>
            
            <p class="print:hidden text-center text-[10px] text-slate-400 uppercase tracking-widest font-bold">
                Cảm ơn bạn đã lựa chọn TechFlow • © 2024 TechFlow Studio
            </p>
        </div>
    </div>
</main>

<style>
    @media print {
        header, footer, .print\:hidden {
            display: none !important;
        }
        body {
            background: white !important;
            padding: 0 !important;
        }
        .mx-auto {
            margin: 0 !important;
            max-width: none !important;
        }
        #printable-order {
            box-shadow: none !important;
            border: none !important;
            width: 100% !important;
        }
    }
    
    @keyframes bounce-subtle {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .animate-bounce-subtle {
        animation: bounce-subtle 2s infinite ease-in-out;
    }
</style>
@endsection

@section('scripts')
<script>
    // Real-time Order Status Polling
    let currentStatus = '{{ $order->status }}';
    
    if (currentStatus === 'pending') {
        const checkStatus = setInterval(async () => {
            try {
                const response = await fetch('{{ route('order.status', $order->id) }}');
                const data = await response.json();
                
                if (data.status !== 'pending') {
                    clearInterval(checkStatus);
                    if (typeof showToast === 'function') {
                        showToast('Thanh toán thành công! Đang cập nhật trạng thái...', 'success');
                    }
                    setTimeout(() => {
                        location.reload(); 
                    }, 2000);
                }
            } catch (error) {
                console.error('Error polling order status:', error);
            }
        }, 3000);
    }
</script>
@endsection
