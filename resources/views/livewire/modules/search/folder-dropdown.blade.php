<div class="mr-2 cursor-pointer" style="display: inline-block;">
    <div class="dropdown" style="display: inline;">
        <i class="fas fa-folder"
           class="btn btn-secondary dropdown-toggle"
           id="folders_{{ $an }}"
           type="button"
           data-toggle="dropdown"
           aria-haspopup="true"
           aria-expanded="false"
        ></i>
        <div class="dropdown-menu dropdown-menu-right rounded-none" aria-labelledby="folders_{{ $an }}" style="padding-bottom: 0px;">

                <div class="folders ml-2">
                    <ul>
                        @foreach ($folders as $key => $folder)
                            <li>
                                <div class="cursor-pointer p-1" wire:click="toggleFolder('{{ $folder->id }}')">
                                    @if(in_array($folder->id, $user_folders))
                                        <i class="far fa-check-square"></i>
                                    @else
                                        <i class="far fa-square"></i>
                                    @endif
                                    {{ $folder->name }}
                                </div>
                                <ul class="ml-6">
                                    @foreach ($folder->subFolders as $subFolder)
                                        @include('livewire.modules.search.sub-folder', ['sub_folder' => $subFolder])
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                        @if(!empty($shares) && count($shares) > 0)
                            <li>
                                <div class="p-1">
                                    <i class="fas fa-share-alt"></i>
                                    Shared
                                </div>
                                <ul class="folders ml-2">
                                    @foreach ($shares as $key => $folder)
                                        <li>
                                            <div class="cursor-pointer p-1" wire:click="toggleFolder('{{ $folder->id }}')">
                                                @if(in_array($folder->id, $user_folders))
                                                    <i class="far fa-check-square"></i>
                                                @else
                                                    <i class="far fa-square"></i>
                                                @endif
                                                {{ $folder->name }}
                                            </div>
                                            <ul class="ml-6">
                                                @foreach ($folder->subFolders as $subFolder)
                                                    @include('livewire.modules.search.sub-folder', ['sub_folder' => $subFolder])
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    </ul>

                </div>
            <hr />
            <div class="m-3" style="min-width: 275px;">
                <form wire:submit.prevent="$emitSelf('folderCreated', Object.fromEntries(new FormData($event.target)))">
                    <label for="folder_name">Add new folder</label>
                    <div class="input-group mb-3 rounded-none">
                        <input type="text" class="form-control rounded-none" id="folder_name" name="folder_name" placeholder="New Folder" aria-label="New Folder" aria-describedby="button-addon2"><br />
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary rounded-none" type="submit" id="button-addon2">
                                ADD
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
