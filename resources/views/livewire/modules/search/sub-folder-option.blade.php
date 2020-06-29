
@if ($sub_folder->folders)
    @if($folder->id != $sub_folder->id)
        <option value="{{ $sub_folder->id }}" @if($folder->id == $sub_folder->id) selected @endif >{{ $sub_folder->name }}</option>
    @endif
    @foreach ($sub_folder->folders as $subFolder)
        @include('livewire.modules.search.sub-folder-option', ['sub_folder' => $subFolder])
    @endforeach
@endif

