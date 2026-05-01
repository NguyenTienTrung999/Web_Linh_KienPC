@extends('layouts.app')
@section('title', 'Quy Định Bảo Hành')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-slate-200 dark:border-slate-800 p-8 md:p-12">
        <h1 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-8 border-b border-slate-100 dark:border-slate-800 pb-8 flex items-center gap-4">
            <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-screwdriver-wrench text-xl"></i>
            </div>
            Quy Định Bảo Hành
        </h1>
        
        <div class="prose prose-slate dark:prose-invert max-w-none prose-p:leading-relaxed prose-p:text-slate-600 dark:prose-p:text-slate-400 prose-headings:font-bold prose-a:text-primary">
            <p class="mb-8 text-base md:text-lg">
                Tất cả các sản phẩm linh kiện máy tính được bán ra tại <strong class="text-primary font-black">TechFlow</strong> đều là hàng chính hãng và được áp dụng chính sách bảo hành theo đúng quy định của nhà sản xuất.
            </p>

            <div class="space-y-8">
                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white mb-4 flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-primary/20 text-primary flex items-center justify-center text-sm">1</span>
                        Điều kiện được bảo hành
                    </h3>
                    <ul class="list-none space-y-3 pl-2">
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-check text-emerald-500 mt-1"></i>
                            <span>Sản phẩm còn trong thời hạn bảo hành (tính từ ngày mua in trên hóa đơn).</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-check text-emerald-500 mt-1"></i>
                            <span>Tem bảo hành, mã vạch seri number phải còn nguyên vẹn, không có dấu hiệu cạo sửa, tẩy xóa hay bị rách mờ.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-check text-emerald-500 mt-1"></i>
                            <span>Sản phẩm bị lỗi kỹ thuật do nhà sản xuất.</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white mb-4 flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-red-500/20 text-red-500 flex items-center justify-center text-sm">2</span>
                        Những trường hợp không được bảo hành
                    </h3>
                    <ul class="list-none space-y-3 pl-2">
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-xmark text-red-500 mt-1 text-lg"></i>
                            <span>Sản phẩm đã hết thời hạn bảo hành.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-xmark text-red-500 mt-1 text-lg"></i>
                            <span>Lỗi do người sử dụng như: rơi vỡ, móp méo, trầy xước, vào nước, chập cháy nổ, côn trùng xâm nhập.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-xmark text-red-500 mt-1 text-lg"></i>
                            <span>Tự ý tháo dỡ, sửa chữa bởi các cá nhân hoặc kỹ thuật viên không phải là nhân viên TechFlow.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-xmark text-red-500 mt-1 text-lg"></i>
                            <span>Sử dụng sai điện áp quy định, over-clock (ép xung) gây cháy nổ linh kiện.</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white mb-4 flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-primary/20 text-primary flex items-center justify-center text-sm">3</span>
                        Phương thức bảo hành
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400">
                        Sản phẩm bảo hành sẽ được xử lý chậm nhất trong vòng <strong>7 - 14 ngày làm việc</strong> (không tính thứ 7, chủ nhật và ngày lễ). Nếu sản phẩm không thể sửa chữa hoặc không còn hàng để đổi, chúng tôi sẽ thỏa thuận đổi sang một sản phẩm tương đương hoặc hoàn tiền theo khấu hao thời gian sử dụng.
                    </p>
                </div>
            </div>
            

        </div>
    </div>
</div>
@endsection
