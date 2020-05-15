<li>
    <div class="cursor-pointer p-1" wire:click="toggleFolder('{{ $sub_folder->id }}')">
        @if(in_array($sub_folder->id, $user_folders))
            <i class="far fa-check-square"></i>
        @else
            <i class="far fa-square"></i>
        @endif
        {{ $sub_folder->name }}
    </div>
    @if ($sub_folder->folders)
        <ul class="ml-6">
            @foreach ($sub_folder->folders as $subFolder)
                @include('livewire.modules.search.sub-folder', ['sub_folder' => $subFolder])
            @endforeach
        </ul>
    @endif
</li>
