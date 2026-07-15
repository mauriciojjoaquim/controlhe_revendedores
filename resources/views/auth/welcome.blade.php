<x-layout-guest page-title="Bem-vindo">

    <div class="container mt-5">
        <div class="row row-cols-sm-1 row-cols-lg-3 justify-content-center">
            <div class="col-12">
                <!-- logo -->
                <div class="text-center mb-5">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="200px">
                </div>
                <div class="card p-5 text-center">
                    <p>welcome, <strong>{{ $user->name }}</strong>!</p>
                    <p>Yout account has been successfully. created.</p>
                    <p>You can now <a href="{{ route('login') }}">login</a> to your account.</p>

                </div>

            </div>
        </div>
    </div>

</x-layout-guest>