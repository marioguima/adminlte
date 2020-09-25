@extends('adminlte::page')

@section('title', 'Automation - Mensagens')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('public/vendor/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('public/vendor/datatables-plugins/responsive/css/responsive.bootstrap4.min.css') }}">
@stop

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Mensagens</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('panel.index') }}">Painel</a></li>
                <li class="breadcrumb-item active">Mensagens</li>
            </ol>
        </div><!-- /.col -->
    </div>

    {{-- Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Sucesso!</h5>
            {{ session('success') }}
        </div>
    @endif

@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Mensagens</h3><a href="{{ route('messages.create') }}"
                        style="color: white" class="btn btn-sm btn-success float-right"><i
                            class="fa fa-plus-square"></i>&nbsp;&nbsp;Novo</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th>Nome</th>
                                <th class="text-center py-0 align-middle">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $message)
                                <tr>
                                    <td class="text-center">{{ $message->id }}</td>
                                    <td><a
                                            href="{{ route('messages.show', ['message' => $message->id]) }}">{{ $message->name }}</a>
                                    </td>
                                    <td class="text-center py-0 align-middle">
                                        <form action="{{ route('messages.destroy', ['message' => $message->id]) }}"
                                            method="POST">
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('messages.show', ['message' => $message->id]) }}"
                                                    class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('messages.edit', ['message' => $message->id]) }}"
                                                    class="btn btn-info"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('messages.destroy', ['message' => $message->id]) }}"
                                                    class="btn btn-danger delete-user"><i class="fas fa-trash"></i></a>
                                            </div>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">ID</th>
                                <th>Nome</th>
                                <th class="text-center py-0 align-middle">Ação</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection


@section('js')

    <!-- DataTables -->
    <script src="{{ asset('public/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/vendor/datatables-plugins/responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/vendor/datatables-plugins/responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                'columnDefs': [{
                        'width': '150px',
                        'targets': [2], // column index (start from 0)
                        'orderable': false, // set orderable false for selected columns
                    }
                ],
                "order": [
                    [0, 'asc'],
                    [1, 'asc']
                ],
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sLoadingRecords": "Carregando..",
                    "sProcessing": "Processando..",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    },
                    "select": {
                        "rows": {
                            "_": "Selecionado %d linhas",
                            "0": "Nenhuma linha selecionada",
                            "1": "Selecionado 1 linha"
                        }
                    },
                    "buttons": {
                        "copy": "Copiar para a área de transferência",
                        "copyTitle": "Cópia bem sucedida",
                        "copySuccess": {
                            "1": "Uma linha copiada com sucesso",
                            "_": "%d linhas copiadas com sucesso"
                        }
                    }
                }
            });
        });

    </script>

    {{-- Confirmar a exclusão --}}
    <script>
        $('.delete-user').click(function(e) {
            console.log('delete');
            e.preventDefault() // Don't post the form, unless confirmed
            if (confirm('Confirma a exclusão?')) {
                // Post the form
                $(e.target).closest('form')
                    .submit() // Post the surrounding form
            }
        });

    </script>

@endsection
