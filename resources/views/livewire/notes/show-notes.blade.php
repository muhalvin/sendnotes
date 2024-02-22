<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    public function delete($noteId)
    {
        $note = Note::where('id', $noteId)->firstOrFail();
        $this->authorize('delete', $note);
        $note->delete();
    }

    public function with(): array
    {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date', 'asc')->get(),
        ];
    }
}; ?>

<div>
    <div class="space-y-2">
        @if ($notes->isEmpty())
            <div class="text-center">
                <p class="text-xl font-bold">No notes yet</p>
                <p class="text-sm">Click the button below to add your first note</p>
                <x-button primary icon-right="plus" class="mt-6" href="{{ route('notes.create') }}" wire:navigate>
                    Create note
                </x-button>
            </div>
        @else
            <x-button primary icon-right="plus" class="mb-12" href="{{ route('notes.create') }}" wire:navigate>
                Create note
            </x-button>

            <div class="grid grid-cols-3 gap-4">
                @foreach ($notes as $note)
                    <x-card wire:key='{{ $note->id }}'>
                        <div class="flex justify-between ">
                            <div>
                                <a href="{{ route('notes.edit', $note) }}" wire:navigate class="text-xl font-bold hover:text-blue-500 hover:underline">
                                    {{ Str::limit($note->title, 20) }}
                                </a>
                                <p class="text-xs">{{ Str::limit($note->body, 40) }}</p>
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($note->send_date)->format('d M Y') }}
                            </div>
                        </div>
                        <div class="flex items-end justify-between mt-4 space-x-1">
                            <p class="text-xs">Recipient:
                                <span class="font-semibold">{{ $note->recipient }}</span>
                            </p>
                            <div>
                                <x-button.circle icon="eye"></x-button.circle>
                                <x-button.circle icon="trash" wire:click="delete('{{ $note->id }}')"></x-button.circle>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif
    </div>
</div>
