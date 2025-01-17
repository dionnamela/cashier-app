<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\ProductCategories as ModelProductCategories;

class ProductCategoriesList extends Component
{
    public $productCategories;

    protected $listeners = ['addedSuccess' => 'refreshProductCategories'];

    public function placeholder()
    {
        return view('placeholder');
    }
    public function mount()
    {
        // Load initial data
        $this->productCategories = ModelProductCategories::all();
    }

    public function refreshProductCategories()
    {
        // Refresh product categories list when new category is added
        $this->productCategories = ModelProductCategories::all();
    }

    public function render()
    {
        sleep(1);
        return view('livewire.dashboard.product-categories-list');
    }
}
