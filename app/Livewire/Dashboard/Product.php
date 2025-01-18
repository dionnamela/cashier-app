<?php

namespace App\Livewire\Dashboard;

use App\Models\Product as ModelsProduct;
use Illuminate\Database\Events\ModelsPruned;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;

class Product extends Component
{
    use WithFileUploads;

    // Store
    public $name,$sku, $image, $price, $description, $stock, $unit;

    // Update
    public $productId, $nameUpdate, $skuUpdate, $currentImage, $imageUpdate, $priceUpdate, $descriptionUpdate, $stockUpdate, $unitUpdate;

    // Detail
    public $selectedProduct = null;

    // List Products
    public $products, $totalProducts;

    // Search
    #[Url()]
    public $search = '';
    public $limit = 8; 
    public $loaded = false;

    protected $listeners = [
        'productUpdated' => 'loadInitialProducts',
        'deleteConfirmed' => 'delete',
    ];
    

    public function mount() 
    {
        $this->totalProducts = ModelsProduct::count();
        $this->products = collect();
    }

    public function updatingSearch()
    {
        $this->limit = 8;
    }

    public function updatedSearch()
    {
        $this->loadInitialProducts();
    }

    public function loadInitialProducts()
    {
        $this->loaded = true;
        $this->products = ModelsProduct::where('name', 'like', '%'.$this->search.'%')
            ->latest()
            ->take($this->limit)
            ->get();
    }

    public function loadMore()
    {
        $this->limit += 8;
        $this->loadInitialProducts();
    }

    public function resetForm()
    {
        $this->reset(['name', 'sku', 'image', 'price', 'description', 'stock', 'unit']);
    }

    public function resetFormEdit()
    {
        $this->reset(['nameUpdate','skuUpdate','imageUpdate','priceUpdate', 'descriptionUpdate', 'stockUpdate', 'unitUpdate']);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:30',
            'sku' => 'required|string|max:30',
            'image' => 'required|image|max:5120',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'stock' => 'required|numeric|min:0',
            'unit' => 'required|string|max:10',
        ]);

        $imagePath = $this->image->store('product-image', 'public');

        ModelsProduct::create([
            'name' => $this->name,
            'sku' => $this->sku,
            'image' => $imagePath,
            'price' => $this->price,
            'description' => $this->description,
            'stock' => $this->stock,
            'unit' => $this->unit,
        ]);

        $this->dispatch('productUpdated'); // dispatch event untuk data ter refresh tanpa reload page
        $this->dispatch('addedSuccess');
    }

    public function editModal($id)
    {
        $product = ModelsProduct::findOrFail($id);

        $this->productId = $product->id;
        $this->nameUpdate = $product->name;
        $this->skuUpdate = $product->sku;
        $this->priceUpdate = $product->price;
        $this->descriptionUpdate = $product->description;
        $this->stockUpdate = $product->stock;
        $this->unitUpdate = $product->unit;
        $this->currentImage = $product->image; // Set gambar lama

        $this->dispatch('showEditModal');
    }

    public function update()
    {
        $this->validate([
            'nameUpdate' => 'required|string|max:30',
            'skuUpdate' => 'required|string|max:30',
            'imageUpdate' => 'nullable|image|max:5120',
            'priceUpdate' => 'required|numeric|min:0',
            'descriptionUpdate' => 'required|string',
            'stockUpdate' => 'required|numeric|min:0',
            'unitUpdate' => 'required|string|max:10',
        ]);

        $product = ModelsProduct::findOrFail($this->productId);

        // Jika ada gambar baru diunggah, proses upload
        if ($this->imageUpdate) {
            $newImagePath = $this->imageUpdate->store('product-image', 'public');

            // Hapus gambar lama jika ada
            if ($this->currentImage && file_exists(public_path('storage/' . $this->currentImage))) {
                unlink(public_path('storage/' . $this->currentImage));
            }

            $product->image = $newImagePath; // Update dengan gambar baru
        } else {
            $product->image = $this->currentImage; // Tetap gunakan gambar lama
        }

        $product->update([
            'name' => $this->nameUpdate,
            'sku' => $this->skuUpdate,
            'price' => $this->priceUpdate,
            'description' => $this->descriptionUpdate,
            'stock' => $this->stockUpdate,
            'unit' => $this->unitUpdate,
        ]);

        $this->dispatch('productUpdated'); // Dispatch event untuk refresh data
        $this->dispatch('updatedSuccess');
    }


    public function deleteConfirmation($id)
    {
        $product = ModelsProduct::findOrFail($id);

        $this->productId = $product->id;
        $this->dispatch('showDeleteConfirmation');
    }


    public function delete()
    {
        $product = ModelsProduct::findOrFail($this->productId);
        $imagePath = $product->image;

        // Hapus file gambar jika ada
        if (file_exists(public_path('storage/' . $imagePath))) {
            unlink(public_path('storage/' . $imagePath));
        }
    
        // Hapus data 
        $product->delete();

        $this->dispatch('productUpdated'); // dispatch event untuk data ter refresh tanpa reload page 
        $this->dispatch('deleteSuccess'); 
    }


    public function render()
    {
        return view('livewire.dashboard.product');
    }
}
