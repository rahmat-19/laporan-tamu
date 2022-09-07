<div class="container shadow  py-4" style="background-color: #e5fff7; ">
    <div class="row justify-content-md-center">
        <div class="row mt-3 mb-3 p-0">
            <div class="col">
                &nbsp;
            </div>
            <div class="col">
                <div class="wrap">
                    <div class="search">
                        <input type="text" class="searchTerm" placeholder="Search By Eamil Or Phone Number" wire:model="search">
                        <button type="submit" class="searchButton">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @if($search)
        @if(!$datas->count())
        <div class="text-center my-5">

            <p class="text-center">Tidak di Temukan <strong><a href="{{route('masuk.tamu')}}">Daftar Sebagai Tamu</a></strong></p>
        </div>
        @endif
        @foreach($datas as $data)
        <div class="col col-md-auto mb-3 mt-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="image">
                        <img src="{{ Storage::url('public/uploads/'.$data->images) }}" class="rounded" width="155">
                    </div>
                    <div class="ms-3 w-100">
                        <h4 class="mb-0 mt-0 name-title">{{$data->name}}</h4>
                        <span class="text-muted perusahaan-title">{{$data->perusahaan}}</span>
                        <div class="p-2 mt-2 bg-primary d-flex flex-column justify-content-between rounded text-white stats">
                            <div class="d-flex flex-column">
                                <span class="info-title">Email</span>
                                <span class="number1">{{$data->email}}</span>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="info-title">Phone Number</span>
                                <span class="number1">{{$data->noHP}}</span>
                            </div>

                        </div>
                        <div class="container mt-2">
                            <div class="row ">
                                <div class="col-md-auto  m-0 me-1 p-0">
                                    @if($data->status)
                                    <a href="{{Route('outGuest.tamu', $data->id)}}" class="btn btn-sm btn-primary w-100">Keluar</a>
                                    @endif
                                </div>
                                <div class="col m-0 p-0">
                                    <button class="btn btn-sm  w-100 @if(!$data->status) btn-primary @else btn-outline-primary @endif" wire:click="keperlaun({{$data->id}})" @if($data->status) disabled @endif>Masuk</button>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    @livewire('search-tamu-from-login')
</div>