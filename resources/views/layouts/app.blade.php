
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'ABHBC')</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('stylesheets')
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-md bg-faded justify-content-center position-fixed top-0 start-0 w-100 text-white"
        style="background-color: #1D4C64;z-index: 1000;">
        <div class=" container">
            <a href="{{ route('utilisateur.index') }}" class="navbar-brand d-flex w-50 me-auto">ABHBC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsingNavbar3">
                <span class="navbar-toggler-icon "></span>
            </button>
            <div class="navbar-collapse collapse w-100" id="collapsingNavbar3">
                <ul class="navbar-nav w-100 justify-content-center">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
                    </li>
                    @if (Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('utilisateur.index') }}">Utilisateur</a>
                        </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Congé
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('personne.index') }}"><i
                                        class="fa-solid fa-person"></i>
                                    Personelle</a></li>
                            <li><a class="dropdown-item" href="{{ route('conger.index') }}"><i
                                        class="fa-solid fa-list"></i> Liste Congé</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav ms-auto w-100 justify-content-end">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa-solid fa-user"></i>
                            {{ Auth::user()->email }} </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item px-4"
                                    href="{{ route('utilisateur.edit', Auth::user()->id) }}">Edit Profile</a></li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('Deconnexion') }}
                                    </x-dropdown-link>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-5 pt-4 pb-4">
        @yield('content')
    </div>


    <script src="https://code.jquery.com/jquery-3.6.1.js">
        $(document).on('click', '.delete', function() {
            let id = $(this).attr('data-id');
            $('#id').val(id);
        });
    </script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $(".table").DataTable();
        });
    </script>
    @stack('scripts')
</body>

</html>
