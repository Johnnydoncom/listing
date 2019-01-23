<?php

namespace App\Http\Controllers\Frontend;

use App\Message;
use App\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::whereNull('parent_id')
                    ->where(function($q) {
                        $q->where(function($query){
                            $query->where('sender', '=', Auth::id());
                        })
                        ->orWhere(function($query) {
                            $query->where('receiver','=', Auth::id());
                        });
                    })->latest()->get();

        return view('frontend.user.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function getConversation($user_two)
    {
        $message = Message::whereNull('parent_id')
                    ->where(function($q) use ($seller) {
                        $q->where(function($query) use ($seller) {
                            $query->where('sender', '=', Auth::id())
                                ->where('receiver', '=', $seller);
                        })
                        ->orWhere(function($query) use ($seller) {
                            $query->where('sender','=', $seller)
                                ->where('receiver', '=', Auth::id());
                        });
                    })->first();

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'receiver' =>  'required'
        ]);
        $listing = Listing::find($request->listing);
        $message = new Message;
        $message->subject = $request->subject;
        $message->sender = Auth::id();
        $message->receiver = $request->receiver;
        $message->message = $request->message. (($listing) ? "\r\n <br><br><a href='".$listing->slug."'> View Post</a>" : '');
        $message->save();

        return redirect()->back()->with('flash_success', 'Your message has been sent!');;
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reply(Request $request, $id )
    {
        $request->validate([
            'message' => 'required',
            'receiver' =>  'required',
            'subject'   =>'required'
        ]);
        $message = new Message;
        $message->subject = $request->subject;
        $message->parent_id = decrypt($request->id);
        $message->sender = Auth::id();
        $message->receiver = $request->receiver;
        $message->message = $request->message;
        $message->save();

        return redirect()->back()->with('flash_success', 'Your message has been sent!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = decrypt($id);
        $message = Message::findOrFail($id);
        return view('frontend.user.messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
