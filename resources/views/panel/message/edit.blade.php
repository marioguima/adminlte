@extends('adminlte::page')

@section('title', 'Automation - Mensagens - Editar')

@section('css')
    <style>
        textarea {
            resize: none;
            overflow: hidden;
            min-height: 40px;
            /* max-height: 300px; */
        }

    </style>
@endsection

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Mensagens - Editar</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('panel.index') }}">Painel</a></li>
                <li class="breadcrumb-item"><a href="{{ route('messages.index') }}">Mensagens</a></li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
    <div class="row">
        <!-- right column -->
        <div class="col-md-12">
            <form role="form" method="POST" action="{{ route('messages.update', ['message' => $message->id]) }}"
                class="form-horizontal" enctype="multipart/form-data">
                @csrf
                @method('put')

                @if (session('error'))
                    <span class="alert alert-danger">{{ session('error') }}</span>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Dados da mensagem</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="name">Nome</label>
                                    <input type="text" id="name" name="name" class="col-sm-10 form-control" maxlength="255"
                                        placeholder="Digite o nome ..." value="{{ $message->name }}" required>
                                </div>
                            </div>
                        </div>
                        {{-- <h5>Mensagem</h5> --}}
                        <caption>Corpo da mensagem</caption>
                        <div class="row">
                            <table class="table" id="items_table">
                                <thead>
                                    <tr class="d-flex">
                                        <th class="col-9">Conteúdo</th>
                                        <th class="col-2">Tipo</th>
                                        <th class="col-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($message->items as $index => $item)
                                        <tr class="d-flex">
                                            <td class="col-9">
                                                <textarea rows="1" oninput="auto_grow(this)" name="item_values[]"
                                                    class="form-control auto-grow">{{ $item->value }}</textarea>
                                            </td>
                                            <td class="col-2">
                                                <select class="form-control" name="item_types[]">
                                                    <option value="text" selected>Texto</option>
                                                    <option value="image" disabled>Image</option>
                                                    <option value="audio" disabled>Áudio</option>
                                                    <option value="video" disabled>Vídeo</option>
                                                    <option value="document" disabled>Documento</option>
                                                    <option value="contact" disabled>Contato</option>
                                                </select>
                                            </td>
                                            @if ($index == 0)
                                                <td class="col-1">
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button" name="add"
                                                            class="btn btn-success add-item">+</button>
                                                    </div>
                                                </td>
                                            @else
                                                <td class="col-1">
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button" name="add"
                                                            class="btn btn-success add-item">+</button>
                                                        <button type="button" name="remove" id="remove"
                                                            class="btn btn-danger">X</button>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a href="{{ URL::previous() }}" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-primary float-right">Salvar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--/.col (right) -->
    </div>
@endsection

@section('js')
    <script>
        function auto_grow(element) {
            element.style.height = "5px";
            element.style.height = (element.scrollHeight) + "px";
        }

        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            var elements = document.querySelectorAll(".auto-grow");
            for (var el of elements) {
                auto_grow(el);
            }

            // Corpo da mensagem
            function new_row(count) {
                var html = '<tr class="d-flex">';
                html += '<td class="col-9">';
                html +=
                    '<textarea rows="1" oninput="auto_grow(this)" name="item_values[]" class="form-control auto-grow"></textarea>';
                html += '</td>';
                html += '<td class="col-2">';
                html += '<select class="form-control" name="item_types[]">';
                html += '<option value="text" selected>Texto</option>';
                html += '<option value="image" disabled>Image</option>';
                html += '<option value="audio" disabled>Áudio</option>';
                html += '<option value="video" disabled>Vídeo</option>';
                html += '<option value="document" disabled>Documento</option>';
                html += '<option value="contact" disabled>Contato</option>';
                html += '</select>';
                html += '</td>';
                if (count > 0) {
                    html += '<td class="col-1">';
                    html += '<div class="btn-group btn-group-sm">';
                    html +=
                        '<button type="button" name="add" class="btn btn-success add-item">+</button>';
                    html +=
                        '<button type="button" name="remove" id="remove" class="btn btn-danger">X</button>';
                    html += '</div>';
                    html += '</td>';
                    html += '</tr>';
                    $('#items_table > tbody').append(html);
                } else {
                    html += '<td class="col-1">';
                    html += '<div class="btn-group btn-group-sm">';
                    html +=
                        '<button type="button" name="add" class="btn btn-success add-item">+</button>';
                    html += '</div>';
                    html += '</td>';
                    html += '</tr>';
                    $('#items_table > tbody').html(html);
                }
            }

            $(document).on('click', '.add-item', function() {
                // parentElement => td
                // .parentElement => tr
                //  .parentElement => tbody
                //   .childNodes => all tr
                //    .length => count tr
                var count = this.parentElement.parentElement.parentElement.parentElement.childNodes.length;
                new_row(count);
            });

            $(document).on('click', '#remove', function() {
                // parentElement => td
                //  .parentElement => div
                //   .parentElement => tr
                this.parentElement.parentElement.parentElement.remove();
            });
        });

    </script>
@endsection
