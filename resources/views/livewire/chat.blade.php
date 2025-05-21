<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Chat') }}</flux:heading>
       
        <flux:separator variant="subtle" />
    </div>

    <div>

        <div class="flex h-[550px] text-sm border rounded-xl shadow overflow-hidden bg-white">

            <div class="w-1/4 border-r bg-gray-50">
                <div class="p-4 font-bold text-gray-700 border-b">Users</div>

                <div class="p-3">
                    <div class="flex items-center gap-2">
                        <button wire:click="resetSearch"
                            class="px-2 py-2 bg-gray-300 rounded hover:bg-gray-400 text-sm">
                            All
                        </button>
                        <input type="text" wire:model="search" wire:keydown="checkSearch"
                            class="flex-grow p-2 border rounded" placeholder="Search users by name/email..." />

                    </div>
                </div>
              
                <div class="divide-y">
                    @forelse ($users as $user)
                        <div wire:click="selectUser({{ $user->id }})"
                            class="p-3 cursor-pointer hover:bg-blue-100 transition {{ $selectedUser && $selectedUser->id === $user->id ? 'bg-blue-100 font-semibold' : '' }}">
                            <div class="text-gray-800">{{ $user->name }}</div>
                            <div class="text-xs text-gray-500">{{ $user->email }}</div>
                        </div>
                    @empty
                        <div class="p-3 text-gray-500 text-sm">
                            No users found.
                        </div>
                    @endforelse
                </div>

            </div>
            <div class="w-3/4 flex flex-col">
                <div class="p-4 border-b bg-gray-50">
                    <div class="text-lg font-semibold text-gray-800">{{ $selectedUser->name }}</div>
                    <div class="test-xs text-gray-500">{{ $selectedUser->email }}</div>
                </div>

                <div class="flex-1 p-4 overflow-auto space-y-2 bg-gray-50">

                    @foreach ($messages as $message)
                        <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }} ">
                            <div
                                class="max-w-xs px-4 py-2 rounded-2xl shadow {{ $message->sender_id === auth()->id() ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800' }}">
                                {{ $message->message }}
                            </div>
                        </div>
                    @endforeach


                </div>
                <form wire:submit="submit" class="p-4 border-t bg-white flex items-center gap-2">
                    <input wire:model="newMessage" type="text"
                        class="flex-1 border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline"
                        placeholder="Type your message...">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-full">Send</button>

                </form>
            </div>
        </div>
    </div>
</div>
