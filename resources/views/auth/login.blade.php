<x-layout-guest page-title="Login">


    <div class="container mt-5 w-100">
        <div class="row row-cols-sm-1 row-cols-lg-3 justify-content-center">
            <div class="col">

                <!-- logo -->
                <div class="text-center mb-5">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="200px">
                </div>

                <!-- login form -->
                <div class="card p-2">

                    <form action="{{ route('login') }}" method="post">
                        @csrf

                       <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                                @error('email')
                                  <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="password">Senha</label>
                                <input type="password" class="form-control" id="password" name="password">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                       </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('password.request')}}" class="card-link">Esqueceu a sua senha?</a>
                            <button type="submit" class="btn btn-primary px-4">Entrar</button>
                        </div>

                    </form>

                    @if (session('status'))
                        <div class="alert alert-success mt-3 text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>

</x-layout-guest>
