<div class="d-flex justify-content-between py-1 px-3">

    <!-- logo -->
    <div class="d-flex align-items-center">
        <a class="{{ $menuHorText }} me-3" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
            <i class="fa fa-bars" aria-hidden="true"></i></a>
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/images/favicon.png') }}" alt="logo" width="50px" class="img-fluid">
        </a>
        <h4 class="ms-3 {{ $menuHorText }}">
            {{config('app.name') }}
        </h4>

    </div>

    <!-- user text-primary -->
    <div class="d-flex align-items-center">

        <a href="{{ route('user.profile-setting', ['id' => Auth::user()->id]) }}" class=" me-2">
            <i class="fa-solid fa-gear me-3 {{ $menuHorText }}"></i>
        </a>
       <div class="avata-user-logo">
            @can('client')
                <a class="" href="{{ route('adm.customers.customer-avata-user.edit-avata-users', ['id' => Auth::user()->id]) }}">
                    @if (Auth::user()->avata_user != null)
                    
                    <img class="rounded me-3" src="{{ url('storage/imagens/photocustomers/'.Auth::user()->id.'/'.Auth::user()->avata_user) }}" alt="avata" width="30px">
                    @else
                    <img class="rounded me-3" src="{{ asset('assets/images/avata-user.png') }}" alt="avata-user.png" width="30px">
            
                    @endif
                </a> 
            @else
                <a class="" href="{{ route('adm.admin.avata-user.edit-avata-users', ['id' => Auth::user()->id]) }}">
                    @if (Auth::user()->avata_user != null)
                    
                    <img class="rounded me-3" src="{{ url('storage/imagens/photousers/'.Auth::user()->id.'/'.Auth::user()->avata_user) }}" alt="avata" width="30px">
                    @else
                    <img class="rounded me-3" src="{{ asset('assets/images/avata-user.png') }}" alt="avata-user.png" width="30px">
                    @endif

                </a> 
            @endcan    
       </div>

        <a href="{{ route('user.profile') }}" class="{{ $menuHorText }} me-3">
              {{ Auth::user()->name }}
        </a>
        {{-- logout --}}
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-sign-out-alt"></i></button>
        </form>
        </a>
    </div>

</div>

