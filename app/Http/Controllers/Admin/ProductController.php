<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(Request $request)
    {
        $query = Product::with('category')->latest();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            switch ($request->status) {
                case 'active':
                    $query->where('is_active', true)->where('stock_quantity', '>', 0);
                    break;
                case 'out_of_stock':
                    $query->where('is_active', true)->where('stock_quantity', '<=', 0);
                    break;
                case 'inactive':
                    $query->where('is_active', false);
                    break;
            }
        }

        // Use pagination since the view has pagination logic built-in
        $products = $query->paginate(10)->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'stock_quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'brand_id' => 'nullable|exists:brands,id',
            'specs' => 'nullable|array',
            'tags' => 'nullable|string|max:255',
            'warranty_period' => 'nullable|string|max:255',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'colors' => 'nullable|array',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $gallery = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $gallery[] = $file->store('products', 'public');
            }
        }
        $validated['gallery'] = $gallery;

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Sản phẩm đã được tạo thành công!');
    }

    /**
     * Show the form for editing the product.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'stock_quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'brand_id' => 'nullable|exists:brands,id',
            'specs' => 'nullable|array',
            'tags' => 'nullable|string|max:255',
            'warranty_period' => 'nullable|string|max:255',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'colors' => 'nullable|array',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $gallery = $product->gallery ?? [];

        // Handle deleted existing images
        if ($request->has('deleted_gallery')) {
            $deletedImages = $request->input('deleted_gallery');
            $gallery = array_values(array_filter($gallery, function ($img) use ($deletedImages) {
                return ! in_array($img, $deletedImages);
            }));

            // Optionally delete physical files
            foreach ($deletedImages as $img) {
                if (Storage::disk('public')->exists($img)) {
                    Storage::disk('public')->delete($img);
                }
            }
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $gallery[] = $file->store('products', 'public');
            }
        }
        $validated['gallery'] = $gallery;

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }

    /**
     * Import products from CSV file.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:10240', // Limit to 10MB CSV
        ], [
            'file.mimes' => 'Hệ thống hiện tại chỉ hỗ trợ định dạng CSV. Vui lòng lưu file Excel dưới dạng CSV (Comma delimited) trước khi tải lên.',
        ]);

        $file = $request->file('file');
        $filePath = $file->getRealPath();

        $fileHandle = fopen($filePath, 'r');

        // Handle BOM (Byte Order Mark) for UTF-8 CSV from Excel
        $bom = fread($fileHandle, 3);
        if ($bom !== "\xEF\xBB\xBF") {
            rewind($fileHandle);
        }

        // Get header
        $header = fgetcsv($fileHandle);

        $importedCount = 0;
        $rowNumber = 1; // Header is row 1

        // Optimization: Cache all categories and brands to avoid N+1 inside the loop
        $allCategories = Category::all()->pluck('id', 'name')->mapWithKeys(function ($id, $name) {
            return [strtolower($name) => $id];
        })->toArray();

        $allBrands = Brand::all()->pluck('id', 'name')->mapWithKeys(function ($id, $name) {
            return [strtolower($name) => $id];
        })->toArray();

        $defaultCategoryId = ! empty($allCategories) ? reset($allCategories) : null;

        // Start transaction for safety
        \DB::beginTransaction();

        try {
            while (($data = fgetcsv($fileHandle)) !== false) {
                $rowNumber++;

                // Column Mapping:
                // 0: Name, 1: Category Name, 2: Brand Name, 3: Price, 4: Sale Price,
                // 5: Stock, 6: Description, 7: Specs (key:val,key2:val2),
                // 8: Main Image, 9: Gallery (img1,img2), 10: Tags (tag1,tag2), 11: Warranty

                if (empty($data) || count($data) < 1 || empty(trim($data[0] ?? ''))) {
                    continue; // Skip empty rows or rows without a name
                }

                // 1. Resolve Category
                $categoryName = strtolower(trim($data[1] ?? ''));
                $categoryId = $allCategories[$categoryName] ?? $defaultCategoryId;

                if (! $categoryId) {
                    throw new \Exception("Dòng {$rowNumber}: Không tìm thấy danh mục và không có danh mục mặc định.");
                }

                // 2. Resolve Brand
                $brandName = strtolower(trim($data[2] ?? ''));
                $brandId = $allBrands[$brandName] ?? null;

                // 3. Parse Specs (format key:value,key2:value2)
                $specsStr = trim($data[7] ?? '');
                $specs = [];
                if (! empty($specsStr)) {
                    $pairs = explode(',', $specsStr);
                    foreach ($pairs as $index => $pair) {
                        $parts = explode(':', $pair, 2);
                        if (count($parts) === 2) {
                            $specs[$index] = [
                                'key' => trim($parts[0]),
                                'value' => trim($parts[1]),
                            ];
                        }
                    }
                }

                // 4. Parse Gallery
                $galleryStr = trim($data[9] ?? '');
                $gallery = ! empty($galleryStr) ? array_map('trim', explode(',', $galleryStr)) : [];

                // 5. Parse Prices and Stock
                $price = (float) str_replace(['.', ','], '', $data[3] ?? 0);
                $salePrice = ! empty($data[4]) ? (float) str_replace(['.', ','], '', $data[4]) : null;
                $stock = (int) ($data[5] ?? 0);

                Product::create([
                    'name' => trim($data[0]),
                    'category_id' => $categoryId,
                    'brand_id' => $brandId,
                    'price' => $price,
                    'sale_price' => $salePrice,
                    'stock_quantity' => $stock,
                    'description' => $data[6] ?? '',
                    'specs' => $specs,
                    'image' => trim($data[8] ?? ''),
                    'gallery' => $gallery,
                    'tags' => trim($data[10] ?? ''),
                    'warranty_period' => trim($data[11] ?? ''),
                    'is_active' => true,
                    'is_featured' => false,
                    'colors' => ! empty($data[12]) ? array_map('trim', explode(',', $data[12])) : [],
                ]);
                $importedCount++;
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Product Import Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Lỗi tại dòng ' . $rowNumber . ': ' . $e->getMessage());
        } finally {
            fclose($fileHandle);
        }

        return redirect()->back()->with('success', "Đã nhập thành công {$importedCount} sản phẩm vào hệ thống.");
    }

    public function downloadSample()
    {
        $filePath = base_path('sample_products_100.csv');
        if (! file_exists($filePath)) {
            return redirect()->back()->with('error', 'File mẫu không tồn tại. Vui lòng liên hệ quản trị viên.');
        }

        return response()->download($filePath, 'TechFlow_Sample_Products.csv');
    }

    /**
     * Remove the specified product.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        if (is_array($product->gallery)) {
            foreach ($product->gallery as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Sản phẩm đã được xóa thành công!');
    }
}
