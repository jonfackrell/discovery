<div class="inline-block">
    <input type="checkbox" class="all-resource-selection" onclick="selectAll(this)"/>
    @if($selected)
        <div class="inline-block">
            {{ count($selected) }}
        </div>
    @endif
    <div class="dropdown inline-block">
        <i class="fas fa-ellipsis-v px-2 cursor-pointer"
           type="button"
           id="bulk_actions"
           data-toggle="dropdown"
           aria-haspopup="true"
           aria-expanded="false"
        ></i>
        <div class="dropdown-menu rounded-none" aria-labelledby="bulk_actions">
            <div class="dropdown-item dropdown-toggle rounded-none"
                 id="bulk_folders"
                 data-toggle="dropdown"
                 aria-haspopup="true"
                 aria-expanded="false"
            >

            <i class="fas fa-folder"

            ></i> Save to Folder
            </div>
            <div class="dropdown-menu dropdown-menu-left rounded-none" aria-labelledby="bulk_folders" style="padding-bottom: 0px;">
                <div class="folders ml-2">
                    <ul>
                        @foreach ($folders as $key => $folder)
                            <li>
                                <div class="cursor-pointer p-1 font-normal" wire:click="toggleFolder('{{ $folder->id }}')">
                                    <i class="far fa-square"></i>
                                    {{ $folder->name }}
                                </div>
                                <ul class="ml-6">
                                    @foreach ($folder->subFolders as $subFolder)
                                        @include('livewire.modules.search.sub-folder-bulk', ['sub_folder' => $subFolder])
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
                                            <div class="cursor-pointer p-1 font-normal" wire:click="toggleFolder('{{ $folder->id }}')">
                                                <i class="far fa-square"></i>
                                                {{ $folder->name }}
                                            </div>
                                            <ul class="ml-6">
                                                @foreach ($folder->subFolders as $subFolder)
                                                    @include('livewire.modules.search.sub-folder-bulk', ['sub_folder' => $subFolder])
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
                <div class="p-3" style="min-width: 275px;">
                    <form wire:submit.prevent="$emitSelf('folderCreated', Object.fromEntries(new FormData($event.target)))">
                        <label for="folder_name">Add new folder</label>
                        <div class="input-group mb-3 rounded-none">
                            <input type="text" class="form-control rounded-none" id="folder_name" name="folder_name" placeholder="New Folder" aria-label="New Folder" aria-describedby="button-addon2"><br />
                            <div class="input-group-append rounded-none">
                                <button class="btn btn-outline-secondary rounded-none" type="submit" id="button-addon2">
                                    ADD
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            @if(count($selected) > 0)
                <a href="http://www.refworks.com/express/ExpressImport.asp?vendor=McKay%20Library&filter=RIS%20Format&url={{ urlencode( route('export.refworks', ['records' => implode('|', array_keys($selected))])) }}"
                   class="dropdown-item"
                   target="export">
                    Export to RefWorks
                </a>
            @endif
        </div>
    </div>

</div>

@push('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            window.livewire.on('resetSelectAll', function(){

                // Remember checked items
                var selected = @this.get('selected');
                $('.resource-selection').each(function(){
                    var $checkbox = $(this);
                    if((Object.keys(selected)).includes($checkbox.val())){
                        $checkbox.prop('checked', true);
                    }
                });
            });
        })
    </script>
@endpush
