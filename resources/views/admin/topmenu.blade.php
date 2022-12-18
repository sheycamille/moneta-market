@section('topbar')
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar"
            data-class="c-sidebar-show"><span class="c-header-toggler-icon"></span></button>
        <a class="c-header-brand d-sm-none" href="/">
            <img class="c-header-brand" src="{{ asset('front/favicon.png') }}" alt="Moneta Market Logo"
                style="width: 50vw;">
        </a>
        <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar"
            data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>

        <ul class="c-header-nav ml-auto mr-4">
            <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#"
                    role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="">
                        Hi {{ Auth('admin')->User()->firstName }}
                        <svg class="c-icon mr-2">
                            <use xlink:href="{{ url('admin/icons/sprites/free.svg#cil-menu') }}"></use>
                        </svg>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right pt-0">
                    <a class="dropdown-item" href="{{ route('adminchangepass') }}">Change
                        Password
                    </a>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="#"
                        onclick="event.preventDefault();document.getElementById('logoutform').submit();">

                        <svg class="c-icon mr-2">
                            <use xlink:href="{{ url('admin/icons/sprites/free.svg#cil-account-logout') }}"></use>
                        </svg>
                        Logout
                        <form id="logoutform" action="{{ route('adminlogout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </a>
                </div>
            </li>
        </ul>

        <div class="c-subheader px-3">
            <ol class="breadcrumb border-0 m-0">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <?php $segments = ''; ?>
                @for ($i = 1; $i <= count(Request::segments()); $i++)
                    <?php $segments .= '/' . Request::segment($i); ?>
                    @if ($i < count(Request::segments()))
                        <li class="breadcrumb-item">{{ ucfirst(Request::segment($i)) }}
                        </li>
                    @else
                        <li class="breadcrumb-item active">{{ ucfirst(Request::segment($i)) }}</li>
                    @endif
                @endfor
            </ol>
        </div>
    </header>
@endsection
