<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class AddCategoryComponent extends Component
{

    public $name;
    public $slug;

    //function for generate the slug
    public function generateslug()
    {
        $this->slug = Str::slug($this->name);
    }

    //livewire hook function for validation
    public function validationSetup($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required | unique:categories',
        ]);
    }

    //function for store ctegory into db
    public function storeCategory()
    {
        //validation
        $this->validate([
            'name' => 'required',
            'slug' => 'required | unique:categories',
        ]);

        $category = new Category();

        $category->name = $this->name;
        $category->slug = $this->slug;

        $category->save();

        session()->flash('message', 'Category has been created successfully!');
    }

    public function render()
    {
        return view('livewire.admin.add-category-component')
            ->layout('layouts.base');
    }
}
