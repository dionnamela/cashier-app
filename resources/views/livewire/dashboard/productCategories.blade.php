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

                <div class="relative bg-white shadow-md sm:rounded-lg">
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
                    </div>
                </div>
                <div wire:init='loadInitialProducts' class="relative overflow-x-auto shadow-md sm:rounded-lg">

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
                            @if (!$loaded)
                                @for ($i = 0; $i < 8; $i++)
                                    <tr
                                        class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div class="h-4 bg-gray-300 rounded animate-pulse"></div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="h-4 bg-gray-300 rounded animate-pulse"></div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="h-4 bg-gray-300 rounded animate-pulse"></div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="h-4 mb-2 w-10 bg-gray-300 rounded animate-pulse"></div>
                                            <div class="h-4 mb-2 w-10 bg-gray-300 rounded animate-pulse"></div>
                                        </td>
                                    </tr>
                                @endfor
                            @else
                                @foreach ($productCategories as $category)
                                    <tr
                                        class="bg-white border-b hover:bg-gray-50">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $category->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $category->created_at->format('d M Y H:i:s') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $category->updated_at->format('d M Y H:i:s') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div>
                                                <button type="button" wire:click="productEdit({{ $category->id }})"
                                                    data-modal-target="editModal" data-modal-toggle="editModal"
                                                    class="mb-2 bg-green-100 hover:bg-green-200 text-green-800 text-xs font-semibold me-2 px-2.5 py-0.5 rounded  border border-green-400 inline-flex items-center justify-center">Ubah</button>
                                            </div>
                                            <div>
                                                <button type="button"
                                                    wire:click="deleteConfirmation({{ $category->id }})"
                                                    class="mb-2 bg-red-100 hover:bg-red-200 text-red-800 text-xs font-semibold me-2 px-2.5 py-0.5 rounded border border-red-400 inline-flex items-center justify-center">
                                                    Hapus
                                                </button>
                                            </div>




                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                {{-- Tombol Load More --}}
                @if ($productCategories->count() >= $limit && $totalProductCategories > $limit)
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
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8v4a4 4 0 100 8v4a8 8 0 01-8-8z"></path>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
        </div>

        {{-- Modal Create --}}
        <div wire:ignore.self id="defaultModal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                    <!-- Modal header -->
                    <div
                        class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Tambah Kategori Produk
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                            data-modal-toggle="defaultModal" id="closeModal">
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
                                    class="block mb-2 text-sm font-medium text-gray-900">Nama
                                    Kategori</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="Masukan nama kategori" wire:model="name">

                                <!-- Display error message for 'name' -->
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <!-- Tombol Simpan -->
                        <div class="flex items-center justify-center">
                            <button wire:loading.remove wire:target='store' type="submit"
                                class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                Simpan
                            </button>
                            <button disabled wire:loading wire:target='store'
                                class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                Menyimpan..
                                <svg class="inline w-5 h-5 text-white animate-spin ml-2"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4">
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
        <div wire:ignore.self id="editModal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                    <!-- Modal header -->
                    <div
                        class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Edit Kategori Produk
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                            data-modal-toggle="editModal" id="closeModalEdit">
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
                                    class="block mb-2 text-sm font-medium text-gray-900">Nama
                                    Kategori</label>
                                <input type="text" name="editName" id="editName"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="Masukan nama kategori" wire:model="editName">

                                <!-- Display error message for 'name' -->
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <!-- Tombol Simpan -->
                        <div class="flex items-center justify-center">
                            <button wire:loading.remove wire:target='update' type="submit"
                                class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                Simpan
                            </button>
                            <button disabled wire:loading wire:target='update'
                                class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                Menyimpan..
                                <svg class="inline w-5 h-5 text-white animate-spin ml-2"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4">
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


        <script>
            $('#defaultModalButton').on('click', function() {
                const modalElement = document.getElementById('defaultModal');
                if (modalElement) {
                    const modal = new Modal(modalElement);
                    modal.show(); // Membuka modal
                }
                $('#closeModal').on('click', function() {
                    const modalElement = document.getElementById('defaultModal');
                    if (modalElement) {
                        const modal = new Modal(modalElement);
                        modal.hide(); // Menutup modal
                    }

                });
            });
        </script>

        <script>
            window.addEventListener('updatedSuccess', () => {
                const modal = document.getElementById('editModal');
                const modalCloseButton = modal.querySelector('[data-modal-toggle="editModal"]');
                modalCloseButton.click();


            });
        </script>

        <script>
            window.addEventListener('addedSuccess', () => {
                const modal = document.getElementById('defaultModal');
                const modalCloseButton = modal.querySelector('[data-modal-toggle="defaultModal"]');
                modalCloseButton.click();


            });
        </script>

        <script>
            $(document).ready(function() {
                window.addEventListener('addedSuccess', function(event) {
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
                        title: "Kategori Produk berhasil ditambahkan"
                    });
                });
            })
        </script>

        <script>
            $(document).ready(function() {
                window.addEventListener('updatedSuccess', function(event) {
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
                        title: "Kategori Produk berhasil diperbarui"
                    });
                });
            })
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
        </script>

        <script>
            $(document).ready(function() {
                window.addEventListener('categoriesDeleted', function(event) {
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
                        title: "Kategori Produk Telah Dihapus"
                    });
                });
            })
        </script>

        <script>
            window.addEventListener('showEditModal', function() {
                const modal = new Modal(document.getElementById('editModal'));
                modal.show(); // Menampilkan modal saat tombol ditekan
            });
            $('#closeModalEdit').on('click', function() {
                const modal = new Modal(document.getElementById('editModal'));
                modal.hide(); // Menutup modal

            });
        </script>

    </div>
</div>
