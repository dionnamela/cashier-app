<div>

    <head>
        <style>
            .image {
                position: relative;
            }

            .image img {
                display: block;
                position: absolute;
                left: 0px;
                /* Menyesuaikan dengan padding-left 6 (px-6) */
                top: 12px;
                width: 40px;
                /* Sesuai dengan width gambar (w-10) */
                height: 40px;
                /* Sesuai dengan height gambar (h-10) */
                border-radius: 50%;
                /* Membuat bentuk lingkaran */
                background: linear-gradient(90deg, #e0e0e0 25%, #e0e0e0 50%, #e0e0e0 75%);
                transition: opacity 0.3s ease-in-out;
            }

        </style>
    </head>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                {{-- Button Add & Search --}}
                <div class="relative bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                    <div
                        class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                        <div class="w-full md:w-1/2">

                            <!-- Tombol Buka Modal -->
                            <button type="button" id="addProductButton" data-modal-target="addModal"
                                data-modal-toggle="addModal"
                                class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                Tambah Produk
                            </button>
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor"
                                            viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input wire:model.live="search" type="text" id="simple-search"
                                        class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Search">
                                </div>
                            </form>
                            <a wire:loading wire:target='search' class="text-secondary text-sm mb-2">
                                Mencari...
                                <svg aria-hidden="true" role="status"
                                    class="inline w-4 h-4 me-3 text-gray-800 animate-spin" viewBox="0 0 100 101"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="#E5E7EB" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentColor" />
                                </svg>
                            </a>
                        </div>
                        <div
                            class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                        </div>
                    </div>
                </div>

                <div wire:init='loadInitialProducts' class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-500 text-white">
                            <tr>
                                <th scope="col" class="px-6 py-3">Gambar</th>
                                <th scope="col" class="px-6 py-3">Nama Produk</th>
                                <th scope="col" class="px-6 py-3">Sku</th>
                                <th scope="col" class="px-6 py-3">Kategori</th>
                                <th scope="col" class="px-6 py-3">Harga</th>
                                <th scope="col" class="px-6 py-3">Stok</th>
                                <th scope="col" class="px-6 py-3">Satuan</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$loaded)
                            {{-- Tampilkan skeleton saat data belum dimuat --}}
                            @for ($i = 0; $i < 8; $i++) <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">
                                    <div class="w-10 h-10 bg-gray-300 rounded-full dark:bg-gray-600 animate-pulse">
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="h-4 bg-gray-300 rounded dark:bg-gray-600 animate-pulse"></div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="h-4 bg-gray-300 rounded dark:bg-gray-600 animate-pulse"></div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="h-4 bg-gray-300 rounded dark:bg-gray-600 animate-pulse"></div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="h-4 bg-gray-300 rounded dark:bg-gray-600 animate-pulse"></div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="h-4 bg-gray-300 rounded dark:bg-gray-600 animate-pulse"></div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="h-4 w-10 bg-gray-300 rounded dark:bg-gray-600 animate-pulse"></div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="h-4 mb-2 w-10 bg-gray-300 rounded dark:bg-gray-600 animate-pulse"></div>
                                    <div class="h-4 mb-2 w-10 bg-gray-300 rounded dark:bg-gray-600 animate-pulse"></div>
                                    <div class="h-4 w-10 bg-gray-300 rounded dark:bg-gray-600 animate-pulse"></div>

                                </td>
                                </tr>
                                @endfor
                                @else
                                {{-- Tampilkan data asli setelah dimuat --}}
                                @forelse ($products as $product)
                                <tr class="bg-white border-b hover:bg-gray-300">
                                    {{-- <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                                        <div class="lazy-placeholder-products flex items-center px-6 py-4 text-gray-900"
                                        x-data="{ imageSrc: null }"
                                        x-init="setTimeout(() => { imageSrc = $el.querySelector('img').dataset.src }, 500)">
                                        <img :src="imageSrc" 
                                             data-src="{{ asset('storage/' . $product->image) }}"
                                    class="lazy-img w-10 h-10 rounded-full">
                </div>
                </th> --}}

                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                    <div class="image flex items-center px-6 py-4 text-gray-900">
                        <img src="{{ asset('storage/' . $product->image) }}" class="lazy-img w-10 h-10 rounded-full">
                    </div>
                </th>
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 ">
                    {{ $product->name }}
                </td>
                <td class="px-6 py-4">{{ $product->sku }}</td>
                <td class="px-6 py-4">Kategori disini</td>
                <td class="px-6 py-4">Rp{{ $product->price }}</td>
                <td class="px-6 py-4">{{ $product->stock }}</td>
                <td class="px-6 py-4">{{ $product->unit }}</td>
                <td class="px-6 py-4">
                    <div>
                        <button wire:click="editModal({{ $product->id }})"
                            class="mb-2 bg-green-100 hover:bg-green-200 text-green-800 text-xs font-semibold me-2 px-2.5 py-0.5 rounded  border border-green-400 inline-flex items-center justify-center">
                            Ubah</button>
                    </div>
                    <div>
                        <button wire:loading.remove wire:target='loadInitialProducts' wire:click="deleteModal({{ $product->id }})"
                            class="mb-2 bg-red-100 hover:bg-red-200 text-red-800 text-xs font-semibold me-2 px-2.5 py-0.5 rounded  border border-red-400 inline-flex items-center justify-center">
                            Delete</button>
                    </div>
                    <div>
                        <button
                            class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-xs font-semibold me-2 px-2.5 py-0.5 rounded border border-blue-400 inline-flex items-center justify-center">
                            Detail
                        </button>
                    </div>
                </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center align-middle h-20">
                        Tidak ada data ditemukan!
                    </td>
                </tr>
                @endforelse
                @endif
                </tbody>
                </table>


            </div>
            {{-- Tombol Load More --}}
            @if($products->count() >= $limit && $totalProducts > $limit)
            <div class="mt-4 mb-2 flex justify-center">
                <!-- Tombol "Tampilkan Lebih" (akan hilang saat loading) -->
                <button wire:click="loadMore"
                    class="bg-gray-800 text-white px-6 py-2 rounded-full shadow-md hover:bg-gray-700 focus:outline-none focus:ring focus:ring-gray-400 focus:ring-opacity-50"
                    wire:loading.remove wire:target="loadMore">
                    Tampilkan Lebih
                </button>

                <!-- Tombol Loading (hanya muncul saat loading) -->
                <button
                    class="mb-5 bg-gray-800 text-white px-6 py-2 rounded-full shadow-md cursor-not-allowed focus:outline-none focus:ring focus:ring-gray-400 focus:ring-opacity-50"
                    type="button" disabled wire:loading wire:target="loadMore">
                    Memuat..
                    <svg class="inline w-5 h-5 text-white animate-spin ml-2" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8v4a4 4 0 100 8v4a8 8 0 01-8-8z"></path>
                    </svg>
                </button>
            </div>
            @endif
        </div>
    </div>
