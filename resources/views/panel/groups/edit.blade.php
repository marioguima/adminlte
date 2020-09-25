@extends('adminlte::page')

@section('title', 'Automation - Grupo - Editar')

@section('css')
@endsection

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Grupo - Editar</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('panel.index') }}">Painel</a></li>
                <li class="breadcrumb-item"><a href="{{ route('segmentations.index') }}">Grupos</a></li>
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
                                <div class="form-group">
                                    <label class="col-form-label">Campanha</label>
                                    <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true"
                                        name="campaigns_id" id="campaigns_id" required
                                        data-placeholder="Selecione uma campanha ...">
                                        <option value="" disabled selected></option>
                                        @foreach ($campaigns as $campaign)
                                            <option value="{{ $campaign->id }}"
                                                {{ $segmentation->campaigns_id == $campaign->id ? 'selected="selected"' : '' }}>
                                                {{ $campaign->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="name">Nome</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Digite o nome ..." value="{{ $segmentation->name }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label class="col-form-label" for="description">Descrição</label>
                                    <textarea id="description" name="description" class="form-control" rows="3"
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
            $('#campaigns_id').select2({
                // placeholder: 'Selecione a campanha',
                // width: '100%'
            });
        });

    </script>
@endsection
