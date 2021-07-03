<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;

class AdminHomeSilderComponent extends Component
{
    //function for delete slide
    public function deleteSlide($slide_id)
    {
        $slider = HomeSlider::find($slide_id);

        $slider->delete();

        session()->flash('message', 'Slider has been deleted successfully!');
    }

    public function render()
    {
        //fetch all sliders by id
        $sliders = HomeSlider::orderBy('id', 'DESC')->get();

        return view('livewire.admin.admin-home-silder-component', [
            'sliders' => $sliders
        ])
            ->layout('layouts.base');
    }
}
