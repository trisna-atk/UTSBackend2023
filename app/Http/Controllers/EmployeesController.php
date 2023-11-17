<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        //mendapatkan semua data pegawai
        $employees = Employees::all();

        //jika data kosong maka kirim status code 204
        if($employees->isEmpty()){
            $data = [
                "messege => Resource is empty"
            ];

            return response()->json($data, 204);
        }

        $data = [
            "messege" => "Get all resources", 
            "data" => $employees
        ];

        //kirim data dan response 
        return response()->json($data, 200); 
    }

    public function show($id){
         $employees = Employees::find($id);
        
         if (!$employees) {
             $data = [
                 "message" => "Resource not found"
             ];
         
             return response()->json($data, 404);
         }
       
             $data = [
             "message" => "Show detail resoucre",
             "data" => $employees
         ];
 
         // mengembalikan data dan status code 200
         return response()->json($data, 200);
         }

    public function store (Request $request) 
    {
        $request->validate([
            'name' => "required",
            'gender' => "required",
            'phone' => "required", 
            'address' => "required",
            'email' => "required|email",
            'status' => "required",
            'hired_on' => "required" 
        ]);

        $input = [
            'name' => $request->name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'status' => $request->status,
            'hired_on' => $request->hired_on
        ];
        
        $employees = Employees::create($input);

        $data = [
            'message' => 'Employees is created succesfully',
            'data' => $employees,
        ];

        // kirim data(json) dan response code 200 jika berhasil
        return response()->json($data, 201);
    }


    public function update($id, Request $request)
    {
        $employees = Employee::find($id);


        $employees->update = ([
            "name" => $request->name ?? $employees->name, 
            "gender" => $request->gender ?? $employees->gender, 
            "phone" => $request->phone ?? $employees->phone, 
            "address" => $request->address ?? $employees->address, 
            "email" => $request->email ?? $employees->email, 
            "status" => $request->status ?? $employees->status
        ]);

        $data = [
            "messege" => "Employees is update succesfully",
            "data" => $employees
        ];

        return response()->json($data, 200); 
    }

    public function destroy($id) {
        $employees = Employe::find($id);

        if (!$employees) {
            $data = [
                "message" => "Resource not found"
            ];
        
            return response()->json($data, 404);
        }
        
            $employees->delete();
        
         $data = [
            'message' => 'Employees is delete succesfully',
            'data' => $employees,
        ];
           
            return response()->json($data, 200);
    }

    public function search(Request $request){
        $request->validate([
            'name' => 'required|string',
        ]);

        $employees = employes::where('name', 'like', '%' . $request->input('name') . '%')->get();

        if ($employees->isEmpty()){
            $data = [
                'messege' => 'Tidak ada Pegawai tang ditemukan dengan nama tersebut', 
            ];

            return response()->json($data, 404);
        }

        $data = [
            'messege' => 'Search Employes by Name', 
            'data' => $employees, 
        ];

        return response()->json($data, 200);
    }

    public function active() {
        // mencari data employees dengan status active
        $activeEmployees = Employees::where('status', 'active')->get();
    
        // mendapatkan jumlah total active employees
        $totalActiveEmployees = $activeEmployees->count();
        
        // jika data berhasil ditemukan akan memumculkan pesan
        $data = [
            "message" => "Get active resource",
            "total" => $totalActiveEmployees,
            "data" => $activeEmployees
        ];
    
        // kirim data(json) dan response code 200 jika berhasil
        return response()->json($data, 200);
    }

    public function inactive() {
        // mencari data employees dengan status active
        $inactiveEmployees = Employees::where('status', 'inactive')->get();
    
        // mendapatkan jumlah total inactive employees
        $totalInactiveEmployees = $inactiveEmployees->count();
        
         // jika data berhasil ditemukan akan memumculkan pesan
        $data = [
            "message" => "Get inactive resource",
            "total" => $totalInactiveEmployees,
            "data" => $inactiveEmployees
        ];
    
        // kirim data(json) dan response code 200 jika berhasil
        return response()->json($data, 200);
    }

    public function terminated() {
        // mencari data employees dengan status terminated
        $terminatedEmployees = Employees::where('status', 'terminated')->get();
    
        // mendapatkan jumlah total terminated employees
        $totalTerminatedEmployees = $terminatedEmployees->count();
        
        // jika data berhasil ditemukan akan memumculkan pesan
        $data = [
            "message" => "Get terminated resource",
            "total" => $totalTerminatedEmployees,
            "data" => $terminatedEmployees
        ];
    
        // kirim data(json) dan response code 200 jika berhasil
        return response()->json($data, 200);
    }
}
