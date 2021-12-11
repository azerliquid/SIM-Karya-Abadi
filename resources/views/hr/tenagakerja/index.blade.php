@extends('component.app')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div class="mr-2" >Data Tenaga Kerja
                </div>
            </div>
            <div class="mx-auto">
                <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
                    <li class="nav-item">
                        <a role="tab" class="nav-link show active" id="tab-0" data-toggle="tab" href="#tab-content-0" aria-selected="true">
                            <span>Card Tabs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link show" id="tab-1" data-toggle="tab" href="#tab-content-1" aria-selected="false">
                            <span>Animated Lines</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link show" id="tab-2" data-toggle="tab" href="#tab-content-2" aria-selected="false">
                            <span>Basic</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="page-title-actions">
                <!-- <button type="button" data-toggle="tooltip" title="" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark" data-original-title="Example Tooltip">
                    <i class="fa fa-star"></i>
                </button> -->
                <div class="d-inline-block">
                    <button class="btn-shadow btn btn-info" id="btn-tambah-tenaga" data-toggle="modal" data-target="#tambahPegawaiModal">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus-square fa-w-20"></i>
                        </span>
                        Tambah Pegawai
                    </button>
                </div>
            </div>    
        </div>
    </div>            
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-6 card">
                <div class="card-body">
                <h5 styleclass="card-title">Tabel Data Tenaga Kerja</h5>
                
                    <table class="mb-0 table table-striped datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>No Telp</th>
                            <th>Alamat</th>
                            <th>Divisi</th>
                            <th>Jabatan</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
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
  @include('hr.tenagakerja.modals')
@endsection