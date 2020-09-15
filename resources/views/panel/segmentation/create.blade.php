@extends('panel.layout.index')

@section('scripts')
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">
                            Segmentação - Criar
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('panel.show') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('segmentations.index') }}">Segmentação</a></li>
                            <li class="breadcrumb-item active">Criar</li>
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
                    <!-- right column -->
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Dados da segmentação</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form role="form" method="POST" action="{{ route('segmentations.store') }}">
                                    @csrf

                                    @if (session('error'))
                                        <span class="alert alert-danger">{{ session('error') }}</span>
                                    @endif

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label" for="name">Nome</label>
                                                <input type="text" id="name" name="name" class="form-control"
                                                    placeholder="Digite o nome ..." value="{{ old('name') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!-- textarea -->
                                            <div class="form-group">
                                                <label class="col-form-label" for="description">Descrição</label>
                                                <textarea id="description" name="description" class="form-control" rows="3"
                                                    placeholder="Digite a descrição ..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                                                <a href="{{ URL::previous() }}"
                                                    class="btn btn-danger float-right">Cancelar</a>
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

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection


@section('page_scripts')
@endsection