<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Response;
use Yajra\DataTables\DataTables;
use Validator;
use App\Models\TenagaKerja;
use App\Models\BarangInOut;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

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
        
        if($request->ajax()) {
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function($row)
            {
                if (Auth::user()->role == 'hr') {
                    $btn = '<a href="/proyek/show/'.$row->id.'" class="mb-2 mr-2 btn btn-sm btn-info btnDetail" data-id="'.$row->id.'" type="button" data-toggle="tooltip" title="Detail" data-placement="bottom"><i class="pe-7s-info"></i></a>';
                    $btn .= '<button class="mb-2 mr-2 btn btn-sm btn-warning btnEdit" data-id="'.$row->id.'" type="button" data-toggle="tooltip" title="Edit" data-placement="bottom"><i class="pe-7s-pen"></i></button>';
                    $btn .= '<button class="mb-2 mr-2 btn btn-sm btn-danger btnHapus" data-id="'.$row->id.'" type="button" data-toggle="tooltip" title="Hapus" data-placement="bottom"><i class="pe-7s-trash"></i></button>';
                }else {
                    $btn = '<a href="'. (Auth::user()->role == 'logistic' ? '/logistik' : '/admin').'/proyek/show/'.$row->id.'" class="mb-2 mr-2 btn btn-sm btn-info btnDetail" data-id="'.$row->id.'" type="button" data-toggle="tooltip" title="Detail" data-placement="bottom"><i class="pe-7s-info"></i></a>';
                }
                return $btn ;
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        if (Auth::user()->role == 'admin') {
            return view('admin.hr.proyek.index');
        }
        if (Auth::user()->role == 'hr') {
            return view('hr.proyek.index');
        }
        if (Auth::user()->role == 'logistic') {
            return view('logistik.proyek.index');
        }
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
    public function show($id)
    { 
        $now = Carbon::now();
        // $start = Carbon::now()->subDays(3)->isoFormat('MM/DD/YYYY');
        $start = $now->startOfWeek(Carbon::FRIDAY)->isoFormat('MM/DD/YYYY');
        $end = $now->endOfWeek(Carbon::THURSDAY)->isoFormat('MM/DD/YYYY');
        $project = Project::with('headProject')->select('id', 'head_project', 'name_project', 'location')->get()->find($id);
        if (Auth::user()->role == 'hr') {
            return view('hr.proyek.detail', compact('project', 'start', 'end')); 
        }
        if (Auth::user()->role == 'logistic') {
            return view('logistik.proyek.detail', compact('project', 'start', 'end')); 
        }
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

    public function detail($id, $start, $end)
    {
        $newEnd = Carbon::parse($end);
        $newStart = Carbon::parse($start);

        // return Response::json($endO);
        
        $data = $this->setDetailByDate($id, $newStart, $newEnd);

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('date', function($row)
            {
                $date = Carbon::parse($row->date)->isoFormat('dddd, D-MM-Y');
                return $date;
            })
            ->addColumn('barang', function($row)
            {
                $brg = $row->barang->name;
                return $brg;
            })
            ->addColumn('total', function($row)
            {
                $ttl = $row->qty * $row->price;
                return $ttl;
            })
            ->rawColumns(['date','barang', 'total'])
            ->make(true);
    }

    public function setDetailByDate($id, $start, $end)
    {
        $data = BarangInOut::with('barangforPro')
        ->where('type', 'Keluar')->where('id_destination', $id)
        ->whereDate('date', '>=', $start)
        ->whereDate('date', '<=', $end)
        ->select('id', 'date', 'id_destination', 'id_barang', 'qty', 'price')
        ->orderBy('date', 'DESC')
        ->get();

        return $data;
    }

    public function sumBarang($id, $start, $end)
    {
        $newEnd = Carbon::parse($end);
        $newStart = Carbon::parse($start);

        // return Response::json($endO);
        
        $data = $this->setSumBarang($id, $newStart, $newEnd);

        $barang = BarangInOut::where('type', 'Keluar')
        ->where('id_destination', $id)
        ->whereDate('date', '>=', $newStart)
        ->whereDate('date', '<=', $newEnd)
        ->sum(DB::raw("qty*price"));

        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('barang', function($row)
        {
            $brg = $row->barang->name;
            return $brg;
        })
        ->with([
            'sumPemakaian' => $barang,
        ])
        ->rawColumns(['barang'])
        ->make(true);
    }

    public function setSumBarang($id, $start, $end)
    {
        $barang = BarangInOut::with('barangforPro')
        ->where('type', 'Keluar')->where('id_destination', $id)
        ->whereDate('date', '>=', $start)
        ->whereDate('date', '<=', $end)
        ->select(DB::raw("id_barang, SUM(qty) as total, SUM(qty*price) as pemakaian"))
        ->groupBy('id_barang')
        ->orderBy('total', 'DESC')
        ->get();

        return $barang;
    }

}