</div>


{{-- Modal Create --}}
<div id="addModal" tabindex="-1" aria-hidden="true" data-modal-backdrop="addModal"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full"
    wire:ignore.self>
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Tambah Produk
                </h3>

                <button type="button" id="closeButtonAddModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            @if ($errors->any())
            <ul class="text-red-500">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            <!-- Modal body -->
            <form wire:submit.prevent="store">
                <div class="grid gap-4 mb-4 sm:grid-cols-2" style="max-height: 60vh; overflow-y: auto;">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Produk</label>
                        <input wire:model='name' type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukan Nama Produk">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }} @enderror
                    </div>
                    <div>
                        <label for="skuUpdate"
                            class="block mb-2 Updatetext-sm font-medium text-gray-900 dark:text-white">SKU</label>
                        <input wire:model='sku' type="text" name="sku" id="sku"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukan SKU">
                        @error('sku') <span class="text-red-500 text-sm">{{ $message }} @enderror
                    </div>
                    <div>
                        <label for="price"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                        <input wire:model='price' type="number" name="price" id="price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukan Harga">
                        @error('price') <span class="text-red-500 text-sm">{{ $message }} @enderror
                    </div>
                    <div>
                        <label for="stok"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                        <input wire:model='stock' type="number" name="stock" id="stock"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukan Stok">
                        @error('stock') <span class="text-red-500 text-sm">{{ $message }} @enderror
                    </div>

                    <div>
                        <label for="unit"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Satuan</label>
                        <select wire:model='unit' id="unit"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">-Pilih Satuan-</option>
                            <option value="KG">KG</option>
                            <option value="Pcs">Pcs</option>
                            <option value="Box">Box</option>
                            <option value="Pack">Pack</option>
                        </select>
                        @error('unit') <span class="text-red-500 text-sm">{{ $message }} @enderror
                    </div>

                    <div class="sm:col-span-2" x-data="imageUploader()">
                        <!-- Input Upload -->
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Upload Gambar</label>
                        <input wire:model='image'
                            type="file"
                            id="image"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            accept=".png,.jpg,.jpeg,.gif,.svg"
                            x-on:change="previewImage($event)"
                        >
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="image">SVG, PNG, JPG or GIF (Max: 5MB)</p>
                    
                        <!-- Progress Container -->
                        <div x-show="uploading" x-transition:enter="transition ease-out duration-300" class="w-full">
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Upload Progress</span>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-200" x-text="`${progress}%`"></span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                <div
                                    class="h-2.5 rounded-full transition-all duration-150 ease-out"
                                    :style="`width: ${progress}%`"
                                    :class="{
                                        'bg-blue-600': progress < 60,
                                        'bg-yellow-400': progress >= 60 && progress < 80,
                                        'bg-green-500': progress >= 80
                                    }"
                                ></div>
                            </div>
                        </div>
                    
                        <!-- Error Message -->
                        @error('image') <span class="text-red-500 text-sm">{{ $message }} @enderror
                        <template x-if="error">
                            <span class="text-red-500 text-sm" x-text="error"></span>
                        </template>
                    
                        <!-- Image Preview -->
                        <template x-if="imagePreview">
                            <div class="flex justify-center items-center mt-2">
                                <div class="flex flex-col items-center">
                                    <!-- Preview Image -->
                                    <img :src="imagePreview" alt="Preview" class="max-w-full h-64 rounded-lg object-cover border-2 border-gray-300 border-dashed">
                                    <!-- File Name -->
                                    <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-semibold" x-text="fileName"></span>
                                        <span x-text="fileSize"></span>
                                    </p>
                                </div>
                            </div>
                        </template>
                    </div>
                    

                    <div class="sm:col-span-2">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea wire:model='description' id="description" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukan deskripsi disini"></textarea>
                        @error('description') <span class="text-red-500 text-sm">{{ $message }} @enderror
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <button wire:loading.remove wire:target='store' wire:click='store' type="submit"
                        class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Simpan
                    </button>
                    <button disabled wire:loading wire:target='store' 
                        class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Menyimpan..
                        <svg class="inline w-5 h-5 text-white animate-spin ml-2" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8v4a4 4 0 100 8v4a8 8 0 01-8-8z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



