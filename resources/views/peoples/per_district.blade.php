<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jumlah Penduduk per Kabupaten</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Jumlah Penduduk per Kabupaten</h1>

        <form action="{{ route('people.per_district') }}" method="GET" class="mt-3">
            <div class="form-group">
                <label for="province_id">Pilih Provinsi:</label>
                <select name="province_id" id="province_id" class="form-control">
                    <option value="">Semua Provinsi</option>
                    @foreach($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kabupaten</th>
                    <th>Jumlah Penduduk</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peoplePerDistrict as $people)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $people->district->name }}</td>
                    <td>{{ $people->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>