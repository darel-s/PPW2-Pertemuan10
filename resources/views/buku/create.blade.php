<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Buku</title>
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-4">Tambah Buku</h2>
        <form action="{{ route('buku.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="judul" class="block text-gray-600">Judul Buku</label>
                <input type="text" id="judul" name="judul" class="border border-gray-300 rounded px-3 py-2 w-full">
            </div>
            <div class="mb-4">
                <label for="penulis" class="block text-gray-600">Penulis</label>
                <input type="text" id="penulis" name="penulis" class="border border-gray-300 rounded px-3 py-2 w-full">
            </div>
            <div class="mb-4">
                <label for="harga" class="block text-gray-600">Harga</label>
                <input type="text" id="harga" name="harga" class="border border-gray-300 rounded px-3 py-2 w-full">
            </div>
            <div class="mb-4">
                <label for="tgl_terbit" class="block text-gray-600">Tanggal Terbit</label>
                <div class='input-group date' id='datetimepicker'>
                    <input type='text' id="tgl_terbit" name="tgl_terbit" class="form-control" placeholder="yyyy/mm/dd" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                <a href="/buku" class="text-gray-600 ml-2">Batal</a>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $(function() {
           $('#datetimepicker').datetimepicker();
        });
    </script>
</body>
</html>
