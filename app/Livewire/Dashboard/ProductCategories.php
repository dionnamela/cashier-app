<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\ProductCategories as ModelProductCategories;
use RealRashid\SweetAlert\Facades\Alert;

class ProductCategories extends Component
{
    public $productCategories;
    public $name;
    public $search = '';
    public $loading = true;  // Properti loading

    public function mount()
    {


        // Mengambil data kategori produk
        $this->productCategories = ModelProductCategories::all();

        // Setelah data dimuat, set loading ke false
        $this->loading = false;
    }

    public function store()
    {
        // Menyimpan kategori produk
        ModelProductCategories::create([
            'name' => $this->name
        ]);

        // Reset input setelah penyimpanan
        $this->reset('name');

        // Merefresh data kategori produk
        $this->productCategories = ModelProductCategories::all();

        // Dispatch custom event untuk memicu aksi JavaScript
        $this->dispatch('addedSuccess');
    }

    public function render()
    {
        return view('livewire.dashboard.productCategories');
    }
}
