@extends('layouts.app')
@section('title', 'Chính Sách Vận Chuyển & Kiểm Hàng')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-slate-200 dark:border-slate-800 p-8 md:p-12">
        <h1 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-8 border-b border-slate-100 dark:border-slate-800 pb-8 flex items-center gap-4">
            <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-truck-fast text-xl"></i>
            </div>
            Vận Chuyển & Kiểm Hàng
        </h1>
        
        <div class="prose prose-slate dark:prose-invert max-w-none prose-p:leading-relaxed prose-p:text-slate-600 dark:prose-p:text-slate-400 prose-headings:font-bold prose-a:text-primary">
            <p class="mb-8 text-base md:text-lg">
                Nhằm mang lại trải nghiệm mua sắm tốt nhất, <strong class="text-primary font-black">TechFlow</strong> hợp tác với các đơn vị vận chuyển hàng đầu để đưa sản phẩm đến tay khách hàng nhanh chóng, an toàn và minh bạch.
            </p>

            <div class="space-y-8">
                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white mb-4 flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-primary/20 text-primary flex items-center justify-center text-sm">1</span>
                        Chi phí vận chuyển
                    </h3>
                    <ul class="list-none space-y-3 pl-2">
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-arrow-right text-primary mt-1 text-sm"></i>
                            <span><strong>Miễn phí vận chuyển (Freeship):</strong> Áp dụng cho các đơn hàng có giá trị từ <strong>2.000.000đ</strong> trở lên trên toàn quốc.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-arrow-right text-primary mt-1 text-sm"></i>
                            <span><strong>Đơn hàng dưới 2 triệu:</strong> Phí vận chuyển sẽ được tính dựa trên biểu phí của đơn vị vận chuyển (GHN, Viettel Post, GHTK), giao động từ 30.000đ - 50.000đ tùy khu vực.</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white mb-4 flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-primary/20 text-primary flex items-center justify-center text-sm">2</span>
                        Thời gian giao hàng dự kiến
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        Ngay sau khi đơn hàng được xác nhận, chúng tôi sẽ tiến hành đóng gói và bàn giao cho đơn vị vận chuyển.
                    </p>
                    <ul class="list-none space-y-3 pl-2">
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-clock text-slate-400 mt-1"></i>
                            <span><strong>Khu vực Nội thành TP.HCM/Hà Nội:</strong> Giao hàng hỏa tốc trong 2h-4h hoặc giao thường trong 24h.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-clock text-slate-400 mt-1"></i>
                            <span><strong>Các tỉnh thành khác:</strong> Thời gian nhận hàng từ 2 - 4 ngày làm việc.</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white mb-4 flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-primary/20 text-primary flex items-center justify-center text-sm">3</span>
                        Chính sách kiểm hàng (ĐỒNG KIỂM)
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400">
                        TechFlow cho phép khách hàng <strong>được mở kiện hàng kiểm tra ngoại quan (Đồng kiểm)</strong> cùng với shipper trước khi thanh toán.
                    </p>
                    <p class="text-slate-600 dark:text-slate-400 font-bold mt-4">Lưu ý khi kiểm hàng:</p>
                    <ul class="list-none space-y-3 pl-2 mt-2">
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-exclamation-circle text-amber-500 mt-1"></i>
                            <span>Khách hàng chỉ kiểm tra bề ngoài hộp, seal niêm phong, ngoại hình linh kiện, tuyệt đối <strong>KHÔNG cắm điện dùng thử hay tháo dỡ linh kiện bên trong</strong>.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-video text-amber-500 mt-1"></i>
                            <span>Khuyến khích khách hàng quay lại video quá trình mở hộp để có căn cứ xử lý nhanh nhất nếu có khiếu nại về móp méo, thiếu hàng.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-phone text-amber-500 mt-1"></i>
                            <span>Nếu phát hiện kiện hàng có dấu hiệu móp méo nghiêm trọng, rách nát, quý khách vui lòng từ chối nhận hàng và gọi ngay Hotline 0329346849 để được hỗ trợ.</span>
                        </li>
                    </ul>
                </div>
            </div>
            

        </div>
    </div>
</div>
@endsection
