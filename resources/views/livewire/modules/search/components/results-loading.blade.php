<div>
<script>
    var items = [1,2,3,4,5];
</script>
<div id="loading-container" class="card-body loading-placeholder rounded-none pt-0 pr-0" style="min-height: 600px; width: 100%;" wire:loading x-data="items">
    <template x-for="item in items" :key="item">
        <div class="summary card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-1">
                        <input type="checkbox" class="resource-selection-placeholder"/>
                        <div class="image">
                            <div class="embed-responsive embed-responsive-16by9"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-11">
                        <div class="row">
                            <div class="col-md-10">
                                <span class="category text link"></span>
                                <h4 class="text"></h4>
                            </div>
                            <div class="col-md-2 lg:text-right">
                                <i class="mr-2 cursor-pointer fas fa-heart"
                                ></i>
                                <i class="mr-2 cursor-pointer fas fa-folder"
                                   class="btn btn-secondary"
                                   type="button"
                                ></i>
                                <i class="mr-2 cursor-pointer fas fa-quote-right"
                                ></i>
                                <i class="mr-2 cursor-pointer fas fa-ellipsis-v"
                                   type="button"
                                ></i>
                            </div>
                        </div>
                        <div class="text line"></div>
                        <div class="text line"></div>
                        <div class="text line"></div>
                        <p class="card-text">
                            <a href="#" class="btn btn-raspberry rounded-none">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </template>

</div>
</div>
