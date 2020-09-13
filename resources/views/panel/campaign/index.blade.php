@extends('panel.layout.index')

{{-- DataTables --}}
@section('scripts')
    {{-- <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    --}}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Campanhas</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($campaigns as $campaign)
                        <tr>
                            <td>{{ $campaign->id }}</td>
                            <td>{{ $campaign->name }}</td>
                            <td>{{ $campaign->description }}</td>
                            <td><a href="{{ route('campaign.show', ['campaign' => $campaign->id]) }}"><button type="button"
                                        class="btn btn-primary"><i class="far fa-eye"></i></button></a>
                                <a href="{{ route('campaign.edit', ['campaign' => $campaign->id]) }}"><button type="button"
                                        class="btn btn-success"><i class="fas fa-edit"></i></button></a>
                                <form action="" method="post">
                                    <input type="hidden" name="campaign" value="">
                                    <input type="submit" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ação</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection


@section('page_scripts')
    {{-- <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "lengthMenu": "Exibir _MENU_ linhas por página",
                    "zeroRecords": "Nenhuma campanha encontrada",
                    "info": "Exibindo a página _PAGE_ de _PAGES_",
                    "infoEmpty": "Nenhum registro encontrado",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "search": "Pesquisar:",
                    "previous": "Anterior"
                }
            });
        });

    </script>
@endsection
