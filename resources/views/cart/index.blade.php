@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
<main class="max-w-7xl mx-auto w-full px-6 lg:px-20 py-10 flex-1">
    <div class="flex flex-col gap-2 mb-8">
        <nav class="flex items-center gap-2 text-sm text-slate-500">
            <a class="hover:text-primary" href="{{ route('home') }}">Trang chủ</a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <span class="text-slate-900 dark:text-slate-100 font-medium">Giỏ hàng</span>
        </nav>
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-slate-100">Giỏ hàng của bạn <span class="text-primary font-normal text-xl ml-2">(3 sản phẩm)</span></h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2 space-y-6">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 dark:border-slate-800 text-slate-500 text-sm uppercase tracking-wider font-semibold">
                            <th class="py-4 px-2">Sản phẩm</th>
                            <th class="py-4 px-2 text-center">Số lượng</th>
                            <th class="py-4 px-2 text-right">Giá</th>
                            <th class="py-4 px-2 text-right">Tạm tính</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <tr class="group">
                            <td class="py-6 px-2">
                                <div class="flex items-center gap-4">
                                    <div class="h-20 w-20 rounded-xl bg-white dark:bg-slate-800 p-2 border border-slate-100 dark:border-slate-700 flex-shrink-0">
                                        <div class="h-full w-full bg-center bg-no-repeat bg-contain" data-alt="Premium wireless noise cancelling headphones" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAcT5APK6cXMrGN4Vue4qmBn4zedmvXZC5J_7ZG6a5r09_oAUE6GJlQkWd8eQ7yBGQdlcVf_I5vB_3tFDvSM9iCcGUCGOpc0tg_i9XE_Civ7mrFdqA0k8bTWTzd_g2swy86UwfJpESIQi01T6I4ehRcDqm2U5D0l4_rjnhh_a-ennVEkJ4UrpLll8o_YkfSbZIbeS5UJQnB7gZp0EejsF_c2UUq36uVBipw6xSGStY3lVTec7MiUb3-8GAl-bvGdgjHIQvOEODMhrM");'></div>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900 dark:text-slate-100">Pro Audio Headphones</p>
                                        <p class="text-sm text-slate-500">Midnight Black</p>
                                        <button class="mt-2 text-xs text-red-500 hover:text-red-600 flex items-center gap-1 font-medium"><i class="fa-solid fa-trash-can text-[10px]"></i> Xóa</button>
                                    </div>
                                </div>
                            </td>
                            <td class="py-6 px-2">
                                <div class="flex items-center justify-center">
                                    <div class="flex items-center border border-slate-200 dark:border-slate-700 rounded-lg overflow-hidden bg-white dark:bg-slate-900">
                                        <button class="px-3 py-1 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400">
                                            <i class="fa-solid fa-minus text-[10px]"></i>
                                        </button>
                                        <span class="px-4 py-1 text-sm font-semibold border-x border-slate-200 dark:border-slate-700">1</span>
                                        <button class="px-3 py-1 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400">
                                            <i class="fa-solid fa-plus text-[10px]"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="py-6 px-2 text-right text-slate-600 dark:text-slate-400">$299.00</td>
                            <td class="py-6 px-2 text-right font-bold text-slate-900 dark:text-slate-100">$299.00</td>
                        </tr>
                        <tr class="group">
                            <td class="py-6 px-2">
                                <div class="flex items-center gap-4">
                                    <div class="h-20 w-20 rounded-xl bg-white dark:bg-slate-800 p-2 border border-slate-100 dark:border-slate-700 flex-shrink-0">
                                        <div class="h-full w-full bg-center bg-no-repeat bg-contain" data-alt="Minimalist smart watch with silicone band" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDT89Yffd9TsUmkAiOgWpx_deMdamxB3oPC64fLhcyDRAYCAlOjSjOYcktG9vIf-HjzNbL7Fg-FXkCjfjHVX0r2DwQyCBxa3dpYbYRKudTrjhr65ad4IUqCShV_jQDLIU1qFOfWw03Z0eZkba7dtJp90jkeU9ZH1gaULuz_Yj9aTmvni9k0Mj0E402Mi3M-1BUucLLJAwFpYSWGYy5nJVHyO8x6WmJaBO_c4_pvx0RyNbgSUkrujMl4ME0oblTEIP3_11y9q9OyxCU");'></div>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900 dark:text-slate-100">Smart Watch Series 7</p>
                                        <p class="text-sm text-slate-500">Arctic White</p>
                                        <button class="mt-2 text-xs text-red-500 hover:text-red-600 flex items-center gap-1 font-medium"><i class="fa-solid fa-trash-can text-[10px]"></i> Xóa</button>
                                    </div>
                                </div>
                            </td>
                            <td class="py-6 px-2">
                                <div class="flex items-center justify-center">
                                    <div class="flex items-center border border-slate-200 dark:border-slate-700 rounded-lg overflow-hidden bg-white dark:bg-slate-900">
                                        <button class="px-3 py-1 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400">
                                            <i class="fa-solid fa-minus text-[10px]"></i>
                                        </button>
                                        <span class="px-4 py-1 text-sm font-semibold border-x border-slate-200 dark:border-slate-700">2</span>
                                        <button class="px-3 py-1 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400">
                                            <i class="fa-solid fa-plus text-[10px]"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="py-6 px-2 text-right text-slate-600 dark:text-slate-400">$199.50</td>
                            <td class="py-6 px-2 text-right font-bold text-slate-900 dark:text-slate-100">$399.00</td>
                        </tr>
                        <tr class="group">
                            <td class="py-6 px-2">
                                <div class="flex items-center gap-4">
                                    <div class="h-20 w-20 rounded-xl bg-white dark:bg-slate-800 p-2 border border-slate-100 dark:border-slate-700 flex-shrink-0">
                                        <div class="h-full w-full bg-center bg-no-repeat bg-contain" data-alt="Mechanical compact keyboard" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAIXyUfL6f9zoKtHqwTYcJiqdPWpEgLr-i28mHiPtqIbOp6Lmq3Mo_5OjGO7rpn_nxWMx1TErHXsL8EwfyK5sE_Ao0bAv9aOr9-qU3KLXaDTrRUUyAOu0NwnAGmQhbg76JIlJC4pXm1XsvGTgWhpB_UOUAywlJ16fsY5SyXrJgTl2X-nTXm7aEZ1VLXqPEbKhsDzY0HCorBRXtmQEC_FtLeRw2qd46sfELwqy-QntO1pKbHFcR9lqJYCuE5DeIE5gUslGvN6cLppRA");'></div>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900 dark:text-slate-100">Mechanical Keyboard</p>
                                        <p class="text-sm text-slate-500">Clicky Blue Switches</p>
                                        <button class="mt-2 text-xs text-red-500 hover:text-red-600 flex items-center gap-1 font-medium"><i class="fa-solid fa-trash-can text-[10px]"></i> Xóa</button>
                                    </div>
                                </div>
                            </td>
                            <td class="py-6 px-2">
                                <div class="flex items-center justify-center">
                                    <div class="flex items-center border border-slate-200 dark:border-slate-700 rounded-lg overflow-hidden bg-white dark:bg-slate-900">
                                        <button class="px-3 py-1 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400">
                                            <i class="fa-solid fa-minus text-[10px]"></i>
                                        </button>
                                        <span class="px-4 py-1 text-sm font-semibold border-x border-slate-200 dark:border-slate-700">1</span>
                                        <button class="px-3 py-1 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400">
                                            <i class="fa-solid fa-plus text-[10px]"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="py-6 px-2 text-right text-slate-600 dark:text-slate-400">$120.00</td>
                            <td class="py-6 px-2 text-right font-bold text-slate-900 dark:text-slate-100">$120.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-primary font-semibold hover:gap-3 transition-all">
                    <i class="fa-solid fa-arrow-left text-sm"></i> Tiếp tục mua sắm
                </a>
                <button class="text-slate-500 hover:text-slate-900 dark:hover:text-slate-100 text-sm font-medium">Xóa toàn bộ giỏ hàng</button>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm">
                <h2 class="text-lg font-bold mb-6">Tóm tắt đơn hàng</h2>
                
                <div class="space-y-4 mb-6">
                    <div class="flex justify-between text-slate-600 dark:text-slate-400">
                        <span>Tạm tính</span>
                        <span class="font-medium text-slate-900 dark:text-slate-100">$818.00</span>
                    </div>
                    <div class="flex justify-between text-slate-600 dark:text-slate-400">
                        <span>Phí vận chuyển dự tính</span>
                        <span class="font-medium text-slate-900 dark:text-slate-100">$15.00</span>
                    </div>
                    <div class="flex justify-between text-slate-600 dark:text-slate-400">
                        <span>Thuế dự tính</span>
                        <span class="font-medium text-slate-900 dark:text-slate-100">$65.44</span>
                    </div>
                    <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-between">
                        <span class="text-lg font-bold">Tổng cộng</span>
                        <span class="text-xl font-extrabold text-primary">$898.44</span>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Mã giảm giá</label>
                    <div class="flex gap-2">
                        <input class="flex-1 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm focus:border-primary focus:ring-0" placeholder="Nhập mã" type="text"/>
                        <button class="px-4 py-2 bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-lg text-sm font-bold hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors">Áp dụng</button>
                    </div>
                </div>

                <button class="w-full bg-primary text-white py-4 rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-primary/30 transition-all flex items-center justify-center gap-2">Tiến hành thanh toán <i class="fa-solid fa-arrow-right text-sm"></i></button>
                <p class="mt-4 text-center text-xs text-slate-400">Miễn phí trả hàng trong vòng 30 ngày. Giao hàng nhanh &amp; bảo mật.</p>
            </div>

            <div class="bg-primary/5 dark:bg-primary/10 rounded-xl p-6 border border-primary/20">
                <div class="flex items-center gap-3 text-primary mb-2">
                    <i class="fa-solid fa-circle-check"></i>
                    <span class="font-bold">Quyền lợi thành viên</span>
                </div>
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">Bạn sẽ nhận được <strong class="text-primary">898 TechPoints</strong> cho đơn hàng này!</p>
            </div>
        </div>
    </div>

    <div class="mt-20 pt-10 border-t border-slate-200 dark:border-slate-800">
        <h3 class="text-xl font-bold mb-8">Có thể bạn cũng thích</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="group cursor-pointer">
                <div class="aspect-square rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 mb-3 overflow-hidden">
                    <div class="h-full w-full bg-center bg-no-repeat bg-cover group-hover:scale-105 transition-transform duration-500" data-alt="High-end tablet on desk" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBkS_ji1FwuOa-aaJCBelzq-3MR6sX42jl1oMO4JV0hS-X0fK0lnjJJd80Ip5thf7MxXhDpDyRv9h8qxFU9NBTX7hArFbz1haOTtHF1_KoE9FVx0SJQIzu0zR37NUG-Bc8XYlHzmfy6Ufy94rSGU1mNu7ipxKAXn5TrWyozkjs64xGJe-UgmBgj2tzol5_CCGn8B3xqKmsknruXklkaZn_jNZi9dsRLiYVAwSSZGpiXo_JJiosdII31j489XMBVTSNqlU_CIeYOLYY");'></div>
                </div>
                <h4 class="font-bold text-sm mb-1 group-hover:text-primary">Ultra Tab 12.9</h4>
                <p class="text-slate-500 text-sm">$799.00</p>
            </div>
            <div class="group cursor-pointer">
                <div class="aspect-square rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 mb-3 overflow-hidden">
                    <div class="h-full w-full bg-center bg-no-repeat bg-cover group-hover:scale-105 transition-transform duration-500" data-alt="Compact wireless earbuds charging case" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAuJCgmiN9Mxd2BcZz1ooZF9ax89a4BUjqEx5TWvcNEc_JkHI5aUDotfO6fZ4bOeFijiBzdi417VfM2WiuuK2RCuM9ANO5QVd3BzgYoMX3rHENbrybvm2P8X1sLXno4yzGYxcpcK1LlAnXjOxer_AJZR1O-zDMt4rCtCTeYi4h0YNBPr7aKdrXn-kcn4X4NeNSfK8PdX15F3fU5Yw3UmZKuAfh_o1t4e-sVy9j58RUjXdAaNHdIeM6LwXu7An7olDJSnv1nHG_1Y5c");'></div>
                </div>
                <h4 class="font-bold text-sm mb-1 group-hover:text-primary">Pods Elite</h4>
                <p class="text-slate-500 text-sm">$159.00</p>
            </div>
            <div class="group cursor-pointer">
                <div class="aspect-square rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 mb-3 overflow-hidden">
                    <div class="h-full w-full bg-center bg-no-repeat bg-cover group-hover:scale-105 transition-transform duration-500" data-alt="External solid state drive" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDY4AhPOiRIYB5j2qrC4TRYLi60QkYo8DBNZzBAyUkVZSQmP4Dh3fe2BEQFMEEHjSp5QU1isUmnwjphtXKwhY4DWMFcSQEMKGyaBGJIoNVS_tqyWLt0Xyrw9dmPfXwt13N9g4At2uGR4EUPHs604TbtriUtnDVHsDnD70t-7-tqcqz02Gmu0y30DJsyUw51Ygkt6VwCEvezOZS2Lvp9cE-3w-Jk-jG8uBARRJYWsRYX-ps6c8gE0fT9WY2Z4n-OAc3dbnNuo2UpXt0");'></div>
                </div>
                <h4 class="font-bold text-sm mb-1 group-hover:text-primary">SpeedDrive 1TB SSD</h4>
                <p class="text-slate-500 text-sm">$89.00</p>
            </div>
            <div class="group cursor-pointer">
                <div class="aspect-square rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 mb-3 overflow-hidden">
                    <div class="h-full w-full bg-center bg-no-repeat bg-cover group-hover:scale-105 transition-transform duration-500" data-alt="Smartphone protective case" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBVuVcFGaAspYb_-4ryJp9Dza3tnZeVMBlxxkeG1lT_Q7_XybNbDZ2_82DwfYvuc1uBBg5krFnmGS78Hi3nXte5EQA-niJt2aOlFHAXUi11lgZVjMwge2P2YraCDdnboiyOuMIA1ZUnpzjOmUxhU7ILzT4Rxf_bZpOizVv81G6J96DRB5KVFH3q7L1hHHoPTAo5GQ60bXw2yMjzcmAnD3RbwkxyE7hUwZtY3aR56PO4JhudMaTJmbxERDrQAiXjm7VQSgsceyH_AXc");'></div>
                </div>
                <h4 class="font-bold text-sm mb-1 group-hover:text-primary">Shield Case Pro</h4>
                <p class="text-slate-500 text-sm">$35.00</p>
            </div>
        </div>
    </div>
</main>
@endsection
