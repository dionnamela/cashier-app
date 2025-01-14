<?php

namespace App\Livewire\Dashboard;

use App\Models\Product as ModelsProduct;
use Livewire\Component;

class Product extends Component
{
    public $products;


    public function mount()
    {
        $this->products = ModelsProduct::all();    
    }

    public function store()
    {
        ModelsProduct::create([
            'name' => 'Product Name',
            'price' => 0,
            'description' => 'Product Description',
        ]);
        $this->products = ModelsProduct::all();
    }

    

    public function update($id, $field)
    {
        $product = ModelsProduct::find($id);
        $product->$field = $product->$field;
        $product->save();
    }

    public function delete($id)
    {
        ModelsProduct::find($id)->delete();
        $this->products = ModelsProduct::all();
    }

    public function render()
    {
        return view('livewire.dashboard.product');
    }
}
