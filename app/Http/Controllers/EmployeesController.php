<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Companies;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeesImport;

class EmployeesController extends Controller
{
    public function index()
    {

        $data = Employees::with('company')->paginate(5);
        return view('employees', compact('data'));
    }

    public function tambahemployees()
    {
        $data = Companies::all();
        return view('addemployees', compact('data'));
    }

    public function insertemployees(Request $request)
    {
        // dd($request->all());

        // Employees::create($request->all());
        Employees::create([
            'nama' => $request->nama,
            'company' => $request->company,
            'email' => $request->email,
        ]);


        return redirect()->route('employeeslist')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function tampilemployees($id)
    {
        $data = Employees::find($id);
        $datac = Companies::all();
        return view('tampilemployees', compact('data', 'datac'));
    }

    public function updateemployees(Request $request, $id)
    {
        // dd($request->all());
        $data = Employees::find($id);
        $data->update($request->all());
        return redirect()->route('employeeslist')->with('success', 'Data Berhasil Diupdate');
    }

    public function deleteemployees($id)
    {
        $data = Employees::find($id);
        $data->delete();
        return redirect()->route('employeeslist')->with('success', 'Data Berhasil Dihapus');
    }

    public function exportemployees()
    {
        $data = Employees::all();
        view()->share('data', $data);
        $pdf = PDF::loadView('dataemployees-pdf');
        return $pdf->download('dataemployees.pdf');
    }

    public function importemployees(Request $request)
    {
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('storage/app/employees/', $namafile);

        Excel::import(new EmployeesImport, public_path('/storage/app/employees/' . $namafile));

        return \redirect()->back();
    }
}