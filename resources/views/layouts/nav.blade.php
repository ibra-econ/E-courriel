<nav class="topnav navbar navbar-light">
    <button type="button" class="p-0 mt-2 mr-3 navbar-toggler text-muted collapseSidebar hide_icon_logo">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>

    <ul class="nav">
        {{-- button mode sombre et clair --}}
        <li class="nav-item">
            <a class="my-2 nav-link text-muted" href="#" id="modeSwitcher" data-mode="light">
                <i class="fe fe-sun fe-16"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="pr-0 nav-link dropdown-toggle text-muted" href="#" id="navbarDropdownMenuLink" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mt-2 avatar avatar-sm">
                    <img src="./assets/avatars/face-1.jpg" alt="..." class="avatar-img rounded-circle">
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                {{-- <p class="dropdown-item" href="#"> {{ Auth::user()->email }}</p> --}}
                <a class="dropdown-item" href="{{ route('Profile') }}">Profile</a>
                {{--
                <hr class="p-0"> --}}
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Deconnexion</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    {{-- <input type="hidden" name="id" value="{{ Auth::user()->id }}"> --}}
                </form>
            </div>
        </li>
    </ul>
</nav>
<aside class="shadow sidebar-left border-right bg-green" id="leftSidebar" data-simplebar>
    <a href="#" class="mt-3 ml-2 btn collapseSidebar toggle-btn d-lg-none text-muted" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->

        <div class="mb-4 w-100 d-flex">
            <a class="mx-auto mt-2 text-center navbar-brand flex-fill" href="">
                <div class="logo-perso-bloc">
                    {{-- <img src="{{ asset('assets/images/logo_icon.png') }}" class="img-fluid logo-icon-perso"
                        height="32" width="32" alt="logo"> --}}
                    <img src="{{ asset('assets/images/logo_white.png') }}" class="img-fluid logo full-logo-icon-perso"
                        alt="logo">
                </div>

            </a>
        </div>
        <ul class="mb-2 navbar-nav flex-fill w-100">
            {{-- Dashboard lien --}}
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('Acceuil') }}">
                    <i class="fe fe-mail fe-16"></i>
                    <span class="ml-3 item-text">Dashboard</span>
                </a>
            </li>
        </ul>
        <ul class="mb-2 navbar-nav flex-fill w-100">
            {{-- Traitement lien --}}
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('Traitement') }}">
                    <i class="fe fe-settings fe-16"></i>
                    <span class="ml-3 item-text">Traitement</span>
                </a>
            </li>
        </ul>
        <ul class="mb-2 navbar-nav flex-fill w-100">
            {{-- imputation lien --}}
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('Imputation') }}">
                    <i class="fe fe-share-2 fe-16"></i>
                    <span class="ml-3 item-text">Imputation</span>
                </a>
            </li>
        </ul>

        <ul class="mb-2 navbar-nav flex-fill w-100">
            {{-- Archive lien --}}
            <li class="nav-item dropdown">
                <a href="#layouts" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle nav-link">
                  <i class="fe fe-archive fe-16"></i>
                  <span class="ml-3 item-text">Archive</span>
                </a>
                <ul class="list-unstyled pl-4 w-100 collapse show" id="layouts" style="">
                  <li class="nav-item">
                    <a class="nav-link pl-3" href="{{ route('archive.courrier') }}"><span class="ml-1 item-text">Courrier</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link pl-3" href="{{ route('archive.document') }}"><span class="ml-1 item-text">Document</span></a>
                  </li>

                </ul>
              </li>
        </ul>
        <p class="mt-4 mb-1 text-white nav-heading">
            <span>Paramètre</span>
        </p>
        <ul class="mb-2 navbar-nav flex-fill w-100">
            {{-- Utilisateurs (Compte) lien --}}
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('Compte') }}">
                    <i class="fe fe-users fe-16"></i>
                    <span class="ml-3 item-text">Utiisateurs</span>
                </a>
            </li>
              {{-- correspondant lien --}}
              <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('Correspondant') }}">
                    <i class="fe fe-user-check fe-16"></i>
                    <span class="ml-3 item-text">Correspondant</span>
                </a>
            </li>
            {{-- Departement lien --}}
              <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('Departement') }}">
                    <i class="fe fe-layers fe-16"></i>
                    <span class="ml-3 item-text">Departement</span>
                </a>
            </li>
            {{-- Annotation lien --}}
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('Annotation') }}">
                    <i class="fe fe-clipboard fe-16"></i>
                    <span class="ml-3 item-text">Annotation</span>
                </a>
            </li>
             {{-- Nature lien --}}
             <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('Nature') }}">
                    <i class="fe fe-award fe-16"></i>
                    <span class="ml-3 item-text">Nature</span>
                </a>
            </li>
            {{-- General (infos de la structure) lien --}}
            <li class="nav-item w-100">
                <a class="nav-link" href="">
                    <i class="fe fe-tool fe-16"></i>
                    <span class="ml-3 item-text">General</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
