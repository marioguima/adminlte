@extends('adminlte::page')

@section('title', 'Automation - Campanha - Editar')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Campanha - Editar</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('panel.index') }}">Painel</a></li>
                <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Campanhas</a></li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
    <div class="row">
        <!-- right column -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Dados da campanha</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form role="form" method="POST" action="{{ route('campaigns.update', ['campaign' => $campaign]) }}">
                        @csrf
                        @method('PUT')

                        @if (session('error'))
                            <span class="alert alert-danger">{{ session('error') }}</span>
                        @endif

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="name">Nome</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Digite o nome ..." value="{{ $campaign->name }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label class="col-form-label" for="description">Descrição</label>
                                    <textarea id="description" name="description" class="form-control" rows="3"
                                        placeholder="Digite a descrição ...">{{ $campaign->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card-footer">
                                    <a href="{{ URL::previous() }}" class="btn btn-danger">Cancelar</a>
                                    <button type="submit" class="btn btn-primary float-right">Confirmar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!--/.col (right) -->
    </div>


@endsection


@section('page_scripts')
@endsection
