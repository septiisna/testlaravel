<?php

namespace App\Http\Controllers;

use App\Models\Companies;

use Illuminate\Http\Request;
// use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CompaniesImport;

class CompaniesController extends Controller
{
    public function index()
    {
        $data = Companies::paginate(5);
        return view('companies', compact('data'));
    }

    public function tambahcompany()
    {
        return view('addcompanies');
    }

    public function insertcompany(Request $request)
    {
        // dd($request->all());

        $data = Companies::create($request->all());
        if ($this->validate(
            $request,
            [
                'logo' => 'mimes:png |max:2048',
            ],
            $messages = [
                'required' => 'The :attribute field is required.',
                'mimes' => 'Only png are allowed.'
            ]
        )) {
            return redirect()->back()->withErrors($messages);
        }

        if ($request->hasFile('logo')) {
            $request->file('logo')->move('storage/app/company/', $request->file('logo')->getClientOriginalName());
            $data->logo = $request->file('logo')->getClientOriginalName();
            $data->save();
        }

        return redirect()->route('companylist')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function tampilcompany($id)
    {
        $data = Companies::find($id);
        // dd($data);
        return view('tampilcompanies', compact('data'));
    }

    public function updatecompany(Request $request, $id)
    {
        // dd($request->all());
        $data = Companies::find($id);
        $data->update($request->all());
        return redirect()->route('companylist')->with('success', 'Data Berhasil Diupdate');
    }

    public function deletecompany($id)
    {
        $data = Companies::find($id);
        $data->delete();
        return redirect()->route('companylist')->with('success', 'Data Berhasil Dihapus');
    }

    public function exportcompany()
    {
        $data = Companies::all();
        view()->share('data', $data);
        $pdf = PDF::loadView('datacompany-pdf');
        return $pdf->download('datacompany.pdf');
    }

    public function importcompany(Request $request)
    {
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('storage/app/company/', $namafile);

        Excel::import(new CompaniesImport, public_path('/storage/app/company/' . $namafile));

        return \redirect()->back();
    }
}