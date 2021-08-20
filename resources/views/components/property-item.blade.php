<div>
    <div class="card my-4">
        <div class="row">
            <div class="col-md-5">
                <img style="max-height: 300px!important;" src="{{$property->firstImage->getUrl()}}" alt=""
                     class="h-100 w-100 card-img">
            </div>
            <div class="col-md-7 card-body" style="padding-right: 30px">
                <div class="d-flex justify-content-between">
                    <div class="card-title text-left fs-4" style="color: green">
                        ${{$property->monthly_rent}}
                    </div>

                    <div>
                        <i class="bi-heart" style="color: red;cursor: pointer;font-size: 1.5em"></i>
                    </div>
                </div>

                <div class="d-flex my-lg-2 justify-content-between">
                    <div>

                        <span class="mx-2">
                            {{$property->bedrooms}}
                            <i class="bi-bell bi-align-top" style="font-size:1.4em"></i>
                        </span>

                        <span class="mx-2">
                            {{$property->bathrooms}}
                            <i class="bi-badge-wc" style="font-size:1.4em"></i>
                        </span>
                    </div>
                    <div>
                        {{$property->created_at->diffForHumans()}}
                    </div>
                </div>

                <div class="card-text mt-md-1">
                    {{$property->address}}
                </div>

                <div class="text-muted">
                    {{$property->location}}
                </div>

                <div class="m-md-1 m-lg-3">
                    @foreach($property->features as $feature)

                        @if($loop->index === 3)
                            <span class="badge bg-primary text-truncate fw-light text-capitalize"
                                  style="max-width: 75px">
                                +{{$loop->count - ($loop->index+1) +1}}
                            </span>
                            @break(true);
                        @endif

                        <span class="badge bg-primary text-truncate fw-light text-capitalize"
                              data-bs-toggle="tooltip" data-bs-placement="top" title="{{$feature->name}}"
                              style="max-width: 75px;cursor: default">
                                {{$feature->name}}
                        </span>

                    @endforeach
                </div>

                <div class="text-primary d-flex justify-content-around">
                    <span>
                        <i class="bi-telephone" style="font-size: 1.2em"></i>
                        {{$property->user->phone}}
                    </span>
                    <span>
                        <i class="bi-envelope" style="font-size: 1.2em"></i>
                        {{$property->user->email}}
                    </span>
                </div>

                <div class="text-end mt-2 pt-2 border-top border-secondary border-0">
                    <button class="btn btn-primary mx-lg-1">Request a tour</button>
                    <button class="btn btn-primary mx-lg-1">Message</button>
                </div>

            </div>
        </div>

    </div>
</div>

