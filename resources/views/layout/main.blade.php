<!-- <!doctype html> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form | User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/sidebar.css">
    @stack('styles')


</head>

<body id="body-pd">
    <header class="header hed" id="header">
        <div class="header_toggle">
            <img src="/images/icon/menu.svg" alt="" id="header-toggle">
        </div>



        <div class="flex-shrink-0 dropdown px-3 border-start">

            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">

            </ul>
        </div>
    </header>
    <div class="title-header">
        <h3>&nbsp;</h3>
    </div>
    @include('sidebar.sidebar')

    @yield('container')





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script src="/js/mian.js"></script>


    @stack('scripts')

</body>

</html>