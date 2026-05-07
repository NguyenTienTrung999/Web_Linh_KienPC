@extends('layouts.app')

@section('title', $order->status === 'pending' && $order->payment_method === 'banking' ? 'Thanh toán đơn hàng' : 'Đặt hàng thành công')

@section('content')
<main class="mx-auto max-w-4xl w-full px-4 md:px-10 py-12">

    {{-- ===== STATE 1: BANKING + PENDING = Show QR Payment Page ===== --}}
    @if($order->payment_method === 'banking' && $order->status === 'pending')
    <div id="payment-pending-state">
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-xl overflow-hidden">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-[#0f212f] to-[#1a3a4f] px-6 py-8 text-center text-white">
                <div class="w-16 h-16 bg-white/10 backdrop-blur rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-qrcode text-3xl text-primary"></i>
                </div>
                <h1 class="text-2xl font-black uppercase tracking-tight mb-2">Thanh Toán Chuyển Khoản</h1>
                <p class="text-white/70 text-sm">Quét mã QR bên dưới để hoàn tất thanh toán cho đơn hàng <strong class="text-primary">#{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</strong></p>
            </div>

            <div class="p-6 md:p-10">
                {{-- QR Section --}}
                <div class="bg-primary/5 rounded-2xl border-2 border-dashed border-primary/20 p-6 md:p-8 mb-8">
                    <div class="flex flex-col lg:flex-row items-center gap-8">
                        {{-- QR Code --}}
                        <div class="flex-shrink-0 bg-white p-4 rounded-2xl shadow-xl border border-slate-100">
                            @php
                                $sepayAcc = env('SEPAY_ACCOUNT', 'YOUR_ACC');
                                $sepayBank = env('SEPAY_BANK', 'YOUR_BANK');
                                $sepayPrefix = env('SEPAY_PREFIX', 'DH');
                                $amount = intval($order->total_price);
                                $description = urlencode($sepayPrefix . $order->id);
                                $qrUrl = "https://qr.sepay.vn/img?acc={$sepayAcc}&bank={$sepayBank}&amount={$amount}&des={$description}&template=compact";
                            @endphp
                            <img src="{{ $qrUrl }}" alt="VietQR SePay" class="w-52 h-52 md:w-60 md:h-60 object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="w-52 h-52 md:w-60 md:h-60 bg-slate-100 rounded-xl items-center justify-center text-center p-4" style="display:none;">
                                <div>
                                    <i class="fa-solid fa-qrcode text-4xl text-slate-300 mb-3"></i>
                                    <p class="text-xs text-slate-500 font-bold">Không tải được mã QR</p>
                                </div>
                            </div>
                            <p class="text-[10px] text-center text-slate-400 mt-2 font-bold uppercase tracking-widest">VietQR - Napas247</p>
                        </div>

                        {{-- Payment Info --}}
                        <div class="flex-1 w-full space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="p-4 bg-white dark:bg-slate-800 rounded-xl border border-slate-100 dark:border-slate-700 shadow-sm">
                                    <span class="text-[10px] font-black uppercase text-slate-400 block mb-1">Nội dung chuyển khoản</span>
                                    <div class="flex items-center justify-between">
                                        <span class="text-lg font-black text-primary font-mono">{{ env('SEPAY_PREFIX', 'DH') }}{{ $order->id }}</span>
                                        <button onclick="navigator.clipboard.writeText('{{ env('SEPAY_PREFIX', 'DH') }}{{ $order->id }}'); this.innerHTML='<i class=\'fa-solid fa-check text-green-500\'></i>'; setTimeout(()=>this.innerHTML='<i class=\'fa-solid fa-copy\'></i>', 1500)" class="p-2 text-slate-400 hover:text-primary transition-colors">
                                            <i class="fa-solid fa-copy"></i>
                                        </button>
                                    </div>
                                    <p class="text-[10px] text-amber-600 font-bold uppercase mt-1">
                                        <i class="fa-solid fa-triangle-exclamation mr-1"></i> Giữ nguyên nội dung này
                                    </p>
                                </div>
                                <div class="p-4 bg-white dark:bg-slate-800 rounded-xl border border-slate-100 dark:border-slate-700 shadow-sm">
                                    <span class="text-[10px] font-black uppercase text-slate-400 block mb-1">Số tiền cần chuyển</span>
                                    <span class="text-lg font-black text-red-600">{{ number_format($order->total_price, 0, ',', '.') }}₫</span>
                                </div>
                            </div>
                            <div class="p-4 bg-white dark:bg-slate-800 rounded-xl border border-slate-100 dark:border-slate-700 shadow-sm">
                                <span class="text-[10px] font-black uppercase text-slate-400 block mb-1">Chuyển tới</span>
                                <p class="text-sm font-bold text-slate-900 dark:text-white">{{ env('SEPAY_OWNER', 'Chủ tài khoản') }}</p>
                                <p class="text-xs text-slate-500">{{ env('SEPAY_BANK', 'Bank') }} - {{ env('SEPAY_ACCOUNT', 'STK') }}</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="relative flex h-3 w-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                                </div>
                                <span class="text-xs font-bold text-slate-500 italic">Hệ thống đang chờ xác nhận từ ngân hàng...</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Info Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-slate-50 dark:bg-slate-800/30 rounded-xl p-5 border border-slate-100 dark:border-slate-800">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 bg-primary/10 text-primary rounded-lg flex items-center justify-center">
                                <i class="fa-solid fa-truck-fast text-sm"></i>
                            </div>
                            <h4 class="font-bold text-slate-900 dark:text-white text-sm uppercase">Thông tin vận chuyển</h4>
                        </div>
                        <div class="space-y-2 text-sm">
                            <p><span class="text-slate-400">Người nhận:</span> <strong>{{ $order->customer_name }}</strong></p>
                            <p><span class="text-slate-400">SĐT:</span> {{ $order->customer_phone }}</p>
                            <p><span class="text-slate-400">Email:</span> {{ $order->customer_email }}</p>
                            <p><span class="text-slate-400">Địa chỉ:</span> {{ $order->shipping_address }}</p>
                        </div>
                    </div>
                    <div class="bg-slate-50 dark:bg-slate-800/30 rounded-xl p-5 border border-slate-100 dark:border-slate-800">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 bg-amber-500/10 text-amber-500 rounded-lg flex items-center justify-center">
                                <i class="fa-solid fa-receipt text-sm"></i>
                            </div>
                            <h4 class="font-bold text-slate-900 dark:text-white text-sm uppercase">Tóm tắt đơn hàng</h4>
                        </div>
                        <div class="space-y-2 max-h-[320px] overflow-y-auto custom-scrollbar pr-2">
                            @foreach($order->items as $item)
                            <div class="flex justify-between text-sm">
                            <div class="flex flex-col text-sm">
                                <span class="text-slate-600 dark:text-slate-400 truncate mr-2">{{ $item->product->name }} x{{ $item->quantity }}</span>
                                @if($item->color)
                                    <span class="text-[10px] text-primary font-bold uppercase tracking-widest">Màu: {{ $item->color }}</span>
                                @endif
                            </div>
                            <span class="font-bold text-slate-900 dark:text-white whitespace-nowrap">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫</span>
                            </div>
                            @endforeach
                        </div>
                        <div class="pt-2 mt-2 border-t border-slate-200 dark:border-slate-700 flex justify-between items-center">
                            <span class="font-bold text-slate-900 dark:text-white">Tổng cộng:</span>
                            <div class="text-right">
                                <span class="font-black text-primary text-lg">{{ number_format($order->total_price, 0, ',', '.') }}₫</span>
                                <p class="text-[10px] text-slate-400">(Giá đã bao gồm VAT)</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Back Button --}}
                <div class="text-center">
                    <a href="{{ route('cart.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 font-bold rounded-xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                        <i class="fa-solid fa-arrow-left"></i> Quay lại giỏ hàng
                    </a>
                    <p class="text-[10px] text-slate-400 mt-3">Sản phẩm vẫn được giữ trong giỏ hàng nếu bạn quay lại.</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===== STATE 2: SUCCESS (COD/Card OR Banking already paid) ===== --}}
    <div id="success-state" class="{{ ($order->payment_method === 'banking' && $order->status === 'pending') ? 'hidden' : '' }}">
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-2xl overflow-hidden relative" id="printable-order">
            <div class="print:hidden absolute -top-24 -right-24 w-64 h-64 bg-primary/5 rounded-full blur-3xl"></div>
            <div class="print:hidden absolute -bottom-24 -left-24 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl"></div>

            {{-- Success Header --}}
            <div class="relative px-6 py-8 md:px-10 border-b border-slate-50 dark:border-slate-800/50 bg-emerald-500/5">
                <div class="flex flex-col md:flex-row items-center gap-6 md:gap-10">
                    <div class="w-16 h-16 md:w-20 md:h-20 bg-emerald-500 text-white rounded-2xl flex items-center justify-center shadow-xl shadow-emerald-500/20 animate-bounce-subtle shrink-0">
                        <i class="fa-solid fa-check text-2xl md:text-3xl"></i>
                    </div>
                    <div class="text-center md:text-left flex-1">
                        <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white mb-1 uppercase tracking-tighter">Đặt hàng thành công!</h1>
                        <p class="text-slate-500 dark:text-slate-400 text-xs md:text-sm leading-relaxed max-w-xl">
                            Cảm ơn bạn đã tin tưởng <strong>TechFlow</strong>. Đơn hàng của bạn đã được tiếp nhận và đang trong quá trình xử lý.
                        </p>
                    </div>
                    <div class="px-5 py-3 bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm shrink-0">
                        <span class="text-[9px] font-black uppercase text-slate-400 block mb-0.5">Mã đơn hàng</span>
                        <span class="text-lg font-black text-primary font-mono select-all">#{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-10 space-y-10">
                {{-- Payment confirmed banner --}}
                @if($order->payment_method === 'banking')
                <div class="bg-emerald-500/10 border border-emerald-500/20 rounded-2xl p-6 flex flex-col md:flex-row items-center gap-6 text-center md:text-left">
                    <div class="w-16 h-16 bg-emerald-500 text-white rounded-full flex items-center justify-center shadow-lg flex-shrink-0">
                        <i class="fa-solid fa-check-double text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-emerald-600 dark:text-emerald-400 mb-1">Đã xác nhận thanh toán!</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 italic">Hệ thống đã nhận được tiền. Đơn hàng đang được chuẩn bị để giao tới bạn.</p>
                    </div>
                </div>
                @endif

                {{-- Info Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
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
                                <span class="text-[10px] font-black uppercase text-slate-400 block">SĐT / Email</span>
                                <p class="text-xs text-slate-600 dark:text-slate-400">{{ $order->customer_phone }} • {{ $order->customer_email }}</p>
                            </div>
                            <div>
                                <span class="text-[10px] font-black uppercase text-slate-400 block">Địa chỉ giao hàng</span>
                                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">{{ $order->shipping_address }}</p>
                            </div>
                        </div>
                    </div>

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
                                        <span class="text-xs font-bold">Tiền mặt (COD)</span>
                                    @elseif($order->payment_method === 'banking')
                                        <i class="fa-solid fa-building-columns text-primary"></i>
                                        <span class="text-xs font-bold">Chuyển khoản SePay</span>
                                    @else
                                        <i class="fa-solid fa-credit-card text-purple-500"></i>
                                        <span class="text-xs font-bold">Thẻ tín dụng</span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <span class="text-[10px] font-black uppercase text-slate-400 block mb-2">Trạng thái</span>
                                @php
                                    $statusMap = [
                                        'pending' => ['label' => 'Đang chờ xử lý', 'color' => 'bg-amber-500'],
                                        'processing' => ['label' => 'Đã thanh toán', 'color' => 'bg-emerald-500'],
                                        'completed' => ['label' => 'Hoàn tất', 'color' => 'bg-blue-500'],
                                        'cancelled' => ['label' => 'Đã hủy', 'color' => 'bg-red-500'],
                                    ];
                                    $st = $statusMap[$order->status] ?? ['label' => $order->status, 'color' => 'bg-slate-500'];
                                    
                                    // Override for COD
                                    if ($order->payment_method === 'cod' && $order->status === 'processing') {
                                        $st['label'] = 'Chờ thanh toán khi nhận hàng';
                                        $st['color'] = 'bg-amber-500';
                                    }
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] font-black text-white uppercase {{ $st['color'] }} shadow-sm">
                                    {{ $st['label'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Order Summary --}}
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 overflow-hidden shadow-sm">
                    <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-700 flex items-center gap-3">
                        <i class="fa-solid fa-shopping-basket text-primary"></i>
                        <h4 class="font-bold text-slate-900 dark:text-white uppercase tracking-widest text-sm">Tóm tắt đơn hàng</h4>
                    </div>
                    <div class="p-0 max-h-[420px] overflow-y-auto custom-scrollbar overflow-x-hidden">
                        <table class="w-full text-left">
                            <tbody class="divide-y divide-slate-50 dark:divide-slate-800/50">
                                @foreach($order->items as $item)
                                <tr>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-14 h-14 bg-slate-50 dark:bg-slate-800 rounded-xl p-2 border border-slate-100 dark:border-slate-700 flex-shrink-0">
                                                <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://placehold.co/200x200?text=Product' }}" class="w-full h-full object-contain">
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-slate-900 dark:text-white leading-tight mb-1">{{ $item->product->name }}</p>
                                                <div class="flex items-center gap-3">
                                                    <p class="text-xs text-slate-400 font-medium">Số lượng: {{ $item->quantity }}</p>
                                                    @if($item->color)
                                                        <span class="text-[10px] text-primary font-bold uppercase tracking-widest">Màu: {{ $item->color }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <p class="text-sm font-mono font-bold text-slate-900 dark:text-white">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫</p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="bg-primary/5 border-t border-slate-100 dark:border-slate-800 px-6 py-4 flex justify-between items-center">
                        <div>
                            <span class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-wider">Tổng cộng:</span>
                            <p class="text-[10px] text-slate-400">(Giá đã bao gồm VAT)</p>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-black text-primary">{{ number_format($order->total_price, 0, ',', '.') }}₫</span>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="print:hidden flex flex-wrap items-center justify-center gap-3 pt-6">
                    <a href="{{ route('home') }}" class="px-6 py-4 bg-slate-900 dark:bg-white dark:text-slate-900 text-white font-black rounded-2xl transition-all hover:scale-105 hover:shadow-xl flex items-center justify-center gap-2 text-sm whitespace-nowrap">
                        <i class="fa-solid fa-house"></i> TIẾP TỤC MUA SẮM
                    </a>
                    <a href="{{ route('orders.invoice', $order->id) }}" target="_blank" class="px-6 py-4 bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 font-black rounded-2xl transition-all hover:scale-105 hover:bg-slate-50 dark:hover:bg-slate-700 flex items-center justify-center gap-2 text-slate-700 dark:text-white text-sm whitespace-nowrap">
                        <i class="fa-solid fa-file-pdf text-red-500"></i> XUẤT HÓA ĐƠN
                    </a>
                    <a href="{{ route('order.tracking') }}" class="px-6 py-4 bg-primary/10 text-primary font-black rounded-2xl transition-all hover:scale-105 hover:bg-primary/20 flex items-center justify-center gap-2 text-sm whitespace-nowrap">
                        <i class="fa-solid fa-magnifying-glass"></i> TRA CỨU ĐƠN HÀNG
                    </a>
                </div>
                
                <p class="print:hidden text-center text-[10px] text-slate-400 uppercase tracking-widest font-bold">
                    Cảm ơn bạn đã lựa chọn TechFlow • © 2024 TechFlow Studio
                </p>
            </div>
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
    // Real-time Order Status Polling (only for banking + pending)
    let currentStatus = '{{ $order->status }}';
    const paymentMethod = '{{ $order->payment_method }}';
    
    if (paymentMethod === 'banking' && currentStatus === 'pending') {
        const checkStatus = setInterval(async () => {
            try {
                const response = await fetch('{{ route("order.status", $order->id) }}');
                const data = await response.json();
                
                if (data.status !== 'pending') {
                    clearInterval(checkStatus);
                    
                    // Clear cart via AJAX
                    await fetch('{{ route("order.clear-cart", $order->id) }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });

                    // Update header cart count
                    const cartCountEl = document.getElementById('cart-count');
                    if (cartCountEl) cartCountEl.innerText = '0';

                    // Hide payment, show success
                    document.getElementById('payment-pending-state').style.display = 'none';
                    document.getElementById('success-state').classList.remove('hidden');
                    
                    if (typeof showToast === 'function') {
                        showToast('Thanh toán thành công! Đơn hàng đã được xác nhận.', 'success');
                    }
                }
            } catch (error) {
                console.error('Error polling order status:', error);
            }
        }, 3000);
    }
</script>
@endsection
