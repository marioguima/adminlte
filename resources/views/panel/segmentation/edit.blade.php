@extends('adminlte::page')

@section('title', 'Automation - Segmentação - Editar')

@section('css')
@endsection

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Segmentação - Editar</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('panel.index') }}">Painel</a></li>
                <li class="breadcrumb-item"><a href="{{ route('segmentations.index') }}">Segmentações</a></li>
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
                    <h3 class="card-title">Dados da segmentação</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form role="form" method="POST"
                        action="{{ route('segmentations.update', ['segmentation' => $segmentation->id]) }}">
                        @csrf
                        @method('PUT')

                        @if (session('error'))
                            <span class="alert alert-danger">{{ session('error') }}</span>
                        @endif

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Campanha</label>
                                    <select class="form-control col-sm-10" tabindex="-1" aria-hidden="true"
                                        name="campaign_id" id="campaign_id" required
                                        data-placeholder="Selecione uma campanha ...">
                                        <option value="" disabled selected></option>
                                        @foreach ($campaigns as $campaign)
                                            <option value="{{ $campaign->id }}"
                                                {{ $segmentation->campaign_id == $campaign->id ? 'selected' : '' }}>
                                                {{ $campaign->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="name">Nome</label>
                                    <input type="text" id="name" name="name" class="form-control col-sm-10"
                                        placeholder="Digite o nome ..." value="{{ $segmentation->name }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- textarea -->
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="description">Descrição</label>
                                    <textarea id="description" name="description" class="form-control col-sm-10" rows="3"
                                        placeholder="Digite a descrição ...">{{ $segmentation->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-footer">
                                    <a href="{{ URL::previous() }}" class="btn btn-danger">Cancelar</a>
                                    <button type="submit" class="btn btn-primary float-right">Cadastrar</button>
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

@section('js')
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('#campaign_id').select2({
                // placeholder: 'Selecione a campanha',
                // width: '100%'
            });
        });

    </script>
@endsection
