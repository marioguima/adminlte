@extends('adminlte::page')

@section('title', 'Automation - Grupos - Editar')

@section('css')
    <style>
        textarea {
            resize: none;
            overflow: hidden;
            min-height: 40px;
        }

    </style>
@endsection

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Grupos - Editar</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('panel.index') }}">Painel</a></li>
                <li class="breadcrumb-item"><a href="{{ route('groups.index') }}">Grupos</a></li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
    <div class="row">
        <!-- right column -->
        <div class="col-md-12">
            <form role="form" method="POST" action="{{ route('groups.update', ['group' => $group->id]) }}"
                class="form-horizontal" enctype="multipart/form-data">
                @csrf
                @method('put')

                @if (session('error'))
                    <span class="alert alert-danger">{{ session('error') }}</span>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Dados do grupo</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Campanha</label>
                                    <select class="col-sm-10 form-control" tabindex="-1" aria-hidden="true"
                                        name="campaigns_id" id="campaigns_select">
                                        @foreach ($campaigns['data'] as $campaign)
                                            <option value="{{ $campaign->id }}"
                                                {{ $group->segmentation->campains_id == $campaign->id ? 'selected' : '' }}>
                                                {{ $campaign->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Segmentação</label>
                                    <select class="col-sm-10 form-control" tabindex="-1" aria-hidden="true"
                                        name="segmentations_id" id="segmentations_select">
                                        <option value="{{ $group->segmentations_id }}">
                                            {{ $group->segmentation->name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="name">Nome</label>
                                    <input type="text" id="name" name="name" class="col-sm-10 form-control" maxlength="25"
                                        placeholder="Digite o nome ..." value="{{ $group->name }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- textarea -->
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="description">Descrição</label>
                                    <textarea id="description" name="description" class="col-sm-10 form-control auto-grow"
                                        oninput="auto_grow(this)"
                                        placeholder="Digite a descrição ...">{{ $group->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="url">Url</label>
                                    <input type="text" id="url" name="url" class="col-sm-10 form-control"
                                        placeholder="Digite a url ..." value="" required>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="seats">Lugares ocupados</label>
                                    <input type="text" id="occuped_seats" name="occuped_seats" class="col-sm-8 form-control"
                                        placeholder="Digite a quantidade ..." value="" required>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="seats">Editar dados do grupo</label>
                                    <select name="edit_data" id="edit_data" class="col-sm-4 form-control"
                                        placeholder="Selecione">
                                        <option value="all" {{ $group->edit_data == 'all' ? 'selected' : '' }}>Todos os
                                            participantes</option>
                                        <option value="only_admins"
                                            {{ $group->edit_data == 'only_admins' ? 'selected' : '' }}>Somente
                                            administradores</option>
                                    </select>
                                    <label class="col-sm-2 col-form-label" for="seats">Enviar mensagens</label>
                                    <select name="send_message" id="send_message" class="col-sm-4 form-control">
                                        <option value="all" {{ $group->send_message == 'all' ? 'selected' : '' }}>Todos os
                                            participantes</option>
                                        <option value="only_admins"
                                            {{ $group->send_message == 'only_admins' ? 'selected' : '' }}>Somente
                                            administradores
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="seats">Lugares disponíveis</label>
                                    <input type="text" id="seats" name="seats" class="col-sm-4 form-control"
                                        placeholder="Digite a quantidade ..." value="{{ $group->seats }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <div class="col-sm-12 row">
                                        <label class="col-sm-2 col-form-label">Imagem</label>
                                        <div class="col-sm-10 row">
                                            <div class="col-sm-10 help-block"><img
                                                    src="{{ asset('public/storage/' . $group->image_path) }}" alt=""></div>
                                        </div>
                                        <div class="col-sm-12 row">
                                            <div class="col-sm-2"></div>
                                            <input class="col-sm-10 form-control" type="file" name="uploadFile"
                                                id="uploadFile" style="padding-left: 0; padding-top: 3px;"
                                                value="{{ $group->image_path }}">
                                        </div>
                                        <div class="col-sm-12 row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10 help-block">Melhor enquadramento com imagem no formato 500
                                                x
                                                361
                                                (largura x altura)</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5>Membros iniciais</h5>
                        <div class="row">
                            <table class="table" id="initial_members_table">
                                <thead>
                                    <tr>
                                        <th class="col-sm">Nome</th>
                                        <th class="col-sm text-center">Administrador</th>
                                        <th class="col-sm"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($group->initialMembers as $index => $member)
                                        <tr>
                                            <td>
                                                <input type="text" name="member_names[]" class="form-control"
                                                    value="{{ $member->contact_name }}">
                                            </td>
                                            <td>
                                                <select class="form-control" name="member_administrators[]">
                                                    <option value="1" {{ $member->administrator == '1' ? 'selected' : '' }}>
                                                        Sim</option>
                                                    <option value="0" {{ $member->administrator == '0' ? 'selected' : '' }}>
                                                        Não</option>
                                                </select>
                                            </td>
                                            @if ($index == 0 and $group->initialMembers->count() == 1)
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button" name="add"
                                                            class="btn btn-success add-item">+</button>
                                                    </div>
                                                </td>
                                            @else
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button" name="add"
                                                            class="btn btn-success add-item">+</button>
                                                        <button type="button" name="remove"
                                                            class="btn btn-danger remove-item">X</button>
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
                            <button type="submit" class="btn btn-primary float-right">Cadastrar</button>
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

            $.fn.select2.defaults.set("language", "pt-br");

            // $('#campaigns_select').select2({
            //     placeholder: 'Selecione a campanha',
            // });

            // buscar as segmentação da companha
            $('#campaigns_select').change(function() {
                // Campaign id
                var id = $(this).val();

                // limpar a lista de segmentações
                $("#segmentations_select").find('option').remove();
                // adiciona o item em branco
                $("#segmentations_select").append('<option value="" disabled selected></option>');

                var _token = $('input[name="_token"]').val();

                // var old_segmentation = {{ old('segmentations_id') ? old('segmentations_id') : 0 }};

                // AJAXA request (recuperar as segmentações da campanha)
                $.ajax({
                    url: "../segmentacoes/" + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var len = 0;

                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        if (len > 0) {
                            // Ler as segmentações e Editar os <option>
                            for (var i = 0; i < len; i++) {
                                var id = response['data'][i].id;
                                var name = response['data'][i].name;

                                var option = "<option value='" + id + "'>" + name + "</option>";

                                $("#segmentations_select").append(option);
                            }
                        }
                    }
                });
            });

            $('#segmentations_select').select2({
                placeholder: 'Selecione a segmentação',
                language: {
                    noResults: function() {
                        return "Nenhuma segmentação encontrada";
                    }
                }
            });

            // Membros iniciais do grupo
            function new_row(nLines) {
                var html = '<tr>';
                html += '<td>';
                html +=
                    '    <input type="text" name="member_names[]" class="form-control" value="">';
                html += '</td>';
                html += '<td>';
                html += '    <select class="form-control" name="member_administrators[]">';
                html += '        <option value="1">Sim</option>';
                html += '        <option value="0">Não</option>';
                html += '    </select>';
                html += '</td>';
                if (nLines == 0) {
                    html += '    <td>';
                    html += '        <div class="btn-group btn-group-sm">';
                    html +=
                        '            <button type="button" name="add" class="btn btn-success add-item">+</button>';
                    html += '        </div>';
                    html += '    </td>';
                } else {
                    html += '    <td>';
                    html += '        <div class="btn-group btn-group-sm">';
                    html +=
                        '            <button type="button" name="add" class="btn btn-success add-item">+</button>';
                    html +=
                        '            <button type="button" name="remove" class="btn btn-danger remove-item">X</button>';
                    html += '        </div>';
                    html += '    </td>';
                }
                html += '</tr>';
                $('#initial_members_table > tbody').append(html);
            }

            $(document).on('click', '.add-item', function() {
                var nLines = $('#initial_members_table > tbody')[0].children.length;
                new_row(nLines);
                addRemoveButtonFirstItem();
            });

            $(document).on('click', '.remove-item', function() {
                // parentElement => div
                //  .parentElement => td
                //   .parentElement => tr
                this.parentElement.parentElement.parentElement.remove();
                addRemoveButtonFirstItem();
            });

            function addRemoveButtonFirstItem() {
                var nLines = $('#initial_members_table > tbody')[0].children.length;
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
                $('#initial_members_table > tbody > tr > td:nth-of-type(3)').replaceWith(html);
            }

        });

    </script>
@endsection
