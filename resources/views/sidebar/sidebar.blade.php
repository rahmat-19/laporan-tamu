<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <a href="#" class="nav_logo gambar">
                <img src="/images/sengked_logo.png" class="logo" id="logo" alt="">
                <span class="nav_logo-name"><img src="/images/sengked.png" class="logo-name" id="logo-img" alt=""></span>
            </a>

            <div class="nav_list">

                <a href="{{Route('masuk.tamu')}}" class="nav_link  {{Request::is('/') ? 'active' : ''}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="antiquewhite" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span class="nav_name">Masuk Tamu</span>
                </a>


                <a href="{{Route('create.tamu')}}" class="nav_link {{Request::is('tambah-tamu*') ? 'active' : ''}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span class="nav_name">Tambah Tamu</span>
                </a>





            </div>
        </div>
        <div class="px-3">

        </div>
    </nav>
</div>