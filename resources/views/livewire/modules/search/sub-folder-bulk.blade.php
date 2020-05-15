<li>
    <div class="cursor-pointer p-1 font-normal" wire:click="toggleFolder('{{ $sub_folder->id }}')">
        <i class="far fa-square"></i>
        {{ $sub_folder->name }}
    </div>
    @if ($sub_folder->folders)
        <ul class="ml-6">
            @foreach ($sub_folder->folders as $subFolder)
                @include('livewire.modules.search.sub-folder-bulk', ['sub_folder' => $subFolder])
            @endforeach
        </ul>
    @endif
</li>
