<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jumlah Penduduk per Provinsi</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Jumlah Penduduk per Provinsi</h1>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Provinsi</th>
                    <th>Jumlah Penduduk</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peoplePerProvince as $people)
                <tr>
                    <td>{{ $loop->iteration }}</td>     
                    <td>
                        @php
                        $provinceName = App\Models\Province::find($people->province_id)->name;
                        @endphp
                        {{ $provinceName }}
                    </td>
                    <td>{{ $people->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>