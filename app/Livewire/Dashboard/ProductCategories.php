<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Url;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ProductCategories as ModelProductCategories;

class ProductCategories extends Component
{
    public $productCategories, $totalProductCategories;
    public $categoryId; // ID kategori yang akan diedit
    public $editName; // Nama kategori yang akan diedit
    public $name; // Nama kategori yang akan diedit
    public $loaded = false;
    protected $listeners = ['deleteConfirmed' => 'deleteCategory', 'productUpdated' => 'loadInitialProducts', 'categoriesDeleted' => 'loadInitialProducts'];
    #[Url()]
    public $search = '';
    public $limit = 8;


    public function mount()
    {
        $this->totalProductCategories = ModelProductCategories::count();
        $this->productCategories = collect();
    }

    public function loadMore()
    {
        $this->limit += 8;
        $this->loadInitialProducts();
    }

    public function updatingSearch()
    {
        $this->limit = 8;
    }

    public function loadInitialProducts()
    {
        $this->loaded = true;
        $this->productCategories = ModelProductCategories::where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->take($this->limit)
            ->get();
    }

    public function updatedSearch()
    {
        $this->loadInitialProducts();
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
        $this->productCategories = ModelProductCategories::latest()->get();

        // Dispatch custom event untuk memicu aksi JavaScript
        $this->dispatch('addedSuccess');
    }
    public function productEdit($id)
    {
        // dd($category);
        $productCategories = ModelProductCategories::where('id', $id)->first();
        $this->categoryId = $productCategories->id;
        $this->editName = $productCategories->name;

        $this->dispatch('showEditModal');
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
        $this->productCategories = ModelProductCategories::latest()->get();

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
        $this->productCategories = ModelProductCategories::latest()->get();

        $this->dispatch('categoriesDeleted');
    }

    public function render()
    {
        return view('livewire.dashboard.productCategories');
    }
}
