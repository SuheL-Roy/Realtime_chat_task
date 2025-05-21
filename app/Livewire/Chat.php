<?php

namespace App\Livewire;

use App\Events\MessageSent;
use App\Models\Chat as ModelsChat;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    public $users;
    public $selectedUser;
    public $newMessage;
    public $messages;
    public $loginId;
    public $search = '';
    public function mount()
    {
        $this->users = User::where('id', '!=', Auth::id())->latest()->get();
        $this->selectedUser = $this->users->first();
        $this->loginId = Auth::id();
        $this->messages = ModelsChat::where(function ($query) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $this->selectedUser->id);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->selectedUser->id)
                ->where('receiver_id', Auth::id());
        })->get();
        $this->loadMessages();
    }
    public function selectUser($userId)
    {
        $this->selectedUser = User::find($userId);
        $this->search = '';
        $this->loadMessages();
    }
    public function loadMessages()
    {
        $this->messages = ModelsChat::where(function ($query) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $this->selectedUser->id);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->selectedUser->id)
                ->where('receiver_id', Auth::id());
        })->get();
    }

    public function submit()
    {
        if (empty($this->newMessage)) {
            return;
        }
        Conversation::create([
            'user_one_id' => Auth::id(),
            'user_two_id' => $this->selectedUser->id,
        ]);
        // Assuming you have a Chat model to handle messages
        $chat = new ModelsChat();
        $chat->sender_id = Auth::id();
        $chat->receiver_id = $this->selectedUser->id;
        $chat->message = $this->newMessage;
        $chat->save();


        $this->messages->push($chat);
        $this->newMessage = '';
        broadcast(new MessageSent($chat));
    }

    public function getListeners()
    {
        return [
            "echo-private:chat.{$this->loginId},MessageSent" => 'loadMessages',
        ];
    }

    public function newChatMessageNotification($message)
    {
        if ($message['sender_id'] == $this->selectedUser->id) {
            $messageobject = ModelsChat::find($message['id']);
            $this->messages->push($messageobject);
        }
    }

    public function render()
    {
        return view('livewire.chat');
    }
    public function checkSearch()
    {
        $this->users = User::where('id', '!=', Auth::id())
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->get();
    }
    public function resetSearch()
    {
        $this->search = ''; // Clear the search input
        $this->users = User::where('id', '!=', Auth::id())->orderBy('name')->get(); // Load all users
    }
}
