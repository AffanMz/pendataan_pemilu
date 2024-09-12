<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Kelurahan</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <x-nav_side>

    </x-nav_side>

    <div class="flex flex-col p-4 pt-20 lg:ml-64">
        <div class="flex flex-col mt-4 rounded-lg dark:border-gray-700">
            <div class="flex w-full justify-between px-4 pb-5 gap-4">
                <h2 class="font-bold text-3xl text-gray-700">Data Kelurahan</h2>

                <!-- Modal toggle -->
                <div class="flex flex-row gap-4 ">
                    <button data-modal-target="default-modal" data-modal-toggle="default-modal" class=" text-white px-4 py-2 bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                    Tambah Data
                    </button>
                    
                </div>
            </div>


            <div class="flex flex-col border p-4 rounded-lg  min-h-[25rem] mb-4 rounde dark:bg-gray-800">
                <form class="w-full flex gap-3 flex-row pb-4">
                    <select id="kecamatan-select" class="bg-gray-50 w-1/3 lg:1/6 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="">Pilih Kecamatan</option>
                        @foreach ($kecamatan as $kec)
                            <option value="{{ $kec->id }}">{{ $kec->name }}</option>
                        @endforeach
                    </select>
                </form>
                @if (session('success'))
                        <div id="alert-3" class="flex items-center p-2 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 me-5 text-sm font-medium">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                        </div>
                    @endif
                <div class="w-full border-t mb-4"></div>
                <h3 class="text-base ml-3 mb-3 dark:text-white">
                    Total data : <span id="banyak" class="font-semibold text-gray-600 dark:text-white">{{ count($kelurahan) }} Kelurahan/Desa</span>
                </h3>
                <div class="w-full rounded-lg overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-blue-300 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Kelurahan/Desa
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $kelurahan as $kel )
                                <tr class="bg-blue-100 border-b dark:bg-gray-800 dark:border-gray-700 font-semibold hover:bg-blue-200 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $kel->name }}
                                    </td>
                                    <td>
                                        <button   button data-modal-target="editModal-{{ $kel->id }}" data-modal-toggle="editModal-{{ $kel->id }}" class="font-medium mr-1 p-2 bg-blue-500 rounded-lg hover:bg-blue-600 text-white">Edit</button>
                                        
                                        <form action="{{ route('kelurahan.destroy', $kel->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium p-2 bg-red-500 rounded-lg hover:bg-red-600 text-white" onclick="return confirm('Are you sure you want to delete this item?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($kelurahan as $kel)
        <div id="editModal-{{ $kel->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Edit {{ $kel->name }}
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editModal-{{ $kel->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <form action="{{ route('kelurahan.update', $kel->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="kec" value="{{ $kel->id_kecamatan }}">
                            <div class="relative z-0 w-full mb-3 group">
                                <input type="text" name="name" value="{{ $kel->name }}" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukan Nama Kelurahan" required />
                            </div>
                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                                <button data-modal-hide="editModal-{{ $kel->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Tambah Data
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form action="{{ route('kelurahan.store') }}" method="POST">
                        @csrf
                        <div class="relative z-0 w-full mb-3 group">
                            <select id="kec" name="kec" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Pilih Kecamatan</option>
                                @foreach ($kecamatan as $kec)
                                    <option value="{{ $kec->id }}">{{ $kec->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="relative z-0 w-full mb-3 group">
                            <input type="text" name="name" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukan Nama Kelurahan" required />
                        </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="default-modal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</button>
                    </form>
                    <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#kecamatan-select').on('change', function() {
            var kecamatanID = $(this).val();
            console.log(kecamatanID);
            
            if (kecamatanID) {
                // Jika ada kecamatan yang dipilih, tampilkan data berdasarkan kecamatan
                $.ajax({
                    url: '/kelurahan/kecamatan/' + kecamatanID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('tbody').empty(); // Kosongkan tabel sebelum menampilkan data baru
                        var totalDesa = 0;
                        $.each(data, function(key, kelurahan) {
                            totalDesa++;
                            $('tbody').append('<tr class="bg-blue-100 border-b dark:bg-gray-800 dark:border-gray-700 font-semibold hover:bg-blue-200 dark:hover:bg-gray-600">' +
                                '<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + (key + 1) + '</th>' +
                                '<td class="px-6 py-4">' + kelurahan.name + '</td>' +
                                '<td class="px-6 py-4">' +
                                            '<button data-modal-target="editModal-' + kelurahan.id + '" data-modal-toggle="editModal-' + kelurahan.id + '" class="font-medium mr-2 p-2 bg-blue-500 rounded-lg hover:bg-blue-600 text-white">Edit</button>' +
                                            
                                            '<form action="/kelurahan/destroy/' + kelurahan.id + '" method="POST" style="display:inline-block;">' +
                                                '@csrf' +
                                                '@method("DELETE")' +
                                                '<button type="submit" class="font-medium p-2 bg-red-500 rounded-lg hover:bg-red-600 text-white" onclick="return confirm(\'Are you sure you want to delete this item?\')">Hapus</button>' +
                                            '</form>' +
                                        '</td>' +
                                '</tr>');
                        });
                        document.querySelectorAll('[data-modal-toggle]').forEach(function(modalToggleEl) {
                            const modalTargetEl = document.getElementById(modalToggleEl.getAttribute('data-modal-target'));

                            if (modalTargetEl) {
                                modalToggleEl.addEventListener('click', function() {
                                    const modal = new Modal(modalTargetEl);
                                    modal.show();

                                    // Tambahkan event listener untuk tombol "X" dan "Cancel"
                                    modalTargetEl.querySelectorAll('[data-modal-hide]').forEach(function(closeButtonEl) {
                                        closeButtonEl.addEventListener('click', function() {
                                            modal.hide();
                                        });
                                    });
                                });
                            }
                        });
                        $('#banyak').text(totalDesa + ' Kelurahan/Desa');
                    }
                });
            } else {
                // Jika opsi "Pilih Kecamatan" dipilih, tampilkan semua data kelurahan
                $.ajax({
                    url: '/kelurahan/all', // Route untuk mengambil semua data kelurahan
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('tbody').empty(); // Kosongkan tabel sebelum menampilkan semua data
                        var totalDesa = 0;
                        $.each(data, function(key, kelurahan) {
                            totalDesa++;
                            $('tbody').append('<tr class="bg-blue-100 border-b dark:bg-gray-800 dark:border-gray-700 font-semibold hover:bg-blue-200 dark:hover:bg-gray-600">' +
                                '<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' + (key + 1) + '</th>' +
                                '<td class="px-6 py-4">' + kelurahan.name + '</td>' +
                                '<td class="px-6 py-4">' +
                                            '<button data-modal-target="editModal-' + kelurahan.id + '" data-modal-toggle="editModal-' + kelurahan.id + '" class="font-medium mr-2 p-2 bg-blue-500 rounded-lg hover:bg-blue-600 text-white">Edit</button>' +
                                            
                                            '<form action="/kelurahan/destroy/' + kelurahan.id + '" method="POST" style="display:inline-block;">' +
                                                '@csrf' +
                                                '@method("DELETE")' +
                                                '<button type="submit" class="font-medium p-2 bg-red-500 rounded-lg hover:bg-red-600 text-white" onclick="return confirm(\'Are you sure you want to delete this item?\')">Hapus</button>' +
                                            '</form>' +
                                        '</td>' +
                                '</tr>');
                        });
                        document.querySelectorAll('[data-modal-toggle]').forEach(function(modalToggleEl) {
                            const modalTargetEl = document.getElementById(modalToggleEl.getAttribute('data-modal-target'));

                            if (modalTargetEl) {
                                modalToggleEl.addEventListener('click', function() {
                                    const modal = new Modal(modalTargetEl);
                                    modal.show();

                                    // Tambahkan event listener untuk tombol "X" dan "Cancel"
                                    modalTargetEl.querySelectorAll('[data-modal-hide]').forEach(function(closeButtonEl) {
                                        closeButtonEl.addEventListener('click', function() {
                                            modal.hide();
                                        });
                                    });
                                });
                            }
                        });
                        $('#banyak').text(totalDesa + ' Kelurahan/Desa');
                    }
                });
            }
        });
    });
</script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

</html>