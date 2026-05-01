@extends('layouts.app')
@section('title', 'Điều Khoản Sử Dụng')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-slate-200 dark:border-slate-800 p-8 md:p-12">
        <h1 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-8 border-b border-slate-100 dark:border-slate-800 pb-8 flex items-center gap-4">
            <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-file-contract text-xl"></i>
            </div>
            Điều Khoản Sử Dụng
        </h1>
        
        <div class="prose prose-slate dark:prose-invert max-w-none prose-p:leading-relaxed prose-p:text-slate-600 dark:prose-p:text-slate-400 prose-headings:font-bold prose-a:text-primary">
            <p class="mb-8 text-base md:text-lg">
                Chào mừng bạn đến với Website <strong class="text-primary font-black">TechFlow</strong>. Khi bạn truy cập vào trang web của chúng tôi, đồng nghĩa với việc bạn đã đồng ý với các điều khoản này. Trang web có quyền thay đổi, chỉnh sửa, thêm hoặc lược bỏ bất kỳ phần nào trong Quy định và Điều kiện sử dụng, vào bất cứ lúc nào.
            </p>

            <div class="space-y-8">
                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white mb-4 flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-primary/20 text-primary flex items-center justify-center text-sm">1</span>
                        Hướng dẫn sử dụng web
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400">
                        Khi vào web của chúng tôi, khách hàng phải đảm bảo đủ 18 tuổi, hoặc truy cập dưới sự giám sát của cha mẹ hay người giám hộ hợp pháp. Chúng tôi cấp giấy phép sử dụng để bạn có thể mua sắm trên web trong khuôn khổ Điều khoản và Điều kiện sử dụng đã đề ra. 
                    </p>
                    <p class="text-slate-600 dark:text-slate-400 mt-3">
                        Nghiêm cấm sử dụng bất kỳ phần nào của trang web này với mục đích thương mại hoặc nhân danh bất kỳ đối tác thứ ba nào nếu không được chúng tôi cho phép bằng văn bản.
                    </p>
                </div>

                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white mb-4 flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-primary/20 text-primary flex items-center justify-center text-sm">2</span>
                        Ý kiến khách hàng
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400">
                        Tất cả nội dung trang web và ý kiến phê bình của quý khách đều là tài sản của chúng tôi. Nếu chúng tôi phát hiện bất kỳ thông tin giả mạo nào, chúng tôi sẽ khóa tài khoản của quý khách ngay lập tức hoặc áp dụng các biện pháp khác theo quy định của pháp luật Việt Nam.
                    </p>
                </div>

                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white mb-4 flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-primary/20 text-primary flex items-center justify-center text-sm">3</span>
                        Chấp nhận đơn hàng và giá cả
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400">
                        Chúng tôi có quyền từ chối hoặc hủy đơn hàng của quý khách vì bất kỳ lý do gì vào bất kỳ lúc nào. Chúng tôi có thể yêu cầu quý khách cung cấp thêm hoặc xác nhận thông tin về số điện thoại và địa chỉ trước khi nhận đơn hàng.
                    </p>
                    <p class="text-slate-600 dark:text-slate-400 mt-3">
                        Chúng tôi cam kết sẽ cung cấp thông tin giá cả chính xác nhất cho người tiêu dùng. Tuy nhiên, đôi lúc vẫn có sai sót xảy ra, ví dụ như trường hợp giá sản phẩm không hiển thị chính xác trên trang web hoặc sai giá, tùy theo từng trường hợp chúng tôi sẽ liên hệ hướng dẫn hoặc thông báo hủy đơn hàng đó.
                    </p>
                </div>
            </div>
            

        </div>
    </div>
</div>
@endsection
