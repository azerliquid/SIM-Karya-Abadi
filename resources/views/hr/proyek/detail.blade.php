@extends('component.app')
@section('content')
<div class="app-main__inner">
    <div class="row">
        <div class="col-md-5">
            <div class="page-title-heading">
                <div>
                    <h2>{{ $project->name_project}}</h2>
                    <div class="page-title-subheading">Ketua Lapangan : <b>{{ $project->headProject->name}}</b>
                    <p>Alamat : {{ $project->location}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-actions">
                        <div class="main-card card">
                            <div class="no-gutters row">
                                <div class="col-md-4">
                                    <div class="widget-content">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-right ml-0 mr-3">
                                                <div class="widget-numbers text-success"></div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Stok Tersedia</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="widget-content">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-right ml-0 mr-3">
                                                <div class="widget-numbers text-warning"></div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Total Masuk</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="widget-content">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-right ml-0 mr-3">
                                                <div class="widget-numbers text-danger"></div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Total Keluar</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>            
    </div>
    <div class="row">
        <div class="col-lg-7">
            <div class="main-card card">
                <div class="card-body">
                <h5 class="card-title">Riwayat Data Masuk Barang Material</h5>
                    <table  class="mb-0 table table-striped" style="width: 100%;" id="tableDetail">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Tanggal</td>
                                <td>Nama Barang</td>
                                <td>Qty</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="main-card mb-6 card">
                <div class="card-body">
                <h5 class="card-title">Data Penggunaan Barang Material</h5>
                    <table  class="mb-0 table table-striped" style="width: 100%;" id="tableSumBarang">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama Barang</td>
                                <td>Qty</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
  @include('hr.proyek.modal_detail')
@endsection