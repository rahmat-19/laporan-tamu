@extends('layout.main')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    #snepshoot {
        width: 360px;
        height: 270px;
        margin-top: 40px;
        position: relative;
        top: 0;
    }

    #parent-camera {
        position: relative;
    }

    #results {
        position: absolute;
        bottom: 40px;
    }

    #take_snp,
    #reset {
        z-index: 2;
        position: relative;
        top: -55px;
    }

    #reset {
        display: none;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script language="JavaScript">
    Webcam.set({
        width: 360,
        height: 350,
        image_format: 'jpeg',
        jpeg_quality: 100
    });

    Webcam.attach('#my_camera');

    function take_snapshot() {
        Webcam.snap(function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img id="snepshoot" src="' + data_uri + '"/>';
        });
    }

    $(document).ready(function() {
        $('.keperluan').select2({
            placeholder: "Keperluan",
            allowClear: true,
            tags: true
        });
        $('.rak').select2({
            placeholder: "Select Rak",
            allowClear: true,
            tags: true
        });

        $('#take_snp').on("click", function() {
            $(this).css('display', 'none');
            $('#reset').css('display', 'inline');
            $('#snepshoot').css('top', '-30px');
        });
        $('#reset').on("click", function() {
            $(this).css('display', 'none');
            $('#take_snp').css('display', 'inline');
            $("#snepshoot").remove();
        });

    });
</script>

@endpush

@section('container')



<div class="container shadow p-4 badan" style="background-color: #e5fff7;">

    <form method="POST" action="{{ route('store.tamu') }}">
        @csrf
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="NAME">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="EMAIL">
                </div>
                <div class="mb-3">
                    <label for="noHP" class="form-label">Phone Number</label>
                    <input type="number" class="form-control" id="noHP" name="noHP" placeholder="exp : 089524554619">
                </div>
                <div class="mb-3">
                    <label for="perusahaan" class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="perusahaan" name="perusahaan" placeholder="exp : PT. Usaha Adi Sanggoro">
                </div>

            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="keperluan" class="form-label">Keperluan</label>
                    <select class="keperluan" name="keperluan[]" multiple="multiple" style="width: 100%;">
                        <option value="Penarikan Server">Penarikan Server</option>
                        <option value="Pemasangan Server">Pemasangan Server</option>
                        <option value="Maintenance Server">Maintenance Server</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="keperluan" class="form-label">Rak</label>
                    <select class="rak" name="rak[]" multiple="multiple" style="width: 100%;">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
                <div class="mb-3 p-0" id="parent-camera">
                    <div id="my_camera"></div>
                    <input type=button value="Take Snapshot" id="take_snp" onClick="take_snapshot()">
                    <input type=button value="Reset" id="reset" onClick="take_snapshot()">

                    <input type="hidden" name="images" class="image-tag">
                    <div id="results"></div>

                </div>

            </div>
        </div>
        <div class="text-center">

            <button type="submit" class="btn btn-primary text-center">SUBMIT</button>
        </div>

    </form>
</div>








@endsection