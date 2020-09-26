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
                                    <div class="input-group date col-sm-4" id="start" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#start_monitoring" name="start" placeholder="Informe a data ..."
                                            autocomplete="off" />
                                        <div class="input-group-append" data-target="#start" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                        </div>
                                    </div>
                                    <label class="col-sm-2 col-form-label" for="end">Fim da campanha</label>
                                    <div class="input-group date col-sm-4" id="end" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#end"
                                            name="end" placeholder="Informe a data ..." autocomplete="off" />
                                        <div class="input-group-append" data-target="#end" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="start_monitoring">Começar monitorar</label>
                                    <div class="input-group date col-sm-4" id="start_monitoring"
                                        data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#start_monitoring" name="start_monitoring"
                                            placeholder="Informe a data ..." autocomplete="off" />
                                        <div class="input-group-append" data-target="#start_monitoring"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                        </div>
                                    </div>
                                    <label class="col-sm-2 col-form-label" for="stop_monitoring">Parar de monitorar</label>
                                    <div class="input-group date col-sm-4" id="stop_monitoring" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#stop_monitoring" name="stop_monitoring"
                                            placeholder="Informe a data ..." autocomplete="off" />
                                        <div class="input-group-append" data-target="#stop_monitoring"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h5 class="card-title mt-2 mb-2">Sequência de mensagens</h5>
                        </div>
                        <div class="row">
                            <table class="table table-striped table-sm" id="messages_table">
                                <thead>
                                    <tr>
                                        <th scope="col">Mensagem</th>
                                        <th scope="col" colspan="5">Agendamento</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="form-control form-control-sm" tabindex="-1" aria-hidden="true"
                                                name="messages_id[]">
                                                <option value="" disabled selected hidden>Selecione ...</option>
                                                @foreach ($messages as $message)
                                                    <option value="{{ $message->id }}">{{ $message->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td colspan="5" class="align-middle">Boas-vindas - Primeira mensagem</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button type="button" name="add" class="btn btn-success add-item">+</button>
                                            </div>

                                            {{-- essa div com os campos é para garantir que
                                            todos os campos vão ser enviados para o controle
                                            com a mesma quantidade de itens na lista/array --}}
                                            <div class="d-none">
                                                <input name="shots[]" />
                                                <input name="quantities[]" />
                                                <input name="units[]" />
                                                <input name="triggers[]" />
                                                <input name="momment[]" />
                                                <input name="scheduler_date[]" />
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
                    date: 'far fa-calendar-alt',
                    up: 'fas fa-arrow-up',
                    down: 'fas fa-arrow-down',
                    previous: 'fas fa-chevron-left',
                    next: 'fas fa-chevron-right',
                    today: 'fas fa-calendar-check-o',
                    clear: 'fas fa-trash',
                    close: 'fas fa-times'
                }
            });
        });
        $(function() {
            $('#start, #end').datetimepicker({
                locale: 'pt-BR',
                format: 'L',
            });
        });
        $(function() {
            $('#start_monitoring, #stop_monitoring').datetimepicker({
                locale: 'pt-BR',
                format: 'L LTS',
            });
        });

        function changeShot(element) {
            // Limpa os campos do relative
            $(element).parent().parent().find('td.relative>input').val('');
            $(element).parent().parent().find('td.relative>select').val('');

            // Limpando a data
            $(element).parent().parent().find('td.date>div>input').val('');

            if (element.value == 'relative') {
                // Mostrando os relativos
                $(element).parent().parent().children('.relative').removeClass('d-none');
                // Escondendo a data
                $(element).parent().parent().children('.date').addClass('d-none');
            } else {
                // Escondendo os relativos
                $(element).parent().parent().children('.relative').addClass('d-none');
                // Mostrando a data
                $(element).parent().parent().children('.date').removeClass('d-none');
            }
        }

        // Sequência de mensagem
        function new_row(count) {
            var html = '<tr>';
            html += '<td>';
            html += '  <select class="form-control form-control-sm" tabindex="-1" aria-hidden="true" name="messages_id[]">';
            html += '    <option value="" disabled selected hidden>Selecione ...</option>';
            html += '    @foreach ($messages as $message)';
            html += '      <option value="{{ $message->id }}">{{ $message->name }}</option>';
            html += '    @endforeach';
            html += '  </select>';
            html += '</td>';
            html += '<td>';
            html +=
                '  <select class="form-control form-control-sm" tabindex="-1" aria-hidden="true" onchange="changeShot(this)" name="shots[]">';
            html += '    <option value="date">Data específica</option>';
            html += '    <option value="relative">Relativo</option>';
            html += '  </select>';
            html += '</td>';
            html += '<td class="relative d-none">';
            html += '  <input type="text" size="1" class="form-control form-control-sm" name="quantities[]" value=""/>';
            html += '</td>';
            html += '<td class="relative d-none">';
            html += '  <select class="form-control form-control-sm" tabindex="-1" aria-hidden="true" name="units[]">';
            html += '    <option value="">...</option>';
            html += '    <option value="minutes">Minuto(s)</option>';
            html += '    <option value="hours">Hora(s)</option>';
            html += '    <option value="days">Dia(s)</option>';
            html += '  </select>';
            html += '</td>';
            html += '<td class="relative d-none">';
            html += '  <select class="form-control form-control-sm" tabindex="-1" aria-hidden="true" name="triggers[]">';
            html += '    <option value="">...</option>';
            html += '    <option value="before">Antes</option>';
            html += '    <option value="after">Depois</option>';
            html += '  </select>';
            html += '</td>';
            html += '<td class="relative d-none">';
            html += '  <select class="form-control form-control-sm" tabindex="-1" aria-hidden="true" name="momment[]">';
            html += '    <option value="">...</option>';
            html += '    <option value="start_campaign">Iniciar campanha</option>';
            html += '    <option value="end_campaign">Finalizar campanha</option>';
            html += '    <option value="start_monitoring">Iniciar monitoramento</option>';
            html += '    <option value="end_monitoring">Finalizar monitoramento</option>';
            html += '  </select>';
            html += '</td>';
            html += '<td colspan="3" class="date">';
            html += '  <div class="input-group date data-target-input="nearest">';
            html +=
                '    <input type="text" class="form-control form-control-sm datetimepicker-input scheduler' + count +
                '" data-target=".scheduler' + count + '" name="scheduler_date[]" autocomplete="off"/>';
            html +=
                '    <div class="input-group-append" data-target=".scheduler' + count + '" data-toggle="datetimepicker">';
            html += '      <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>';
            html += '    </div>';
            html += '  </div>';
            html += '</td>';
            html += '<td class="date" colspan="1">';
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
            $('.scheduler' + nLines).datetimepicker({
                locale: 'pt-BR'
            });
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
