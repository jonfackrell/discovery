@extends('layouts.app')

@section('content')

<div>

    <div class="container-fluid mt-12">

        <div class="row">

            <div class="col-sm-12 col-md-2 bg-gray-50 pr-0 pt-2">

                <div class="ml-1">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-lg text-black font-open-sans uppercase" href="{{ route('account.likes') }}">Liked</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-lg text-black font-open-sans uppercase" href="{{ route('account.folders') }}">Folders</a>
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


                </div>

            </div>


            <div class="col-sm-12 col-md-10 pl-0">
                <form class="w-full"
                      action="{{ route('account.preferences.update') }}"
                      method="POST"
                >
                @csrf
                    <div class="list card mt-12">
                        <div class="card-header bg-white border-0 py-2 px-4">
                            <h2 class="mb-0">
                                <div class="text-xl toggle text-black inline-block font-bold">
                                    <i class="tool fas fa-cog cursor-pointer mr-2" aria-hidden="true"></i>
                                    Preferences
                                </div>
                                <div class="tool dropdown float-right pt-1" style="display: inline-block;">

                                </div>
                            </h2>
                        </div>

                        <div class="card-body pt-0 pr-0 bg-gray-75">

                            <div class="flex flex-row">
                                <div class="text-gray-700 text-center bg-white px-4 py-2 m-2">
                                    <h3 class="font-bold text-lg mb-4 text-left">
                                        Display
                                    </h3>
                                    <div class="flex flex-row">
                                        <select class="form-control rounded-none flex-shrink w-auto" name="count" id="count">
                                            <option value="10" @if($user->options->count == '10') selected @endif>10</option>
                                            <option value="20" @if($user->options->count == '20') selected @endif>20</option>
                                            <option value="30" @if($user->options->count == '30') selected @endif>30</option>
                                            <option value="40" @if($user->options->count == '40') selected @endif>40</option>
                                            <option value="50" @if($user->options->count == '50') selected @endif>50</option>
                                        </select>
                                        <label for="count" class="pt-2 ml-2 text-left" style="width: 150px">
                                            Results per page
                                        </label>
                                    </div>
                                    <br />
                                    {{--<input type="checkbox"
                                           name="citation_styles[]"
                                           id="abnt"
                                           value="abnt"
                                           @if(in_array('abnt', explode('|', $user->options->citation_styles))) checked @endif
                                    >
                                    <label class="pt-1"
                                           for="abnt">
                                        ABNT
                                    </label>
                                    <br />--}}
                                </div>
                                <div class="text-gray-700 bg-white px-4 py-2 m-2">
                                    <h3 class="font-bold text-lg mb-4 text-left">
                                        Citation Styles
                                    </h3>
                                    <input type="checkbox"
                                           name="citation_styles[]"
                                           id="abnt"
                                           value="abnt"
                                            @if(in_array('abnt', explode('|', $user->options->citation_styles))) checked @endif
                                    >
                                    <label class="pt-1"
                                           for="abnt">
                                        ABNT
                                    </label>
                                    <br />
                                    <input type="checkbox"
                                           name="citation_styles[]"
                                           id="ama"
                                           value="ama"
                                            @if(in_array('ama', explode('|', $user->options->citation_styles))) checked @endif
                                    >
                                    <label class="pt-1"
                                           for="ama">
                                        AMA
                                    </label>
                                    <br />
                                    <input type="checkbox"
                                           name="citation_styles[]"
                                           id="apa"
                                           value="apa"
                                            @if(in_array('apa', explode('|', $user->options->citation_styles))) checked @endif
                                    >
                                    <label class="pt-1"
                                           for="apa">
                                        APA
                                    </label>
                                    <br />
                                    <input type="checkbox"
                                           name="citation_styles[]"
                                           id="chicago"
                                           value="chicago"
                                           @if(in_array('chicago', explode('|', $user->options->citation_styles))) checked @endif
                                    >
                                    <label class="pt-1"
                                           for="chicago">
                                        Chicago/Turabian: Author-Date
                                    </label>
                                    <br />
                                    <input type="checkbox"
                                           name="citation_styles[]"
                                           id="harvard"
                                           value="harvard"
                                           @if(in_array('harvard', explode('|', $user->options->citation_styles))) checked @endif
                                    >
                                    <label class="pt-1"
                                           for="harvard">
                                        Harvard
                                    </label>
                                    <br />
                                    <input type="checkbox"
                                           name="citation_styles[]"
                                           id="mla"
                                           value="mla"
                                           @if(in_array('mla', explode('|', $user->options->citation_styles))) checked @endif
                                    >
                                    <label class="pt-1"
                                           for="mla">
                                        MLA
                                    </label>
                                    <br />
                                    <input type="checkbox"
                                           name="citation_styles[]"
                                           id="turabian"
                                           value="turabian"
                                           @if(in_array('turabian', explode('|', $user->options->citation_styles))) checked @endif
                                    >
                                    <label class="pt-1"
                                           for="turabian">
                                        Chicago/Turabian: Humanities
                                    </label>
                                    <br />
                                    <input type="checkbox"
                                           name="citation_styles[]"
                                           id="vancouver"
                                           value="vancouver"
                                           @if(in_array('vancouver', explode('|', $user->options->citation_styles))) checked @endif
                                    >
                                    <label class="pt-1"
                                           for="vancouver">
                                        Vancouver/ICMJE
                                    </label>
                                </div>
                            </div>

                            <button class="btn btn-outline-secondary rounded-none ml-2" type="submit" id="share-folder-submit">
                                UPDATE
                            </button>
                        </div>

                    </div>


                </form>
            </div>


        </div>

    </div>

</div>




@endsection
