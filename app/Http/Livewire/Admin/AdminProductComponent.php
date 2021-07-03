<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{

    use WithPagination;

    //function for delete product
    public function deleteProduct($id)
    {
        //fetch product by id
        $product = Product::find($id);

        $product->delete();

        session()->flash('message', 'Product has been deleted successfully!');
    }

    public function render()
    {

        //fetch all product by id
        $products = Product::orderBy('id', 'DESC')->paginate(10);

        return view('livewire.admin.admin-product-component', [
            'products' => $products
        ])
            ->layout('layouts.base');
    }
}
