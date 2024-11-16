<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Category; 
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Log;




class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function brands()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        return view('admin.brands', compact('brands'));
    }

    public function add_Brand()
    {
        return view('admin.brand-add');
    }
    public function brand_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands,slug',
            'image' => 'mimes:png,jpg,jpeg|max:2048',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $image = $request->file('image');
        $file_extention = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extention;
        $this->GenerateBrandThumbnailsImage($image, $file_name);
        $brand->image = $file_name;
        $brand->save();
        return redirect()->route('admin.brands')->with('success', 'Brand added successfully');

    }
    public function GenerateBrandThumbnailsImage($image, $imageName){
       
        $destinationPath = public_path('uploads/brands');
        $img = Image::make($image->path());
        $img->cover(124,124,"top");
        $img->resize(124,124, function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$imageName);
      
    }
    public function categories(){
        $categories = Category::orderBy('id','DESC')->paginate(10);
        return view('admin.categories', compact('categories'));
    }
    public function category_add(){
        return view('admin.category-add');
    }
    public function category_store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'slug' => 'required|unique:categories,slug',
                'image' => 'mimes:png,jpg,jpeg|max:2048',
            ]);

            $category = new Category();
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $file_extention = $image->extension();
                $file_name = Carbon::now()->timestamp.'.'.$file_extention;
                $this->GenerateCategoriesThumbnailsImage($image, $file_name);
                $category->image = $file_name;
            }

            $category->save();
            return redirect()->route('admin.categories')->with('success', 'Category added successfully');
        } catch (\Exception $e) {
            Log::error('Error adding category: '.$e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while adding the category.');
        }
    }

    public function GenerateCategoriesThumbnailsImage($image, $imageName)
    {
        try {
            $destinationPath = public_path('uploads/categories');
            $img = Image::make($image->path());
            $img->resize(124, 124, function($constraint){
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$imageName);
        } catch (\Exception $e) {
            Log::error('Error generating category thumbnail: '.$e->getMessage());
            throw $e;
        }
    }
}