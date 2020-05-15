<div>

    <div>
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content rounded-none">
                <div class="modal-header">
                    <h5 class="modal-title font-bold" id="citations-modal">MARC Record @if($record) for #{{ $record['key'] }}@endif</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="$emit('hideMarcRecord')">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" wire:loading.remove>
                    @if($record)
                        @foreach($record['fields']['bib']['fields'] as $field)
                            <div class="row">
                                <div class="col-1">
                                    {{ $field['tag'] }}
                                </div>
                                <div class="col-1">
                                    @if(array_key_exists('inds', $field))
                                        {{ $field['inds'] }}
                                    @endif
                                </div>
                                <div class="col-10">
                                    @foreach($field['subfields'] as $subfields)
                                        ‡{{ implode("", $subfields) }}
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="modal-body loading-placeholder" wire:loading style="width: 90%;">
                    <div class="row">
                        <div class="col-2">
                            <div class="text"></div>
                        </div>
                        <div class="col-10">
                            <div style="margin-left: 40px; text-indent: -40px;">
                                <div class="text line cite"></div>
                                <div class="text line cite"></div>
                                <div class="text line cite"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-none" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
