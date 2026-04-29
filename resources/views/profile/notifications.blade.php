@extends('layouts.app')

@section('title', 'Thông báo của tôi')

@section('content')
<main class="flex-1 w-full max-w-[1440px] mx-auto px-4 md:px-10 lg:px-40 py-8 min-h-[calc(100vh-200px)]">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar -->
        @include('profile.partials.sidebar')

        <!-- Main Content -->
        <div class="flex-1">
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Thông báo</h2>
                        <p class="text-sm text-slate-500">Cập nhật tình hình đơn hàng và ưu đãi dành riêng cho bạn</p>
                    </div>
                </div>

                <div class="p-6">
                    @if($notifications->count() > 0)
                        <div class="flex flex-col gap-4">
                            @foreach($notifications as $notification)
                                <div class="flex items-start gap-4 p-4 rounded-xl border {{ $notification->read_at ? 'bg-white dark:bg-slate-900 border-slate-100 dark:border-slate-800' : 'bg-primary/5 border-primary/20' }} transition-all hover:shadow-md">
                                    <!-- Icon Circle -->
                                    <div class="h-10 w-10 rounded-full shrink-0 flex items-center justify-center {{ $notification->read_at ? 'bg-slate-100 text-slate-500' : 'bg-primary text-white' }}">
                                        <i class="fa-solid fa-box-open text-sm"></i>
                                    </div>
                                    
                                    <!-- Content -->
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="font-bold text-sm {{ $notification->read_at ? 'text-slate-700 dark:text-slate-300' : 'text-slate-900 dark:text-white' }}">
                                                Cập nhật đơn hàng
                                            </p>
                                            <span class="text-[11px] text-slate-400">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <p class="text-sm {{ $notification->read_at ? 'text-slate-500' : 'text-slate-600 dark:text-slate-400' }}">
                                            {{ $notification->data['message'] ?? 'Bạn có cập nhật mới về đơn hàng.' }}
                                        </p>
                                        
                                        @if(isset($notification->data['order_id']))
                                            <a href="{{ route('profile.orders') }}" class="inline-block mt-2 text-xs font-bold text-primary hover:underline">
                                                Xem chi tiết đơn hàng
                                            </a>
                                        @endif
                                    </div>

                                    <!-- Read Status Dot -->
                                    @if(!$notification->read_at)
                                        <div class="h-2 w-2 rounded-full bg-primary mt-2"></div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $notifications->links() }}
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="py-20 flex flex-col items-center justify-center text-center">
                            <div class="h-20 w-20 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-300 mb-4">
                                <i class="fa-solid fa-bell-slash text-3xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-1">Chưa có thông báo nào</h3>
                            <p class="text-slate-500 text-sm max-w-xs mx-auto">Khi có cập nhật về đơn hàng, chúng tôi sẽ thông báo cho bạn tại đây.</p>
                            <a href="{{ route('store.index') }}" class="mt-6 inline-flex h-10 items-center px-6 bg-primary text-white text-sm font-bold rounded-lg hover:bg-primary/90 transition-all">
                                Tiếp tục mua sắm
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
