@extends('layouts.app')
@section('title', 'Chính Sách Đổi Trả')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-slate-200 dark:border-slate-800 p-8 md:p-12">
        <h1 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-8 border-b border-slate-100 dark:border-slate-800 pb-8 flex items-center gap-4">
            <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-right-left text-xl"></i>
            </div>
            Chính Sách Đổi Trả
        </h1>
        
        <div class="prose prose-slate dark:prose-invert max-w-none prose-p:leading-relaxed prose-p:text-slate-600 dark:prose-p:text-slate-400 prose-headings:font-bold prose-a:text-primary">
            <p class="mb-8 text-base md:text-lg">
                Để đảm bảo quyền lợi tốt nhất cho người tiêu dùng, <strong class="text-primary font-black">TechFlow</strong> hỗ trợ khách hàng đổi/trả sản phẩm theo các quy định dưới đây.
            </p>

            <div class="space-y-8">
                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white mb-4 flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-primary/20 text-primary flex items-center justify-center text-sm">1</span>
                        Đổi trả miễn phí trong 7 ngày đầu
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        Trong vòng 7 ngày kể từ ngày mua hàng, nếu sản phẩm phát sinh lỗi phần cứng do nhà sản xuất (không áp dụng với lỗi phần mềm), quý khách sẽ được <strong>đổi sang sản phẩm mới 100%</strong> (cùng model) hoàn toàn miễn phí.
                    </p>
                    <p class="text-slate-600 dark:text-slate-400 font-bold">Điều kiện áp dụng:</p>
                    <ul class="list-none space-y-3 pl-2 mt-2">
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-check text-emerald-500 mt-1"></i>
                            <span>Sản phẩm phải còn nguyên vẹn vỏ hộp, phụ kiện đi kèm, mút xốp, sách hướng dẫn.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-check text-emerald-500 mt-1"></i>
                            <span>Sản phẩm không bị trầy xước, móp méo, dính nước hay có dấu hiệu va đập.</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white mb-4 flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-primary/20 text-primary flex items-center justify-center text-sm">2</span>
                        Trường hợp hoàn tiền (Trả hàng)
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400">
                        Chúng tôi chỉ chấp nhận hoàn tiền khi sản phẩm đáp ứng điều kiện đổi mới 7 ngày nhưng cửa hàng <strong>không còn sản phẩm cùng model để đổi</strong> và khách hàng không đồng ý đổi sang sản phẩm model khác. 
                    </p>
                    <p class="text-slate-600 dark:text-slate-400 mt-3">
                        Không áp dụng trả hàng hoàn tiền vì lý do cá nhân (không thích, không biết sử dụng...).
                    </p>
                </div>

                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white mb-4 flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-primary/20 text-primary flex items-center justify-center text-sm">3</span>
                        Quy trình thực hiện đổi trả
                    </h3>
                    <ul class="list-none space-y-3 pl-2">
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-arrow-right text-primary mt-1 text-sm"></i>
                            <span><strong>Bước 1:</strong> Liên hệ số Hotline 0329346849 hoặc gửi Email báo cáo tình trạng lỗi sản phẩm.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-arrow-right text-primary mt-1 text-sm"></i>
                            <span><strong>Bước 2:</strong> Gửi sản phẩm cùng đầy đủ hộp, phụ kiện về địa chỉ kho của TechFlow.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-arrow-right text-primary mt-1 text-sm"></i>
                            <span><strong>Bước 3:</strong> Kỹ thuật viên kiểm tra lỗi (tối đa 48h làm việc).</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600 dark:text-slate-400">
                            <i class="fa-solid fa-arrow-right text-primary mt-1 text-sm"></i>
                            <span><strong>Bước 4:</strong> Thông báo kết quả và tiến hành gửi hàng đổi mới cho khách.</span>
                        </li>
                    </ul>
                </div>
            </div>
            

        </div>
    </div>
</div>
@endsection
