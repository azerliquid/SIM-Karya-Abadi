<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Response;
use Yajra\DataTables\DataTables;
use Validator;
use App\Models\TenagaKerja;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        
        $data = Project::with('headProject')->where('status', 'Aktif')
        ->where('deleted', 0)->get();
        // return Response::json($data);

        if($request->ajax()) {
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
        return view('hr.proyek.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $ketuaLapangan = TenagaKerja::select('id','name')->where('position', "Ketua Lapangan")
            ->where('deleted', 0)->get();
    
            return response()->json($ketuaLapangan);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name_project' => 'required',
            'location' => 'required',
        ];

        $messages = [
            'name_project.required' => 'Nama proyek wajib di isi',
            'location.required' => 'Lokasi wajib di isi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $proyek = new Project;
            $proyek->name_project = $request->name_project;
            $proyek->location = $request->location;
            $proyek->head_project = $request->ketua;
            $proyek->deleted = 0;
            $proyek->save();

            return Response::json([
                'title' => 'Berhasil',
                'text' => 'Data berhasil di inputkan',
                'icon' => 'success'
                ]);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name_project' => 'required',
            'location' => 'required',
        ];

        $messages = [
            'name_project.required' => 'Nama proyek wajib di isi',
            'location.required' => 'Lokasi wajib di isi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $proyek = Project::find($id);

            $proyek->name_project = $request->name_project;
            $proyek->location = $request->location;
            $proyek->save();

            return Response::json([
                'title' => 'Berhasil',
                'text' => 'Data berhasil di ubah',
                'icon' => 'success'
                ]); 
        }

        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $proyek = Project::find($id);
        $proyek->deleted = 1;
        $proyek->save();

        return Response::json([
            'title' => 'Berhasil',
            'text' => 'Data berhasil di hapus',
            'icon' => 'success'
            ]);
    }    
    
    public function showketua(Request $request)
    {
        if ($request->ajax()) {
            $ketuaLapangan = TenagaKerja::where('position', "Ketua Lapangan")
            ->where('deleted', 0)->get();
    
            return response()->json("wiu");
        }
    }
}
