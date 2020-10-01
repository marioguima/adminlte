<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageItem;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class MessageController extends Controller
{

    public $request;
    protected $model;

    public function __construct(Request $request, Message $model)
    {
        $this->middleware('auth');
        $this->request = $request;
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth()->User();
        $messages = new Message();
        $messages = $messages->where('id', '!=', 0)->with(['items'])->get();
        // dd($messages);
        return view(
            'panel.message.index',
            [
                'user' => $user,
                'messages' => $messages
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth()->User();
        return view(
            'panel.message.create',
            ['user' => $user]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = new Message();
        $message->name = $request->name;
        $message->save();

        // Salva os itens da mensagem
        for ($i = 0; $i < count($request->item_values); $i++) {
            $messageItem = new MessageItem();
            $messageItem->message_id = $message->id;
            $messageItem->type = $request->item_types[$i];
            $messageItem->value = $request->item_values[$i];
            $messageItem->save();
            unset($messageItem);
        }

        if ($message)
            return redirect()->route("messages.index")->with('success', 'Mensagem cadastrada com sucesso!');

        return redirect()->route('messages.index')->with('error', 'Ocorreu um erro ao cadastrar a mensagem');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        $user = Auth()->User();
        return view('panel.message.show', [
            'user' => $user,
            'message' => $message
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        $user = Auth()->User();
        return view('panel.message.edit', [
            'user' => $user,
            'message' => $message
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        $message->name = $request->name;
        $message->save();

        // Exclui todos os itens
        MessageItem::where('message_id', $message->id)->delete();

        // Salva os itens da mensagem
        for ($i = 0; $i < count($request->item_values); $i++) {
            $messageItem = new MessageItem();
            $messageItem->message_id = $message->id;
            $messageItem->type = $request->item_types[$i];
            $messageItem->value = $request->item_values[$i];
            $messageItem->save();
            unset($messageItem);
        }

        if ($message)
            return redirect()->route("messages.index")->with('success', 'Mensagem alterada com sucesso!');

        return redirect()->route('messages.index')->with('error', 'Ocorreu um erro ao alterar a mensagem');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('messages.index');
    }
}
