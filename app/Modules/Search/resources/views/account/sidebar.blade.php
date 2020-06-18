<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link text-lg text-black font-open-sans uppercase" href="{{ route('search') }}">Search</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-lg text-black font-open-sans uppercase" href="{{ route('account.likes') }}">Liked</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-lg text-black font-open-sans uppercase" href="{{ route('account.folders') }}">Folders</a>
        @if(!empty($folders))
            <div id="folder-nav">
                <ul class="folders ml-4">
                    @foreach ($folders as $key => $folderNav)
                        <li>
                            <div class="cursor-pointer p-1" wire:click="$set('activeFolder', {{ $folderNav->id }})">
                                <i class="far fa-folder"></i>
                                {{ $folderNav->name }}
                            </div>

                            <ul class="ml-2">
                                @foreach ($folderNav->subFolders as $subFolder)
                                    @include('livewire.modules.search.sub-folder-navigation', ['sub_folder' => $subFolder])
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                    @if(count($shares) > 0)
                        <li>
                            <div class="p-1">
                                <i class="fas fa-share-alt"></i>
                                Shared
                            </div>
                            <ul class="folders ml-2">
                                @foreach ($shares as $key => $folderNav)
                                    <li>
                                        <div class="cursor-pointer p-1" wire:click="$set('activeFolder', {{ $folderNav->id }})">
                                            <i class="far fa-folder"></i>
                                            {{ $folderNav->name }}
                                        </div>

                                        <ul class="ml-2">
                                            @foreach ($folderNav->subFolders as $subFolder)
                                                @include('livewire.modules.search.sub-folder-navigation', ['sub_folder' => $subFolder])
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        @endif
    </li>
    <li class="nav-item">
        <a class="nav-link text-lg text-black font-open-sans uppercase" href="#">Recently Viewed</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-lg text-black font-open-sans uppercase" href="{{ route('account.preferences') }}">Preferences</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-lg text-black font-open-sans uppercase" href="#">Personal Info</a>
    </li>
</ul>
