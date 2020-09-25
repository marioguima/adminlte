@extends('adminlte::page')

@section('title', 'Automation - Mensagens - Ver')

@section('css')
    <style>
        textarea {
            resize: none;
            overflow: hidden;
            min-height: 40px;
            /* max-height: 300px; */
        }

        .direct-chat-text {
            white-space: pre-line;
        }

    </style>
@endsection

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Mensagens - Ver</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('panel.index') }}">Painel</a></li>
                <li class="breadcrumb-item"><a href="{{ route('messages.index') }}">Mensagens</a></li>
                <li class="breadcrumb-item active">Ver</li>
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
                    <h3 class="card-title">Dados da mensagem</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>{{ $message->name }}</h3>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="direct-chat-msg">
                            @foreach ($message->items as $index => $item)
                                <div class="direct-chat-text">{{ $item->value }}</div>
                            @endforeach
                        </div> --}}

                        <div class="timeline">
                            <div class="time-label">
                                <span class="bg-blue">Boas-vindas</span>
                            </div>

                            @foreach ($message->items as $index => $item)
                                <div>
                                    @if ($item->type == 'text')
                                        <i class="fas fa-comment-dots bg-yellow"></i>
                                    @elseif ($item->type == 'image')
                                        <i class="fa fa-camera bg-purple"></i>
                                    @elseif ($item->type == 'document')
                                        <i class="fas fa-file bg-blue"></i>
                                    @elseif ($item->type == 'video')
                                        <i class="fas fa-video bg-maroon"></i>
                                    @elseif ($item->type == 'audio')
                                        <i class="fas fa-user bg-green"></i>
                                    @elseif ($item->type == 'contact')
                                        <i class="fas fa-microphone"></i>
                                    @endif

                                    <div class="timeline-item" style="background: #e9eaec;">
                                        {{-- <span class="time"><i class="fas fa-clock"></i> Aguardar 5 segundos</span> --}}
                                        <div class="timeline-header no-border">{!! html_entity_decode($item->whatsapp_markdown_to_html) !!}</div>
                                    </div>
                                </div>
                            @endforeach
                            <div>
                                <i class="fas fa-minus-circle bg-red"></i>
                                {{-- <i class="fas fa-clock bg-gray"></i>
                                --}}
                                {{-- <i class="fas fa-check" bg-gray></i>
                                --}}
                            </div>
                        </div>

                        {{-- <table class="table" id="items_table">
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
                                            {{ $item->value }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> --}}
                    </div>
                </div>
            </div>
        </div>
        <!--/.col (right) -->
    </div>
@endsection
