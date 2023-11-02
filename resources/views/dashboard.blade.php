<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mt-4 mb-4 p-4 bg-white shadow-md flex items-center justify-between">
                        <a href="{{ route('buku.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tambah Buku</a>
                        <form action="{{ route('buku.search') }}" method="GET" class="flex items-center">
                            @csrf
                            <input type="text" name="kata" class="border rounded-l py-2 px-3 w-full" placeholder="Cari judul atau penulis...">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white rounded-r px-4 py-2">Cari</button>
                        </form>
                    </div>
                    <table class="w-full border-collapse border border-gray-300 bg-white shadow-md">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 border border-gray-300">No.</th>
                                <th class="px-4 py-2 border border-gray-300">Judul Buku</th>
                                <th class="px-4 py-2 border border-gray-300">Penulis</th>
                                <th class="px-4 py-2 border border-gray-300">Harga</th>
                                <th class="px-4 py-2 border border-gray-300">Tgl. Terbit</th>
                                <th class="px-4 py-2 border border-gray-300">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 0;
                            @endphp
                            @foreach ($data_buku as $buku)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover-bg-gray-600">
                                <td class="w-4 p-4">
                                    {{ ++$no }}
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $buku->judul }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $buku->penulis }}
                                </td>
                                <td class="px-6 py-4">
                                    Rp {{ number_format($buku->harga, 2) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $buku->tgl_terbit->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('buku.edit', $buku->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2">Edit</a>
                                    <a href="{{ route('buku.edit', $buku->id) }}" class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav class="flex items-center justify-between pt-4" aria-label="Table navigation">
                        <ul class="inline-flex -space-x-px text-sm h-8">
                            {{ $data_buku->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
