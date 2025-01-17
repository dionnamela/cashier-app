<div>
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
                            {{ $category->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $category->updated_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="#"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            <a href="#"
                                onclick="confirm('Apakah Anda yakin ingin menghapus kategori ini?') || event.stopImmediatePropagation()"
                                wire:click="delete({{ $category->id }})"
                                class="ml-3 font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
