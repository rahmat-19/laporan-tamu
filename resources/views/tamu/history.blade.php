@extends('layout.main')
@push('styles')
@endpush

@push('scripts')
@endpush

@section('container')


<div class="container shadow badan" style="background-color: #e5fff7;">
    <div class="row justify-content-md-center table-responsive p-5">
        <div class="buton-export">

            <a href="{{Route('historyExport.tamu')}}" class="btn bg-success mb-3">Export</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">perusahaan</th>
                    <th scope="col">Keperluan</th>
                    <th scope="col">Email</th>
                    <th scope="col">Waktu Masuk</th>
                    <th scope="col">Waktu Keluar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$data->user_tamus->name}}</td>
                    <td>{{$data->user_tamus->perusahaan}}</td>

                    <td>
                        <ul class="list-group" style="list-style: none;">
                            @foreach($data->keperluan as $sn)
                            <li>{{$sn}}</li>
                            @endforeach

                        </ul>
                    </td>
                    <td>{{$data->user_tamus->email}}</td>
                    <td>{{(new DateTime($data->masuk))->format('M d, Y H:i')}}</td>
                    <td>@if(!$data->keluar) <span class="badge bg-danger">Belum Keluar</span> @else {{(new DateTime($data->keluar))->format('M d, Y H:i')}} @endif</td>
                </tr>
                @endforeach

            </tbody>
        </table>
        @foreach($datas as $data)

        @endforeach
    </div>

</div>
@endsection