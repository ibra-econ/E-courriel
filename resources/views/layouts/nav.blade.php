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
        {{-- button notification --}}
        <li class="nav-item nav-notif">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
                <span class="fe fe-bell fe-16"></span>
                <span class="dot dot-md bg-success"></span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="pr-0 nav-link dropdown-toggle text-muted" href="#" id="navbarDropdownMenuLink" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mt-2 avatar avatar-sm">
                    <img src="{{ asset('assets/images/favicon.png') }}" alt="photo" class="avatar-img rounded-circle">
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <p class="dropdown-item" href="#"> {{ Auth::user()->email }}</p>
                <hr class="m-0">
                <a class="dropdown-item" href="{{ route('show.user',['id'=> Auth::user()->id]) }}">Profile</a>

                <hr class="m-0">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Deconnexion</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
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
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fe fe-activity fe-16"></i>
                    <span class="ml-3 item-text">Dashboard</span>
                </a>
            </li>
        </ul>
        <ul class="mb-2 navbar-nav flex-fill w-100">
            {{-- Archive lien --}}
            <li class="nav-item dropdown">
                <a href="#layouts" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle nav-link">
                    <i class="fe fe-mail fe-16"></i>
                    <span class="ml-3 item-text">Courrier</span>
                </a>
                <ul class="list-unstyled pl-4 w-100 collapse show" id="layouts" style="">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('Depart') }}"><span
                                class="ml-1 item-text">Départ</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('Arriver') }}"><span
                                class="ml-1 item-text">Arrivée</span></a>
                    </li>

                </ul>
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
            {{-- Archive lien --}}
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('archive.courrier') }}">
                    <i class="fe fe-archive fe-16"></i>
                    <span class="ml-3 item-text">Archives</span>
                </a>
            </li>
        </ul>

        <ul class="mb-2 navbar-nav flex-fill w-100">
            {{-- Archive lien --}}
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('document') }}">
                    <i class="fe fe-file fe-16"></i>
                    <span class="ml-3 item-text">Documents</span>
                </a>
            </li>
        </ul>

        <ul class="mb-2 navbar-nav flex-fill w-100">
            {{-- imputation lien --}}
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('Imputation') }}">
                    <i class="fe fe-share-2 fe-16"></i>
                    <span class="ml-3 item-text">Imputations</span>
                </a>
            </li>
        </ul>
        <p class="mt-4 mb-1 text-white nav-heading">
            <span>Paramètre</span>
        </p>
        <ul class="mb-2 navbar-nav flex-fill w-100">
            <ul class="mb-2 navbar-nav flex-fill w-100">
                {{-- Utilisateurs lien --}}
                <li class="nav-item dropdown">
                    <a href="#layouts" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle nav-link">
                        <i class="fe fe-users fe-16"></i>
                        <span class="ml-3 item-text">Utiisateurs</span>
                    </a>
                    <ul class="list-unstyled pl-4 w-100 collapse show" id="layouts" style="">
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('Compte') }}"><span
                                    class="ml-1 item-text">Compte</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('Journal') }}"><span
                                    class="ml-1 item-text">Journal</span></a>
                        </li>

                    </ul>
                </li>
            </ul>
            {{-- correspondant lien --}}
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('Correspondant') }}">
                    <i class="fe fe-user-check fe-16"></i>
                    <span class="ml-3 item-text">Correspondants</span>
                </a>
            </li>
            {{-- Departement lien --}}
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('Departement') }}">
                    <i class="fe fe-layers fe-16"></i>
                    <span class="ml-3 item-text">Departements</span>
                </a>
            </li>
            {{-- Annotation lien --}}
            <li class="nav-item w-100">
                <a class="nav-link" href="{{ route('Annotation') }}">
                    <i class="fe fe-clipboard fe-16"></i>
                    <span class="ml-3 item-text">Annotations</span>
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
                <a class="nav-link" href="{{ route('Config') }}">
                    <i class="fe fe-tool fe-16"></i>
                    <span class="ml-3 item-text">Configuration</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
<div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush my-n3">
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="fe fe-box fe-24"></span>
                            </div>
                            <div class="col">
                                <small><strong>Package has uploaded successfull</strong></small>
                                <div class="my-0 text-muted small">Package is zipped and uploaded</div>
                                <small class="badge badge-pill badge-light text-muted">1m ago</small>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="fe fe-download fe-24"></span>
                            </div>
                            <div class="col">
                                <small><strong>Widgets are updated successfull</strong></small>
                                <div class="my-0 text-muted small">Just create new layout Index, form, table</div>
                                <small class="badge badge-pill badge-light text-muted">2m ago</small>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="fe fe-inbox fe-24"></span>
                            </div>
                            <div class="col">
                                <small><strong>Notifications have been sent</strong></small>
                                <div class="my-0 text-muted small">Fusce dapibus, tellus ac cursus commodo</div>
                                <small class="badge badge-pill badge-light text-muted">30m ago</small>
                            </div>
                        </div> <!-- / .row -->
                    </div>
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="fe fe-inbox fe-24"></span>
                            </div>
                            <div class="col">
                                <small><strong>Notifications have been sent</strong></small>
                                <div class="my-0 text-muted small">Fusce dapibus, tellus ac cursus commodo</div>
                                <small class="badge badge-pill badge-light text-muted">30m ago</small>
                            </div>
                        </div> <!-- / .row -->
                    </div>
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="fe fe-inbox fe-24"></span>
                            </div>
                            <div class="col">
                                <small><strong>Notifications have been sent</strong></small>
                                <div class="my-0 text-muted small">Fusce dapibus, tellus ac cursus commodo</div>
                                <small class="badge badge-pill badge-light text-muted">30m ago</small>
                            </div>
                        </div> <!-- / .row -->
                    </div>
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="fe fe-link fe-24"></span>
                            </div>
                            <div class="col">
                                <small><strong>Link was attached to menu</strong></small>
                                <div class="my-0 text-muted small">New layout has been attached to the menu</div>
                                <small class="badge badge-pill badge-light text-muted">1h ago</small>
                            </div>
                        </div>
                    </div> <!-- / .row -->
                </div> <!-- / .list-group -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-green-1 btn-block" data-dismiss="modal">Tout marquer comme
                    lu</button>
            </div>
        </div>
    </div>
</div>
