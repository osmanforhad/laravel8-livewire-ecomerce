<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;

class EditProductComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $regular_price;
    public $sale_price;
    public $SKU;
    public $stock_status;
    public $featured;
    public $quantity;
    public $image;
    public $category_id;

    public $updated_image;
    public $product_id;

    public function mount($product_slug)
    {
        //fetch product from db
        $product = Product::where('slug', $product_slug)->first();

        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_description = $product->short_description;
        $this->description = $product->description;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->SKU = $product->SKU;
        $this->stock_status = $product->stock_status;
        $this->featured = $product->featured;
        $this->quantity = $product->quantity;
        $this->image = $product->image;
        $this->category_id = $product->category_id;

        $this->updated_image = $product->updated_image;
        $this->product_id = $product->id;
    }

    //function for generate slug
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name, '-');
    }

     //livewire hook function for validation
     public function validationSetup($fields)
     {
         $this->validateOnly($fields, [
             'name' => 'required',
             'slug' => 'required | unique:products',
             'short_description' => 'required',
             'description' => 'required',
             'regular_price' => 'required | numeric',
             'SKU' => 'required',
             'stock_status' => 'required',
             'quantity' => 'required | numeric',
             'category_id' => 'required'
         ]);
     }

    //function for update product info
    public function updateProduct()
    {
         //validation
         $this->validate([
            'name' => 'required',
            'slug' => 'required | unique:products',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required | numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'quantity' => 'required | numeric',
            'category_id' => 'required'
        ]);

        $product = Product::find($this->product_id);

        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->SKU = $this->SKU;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;

        //for update image file
        if ($this->updated_image) {
            //for upload product into products folder
            $imageName = Carbon::now()->timestamp . '_' . $this->updated_image->extension();
            $this->updated_image->storeAs('products', $imageName);

            $product->image = $imageName;
        }

        $product->category_id = $this->category_id;

        $product->save();

        session()->flash('message', 'Product has been Updated successfully!');
    }

    public function render()
    {
        //fetch category
        $categories = Category::all();

        return view('livewire.admin.edit-product-component', [
            'categories' => $categories
        ])
            ->layout('layouts.base');
    }
}
