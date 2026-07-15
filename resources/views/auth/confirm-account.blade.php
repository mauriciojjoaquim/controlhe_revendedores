<x-layout-guest page-title="Account Confirmation">

    <div class="container mt-5">
        <div class="row row-cols-sm-1 row-cols-lg-3 justify-content-center">
            <div class="col">
    
                <!-- logo -->
                <div class="text-center mb-5">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="200px">
                </div>
    
                    <form action="{{ route('update-confirm-account') }}" method="post">
                        @csrf

                        <input type="hidden" name="id_token" id="id_token" value="{{ $user->confirmation_token }}">
    
                        <div class="mb-3">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control" id="password" name="password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>  
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation ">Confirmar Senha</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            @error('password_confirmation')
                                  <div class="text-danger">{{ $message }}</div>  
                                @enderror
                        </div>

                        
    
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ route('login')}}">Já sei a minha senha?</a>
                            <button type="submit" class="btn btn-primary px-4">Enviar Senha</button>
                        </div>
    
                    </form>
    
    
                </div>
    
            </div>
        </div>
    </div>
    
    </x-layout-guest>