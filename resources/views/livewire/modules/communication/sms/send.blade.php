<div>
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content rounded-none">
            <div class="modal-header">
                <h5 class="modal-title font-bold" id="citations-modal">Send SMS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="$emit('nosms')">
                    <span aria-hidden="true">×</span>
                </button>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body" wire:loading.remove>
                @foreach($items as $item)
                    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                        <p class="font-bold">Message</p>
                        <p class="text-sm">{!! $item['call_number'] !!} | {!! $item['collection'] !!} | {!! $item['title'] !!}</p>
                    </div>
                @endforeach
            </div>
            <div class="modal-body" wire:loading.remove>
                <form wire:submit.prevent="send(Object.fromEntries(new FormData($event.target)))">
                    <div class="input-group mb-3">
                        <input type="text" name="phone_number" value="{{ session('phone_number') }}" class="form-control rounded-none" placeholder="Phone Number" aria-label="Phone Number" aria-describedby="Send">
                        <div class="input-group-append">
                            <button class="btn btn-raspberry rounded-none" type="submit" id="Send">
                                Send
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-none" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
