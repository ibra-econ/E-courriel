<section class="h-100 gradient-form" style="background-color: #00A97E;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">

                                <div class="text-center">
                                    <img class="mx-auto img-fluid" src="{{ asset('assets/images/favicon.png') }}"
                                        alt="logo">
                                </div>
                                {{ $slot }}
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex d-none d-lg-block d-xl-block align-items-center" style="background: #00704D;">
                            <div class="text-white px-3 p-md-5 py-5 mx-md-4">
                                <img src="{{ asset('assets/images/logo_white.png') }}" alt="logo">
                                <h4 class="my-4 text-center">Geré plus facilement vos courrier</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
