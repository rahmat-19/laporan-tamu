@extends('layout.main')
@push('styles')
<link rel="stylesheet" href="/css/card.css">
@endpush

@push('scripts')
@endpush

@section('container')


<div class="container shadow " style="background-color: #e5fff7;">
    <div class="row justify-content-md-center">
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
                        <div class="button mt-2 d-flex flex-row align-items-center">
                            <a href="{{Route('outGuest.tamu', $data->id)}}" class="btn btn-sm btn-outline-primary w-100">Keluar</a>
                            <!-- <button class="btn btn-sm btn-primary w-100 ms-2">Follow</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection