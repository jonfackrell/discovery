<div>
    <i class="fas fa-heart cursor-pointer cursor-pointer mt-2 p-2"
       style="@if($liked) color: red;@endif"
       wire:click="$emitSelf('toggle')"
    ></i>
</div>
