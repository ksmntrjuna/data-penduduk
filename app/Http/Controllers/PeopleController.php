<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\PeopleExport;
// use Maatwebsite\Excel\Facades\Excel;



class PeopleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $province_id = $request->input('province_id');
        $district_id = $request->input('district_id');

        $query = People::with('district');

        if (!empty($search)) {
            $query->where('name', 'LIKE', "%$search%")
            ->orWhere('nik', 'LIKE', "%$search%");
        }

        if (!empty($province_id)) {
            $query->whereHas('district', function ($q) use ($province_id) {
                $q->where('province_id', $province_id);
            });
        }

        if (!empty($district_id)) {
            $query->where('district_id', $district_id);
        }

        $peoples = $query->paginate(10);

        // Mengambil daftar provinsi untuk dikirim ke tampilan
        $provinces = Province::all();

        // Mengambil daftar kabupaten untuk dikirim ke tampilan
        $districts = District::all();

        return view('peoples.index', compact('peoples', 'provinces', 'districts'));
    }


    public function create()
    {
        $provinces = Province::all();
        // Ubah bagian ini agar hanya mengambil kabupaten dari provinsi pertama secara default
        $districts = District::where('province_id', $provinces->first()->id)->get();

        return view('peoples.create', compact('districts', 'provinces'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:18|unique:people',
            'gender' => 'required|in:male,female',
            'birthdate' => 'required|date',
            'address' => 'required|string',
            'district_id' => 'required|exists:districts,id',
        ]);

        People::create($request->all());

        return redirect()->route('peoples.index')->with('success', 'Data penduduk berhasil ditambahkan');
    }

    public function edit(People $people)
    {
        $peoples = People::find($people);
        $provinces = Province::all();
        $districts = District::where('province_id', $provinces->first()->id)->get();

        return view('peoples.edit', compact('people', 'districts', 'provinces'));
    }

    public function update(Request $request, People $people)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:18|unique:people,nik,' . $people->id,
            'gender' => 'required|in:male,female',
            'birthdate' => 'required|date',
            'address' => 'required|string',
            'district_id' => 'required|exists:districts,id',
        ]);

        $people->update($request->all());

        return redirect()->route('peoples.index')->with('success', 'Data penduduk berhasil diperbarui');
    }

    public function destroy(People $people)
    {
        $people->delete();

        return redirect()->route('peoples.index')->with('success', 'Data penduduk berhasil dihapus');
    }

    public function getDistricts($province_id)
    {
        $districts = District::where('province_id', $province_id)->pluck('name', 'id');
        return response()->json($districts);
    }

    // Metode untuk mencetak HTML jumlah penduduk per provinsi
    public function peoplePerProvince()
    {
        $peoplePerProvince = People::select('province_id', \DB::raw('count(*) as total'))
            ->groupBy('province_id')
            ->get();

        return view('peoples.per_province', compact('peoplePerProvince'));
    }

    // Metode untuk mencetak HTML jumlah penduduk per kabupaten
    public function peoplePerDistrict(Request $request)
    {
        $province_id = $request->input('province_id');

        $query = People::select('district_id', \DB::raw('count(*) as total'));

        if ($province_id) {
            $query->whereHas('district', function ($q) use ($province_id) {
                $q->where('province_id', $province_id);
            });
        }

        $peoplePerDistrict = $query->groupBy('district_id')->get();

        $provinces = Province::all();

        return view('peoples.per_district', compact('peoplePerDistrict', 'provinces'));
    }

    // Metode untuk mengekspor data penduduk ke Excel
    public function export(Request $request)
    {
        $province_id = $request->input('province_id');
        $district_id = $request->input('district_id');

        // Query based on the selected province and district
        $query = People::query();

        if ($province_id) {
            $query->whereHas('district', function ($q) use ($province_id) {
                $q->where('province_id', $province_id);
            });
        }

        if ($district_id) {
            $query->where('district_id', $district_id);
        }

        // Get the filtered people data
        $people = $query->get();

        // Prepare data for the Excel file
        $exportData = [];

        // Header for the Excel file
        $exportData[] = ['Nama', 'NIK', 'Tanggal Lahir', 'Alamat', 'Jenis Kelamin', 'Provinsi', 'Kabupaten'];

        // Loop through each selected person
        foreach ($people as $person) {
            $exportData[] = [
                $person->name,
                $person->nik,
                $person->birthdate,
                $person->address,
                ucfirst($person->gender),
                $person->district->province->name,
                $person->district->name
            ];
        }

        // Use the Excel library to create an Excel file with the prepared data
        return Excel::download(new PeopleExport($exportData), 'people.xlsx');
    }
}
