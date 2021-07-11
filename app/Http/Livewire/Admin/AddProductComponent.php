<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AddProductComponent extends Component
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
    public $images;

    //function for setup default value
    public function mount()
    {
        $this->stock_status = 'instock';
        $this->featured = 0;
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
            'image' => 'required | mimes:jpeg,png,jpg',
            'category_id' => 'required'
        ]);
    }

    //function for store product into db
    public function addProduct()
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
            'image' => 'required | mimes:jpeg,png,jpg',
            'category_id' => 'required'
        ]);

        $product = new Product();

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

        //for upload product image into products folder
        $imageName = Carbon::now()->timestamp . '_' . $this->image->extension();
        $this->image->storeAs('products', $imageName);

        $product->image = $imageName;

        if ($this->images) {

            $imagesName = '';

            foreach ($this->images as $key => $image) {

                //for upload product images into products folder
                $imgName = Carbon::now()->timestamp . $key. '_' . $image->extension();
                $image->storeAs('products', $imaName);

                $imagesName = $imagesName . ',' . $imgName;
            }
            $product->images = $imagesName;
        }

        $product->category_id = $this->category_id;

        $product->save();

        session()->flash('message', 'Product has been created successfully!');
    }

    public function render()
    {
        //fetch category
        $categories = Category::all();


        return view('livewire.admin.add-product-component', [
            'categories' => $categories
        ])
            ->layout('layouts.base');
    }
}
