<div>
    <style>
        .skeleton {
            background: linear-gradient(90deg, #e0e0e0 25%, #f5f5f5 50%, #e0e0e0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        .skeleton-text {
            height: 16px;
            margin-bottom: 8px;
            border-radius: 4px;
        }

        .skeleton-rect {
            height: 40px;
            border-radius: 8px;
            margin-bottom: 16px;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- Button Add & Search --}}

                <div class="relative bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                    <div
                        class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                        <div class="w-full md:w-1/2">
                            <button type="button" id="defaultModalButton" data-modal-target="defaultModal"
                                data-modal-toggle="defaultModal"
                                class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Tambah
                                Kategori Produk</button>

                            {{-- Pencarian --}}
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
                                        placeholder="Search" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-500 text-white">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nama Kategori</th>
                                <th scope="col" class="px-6 py-3">Dibuat Pada</th>
                                <th scope="col" class="px-6 py-3">Diubah Pada</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productCategories as $category)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $category->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $category->created_at->format('d M Y H:i:s') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $category->updated_at->format('d M Y H:i:s') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <button type="button" wire:click="productEdit({{ $category }})"
                                            data-modal-target="editModal" data-modal-toggle="editModal"
                                            class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Edit</button>

                                        <button type="button" wire:click="deleteConfirmation({{ $category->id }})"
                                            class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-800">
                                            hapus
                                        </button>


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        {{-- Modal Create --}}
        <div wire:ignore.self id="defaultModal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div
                        class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Tambah Kategori Produk
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="defaultModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form wire:submit.prevent="store">
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Kategori</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukan nama kategori" wire:model="name">

                                <!-- Display error message for 'name' -->
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <!-- Tombol Simpan -->
                        <button type="submit"
                            class="text-white inline-flex items-center px-4 py-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <span wire:loading.remove wire:target="store">Simpan</span>
                            <span wire:loading wire:target="store" class="flex items-center space-x-2">
                                <!-- Icon Spinner -->
                                <i class="fas fa-circle-notch fa-spin"></i>
                                <span>Memproses...</span>
                            </span>
                        </button>


                    </form>
                </div>
            </div>
        </div>
        <div wire:ignore.self id="editModal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div
                        class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Edit Kategori Produk
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="editModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form wire:submit.prevent="update">
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Kategori</label>
                                <input type="text" name="editName" id="editName"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukan nama kategori" wire:model="editName">

                                <!-- Display error message for 'name' -->
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <!-- Tombol Simpan -->
                        <button type="submit"
                            class="text-white inline-flex items-center px-4 py-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <span wire:loading.remove wire:target="update">Simpan</span>
                            <span wire:loading wire:target="update" class="flex items-center space-x-2">
                                <!-- Icon Spinner -->
                                <i class="fas fa-circle-notch fa-spin"></i>
                                <span>Memproses...</span>
                            </span>
                        </button>


                    </form>
                </div>
            </div>
        </div>

        <script>
            // Menangani pembukaan modal
            window.addEventListener('openModal', () => {
                const modal = document.getElementById('editModal');
                modal.classList.remove('hidden');
            });

            // Menangani sukses update kategori
            window.addEventListener('updatedSuccess', () => {
                const modal = document.getElementById('editModal');
                const modalCloseButton = modal.querySelector('[data-modal-toggle="editModal"]');
                modalCloseButton.click();

                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: 'Kategori produk berhasil diperbarui.',
                    showConfirmButton: true,
                    confirmButtonText: 'Tutup',
                    timer: 2500,
                    customClass: {
                        confirmButton: 'bg-blue-500 text-white hover:bg-blue-600 focus:ring-blue-500'
                    }
                });
            });
        </script>

        <script>
            Livewire.on('addedSuccess', () => {
                // Menutup modal dengan id 'defaultModal'
                const modal = document.getElementById('defaultModal');
                const modalCloseButton = modal.querySelector('[data-modal-toggle="defaultModal"]');
                modalCloseButton.click();

                // Menampilkan SweetAlert setelah modal ditutup
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: 'Kategori produk baru telah berhasil ditambahkan.',
                    showConfirmButton: true,
                    confirmButtonText: 'Tutup',
                    timer: 1500,
                    customClass: {
                        confirmButton: 'bg-blue-500 text-white hover:bg-blue-600 focus:ring-blue-500'
                    }
                });
            });
        </script>
        <script>
            Livewire.on('upatedSuccess', () => {
                // Menutup modal dengan id 'defaultModal'
                const modal = document.getElementById('editModal');
                const modalCloseButton = modal.querySelector('[data-modal-toggle="editModal"]');
                modalCloseButton.click();

                // Menampilkan SweetAlert setelah modal ditutup
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: 'Kategori produk baru telah berhasil ditambahkan.',
                    showConfirmButton: true,
                    confirmButtonText: 'Tutup',
                    timer: 1500,
                    customClass: {
                        confirmButton: 'bg-blue-500 text-white hover:bg-blue-600 focus:ring-blue-500'
                    }
                });
            });
        </script>
        <script>
            window.addEventListener('show-delete-confirmation', event => {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Kategori produk ini akan dihapus.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('deleteConfirmed');
                    }
                });
            });

            window.addEventListener('categoriesDeleted', event => {
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Kategori produk berhasil dihapus.',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#1E40AF', // Mengatur warna tombol menjadi biru
                });
            });
        </script>

    </div>
</div>
