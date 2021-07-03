<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class EditHomeSliderComponent extends Component
{

    use WithFileUploads;

    public $title;
    public $subtitle;
    public $price;
    public $link;
    public $image;
    public $status;

    public $updated_image;
    public $slider_id;

    public function mount($slide_id)
    {
        //fetch slider by id
        $slider = HomeSlider::find($slide_id);

        $this->title = $slider->title;
        $this->subtitle = $slider->subtitle;
        $this->price = $slider->price;
        $this->link = $slider->link;
        $this->image = $slider->image;
        $this->status = $slider->status;
        $this->slider_id = $slider->id;
    }

    //function for updateSlider
    public function updateSlider()
    {
        $slider = HomeSlider::find($this->slider_id);

        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->price = $this->price;
        $slider->link = $this->link;

        //check for image update
        if ($this->updated_image) {
            //for create image name
            $imageName = Carbon::now()->timestamp . '_' . $this->updated_image->extension();
            //for upload image into folder
            $this->updated_image->storeAs('sliders', $imageName);
            $slider->image = $imageName;
        }
        $slider->status = $this->status;

        $slider->save();

        session()->flash('message', 'Sldier has been updated successfully!');
    }

    public function render()
    {
        return view('livewire.admin.edit-home-slider-component')->layout('layouts.base');
    }
}
