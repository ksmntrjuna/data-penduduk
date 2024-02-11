<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Provinsi</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #f8f9fa;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 10px 15px;
            display: block;
            color: #333;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #e9ecef;
        }

        .content {
            margin-left: 270px;
            /* Lebar sidebar + sedikit jarak */
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h5 class="text-center">Menu</h5>
        <ul class="list-unstyled">
            <li><a href="{{ route('provinces.index') }}">Provinsi</a></li>
            <li><a href="{{ route('districts.index') }}">Kabupaten</a></li>
            <li><a href="{{ route('peoples.index') }}">Penduduk</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="container">
            <h2>Daftar Provinsi</h2>

            <a href="{{ route('provinces.create') }}" class="btn btn-success">Tambah Provinsi</a>

            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Provinsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($provinces as $key => $province)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $province->name }}</td>
                        <td>
                            <a href="{{ route('provinces.edit', $province) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('provinces.destroy', $province) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>