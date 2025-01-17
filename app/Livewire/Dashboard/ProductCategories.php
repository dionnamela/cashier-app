<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\ProductCategories as ModelProductCategories;
use RealRashid\SweetAlert\Facades\Alert;

class ProductCategories extends Component
{
    public $productCategories;
    public $categoryId; // ID kategori yang akan diedit
    public $name; // Nama kategori yang akan diedit

    public function store()
    {
        // Validasi input dengan pesan error kustom
        $this->validate([
            'name' => 'required|unique:product_categories,name',
        ], [
            'name.required' => 'Nama kategori produk wajib diisi.',
            'name.unique' => 'Nama kategori produk sudah ada. Silakan masukkan nama lain.',
        ]);

        sleep(1);

        // Menyimpan kategori produk
        ModelProductCategories::create([
            'name' => $this->name,
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