{{-- Modal Edit --}}
<div id="editModal" tabindex="-1" aria-hidden="true" data-modal-backdrop="editModal"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full"
    wire:ignore.self>
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit Produk {{ $nameUpdate }}

                </h3>

                <button type="button" id="closeButtonEditModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            @if ($errors->any())
                <ul class="text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <!-- Modal body -->
            <form wire:submit.prevent="update">
                <div class="grid gap-4 mb-4 sm:grid-cols-2" style="max-height: 60vh; overflow-y: auto;">
                    <div>
                        <label for="nameUpdate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                        <input wire:model='nameUpdate' type="text" name="nameUpdate" id="nameUpdate"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukan Nama Produk">
                        @error('nameUpdate') <span class="text-red-500 text-sm">{{ $message }} @enderror
                    </div>
                    <div>
                        <label for="skuUpdate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKU</label>
                        <input wire:model='skuUpdate' type="text" name="skuUpdate" id="skuUpdate"
                            class="bg-gray-50 border border-gray-300 text-grUpdateay-900 text-sm Updaterounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukan SKU">
                        @error('skuUpdate') <span class="text-red-500 text-sm">{{ $message }} @enderror
                    </div>
                    <div>
                        <label for="priceUpdate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                        <input wire:model='priceUpdate' type="number" name="priceUpdate" id="priceUpdate"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukan Harga">
                        @error('priceUpdate') <span class="text-red-500 text-sm">{{ $message }} @enderror
                    </div>
                    <div>
                        <label for="stockUpdate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                        <input wire:model='stockUpdate' type="number" name="stockUpdate" id="stockUpdate"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukan Stok">
                        @error('stockUpdate') <span class="text-red-500 text-sm">{{ $message }} @enderror
                    </div>

                    <div>
                        <label for="unitUpdate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Satuan</label>
                        <select wire:model='unitUpdate' id="unitUpdate"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">-Pilih Satuan-</option>
                            <option value="KG">KG</option>
                            <option value="Pcs">Pcs</option>
                            <option value="Box">Box</option>
                            <option value="Pack">Pack</option>
                        </select>
                        @error('unitUpdate') <span class="text-red-500 text-sm">{{ $message }} @enderror
                    </div>

                    <div class="sm:col-span-2" x-data="imageUploader()">
                        <!-- Input Upload -->
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Upload Gambar</label>
                        <input wire:model='imageUpdate'
                            type="file"
                            id="image"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            accept=".png,.jpg,.jpeg,.gif,.svg"
                            x-on:change="previewImage($event)"
                        >
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="image">SVG, PNG, JPG or GIF (Max: 5MB)</p>
                    
                        <!-- Progress Container -->
                        <div x-show="uploading" x-transition:enter="transition ease-out duration-300" class="w-full">
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Upload Progress</span>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-200" x-text="`${progress}%`"></span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                <div
                                    class="h-2.5 rounded-full transition-all duration-150 ease-out"
                                    :style="`width: ${progress}%`"
                                    :class="{
                                        'bg-blue-600': progress < 60,
                                        'bg-yellow-400': progress >= 60 && progress < 80,
                                        'bg-green-500': progress >= 80
                                    }"
                                ></div>
                            </div>
                        </div>
                    
                        <!-- Error Message -->
                        @error('image') <span class="text-red-500 text-sm">{{ $message }} @enderror
                        <template x-if="error">
                            <span class="text-red-500 text-sm" x-text="error"></span>
                        </template>
                    
                        <!-- Image Preview -->
                        <template x-if="imagePreview">
                            <div class="flex justify-center items-center mt-2">
                                <div class="flex flex-col items-center">
                                    <!-- Preview Image -->
                                    <img :src="imagePreview" alt="Preview" class="max-w-full h-64 rounded-lg object-cover border-2 border-gray-300 border-dashed">
                                    <!-- File Name -->
                                    <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-semibold" x-text="fileName"></span>
                                        <span x-text="fileSize"></span>
                                    </p>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea wire:model='description' id="description" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukan deskripsi disini"></textarea>
                        @error('description') <span class="text-red-500 text-sm">{{ $message }} @enderror
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <button wire:loading.remove wire:target='update' wire:click='update' type="submit"
                        class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Simpan
                    </button>
                    <button disabled wire:loading wire:target='update' 
                        class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Menyimpan..
                        <svg class="inline w-5 h-5 text-white animate-spin ml-2" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8v4a4 4 0 100 8v4a8 8 0 01-8-8z"></path>
                        </svg>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>



