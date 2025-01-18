<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\ProductCategories as ModelProductCategories;
use RealRashid\SweetAlert\Facades\Alert;

class ProductCategories extends Component
{
    public $productCategories;
    public $categoryId; // ID kategori yang akan diedit
    public $editName; // Nama kategori yang akan diedit
    public $name; // Nama kategori yang akan diedit
    public $isLoading = true;
    protected $listeners = ['deleteConfirmed' => 'deleteCategory'];
    public $search = '';


    public function mount()
    {
        // Simulasikan loading data
        $this->productCategories = ModelProductCategories::all();
        $this->isLoading = false;
    }

    public function updatedSearch()
    {
        $this->productCategories = ModelProductCategories::where('name', 'like', '%' . $this->search . '%')->get();
    }

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
    public function productEdit($category)
    {
        // dd($category);
        $this->categoryId = $category['id'];
        $this->editName = $category['name'];
    }
    public function update()
    {
        // Validasi input dengan pesan error kustom
        $this->validate([
            'editName' => 'required|unique:product_categories,name,' . $this->categoryId,
        ], [
            'editName.required' => 'Nama kategori produk wajib diisi.',
            'editName.unique' => 'Nama kategori produk sudah ada. Silakan masukkan nama lain.',
        ]);

        sleep(1);

        // Update kategori produk
        ModelProductCategories::find($this->categoryId)->update([
            'name' => $this->editName,
        ]);

        // Reset input setelah penyimpanan
        $this->reset('editName');

        // Merefresh data kategori produk
        $this->productCategories = ModelProductCategories::all();

        // Dispatch custom event untuk memicu aksi JavaScript
        $this->dispatch('updatedSuccess');
    }

    public $delete_id;

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('show-delete-confirmation');
        // Mengirimkan event untuk memunculkan SweetAlert
        // dd($this->categoryIdToDelete);
    }
    public function deleteCategory()
    {

        $categories = ModelProductCategories::where('id', $this->delete_id)->first();
        $categories->delete();
        $this->productCategories = ModelProductCategories::all();
        $this->dispatch('categoriesDeleted');
    }

    public function render()
    {
        return view('livewire.dashboard.productCategories');
    }
}
