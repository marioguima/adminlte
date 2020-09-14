@extends('panel.layout.index')

{{-- DataTables --}}
@section('scripts')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                {{-- <a class="btn btn-info"
                    onclick="$('.toast').toast('show'); console.log('clicou');">Info message</a>
                --}}
                {{-- Toast --}}
                @if (session('success'))
                    <style>
                        .toast {
                            left: 50%;
                            position: fixed;
                            transform: translate(-50%, 0px);
                            z-index: 9999;
                        }

                    </style>
                    {{-- style="position: absolute; top: 4rem; right: 1rem; z-index:1;"
                    --}}
                    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                        <div class="toast-header">
                            <strong class="mr-auto">Sucesso</strong>
                            <small>Fechar</small>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif


                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">
                            Campanhas
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('panel.show') }}">Home</a></li>
                            <li class="breadcrumb-item active">
                                Campanhas
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Lista de Campanhas | Adicionar : <a
                                        href="{{ route('campaigns.create') }}" style="color: white"
                                        class="btn btn-sm btn-success fa fa-plus-square"></a>
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th>Criada</th>
                                            <th class="text-center py-0 align-middle">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($campaigns as $campaign)
                                            <tr>
                                                <td class="text-center">{{ $campaign->id }}</td>
                                                <td>{{ $campaign->name }}</td>
                                                <td>{{ $campaign->description }}</td>
                                                <td>{{ $campaign->created_at->diffForHumans() }}</td>
                                                <td class="text-center py-0 align-middle">
                                                    <form
                                                        action="{{ route('campaigns.destroy', ['campaign' => $campaign->id]) }}"
                                                        method="POST">
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="{{ route('campaigns.show', ['campaign' => $campaign->id]) }}"
                                                                class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                                            <a href="{{ route('campaigns.edit', ['campaign' => $campaign->id]) }}"
                                                                class="btn btn-info"><i class="fas fa-edit"></i></a>
                                                            <a href="{{ route('campaigns.destroy', ['campaign' => $campaign->id]) }}"
                                                                class="btn btn-danger delete-user"><i
                                                                    class="fas fa-trash"></i></a>
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
                                            <th>Descrição</th>
                                            <th>Criada</th>
                                            <th class="text-center py-0 align-middle">Ação</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection


@section('page_scripts')

    <!-- DataTables -->
    <script src="{{ url('public/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('public/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('public/dist/js/demo.js') }}"></script>
    <!-- page script -->

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
                    'targets': [4], // column index (start from 0)
                    'orderable': false, // set orderable false for selected columns
                }],
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
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

    @if (session('success'))
        <script>
            $(document).ready(() => {
                $('.toast').toast('show');
            });

        </script>

    @endif

@endsection
