<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penduduk</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2>Edit Penduduk</h2>

        <form action="{{ route('peoples.update', $people) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" name="name" class="form-control" value="{{ $people->name }}" required>
            </div>
            <div class="form-group">
                <label for="nik">NIK:</label>
                <input type="text" name="nik" class="form-control" value="{{ $people->nik }}" required>
            </div>
            <div class="form-group">
                <label for="gender">Jenis Kelamin:</label>
                <select name="gender" class="form-control" required>
                    <option value="male" {{ $people->gender == 'male' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="female" {{ $people->gender == 'female' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="birthdate">Tanggal Lahir:</label>
                <input type="date" name="birthdate" class="form-control" value="{{ $people->birthdate }}" required>
            </div>
            <div class="form-group">
                <label for="address">Alamat:</label>
                <textarea name="address" class="form-control" required>{{ $people->address }}</textarea>
            </div>
            <div class="form-group">
                <label for="province_id">Provinsi:</label>
                <select name="province_id" class="form-control" required>
                    @foreach($provinces as $province)
                    <option value="{{ $province->id }}" {{ $province->id == $people->district->province_id ? 'selected' : '' }}>
                        {{ $province->name }}
                    </option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group">
                <label for="district_id">Kabupaten:</label>
                <select name="district_id" class="form-control" required>
                    @foreach($districts as $district)
                    <option value="{{ $district->id }}" {{ $district->id == $people->district_id ? 'selected' : '' }}>
                        {{ $district->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- Ajax Script -->
    <script>
        $(document).ready(function() {
            $('#province_id').change(function() {
                var provinceId = $(this).val();
                if (provinceId) {
                    $.ajax({
                        url: '/get-districts/' + provinceId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#district_id').empty();
                            $.each(data, function(key, value) {
                                $('#district_id').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    $('#district_id').empty();
                }
            });
        });
    </script>
</body>

</html>