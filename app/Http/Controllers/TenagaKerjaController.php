<?php

namespace App\Http\Controllers;

use App\Models\TenagaKerja;
use Illuminate\Http\Request;
use App\Models\User;
use Response;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Validator;

class TenagaKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return response()->json($data);
        $data = TenagaKerja::where('deleted', 0)->get();
        if ($request->ajax()) {
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function($row)
            {
                $btn = '<button class="mb-2 mr-2 btn btn-sm btn-warning btnEdit" data-id="'.$row->id.'" type="button" data-toggle="tooltip" title="Edit" data-placement="bottom"><i class="pe-7s-pen"></i></button>';
                $btn .= '<button class="mb-2 mr-2 btn btn-sm btn-danger btnHapus" data-id="'.$row->id.'" type="button" data-toggle="tooltip" title="Hapus" data-placement="bottom"><i class="pe-7s-trash"></button>';                
                return $btn ;
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        // return view('logistik.barang.index');
        return view('hr.tenagakerja.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return Response::json(['data' => $request->all()]);
        $tenagaKerja = new TenagaKerja;
        $tenagaKerja->name = $request->name;
        $tenagaKerja->phone = $request->phone;
        $tenagaKerja->address = $request->address;
        $tenagaKerja->placement = $request->placement;
        $tenagaKerja->position = $request->role;
        $tenagaKerja->description = $request->description == NULL ? "-" : $request->description;
        $tenagaKerja->deleted = 0;

        $tenagaKerja->save();
        $id_tenagakerja = $tenagaKerja->id;

        if ($request->role === "Ketua Lapangan") {
            // return Response::json(['data' => $request->all()]);
            $user = new User;
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->username);
            $user->save();
            $id = $user->id;
            $id_user = TenagaKerja::find($id_tenagakerja);
            $id_user->id_user = $id;
            $id_user->save();
        }

        return Response::json(['success' => 'Data berhasil di inputkan']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TenagaKerja  $tenagaKerja
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tenagaKerja = TenagaKerja::find($id);

        return Response::json($tenagaKerja);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TenagaKerja  $tenagaKerja
     * @return \Illuminate\Http\Response
     */
    public function edit(TenagaKerja $tenagaKerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TenagaKerja  $tenagaKerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $tenagaKerja = TenagaKerja::find($id);
        $tenagaKerja->name = $request->name;
        $tenagaKerja->phone = $request->phone;
        $tenagaKerja->address = $request->address;
        $placementOld = $tenagaKerja->placement;
        $positionOld = $tenagaKerja->position;
        $descOld = $tenagaKerja->description;
        if ($tenagaKerja->placement != $request->placement_edit && $request->placement_edit != NULL  && $request->role != NULL) {
            // return response()->json([$tenagaKerja->placement, $tenagaKerja->position, $request->placement_edit]);
            $tenagaKerja->placement = $request->placement_edit == $placementOld ? $placementOld : $request->placement_edit;
            $tenagaKerja->position = $request->role == $positionOld ? $positionOld : $request->role;
            $tenagaKerja->description = "-";
        }elseif ($placementOld == "Pegawai Lapangan" && $tenagaKerja->placement == $request->placement_edit) {
            $tenagaKerja->position = $request->role;
            $tenagaKerja->description = $descOld != $request->description ? $request->description : $descOld;
        }
        // return response()->json(['id' => $tenagaKerja] );
        
        $tenagaKerja->save();
        $id_tenagakerja = $tenagaKerja->id;
            if ($request->placement_edit == "Staff" && $placementOld != $request->placement_edit ) {
                $user = new User;
                $user->name = $request->name;
                $user->username = $request->username;
                $user->email = $request->email;
                $user->password = Hash::make($request->username);
                $user->save();
                $id = $user->id;
                $id_user = TenagaKerja::find($id_tenagakerja);
                $id_user->id_user = $id;
                $id_user->save();
            }


        return Response::json([
            'success' => 'Data berhasil di ubah',
            'desc_edit' => $request->description,
            'desc' => $tenagaKerja->description,
            'descOld' => $descOld,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TenagaKerja  $tenagaKerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $tenagaKerja = TenagaKerja::find($id);
        $tenagaKerja->deleted = 1;
        $tenagaKerja->save();

        return Response::json(['success' => 'Data berhasil dihapus']);
    }
}
