<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\HomeCategory;
use Livewire\Component;

class AdminHomeCategoryComponent extends Component
{
    public $selected_categories = [];
    public $numberofproducts;

    public function mount()
    {
        $category = HomeCategory::find(1);
        //convert string to array
        $this->selected_categories = explode(',', $category->sel_categories);
        $this->numberofproducts = $category->no_of_products;
    }

    //function for update home category
    public function updateHomeCategory()
    {
        $category = HomeCategory::find(1);
        //convert array to string
        $category->sel_categories = implode(',', $this->selected_categories);
        $category->no_of_products = $this->numberofproducts;

        $category->save();

        session()->flash('message', 'Home Category has been updated successfully!');
    }

    public function render()
    {
        //fetch all category
        $categories = Category::all();

        return view('livewire.admin.admin-home-category-component', [
            'categories' => $categories
        ])
            ->layout('layouts.base');
    }
}
