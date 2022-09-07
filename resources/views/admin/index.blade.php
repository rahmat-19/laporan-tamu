@extends('layout.main')
@push('styles')
@endpush

@push('scripts')
<script>
    $(document).on('click', '.open_modal_show', function() {
        let url = $(this).data('url');
        let tour_id = $(this).val();
        $.get(url, function(data) {
            // $('#keterangan').html(data.keterangan);
            // $('#waktu').text(new Date(data.tanggalMasuk).toDateString());
            // if (data.type) {
            //     $('#type').text(data.type)
            // }
            // if (data.pemilik) {
            //     $('#pemilik').text(`Pemilik : ${data.pemilik}`)
            // }
            // $('#unit').text(data.unit);
            // // $('#pnj').text(data.unit);
            // $('#device').text(data.device);
            // $('#merek').text(data.merek);
            // if (data.gambar) {

            $('#image-bar').attr('src', "{{ Storage::url('public/uploads/') }}" + data.images);
            // } else {
            // $('#image-bar').attr('src', "images/imagesNotFound.jpg");

            // }
            $('#modalShow').modal('show');
        })
    });
</script>
@endpush

@section('container')
<div class="container shadow p-4 badan" style="background-color: #e5fff7;">
    <div class="row justify-content-md-center table-responsive p-5">


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nomor Telpon</th>
                    <th scope="col">Perusahaan</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$data->name}}</td>
                    <td>{{$data->perusahaan}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->noHP}}</td>
                    <td>

                        <button class="open_modal_show" value="{{$data->id}}" data-url="{{Route('userInformation.show',$data->id)}}" type="button" style="background-color: transparent; border: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#a98a0c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                        <form method="post" class="d-inline" action="{{route('userInformation.destroy',$data->id)}}">
                            @method('delete')
                            @csrf
                            <button type="submit" style="background-color: transparent; border: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-x">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="8.5" cy="7" r="4"></circle>
                                    <line x1="18" y1="8" x2="23" y2="13"></line>
                                    <line x1="23" y1="8" x2="18" y2="13"></line>
                                </svg>

                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        @foreach($datas as $data)

        @endforeach
    </div>
</div>


<div class="modal fade" id="modalShow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="staticBackdropLabel"><strong id="device"></strong> : <span id="merek"></span></h5> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="fs-5" id="type"></p>
                <div class="card mb-3 border-0" style="max-width: 540px;">
                    <div class="row g-0">
                        <img src="" id="image-bar" class="card-img-top rounded mx-auto d-block" style="width:20rem;">
                        <div>
                            <div class="card-body">
                                <!-- <p class="fs-5" id="pemilik"></p> -->
                                <!-- <p class="fs-5" id="pnj"></p> -->
                                <!-- <p class="card-text"><small class="text-muted" id="waktu"></small></p> -->
                                <!-- <h5 class="mb-4">Jumlah : <strong id="unit"></strong> unit</h5> -->
                                <!-- <p class="card-text" id="keterangan"></p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection