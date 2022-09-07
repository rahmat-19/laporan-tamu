@extends('layout.main')
@push('styles')
@livewireStyles
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="/css/card.css">
<link rel="stylesheet" href="/css/search.css">
@endpush

@push('scripts')
@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    window.addEventListener('openmodal', event => {
        $("#ModalUpdate").modal('show');

    })
    window.addEventListener('closemodal', event => {
        $("#ModalUpdate").modal('hide');

    })
</script>

@endpush
<!-- row-cols-1 row-cols-sm-2 row-cols-md-3 g-3  -->
@section('container')

<div class="container shadow " style="background-color: #e5fff7;">
    <div class="row justify-content-md-center">
        @livewire('search-tamu-login')

    </div>

</div>




@endsection