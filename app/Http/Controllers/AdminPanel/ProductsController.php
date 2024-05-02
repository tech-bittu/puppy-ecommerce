<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_image;
use App\Models\Subcategory;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        return view('admin.product.list-product');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['category'] = Category::all();
        $data['subcategory'] = Subcategory::all();
        $data['brand'] = Brand::all();

        return view('admin.product.create-product', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(ProductRequest $request)
    public function store(ProductRequest $request)
    {
        // dd($request->all());
        $requestImageGallery = $request->image_gallery;
        unset($request['_token'], $request['image_gallery']);

        $productId = Product::insertGetId($request->all());
        if (!empty($requestImageGallery)) {
            // ## trim extra comma(,)
            $requestImageGallery = trim($requestImageGallery, ',');
            // ## replace url 
            $image_gallery = str_replace(url(''), '', $requestImageGallery);
            // ## make image-name array
            $imgArray = explode(',', $image_gallery);

            // create image manager with desired driver
            $manager = new ImageManager(
                new Driver()
            );

            foreach ($imgArray as $k => $img) {
                $img =  str_replace('/temp/', '', $img);
                $tempSourcePath = ('temp/' . $img);
                //## ***************************large

                // open an image file
                $image = $manager->read($tempSourcePath);
                // resize image instance
                // $image->resize(1400, 500);
                $image->scale(width: 1400);
                // insert a watermark
                // $image->place('images/watermark.png');

                // encode edited image
                $encoded = $image->toPng();
                $encoded->save('uploads/product/large/' . $img);

                //## ***************************small
                // open an image file
                $image = $manager->read($tempSourcePath);
                // resize image instance
                $image->scale(width: 300);

                // insert a watermark
                // $image->place('images/watermark.png');

                // encode edited image
                $encoded = $image->toPng();
                $encoded->save('uploads/product/small/' . $img);


                Product_image::insert(
                    [
                        'image' => $img,
                        'product_id' => $productId,
                        'created_at'=>now(),
                        'updated_at'=>now()

                    ]
                );
            }
        } else {
            unset($request['image_gallery']);
        }

        return redirect('admin/products')->with('success_message', 'Product info inserted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['category'] = Category::all();
        $data['subcategory'] = Subcategory::all();
        $data['brand'] = Brand::all();
        $data['product'] = Product::find($id);

        return view('admin.product.create-product', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        unset($request['_token'], $request['_method']);
        // dd($request->all());
        $request["updated_at"] = now();
        $suc = Product::where('id', $id)->update($request->all());
        // Product::insert($request->all());
        if ($suc) {
            return redirect('admin/products')->with('success_message', 'Product info Updated successfully.');
        } else {
            return redirect('admin/products')->with('error_message', 'Technical error, fail successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function status(string $id)
    {
        $previousStatus = Product::find($id)->status;

        $status = $previousStatus ? 0 : 1;

        $suc = Product::find($id)
            ->update(['status' => $status]);

        if ($suc) {
            return redirect('admin/products')->with('success_message', "$id Status changed successfully");
        } else {
            return redirect('admin/products')->with('error_message', "Technical error try again!");
        }
    }

    public function temp(Request $request)
    {
        // return response()->json($request->all());
        $image = $request->images;
        if (!empty($image)) {
            $originalExtension = $image->getClientOriginalExtension();
            $imageName = time() . date('D') . rand(10, 99) . '.' . $originalExtension;
            $image->move(public_path('temp'), $imageName);
            return $imageName;
        }
        return "Empty file or not getting input name images.";
    }
}
