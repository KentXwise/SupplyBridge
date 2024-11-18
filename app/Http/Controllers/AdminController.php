<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Category; 
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use App\Models\Product;

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
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }
        $img = Image::make($image->path());
        $img->cover(124,124,"top");
        $img->resize(124,124, function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$imageName);
    }
    public function categories(){
        try {
            $categories = Category::orderBy('id', 'DESC')->paginate(10);
            return view('admin.categories', compact('categories'));
        } catch (\Exception $e) {
            Log::error('Error fetching categories: '.$e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while fetching the categories.');
        }
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
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            $img = Image::make($image->path()); // Ensure this line is correct
            $img->resize(124, 124, function($constraint){
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$imageName);
        } catch (\Exception $e) {
            Log::error('Error generating category thumbnail: '.$e->getMessage());
            throw $e;
        }
    }
    public function category_edit($id)
    {
        
            $category = Category::find($id);
            return view('admin.category-edit', compact('category'));
        
    }
    public function category_update(Request $request){
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug'.$request->id,
            'image' => 'mimes:png,jpg,jpeg|max:2048',
        ]);

        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        if ($request->hasFile('image')) {
            if(File::exists(public_path('uploads/categories').'/'.$category->image)){
                File::delete(public_path('uploads/categories').'/'.$category->image);
            }
            $image = $request->file('image');
            $file_extention = $image->extension();
            $file_name = Carbon::now()->timestamp.'.'.$file_extention;
            $this->GenerateCategoriesThumbnailsImage($image, $file_name);
            $category->image = $file_name;
        }
        $category->save();
        return redirect()->route('admin.categories')->with('status', 'Category has been updated successfully'); 


    }
    public function category_delete($id){
        $category = Category::find($id);
        if(File::exists(public_path('uploads/categories').'/'.$category->image)){
            File::delete(public_path('uploads/categories').'/'.$category->image);
        }
        $category->delete();
        return redirect()->route('admin.categories')->with('status', 'Category has been deleted successfully');
    }

  public function products()
  {
      $products = Product::orderBy('id', 'DESC')->paginate(10);
      return view('admin.products', compact('products'));
  } 
}