<div>
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content rounded-none">
            <div class="modal-header">
                <h5 class="modal-title font-bold" id="citations-modal">Citations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="$emit('nocite')">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-8">
                        <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                            <p>Always make any necessary corrections before using. Pay special attention to personal names, capitalization, and dates.</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <a href="http://www.refworks.com/express/ExpressImport.asp?vendor=McKay%20Library&filter=RIS%20Format&url={{ urlencode( route('export.refworks', ['records' => $index . ':' . $database . ':' . $an])) }}"
                           class="btn btn-raspberry rounded-none"
                           target="export">
                            Export to RefWorks
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal-body" wire:loading.remove>
                @foreach($citations as $citation)
                    <div class="row py-3">
                        <div class="col-2 font-bold">
                            {!! $citation['Label'] !!}
                        </div>
                        <div class="col-10">
                            <p style="margin-left: 40px; text-indent: -40px;">
                                {!! $citation['SectionLabel'] !!}
                            </p>
                            <p style="line-height: 2; margin-left: 40px; text-indent: -40px;">
                                {!! $citation['Data'] !!}
                            </p>
                        </div>
                    </div>
                    @if(!$loop->last) <hr/> @endif
                @endforeach
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
