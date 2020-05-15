<div class="container-fluid bg-gray-50 pt-4">
    <div class="container">
        <form wire:submit.prevent="search(Object.fromEntries(new FormData($event.target)))">
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <select class="custom-select rounded-none"
                            id="field"
                            name="field"
                            style="height: 3.1rem">
                        <option value="AU" @if($field == 'AU') selected @endif>Author</option>
                        <option value="KW"  @if($field == 'KW' || empty($field)) selected @endif>Keyword</option>
                        <option value="TI" @if($field == 'TI') selected @endif>Title</option>
                    </select>
                </div>
                <input type="search"
                       name="term"
                       value="{{ $term }}"
                       class="form-control p-4 font-black rounded-none"
                       placeholder="Search..."
                       aria-label="Search"
                       aria-describedby="submit-search">
                <div class="input-group-append">
                    <div class="btn btn-secondary rounded-none"
                            wire:click.prevent="$emit('toggleAvancedSearch');"
                            title="Advanced Search">
                        <i class="fas fa-caret-down" style="padding-top: 12px;"></i>
                    </div>
                    <button class="btn btn-raspberry rounded-none" type="submit" id="submit-search">
                        {{--<i class="fas fa-search"></i>--}} SEARCH
                    </button>
                </div>
            </div>

            {{--<input type="checkbox" id="fullText"  wire:model="fullText" value="true">
            <label for="fullText"> Full Text</label>--}}

            @if($advanced == 'true')
                <div class="row">
                    <div class="col-12">
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <select class="custom-select rounded-none"
                                        id="field_2"
                                        name="field_2"
                                        style="height: 3.1rem">
                                    @foreach(collect($info['AvailableSearchCriteria']['AvailableSearchFields']) as $option)
                                        <option value="{{ $option['FieldCode'] }}" @if($option['FieldCode'] == $field_2 || ($option['FieldCode'] == 'KW' && empty($field_2))) selected @endif>
                                            {{ ($option['Label'] != 'All Text') ? $option['Label'] : 'Any Field' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="search"
                                   name="term_2"
                                   value="{{ $term_2 }}"
                                   class="form-control p-4 font-black rounded-none"
                                   placeholder="Search..."
                                   aria-label="Search"
                                   aria-describedby="submit-search">
                            <div class="input-group-append">

                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <select class="custom-select rounded-none"
                                        id="field_3"
                                        name="field_3"
                                        style="height: 3.1rem">
                                    @foreach(collect($info['AvailableSearchCriteria']['AvailableSearchFields']) as $option)
                                        <option value="{{ $option['FieldCode'] }}"  @if($option['FieldCode'] == $field_3 || ($option['FieldCode'] == 'KW' && empty($field_3))) selected @endif>
                                            {{ ($option['Label'] != 'All Text') ? $option['Label'] : 'Any Field' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="search"
                                   name="term_3"
                                   value="{{ $term_3 }}"
                                   class="form-control p-4 font-black rounded-none"
                                   placeholder="Search..."
                                   aria-label="Search"
                                   aria-describedby="submit-search">
                            <div class="input-group-append">

                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                <label class="font-bold pt-2" for="type">Source Type</label>
                            </div>
                            <div class="col-9">
                                <select class="form-control rounded-none" name="type" id="type">
                                    <option value="" @if($type == 'any' || empty($type)) selected @endif>Any</option>
                                    <option value="Academic Journals" @if($type == 'Academic Journals') selected @endif>Articles</option>
                                    <option value="Audio" @if($type == 'Audio') selected @endif>Audio</option>
                                    <option value="Audiobooks" @if($type == 'Audiobooks') selected @endif>Audiobooks</option>
                                    <option value="Books" @if($type == 'Books') selected @endif>Books</option>
                                    <option value="Dissertations" @if($type == 'Dissertations') selected @endif>Thesis & Dissertations</option>
                                    <option value="Maps" @if($type == 'Maps') selected @endif>Maps</option>
                                    <option value="Music Scores" @if($type == 'Music Scores') selected @endif>Music Scores</option>
                                    <option value="News" @if($type == 'News') selected @endif>Newspapers</option>
                                    <option value="Print Books" @if($type == 'Print Books') selected @endif>Print Books</option>
                                    <option value="Videos" @if($type == 'Videos') selected @endif>Video</option>
                                </select>
                            </div>
                        </div>
                    </div>{{--
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                <label class="font-bold pt-2" for="collection">Collection</label>
                            </div>
                            <div class="col-9">
                                <select class="form-control rounded-none" name="collection" id="collection">
                                    <option value="" @if(empty($collection)) selected @endif> -- Select a Collection -- </option>
                                    @foreach(collect($info['AvailableSearchCriteria']['AvailableLimiters'])->where('Id', 'GZ')->first()['LimiterValues'] as $option)
                                        <option value="{{ $option['Value'] }}" @if($option['Value'] == $collection) selected @endif>{{ $option['Value'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>--}}
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                <label class="font-bold pt-2" for="language">Language</label>
                            </div>
                            <div class="col-9">
                                <select class="form-control rounded-none" name="language" id="language">
                                    <option value="" @if(empty($language)) selected @endif> -- Select a Language -- </option>
                                    @foreach(collect($info['AvailableSearchCriteria']['AvailableLimiters'])->where('Id', 'LA99')->first()['LimiterValues'] as $option)
                                        <option value="{{ $option['Value'] }}" @if($option['Value'] == $language) selected @endif>{{ $option['Value'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                <label class="font-bold pt-2" for="count">Results Per Page</label>
                            </div>
                            <div class="col-9">
                                <select class="form-control rounded-none" name="count" id="count">
                                    <option value="10" @if($count == 10) selected @endif>10</option>
                                    <option value="20" @if($count == 20) selected @endif>20</option>
                                    <option value="30" @if($count == 30) selected @endif>30</option>
                                    <option value="40" @if($count == 40) selected @endif>40</option>
                                    <option value="50" @if($count == 50) selected @endif>50</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                <label class="font-bold pt-2" for="period">Date Range</label>
                            </div>
                            <div class="col-9">
                                <select class="form-control rounded-none" name="period" id="period">
                                    <option value="" @if(empty($period)) selected @endif>All Years</option>
                                    <option value="1" @if($period == 1) selected @endif>This Year</option>
                                    <option value="2" @if($period == 2) selected @endif>Last 2 Years</option>
                                    <option value="5" @if($period == 3) selected @endif>Last 5 Years</option>
                                    <option value="10" @if($period == 4) selected @endif>Last 10 Years</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                <label class="font-bold pt-2" for="mode">Search Mode</label>
                            </div>
                            <div class="col-9">
                                <select class="form-control rounded-none" name="mode" id="mode">
                                    <option value="bool" @if($mode == 'bool') selected @endif>Boolean / Phrase</option>
                                    <option value="all" @if($mode == 'all') selected @endif>Find all my search terms</option>
                                    <option value="any" @if($mode == 'any') selected @endif>Find any of my search terms</option>
                                    <option value="smart" @if($mode == 'smart' || empty($mode)) selected @endif>SmartText Searching</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <br />
            @endif

            <div class="row">
                <div class="col-1">

                </div>
                <div class="col-11">
                    <span>
                        <input type="checkbox"
                               id="peerReviewed"
                               wire:model="peerReviewed"
                               value="true">
                        <label class="pt-1 align-middle"
                               for="peerReviewed">
                            Peer Reviewed
                        </label>
                    </span>
                    <span class="ml-4">
                        <input type="checkbox"
                               id="available"
                               wire:model="available"
                               value="true">
                        <label class="pt-1 align-middle"
                               for="available">
                            Available in Library Collection
                        </label>
                    </span>
                    @if($advanced == 'true')
                        <span class="ml-4">
                            <input type="hidden" name="thesaurus" value="false"/>
                            <input type="checkbox"
                                   id="thesaurus"
                                   wire:model="thesaurus"
                                   value="true"
                            >
                            <label class="pt-1 align-middle"
                                   for="thesaurus">
                                Apply Related Words
                            </label>
                        </span>
                        <span class="ml-4">
                            <input type="hidden" name="rel_subjects" value="false"/>
                            <input type="checkbox"
                                   id="rel_subjects"
                                   wire:model="rel_subjects"
                                   value="true"
                            >
                            <label class="pt-1 align-middle"
                                   for="rel_subjects">
                                Apply Related Subjects
                            </label>
                        </span>
                    @endif
                </div>
            </div>


        </form>
    </div>
</div>