{{-- Modal Delete --}}
<div id="deleteModal" tabindex="-1" aria-hidden="true" data-modal-backdrop="deleteModal"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full"
    wire:ignore.self>
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t sm:mb-5">
                <button type="button" class="closeButtonDeleteModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Anda yakin ingin menghapus produk <b>{{ $nameUpdate }}</b>?</h3>
                
                <button wire:loading.remove wire:click='delete' type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                   Hapus
                </button>
                <button disabled wire:loading wire:target='delete' type="button" class="text-white bg-red-300 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Menghapus..
                 </button>

                <button  data-modal-hide="deleteModal" type="button" class="closeButtonDeleteModal py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>




{{-- Script modal tambah --}}
<script>
    $(document).ready(function () {

        window.addEventListener('addedSuccess', function () {
            const modal = new Modal(document.getElementById('addModal'));
            modal.hide(); // Menutup modal setelah data berhasil ditambahkan
            @this.call('resetForm'); // Mereset form di Livewire
        });

        // Pastikan tombol buka modal tetap bisa membuka modal
        $('#addProductButton').on('click', function () {
            const modal = new Modal(document.getElementById('addModal'));
            modal.show(); // Menampilkan modal saat tombol ditekan
        });

        // Event listener untuk menutup modal dan mereset form ketika tombol close ditekan
        $('#closeButtonAddModal').on('click', function () {
            const modal = new Modal(document.getElementById('addModal'));
            modal.hide(); // Menutup modal
            @this.call('resetForm'); // Mereset form di Livewire
        });
    });

</script>

{{-- Alpine FileUpload --}}
<script>
    function imageUploader() {
        return {
            imagePreview: null,
            fileName: '',
            fileSize: '',
            error: null,
            uploading: false,
            progress: 0,

            previewImage(event) {
                const file = event.target.files[0];

                if (!file) {
                    this.error = "No file selected.";
                    return;
                }

                if (!['image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'image/svg+xml'].includes(file.type)) {
                    this.error = "Image must be an image (PNG, JPG, GIF, SVG).";
                    return;
                }

                if (file.size > 5 * 1024 * 1024) {
                    this.error = "Image cannot be more than 5MB";
                    return;
                }

                this.error = null;
                this.fileName = file.name;
                this.fileSize = `${(file.size / 1024).toFixed(2)} KB`;

                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imagePreview = e.target.result;
                };
                reader.readAsDataURL(file);

                // Simulate progress bar
                this.simulateProgress();
            },

            simulateProgress() {
                this.uploading = true;
                this.progress = 0;

                const interval = setInterval(() => {
                    this.progress += 10;

                    if (this.progress >= 100) {
                        clearInterval(interval);
                        this.uploading = false;
                    }
                }, 150);
            },
        };
    }
