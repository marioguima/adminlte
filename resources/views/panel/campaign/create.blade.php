@extends('adminlte::page')

@section('title', 'Automation - Campanha - Editar')

@section('css')
    <link rel="stylesheet" href="{{ asset('public/vendor/daterangepicker/daterangepicker.css') }}">
@endsection

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
                    <form role="form" method="POST" action="{{ route('campaigns.store') }}">
                        @csrf

                        @if (session('error'))
                            <span class="alert alert-danger">{{ session('error') }}</span>
                        @endif

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="name">Nome</label>
                                    <input type="text" id="name" name="name" class="form-control col-sm-10"
                                        placeholder="Digite o nome ..." value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- textarea -->
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="description">Descrição</label>
                                    <textarea id="description" name="description" class="form-control col-sm-10" rows="3"
                                        placeholder="Digite a descrição ..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="seats">Início da campanha</label>
                                    <input type="text" id="start" name="start" class="form-control col-sm-4"
                                        placeholder="Informe a data ..." value="" required>
                                    <label class="col-sm-2 col-form-label" for="seats">Fim da campanha</label>
                                    <input type="text" id="end" name="end" class="form-control col-sm-4"
                                        placeholder="Informe a data ..." value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="seats">Começar monitorar</label>
                                    <input type="text" id="start_monitoring" name="start_monitoring"
                                        class="form-control col-sm-4" placeholder="Informe a data ..." value="" required>
                                    <label class="col-sm-2 col-form-label" for="seats">Parar de monitorar</label>
                                    <input type="text" id="stop_monitoring" name="stop_monitoring"
                                        class="form-control col-sm-4" placeholder="Informe a data ..." value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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

@section('js')
    <script src="{{ asset('public/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('public/vendor/daterangepicker/daterangepicker.js') }}"></script>

    {{-- <script>
        $(function() {
            $('input[name="start_monitoring"]').daterangepicker({
                opens: 'left',
                locale: {
                    format: 'DD/MM/YYYY'
                }
            }, function(start, end, label) {
                console.log("A nova seleação de data foi feita: " + start.format('DD/MM/YYYY') + ' to ' +
                    end
                    .format('DD/MM/YYYY'));
            });
        });

    </script> --}}
@endsection
