<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kabupaten</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2>Edit Kabupaten</h2>

        <form action="{{ route('districts.update', $district) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nama Kabupaten:</label>
                <input type="text" name="name" class="form-control" value="{{ $district->name }}" required>
            </div>
            <div class="form-group">
                <label for="province_id">Provinsi:</label>
                <select name="province_id" class="form-control" required>
                    @foreach($provinces as $province)
                    <option value="{{ $province->id }}" {{ $province->id == $district->province_id ? 'selected' : '' }}>
                        {{ $province->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>