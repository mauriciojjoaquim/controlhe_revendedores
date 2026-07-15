<x-layout-app page-title="Editar Vendedora" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Editar Vendedora</h3>

        <hr>
        @if(session('status'))
            <div class="d-flex justify-content-center">
                <div class="w-100">
                    <div class="alert alert-{{ session('tipo_alert') }} {{ session('paricin') }} text-center mt-4 p-2" role="alert">
                        <div class="p-1">
                            <p class="pt-2 h1  {{ session('paricin') }}"><i class="{{ session('icon') }}"></i></p>
                            <p class="fs-4">{{ session('mesagem') }}</p>
                            <p class="fs-5"></p>
                        </div>

                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('adm.leaders.leader-seller.updated-leader-seller') }}" method="post">

            @csrf
            <div class="container-fluid">
                <div class="justify-content-center">
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-2 g-2 ´-3">

                        <div class="col">
                            <div class="border {{ $conf['color-border'] }} p-3">
                                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 g-2">

                                    <div class="col-sm-12 col-md-12 cols-xl-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nome</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $colaborator->name) }}">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 cols-xl-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $colaborator->email) }}">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 cols-xl-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Senha</label>
                                            <input type="password" class="form-control" id="new_password" name="new_password" value="{{ old('new_password') }}">
                                            @error('new_password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 cols-xl-6">
                                        <div class="mb-3">
                                            <label for="new_password_confirmation" class="form-label">Confirme a senha</label>
                                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" value="{{ old('new_password_confirmation') }}">
                                            @error('new_password_confirmation')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 cols-xl-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Contato / Whsapp</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $colaborator->detail->phone) }}">
                                            @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="border {{ $conf['color-border'] }} p-3">
                                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 g-2">

                                    <div class="col-sm-12 col-md-12 cols-xl-6">
                                        <div class="mb-3">
                                            <label for="zip_code" class="form-label">CEP</label>
                                            <input type="text" class="form-control" id="cep" name="zip_code" value="{{ old('zip_code', $colaborator->detail->zip_code) }}">
                                            @error('zip_code')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 cols-xl-6">
                                        <div class="mb-3">
                                            <label for="Address" class="form-label">Endereço</label>
                                            <input type="text" class="form-control" id="rua" name="address" value="{{ old('address', $colaborator->detail->addess) }}">
                                            @error('address')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 cols-xl-6">
                                        <div class="mb-4">
                                            <label for="number" class="form-label">Numero</label>
                                            <input type="text" class="form-control" id="number" name="number" value="{{ old('number', $colaborator->detail->number) }}">
                                            @error('number')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 cols-xl-6">
                                        <div class="mb-3">
                                            <label for="complement" class="form-label">Complemento</label>
                                            <input type="text" class="form-control" id="complement" name="complement" value="{{ old('complement', $colaborator->detail->complement) }}">
                                            @error('complement')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 cols-xl-6">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="neighborhood" class="form-label">Bairro</label>
                                                <input type="text" class="form-control" id="bairro" name="neighborhood" value="{{ old('neighborhood', $colaborator->detail->neighborhood) }}">
                                                @error('neighborhood')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <input type="hidden" name="id" value="{{ $colaborator->id }}">
                                <div class="mt-3">
                                    <a href="{{ route('adm.leaders.leader-seller.table-leader-seller') }}" class="btn btn-outline-warning me-3">Voltar</a>
                                    <button type="submit" class="btn btn-outline-primary mb-4">Editar Vendedor</button>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </form>

    </div>

</x-layout-app>

