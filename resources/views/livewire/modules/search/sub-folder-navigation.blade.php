<li>
    <div class="cursor-pointer p-1" wire:click="$set('activeFolder', {{ $sub_folder->id }})">
        <i class="far fa-folder"></i>
        {{ $sub_folder->name }}
    </div>
    @if ($sub_folder->folders)
        <ul class="ml-2">
            @foreach ($sub_folder->folders as $subFolder)
                @include('livewire.modules.search.sub-folder-navigation', ['sub_folder' => $subFolder])
            @endforeach
        </ul>
    @endif
</li>
