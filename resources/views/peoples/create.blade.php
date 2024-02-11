<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penduduk</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2>Tambah Penduduk</h2>

        <form action="{{ route('peoples.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nik">NIK:</label>
                <input type="text" name="nik" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="gender">Jenis Kelamin:</label>
                <select name="gender" class="form-control" required>
                    <option value="male">Laki-laki</option>
                    <option value="female">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="birthdate">Tanggal Lahir:</label>
                <input type="date" name="birthdate" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Alamat:</label>
                <textarea name="address" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="province_id">Provinsi:</label>
                <select name="province_id" id="province_id" class="form-control" required>
                    <option value="">Pilih Provinsi</option>
                    @foreach($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="district_id">Kabupaten:</label>
                <select name="district_id" id="district_id" class="form-control" required>
                    <option value="">Pilih Kabupaten</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
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