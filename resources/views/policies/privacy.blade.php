@extends('layouts.app')
@section('title', 'Chính Sách Bảo Mật')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-slate-200 dark:border-slate-800 p-8 md:p-12">
        <h1 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-8 border-b border-slate-100 dark:border-slate-800 pb-8 flex items-center gap-4">
            <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-shield-halved text-xl"></i>
            </div>
            Chính Sách Bảo Mật
        </h1>
        
        <div class="prose prose-slate dark:prose-invert max-w-none prose-p:leading-relaxed prose-p:text-slate-600 dark:prose-p:text-slate-400 prose-headings:font-bold prose-a:text-primary">
            <p class="mb-8 text-base md:text-lg">
                Chào mừng bạn đến với <strong class="text-primary font-black">TechFlow</strong>. Chúng tôi tôn trọng và cam kết bảo mật những thông tin cá nhân của bạn. Xin vui lòng đọc kỹ Chính Sách Bảo Mật dưới đây để hiểu hơn những cam kết mà chúng tôi thực hiện nhằm tôn trọng và bảo vệ quyền lợi của khách hàng.
            </p>

            <div class="space-y-8">
                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white mb-4 flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-primary/20 text-primary flex items-center justify-center text-sm">1</span>
                        Mục đích thu thập thông tin
                    </h3>
                    <p class="mb-4 text-slate-600 dark:text-slate-400">
                        Các thông tin thu thập thông qua website của TechFlow sẽ giúp chúng tôi:
                    </p>
                    <ul class="list-none space-y-3 pl-2">
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-check text-emerald-500 mt-1"></i>
                            <span>Hỗ trợ khách hàng khi mua sản phẩm.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-check text-emerald-500 mt-1"></i>
                            <span>Giải đáp thắc mắc khách hàng.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-check text-emerald-500 mt-1"></i>
                            <span>Cung cấp cho bạn thông tin mới nhất trên website của chúng tôi.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-check text-emerald-500 mt-1"></i>
                            <span>Xem xét và nâng cấp nội dung, giao diện của website.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-check text-emerald-500 mt-1"></i>
                            <span>Thực hiện các hoạt động quảng bá liên quan đến sản phẩm linh kiện PC.</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white mb-4 flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-primary/20 text-primary flex items-center justify-center text-sm">2</span>
                        Phạm vi sử dụng thông tin
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400">
                        TechFlow thu thập và sử dụng thông tin cá nhân bạn với mục đích phù hợp và hoàn toàn tuân thủ nội dung của "Chính Sách Bảo Mật" này. Khi cần thiết, chúng tôi có thể sử dụng những thông tin này để liên hệ trực tiếp với bạn dưới các hình thức như: xác nhận đơn đặt hàng, thư cảm ơn, thông tin về kỹ thuật, cập nhật trạng thái giao hàng...
                    </p>
                </div>

                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white mb-4 flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-primary/20 text-primary flex items-center justify-center text-sm">3</span>
                        Chia sẻ thông tin cá nhân
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        Ngoại trừ các trường hợp về sử dụng thông tin cá nhân như đã nêu, chúng tôi cam kết sẽ không bán hay tiết lộ thông tin cá nhân bạn cho bên thứ ba. Chúng tôi chỉ cung cấp thông tin của bạn trong các trường hợp thật sự cần thiết như sau:
                    </p>
                    <ul class="list-none space-y-3 pl-2">
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-arrow-right text-primary mt-1 text-sm"></i>
                            <span>Cung cấp cho đơn vị vận chuyển (Giao Hàng Nhanh, Viettel Post...) để giao hàng.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-arrow-right text-primary mt-1 text-sm"></i>
                            <span>Khi có yêu cầu của các cơ quan pháp luật có thẩm quyền.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-arrow-right text-primary mt-1 text-sm"></i>
                            <span>Trong trường hợp bảo vệ quyền lợi chính đáng của TechFlow trước pháp luật.</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white mb-4 flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-primary/20 text-primary flex items-center justify-center text-sm">4</span>
                        Cam kết bảo mật
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400">
                        Khi bạn đặt hàng hoặc gửi thông tin cá nhân cho chúng tôi, bạn đã đồng ý với các điều khoản nêu trên. TechFlow cam kết bảo vệ thông tin của bạn bằng công nghệ bảo mật cao nhất, mã hóa dữ liệu truyền tải để đảm bảo an toàn tuyệt đối khỏi sự truy cập trái phép.
                    </p>
                </div>
            </div>
            

        </div>
    </div>
</div>
@endsection
