@extends('component.app')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-home icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div class="mr-4">Data Proyek
                    <!-- <div class="page-title-subheading">Tables are the backbone of almost all web applications.
                    </div> -->
                </div>
                <!-- <ul class="nav nav-pills">
                    <li class="nav-item"><a data-toggle="tab" href="#tab-eg13-0" class="active nav-link">Semua Proyek</a></li>
                    <li class="nav-item"><a data-toggle="tab" href="#tab-eg13-1" class="nav-link">Aktif</a></li>
                    <li class="nav-item"><a data-toggle="tab" href="#tab-eg13-1" class="nav-link">Selesai</a></li>
                </ul> -->
            </div>
            <!-- <div class="page-title-actions">
                <div class="d-inline-block">
                    <button class="btn-shadow btn btn-info" id="btn-tambah-project" data-toggle="modal" data-target="#tambahProjectModal">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus-square fa-w-20"></i>
                        </span>
                        Tambah Proyek
                    </button>
                </div>
            </div>     -->
        </div>
    </div>            
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-6 card">
                <div class="card-body"><h5 class="card-title">Tabel Data Proyek</h5>
                    <table class="mb-0 table table-striped datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Proyek</th>
                            <th>Kepala Lapangan</th>
                            <th>Lokasi</th>
                            <th>Status</th>
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
  @include('admin.hr.proyek.modals')
@endsection