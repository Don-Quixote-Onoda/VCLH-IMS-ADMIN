<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Freebie as FreebieModel;

class Freebie extends Component
{

    public $name; 

    protected $rules = [
        'name' => 'required',
    ];

    public function save_freebie() {
        $this->validate();
        $freebie = new FreebieModel;
        $freebie->name = $this->name;
        $freebie->save();
        $this->form_reset();
    }

    public function form_reset() {
        $this->name = '';
    }

    public function render()
    {
        return view('livewire.freebie');
    }
}
