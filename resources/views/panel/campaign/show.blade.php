@extends('adminlte::page')

@section('title', 'Automation - Campanha - Ver')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Campanha - Ver</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('panel.index') }}">Painel</a></li>
                <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Campanhas</a></li>
                <li class="breadcrumb-item active">Ver</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $campaign->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                            <div class="row">

                                <div class="col-12 col-sm-6">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total de
                                                cliques</span>
                                            <span class="info-box-number text-center text-muted mb-0">2000</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total de
                                                leads</span>
                                            <span class="info-box-number text-center text-muted mb-0">20 <span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h4>Segmentações - {{ $campaign->segmentations->count() }}</h4>
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg"
                                                alt="user image">
                                            <span class="username">
                                                <a href="#">Jonathan Burke Jr.</a>
                                            </span>
                                            <span class="description">Shared publicly - 7:45 PM today</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            Lorem ipsum represents a long-held tradition for designers,
                                            typographers and the like. Some people hate it and argue for
                                            its demise, but others ignore.
                                        </p>

                                        <p>
                                            <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo
                                                File 1
                                                v2</a>
                                        </p>
                                    </div>

                                    <div class="post clearfix">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg"
                                                alt="User Image">
                                            <span class="username">
                                                <a href="#">Sarah Ross</a>
                                            </span>
                                            <span class="description">Sent you a message - 3 days ago</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            Lorem ipsum represents a long-held tradition for designers,
                                            typographers and the like. Some people hate it and argue for
                                            its demise, but others ignore.
                                        </p>
                                        <p>
                                            <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo
                                                File 2</a>
                                        </p>
                                    </div>

                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg"
                                                alt="user image">
                                            <span class="username">
                                                <a href="#">Jonathan Burke Jr.</a>
                                            </span>
                                            <span class="description">Shared publicly - 5 days ago</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            Lorem ipsum represents a long-held tradition for designers,
                                            typographers and the like. Some people hate it and argue for
                                            its demise, but others ignore.
                                        </p>

                                        <p>
                                            <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo
                                                File 1
                                                v1</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                            <h5 class="text-primary"><i class="fas fa-pencil-alt"></i> Detalhes</h5>
                            <p class="text-muted">{{ $campaign->description }}</p>
                            <br>
                            <div class="text-muted">
                                <p class="text-sm">Data da Criação
                                    <b class="d-block">{{ date('d-m-Y H:i:s', strtotime($campaign->created_at)) }}</b>
                                </p>
                                <p class="text-sm">Última Atualização
                                    <b class="d-block">{{ date('d-m-Y H:i:s', strtotime($campaign->updated_at)) }}</b>
                                </p>
                            </div>

                            {{-- <h5 class="mt-5 text-muted">Project files</h5>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i>
                                        Functional-requirements.docx</a>
                                </li>
                                <li>
                                    <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i>
                                        UAT.pdf</a>
                                </li>
                                <li>
                                    <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i>
                                        Email-from-flatbal.mln</a>
                                </li>
                                <li>
                                    <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i>
                                        Logo.png</a>
                                </li>
                                <li>
                                    <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i>
                                        Contract-10_12_2014.docx</a>
                                </li>
                            </ul>
                            <div class="text-center mt-5 mb-3">
                                <a href="#" class="btn btn-sm btn-primary">Add files</a>
                                <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>
@endsection
