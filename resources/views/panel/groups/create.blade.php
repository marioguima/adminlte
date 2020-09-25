@extends('adminlte::page')

@section('title', 'Automation - Grupos - Criar')

@section('css')
@endsection

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Grupos - Criar</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('panel.index') }}">Painel</a></li>
                <li class="breadcrumb-item"><a href="{{ route('groups.index') }}">Grupos</a></li>
                <li class="breadcrumb-item active">Criar</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
    <div class="row">
        <!-- right column -->
        <div class="col-md-12">
            <form role="form" method="POST" action="{{ route('groups.store') }}" class="form-horizontal"
                enctype="multipart/form-data">
                @csrf

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
                                        name="campaigns_id" id="campaigns_select" required>
                                        <option value="" disabled selected></option>
                                        @foreach ($campaigns['data'] as $campaign)
                                            <option value="{{ $campaign->id }}">
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
                                        name="segmentations_id" id="segmentations_select" required>
                                        <option value="" disabled selected></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="name">Nome</label>
                                    <input type="text" id="name" name="name" class="col-sm-10 form-control" maxlength="25"
                                        placeholder="Digite o nome ..." value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- textarea -->
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="description">Descrição</label>
                                    <textarea id="description" name="description" class="col-sm-10 form-control" rows="3"
                                        placeholder="Digite a descrição ..."></textarea>
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
                                        <option value="" disabled selected hidden>Selecione ...</option>
                                        <option value="all">Todos os participantes</option>
                                        <option value="only_admins">Somente administradores</option>
                                    </select>
                                    <label class="col-sm-2 col-form-label" for="seats">Enviar mensagens</label>
                                    <select name="send_message" id="send_message" class="col-sm-4 form-control">
                                        <option value="" disabled selected hidden>Selecione ...</option>
                                        <option value="all">Todos os participantes</option>
                                        <option value="only_admins">Somente administradores</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="seats">Lugares disponíveis</label>
                                    <input type="text" id="seats" name="seats" class="col-sm-4 form-control"
                                        placeholder="Digite a quantidade ..." value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="uploadFile">Imagem</label>
                                    <input class="col-sm-10 form-control" type="file" name="uploadFile" id="uploadFile" style="padding-left: 0; padding-top: 3px;">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10 help-block">Melhor enquadramento com imagem no formato 500 x 361
                                        (largura x altura)</div>
                                </div>
                            </div>
                        </div>
                        <h5>Membros adicionais</h5>
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
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $.fn.select2.defaults.set("language", "pt-br");

            $('#campaigns_select').select2({
                placeholder: 'Selecione a campanha',
            });

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
                    url: "segmentacoes/" + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var len = 0;

                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        if (len > 0) {
                            // Ler as segmentações e criar os <option>
                            for (var i = 0; i < len; i++) {
                                var id = response['data'][i].id;
                                var name = response['data'][i].name;

                                // var selected = '';
                                // if(old_segmentation == id) {
                                //     selected = 'selected';
                                // }

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
            // let row_number = 1;

            // Cria a primeira linha para adicionar um membro
            new_row(0);

            function new_row(count) {
                var html = '<tr>';
                html += '<td>';
                html +=
                    '<input type="text" name="member_names[]" class="form-control" value="">';
                html += '</td>';
                html += '<td>';
                html += '<select class="form-control" name="member_administrators[]">';
                html += '<option value="1" selected>Sim</option>';
                html += '<option value="0">Não</option>';
                html += '</select>';
                // html += '<input type="checkbox" name="member_administrators[]"';
                // html += 'class="form-control" value="' + count + '">';
                html += '</td>';
                if (count > 0) {
                    html += '<td>';
                    html +=
                        '<button type="button" name="remove" id="remove_member" class="btn btn-danger">X</button>';
                    html += '</td>';
                    html += '</tr>';
                    $('#initial_members_table > tbody').append(html);
                } else {
                    html += '<td>';
                    html +=
                        '<button type="button" name="add" id="add" class="btn btn-success">+</button>';
                    html += '</td>';
                    html += '</tr>';
                    $('#initial_members_table > tbody').html(html);
                }
            }

            $('#add').click(function() {
                // parentElement => td
                // .parentElement => tr
                //  .parentElement => tbody
                //   .childNodes => all tr
                //    .length => count tr
                var count = this.parentElement.parentElement.parentElement.childNodes.length;
                new_row(count);
            });

            $(document).on('click', '#remove_member', function() {
                // remove a linha
                // parentElement => td
                // .parentElement => tr
                this.parentElement.parentElement.remove();
            });
        });

    </script>
@endsection
