<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penduduk</title>
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
            <h2>Daftar Penduduk</h2>

            <div class="mb-3">
                <a href="{{ route('peoples.create') }}" class="btn btn-success">Tambah Data</a>
                <a href="{{ route('people.per_province') }}" class="btn btn-primary">Print per Provinsi</a>
                <a href="{{ route('people.per_district') }}" class="btn btn-primary">Print per Kabupaten</a>
                <a href="{{ route('people.export') }}" class="btn btn-primary">Export Excel</a>
            </div>

            <form action="{{ route('peoples.index') }}" method="GET" class="mt-3">
                <input type="text" name="search" placeholder="Cari berdasarkan Nama atau NIK">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>

            <form action="{{ route('peoples.index') }}" method="GET" class="mb-3">
                <div class="form-row">
                    <div class="col-md-4">
                        <select name="province_id" class="form-control">
                            <option value="">Pilih Provinsi</option>
                            @foreach ($provinces as $province)
                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="district_id" class="form-control">
                            <option value="">Pilih Kabupaten</option>
                            @foreach ($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>


            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peoples as $people)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('peoples.edit', $people) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('peoples.destroy', $people) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                        <td>{{ $people->name }}</td>
                        <td>{{ $people->nik }}</td>
                        <td>{{ $people->birthdate }}</td>
                        <td>{{ $people->address }}, {{ $people->district->name }}, {{ $people->district->province->name }}</td>
                        <td>{{ ucfirst($people->gender) }}</td>
                        <td>{{ $people->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $peoples->links() }}
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>