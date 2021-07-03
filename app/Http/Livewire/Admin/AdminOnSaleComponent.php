<?php

namespace App\Http\Livewire\Admin;

use App\Models\OnSale;
use Livewire\Component;

class AdminOnSaleComponent extends Component
{
    public $sale_date;
    public $status;

    public function mount()
    {
        $onSale = OnSale::find(1);

        $this->sale_date = $onSale->sale_date;
        $this->status = $onSale->status;
    }

    //function for setup onSale functionality
    public function setupOnsale()
    {
        $onsale = OnSale::find(1);

        $onsale->sale_date = $this->sale_date;
        $onsale->status= $this->status;

        $onsale->save();

        session()->flash('message', 'OnSale Recored has been setup Successfully!');
    }

    public function render()
    {
        return view('livewire.admin.admin-on-sale-component')->layout('layouts.base');
    }
}