</script>

<script>
    function imageUploader() {
        return {
            imagePreview: @entangle('imagePreview') ?? null,  // Gunakan entangle untuk bind dengan Livewire
            fileName: @entangle('fileName') ?? '', 
            fileSize: @entangle('fileSize') ?? '',
            error: null,
            uploading: false,
            progress: 0,
            existingImage: @entangle('existingImage') ?? null, // Entangle existing image if available
            hasImage: false,

            init() {
                // Jika ada gambar yang sudah ada (misalnya saat edit), tampilkan gambar tersebut
                if (this.existingImage) {
                    this.imagePreview = this.existingImage;
                    this.hasImage = true;
                }
            },

            previewImage(event) {
                const file = event.target.files[0];

                if (!file) {
                    this.error = "No file selected.";
                    return;
                }

                if (!['image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'image/svg+xml'].includes(file.type)) {
                    this.error = "Image must be an image (PNG, JPG, GIF, SVG).";
                    return;
                }

                if (file.size > 5 * 1024 * 1024) {
                    this.error = "Image cannot be more than 5MB";
                    return;
                }

                this.error = null;
                this.fileName = file.name;
                this.fileSize = `${(file.size / 1024).toFixed(2)} KB`;

                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imagePreview = e.target.result;
                    this.hasImage = true;
                };
                reader.readAsDataURL(file);

                // Simulate progress bar
                this.simulateProgress();
            },

            simulateProgress() {
                this.uploading = true;
                this.progress = 0;

                const interval = setInterval(() => {
                    this.progress += 10;

                    if (this.progress >= 100) {
                        clearInterval(interval);
                        this.uploading = false;
                    }
                }, 150);
            },

            removeImage() {
                // Remove selected image and reset fields
                this.imagePreview = null;
                this.fileName = '';
                this.fileSize = '';
                this.hasImage = false;
                this.existingImage = null;
            },
        };
    }
</script>

{{-- Script modal edit --}}
<script>
    $(document).ready(function () {

        window.addEventListener('updatedSuccess', function () {
            const modal = new Modal(document.getElementById('editModal'));
            modal.hide(); // Menutup modal setelah data berhasil ditambahkan

        });


        window.addEventListener('showEditModal', function () {
            const modal = new Modal(document.getElementById('editModal'));
            modal.show(); // Menampilkan modal saat tombol ditekan
        });


        // Event listener untuk menutup modal dan mereset form ketika tombol close ditekan
        $('#closeButtonEditModal').on('click', function () {
            const modal = new Modal(document.getElementById('editModal'));
            modal.hide(); // Menutup modal
            @this.call('resetFormEdit');
        });

    });

</script>

{{-- Script modal delete --}}
<script>
    $(document).ready(function () {

        window.addEventListener('deleteSuccess', function () {
            const modal = new Modal(document.getElementById('deleteModal'));
            modal.hide(); // Menutup modal setelah data berhasil ditambahkan

        });


        window.addEventListener('showDeleteModal', function () {
            const modal = new Modal(document.getElementById('deleteModal'));
            modal.show(); // Menampilkan modal saat tombol ditekan
        });


        // Event listener untuk menutup modal dan mereset form ketika tombol close ditekan
        $('.closeButtonDeleteModal').on('click', function () {
            const modal = new Modal(document.getElementById('deleteModal'));
            modal.hide(); // Menutup modal

        });

    });

</script>

{{-- Sweet alert,added success --}}
<script>
    $(document).ready(function () {
        window.addEventListener('addedSuccess', function (event) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "Produk berhasil ditambahkan"
            });
        });
    })

</script>

{{-- Sweet alert,updated success --}}
<script>
    $(document).ready(function () {
        window.addEventListener('updatedSuccess', function (event) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "Produk berhasil diperbarui"
            });
        });
    })

</script>

{{-- Sweet alert,delete success --}}
<script>
    $(document).ready(function () {
        window.addEventListener('deleteSuccess', function (event) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "Produk berhasil dihapus dari database!"
            });
        });
    })

</script>
</div>
