@extends('adminlte::page')

@section('title', 'Automation - Campanha - Criar')

@section('css')
    <link rel="stylesheet"
        href="{{ asset('public/vendor/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

@endsection

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Campanha - Criar</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('panel.index') }}">Painel</a></li>
                <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Campanhas</a></li>
                <li class="breadcrumb-item active">Criar</li>
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
                        <h5 class="mt-2">Sequência de mensagens</h5>
                        <div class="row">
                            <table class="table table-striped" id="messages_table">
                                <thead>
                                    <tr>
                                        <th scope="col">Mensagem</th>
                                        <th scope="col">Agendamento</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="form-control" tabindex="-1" aria-hidden="true"
                                                name="messages_id[]">
                                                <option value="" disabled selected hidden>Selecione ...</option>
                                                @foreach ($messages as $message)
                                                    <option value="{{ $message->id }}">{{ $message->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="align-middle">Boas-vindas - Primeira mensagem</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button type="button" name="add" class="btn btn-success add-item">+</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
    <script src="{{ asset('public/vendor/moment/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('public/vendor/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <script>
        $(function() {
            $.fn.datetimepicker.Constructor.Default = $.extend({}, $.fn.datetimepicker.Constructor.Default, {
                icons: {
                    time: 'far fa-clock',
                    date: 'far fa-calendar',
                    up: 'fas fa-arrow-up',
                    down: 'fas fa-arrow-down',
                    previous: 'fas fa-chevron-left',
                    next: 'fas fa-chevron-right',
                    today: 'fas fa-calendar-check-o',
                    clear: 'fas fa-trash',
                    close: 'fas fa-times'
                }
            });
            $('.scheduler').datetimepicker({
                locale: 'pt-BR'
            });
        });

        // Sequência de mensagem
        function new_row(count) {
            var html = '<tr>';
            html += '<td>';
            html += '  <select class="form-control" tabindex="-1" aria-hidden="true" name="messages_id[]">';
            html += '    <option value="" disabled selected hidden>Selecione ...</option>';
            html += '    @foreach ($messages as $message)';
            html += '      <option value="{{ $message->id }}">{{ $message->name }}</option>';
            html += '    @endforeach';
            html += '  </select>';
            html += '</td>';
            html += '<td>';
            html += '  <div class="input-group date scheduler' + count + '" data-target-input="nearest">';
            html +=
                '    <input type="text" class="form-control datetimepicker-input scheduler" data-target=".scheduler' + count + '" id="scheduler[]"/>';
            html +=
                '    <div class="input-group-append" data-target=".scheduler' + count + '" data-toggle="datetimepicker">';
            html += '      <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>';
            html += '    </div>';
            html += '  </div>';
            html += '</td>';
            html += '<td class="align-middle">';
            html += '  <div class="btn-group btn-group-sm">';
            html += '    <button type="button" name="add" class="btn btn-success add-item">+</button>';
            html += '    <button type="button" name="remove" class="btn btn-danger remove-item">X</button>';
            html += '  </div>';
            html += '</td>';
            html += '</tr>';
            $('#messages_table > tbody').append(html);
        }

        $(document).on('click', '.add-item', function() {
            var nLines = $('#messages_table > tbody')[0].children.length;
            new_row(nLines);
            // addRemoveButtonFirstItem();
        });

        $(document).on('click', '.remove-item', function() {
            // remove a linha
            // .parentElement => div
            //  .parentElement => td
            //   .parentElement => tr
            this.parentElement.parentElement.parentElement.remove();
            // addRemoveButtonFirstItem();
        });

        function addRemoveButtonFirstItem() {
            var nLines = $('#messages_table > tbody')[0].children.length;
            var html = '<td>';
            html += '<div class="btn-group btn-group-sm">';
            if (nLines == 1) {
                html += '  <button type="button" name="add" class="btn btn-success add-item">+</button>';
            } else {
                html += '  <button type="button" name="add" class="btn btn-success add-item">+</button>';
                html += '  <button type="button" name="remove" class="btn btn-danger remove-item">X</button>';
            }
            html += '</div>';
            html += '</td>';
            $('#messages_table > tbody > tr > td:nth-of-type(3)').replaceWith(html);
        }

    </script>
@endsection
