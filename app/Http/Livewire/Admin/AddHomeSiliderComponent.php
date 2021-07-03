<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddHomeSiliderComponent extends Component
{
    use WithFileUploads;

    public $title;
    public $subtitle;
    public $price;
    public $link;
    public $image;
    public $status;

    public function mount()
    {
        $this->status = 0;
    }

    //function for store slider into db
    public function addSlider()
    {
        $slider = new HomeSlider();

        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->price = $this->price;
        $slider->link = $this->link;

        //for create image name
        $imageName = Carbon::now()->timestamp. '_' . $this->image->extension();
        //for upload image into folder
        $this->image->storeAs('sliders', $imageName);

        $slider->image = $imageName;
        $slider->status = $this->status;

        $slider->save();

        session()->flash('message', 'Slider has been created successfully!');

    }

    public function render()
    {
        return view('livewire.admin.add-home-silider-component')
            ->layout('layouts.base');
    }
}
