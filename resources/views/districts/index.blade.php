<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kabupaten</title>
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
            <h2>Daftar Kabupaten</h2>

            <div class="row mb-3">
                <div class="col-md-6">
                    <a href="{{ route('districts.create') }}" class="btn btn-success">Tambah Kabupaten</a>
                </div>
                <div class="col-md-6 text-right">
                    <form action="{{ route('districts.index') }}" method="GET" class="form-inline">
                        <div class="form-group">
                            <input type="text" name="search" class="form-control mr-2" placeholder="Cari nama kabupaten...">
                        </div>
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
                </div>
            </div>

            <form action="{{ route('districts.index') }}" method="GET" class="mb-3">
                <div class="form-group">
                    <select name="province_id" class="form-control">
                        <option value="">Semua Provinsi</option>
                        @foreach ($provinces as $province)
                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>


            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kabupaten</th>
                        <th>Provinsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $counter = 1;
                    @endphp
                    @foreach($districts as $district)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $district->name }}</td>
                        <td>{{ $district->province->name }}</td>
                        <td>
                            <a href="{{ route('districts.edit', $district) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('districts.destroy', $district) }}" method="POST" style="display:inline">
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