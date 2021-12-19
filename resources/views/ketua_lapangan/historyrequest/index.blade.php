@extends('component.app')
@section('content')
<div class="app-main__inner">
    <!-- <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph text-success">
                    </i>
                </div>
                <div>Riwayat Permintaan Suplai Bahan Bangunan
                </div>
            </div>
            <div class="page-title-actions">
            </div>    
        </div>
    </div> -->
    <div class="row m-2 justify-content-center">
        <h5 style="font-weight: bolder">Riwayat Permintaan Bahan Bangunan</h5>
    </div>
    <div class="tab-content" >
        <div class="main-card m-2 p-0 card">
            <div class="card-body">
                <ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                    <li class="nav-item">
                        <a onclick="generateType('all')" role="tab" style="font-size:12; font-weight:bold;" class="nav-link active show" id="tabs-all" data-toggle="tab" href="" aria-selected="true">
                            <span class="nav-text">Semua</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a onclick="generateType('waiting')" role="tab" style="font-size:14; font-weight:bold;" class="nav-link show" id="tab-c1-1" data-toggle="tab" href="#tab-animated1-1" aria-selected="false">
                            <span class="nav-text">Menunggu Konfirmasi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a onclick="generateType('procces')" role="tab" style="font-size:14; font-weight:bold;" class="nav-link show" id="tab-c1-1" data-toggle="tab" href="#tab-animated1-1" aria-selected="false">
                            <span class="nav-text">Diproses</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a onclick="generateType('done')" role="tab" style="font-size:14; font-weight:bold;" class="nav-link show" id="tab-c1-2" data-toggle="tab" href="#tab-animated1-2" aria-selected="false">
                            <span class="nav-text">Selesai</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" id="listData">
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
  @include('ketua_lapangan.historyrequest.modals')
@endsection