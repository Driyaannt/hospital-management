<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BedModel;
use Illuminate\Validation\Rule;

class BedController extends Controller
{
    public function index()
    {
        $beds = BedModel::all();

        $category_bed = BedModel::selectRaw('
            category,
            COUNT(*) as total_beds,
            SUM(CASE WHEN status = "Available" THEN 1 ELSE 0 END) as available_beds,
            SUM(CASE WHEN status != "Available" THEN 1 ELSE 0 END) as occupied_beds
        ')
            ->groupBy('category')
            ->get();

        return view('layouts.master-data.data-bed.data-bed', compact('beds', 'category_bed'));
    }


    // Menampilkan form create atau update
    public function create($id = null)
    {
        $bed = null;
        if ($id) {
            $bed = BedModel::find($id); // Ambil data bed jika ada ID
        }
        return view('layouts.master-data.data-bed.action-bed', compact('bed'));
    }

    // Menyimpan data (create atau update)
    public function store(Request $request, $id = null)
    {
        $request->validate([
            'category' => 'required|string|in:Regular,VIP,VVIP',
            'bed_number' => [
                'required',
                Rule::unique('m_beds')->where(function ($query) use ($request) {
                    return $query->where('category', $request->category);
                })
            ],
            'status' => 'required|string|in:Available,Occupied'
        ]);

        // Data yang akan disimpan
        $data = [
            'category' => $request->category,
            'bed_number' => $request->bed_number,
            'status' => $request->status,
        ];

        // Jika ada ID, update data. Jika tidak, buat data baru
        if ($id) {
            BedModel::find($id)->update($data);
            $message = 'Bed updated successfully.';
        } else {
            BedModel::create($data);
            $message = 'Bed created successfully.';
        }

        return redirect('/bed')->with('success', $message);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string|in:Regular,VIP,VVIP',
            'bed_number' => [
                'required',
                Rule::unique('m_beds')->ignore($id)->where(function ($query) use ($request) {
                    return $query->where('category', $request->category);
                })
            ],
            'status' => 'required|string|in:Available,Occupied'
        ]);

        // Cek apakah data ditemukan
        $bed = BedModel::findOrFail($id);

        // Update data ke database
        $bed->update([
            'category' => $request->category,
            'bed_number' => $request->bed_number,
            'status' => $request->status,
        ]);

        return redirect('/bed')->with('success', 'Bed updated successfully.');
    }

    public function destroy($id)
    {
        $bed = BedModel::findOrFail($id); // Cari bed berdasarkan ID
        $bed->delete(); // Hapus bed

        return redirect()->route('v-data-bed')->with('success', 'Bed deleted successfully.');
    }

    
}
