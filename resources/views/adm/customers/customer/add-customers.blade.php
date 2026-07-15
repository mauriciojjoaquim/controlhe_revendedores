<x-layout-app page-title="Novo Cliente" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Novo Cliente</h3>

        <hr>
        {{-- disabled --}}
        <form action="{{ route('adm.customers.created-customers') }}" method="post">

            @csrf
            <div class="container-fluid">
                <div class="justify-content-center">
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 g-2 p-3">
                        {{-- Client --}}
                        <div class="col">
                            <div class="border {{ $conf['color-border'] }}">
                                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 g-2 p-3">
                                    
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nome</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="cpf" class="form-label">CPF</label>
                                            <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf') }}">
                                            @error('cpf')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Contato/Whatsapp</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                                            @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        {{-- Client - Detail --}}
                        <div class="col">
                            <div class="border {{ $conf['color-border'] }}">
                                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 g-2 p-3">
                                    
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="zip_code" class="form-label">CEP</label>
                                            <input type="text" class="form-control" id="cep" name="zip_code" value="{{ old('zip_code') }}">
                                            @error('zip_code')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="Address" class="form-label">Endereço</label>
                                            <input type="text" class="form-control" id="rua" name="address" value="{{ old('address') }}">
                                            @error('address')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="mb-4">
                                            <label for="number" class="form-label">Numero</label>
                                            <input type="text" class="form-control" id="number" name="number" value="{{ old('number') }}">
                                            @error('number')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="complement" class="form-label">Complemento</label>
                                            <input type="text" class="form-control" id="complement" name="complement" value="{{ old('complement') }}">
                                            @error('complement')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="neighborhood" class="form-label">Bairro</label>
                                            <input type="text" class="form-control" id="bairro" name="neighborhood" value="{{ old('neighborhood') }}">
                                            @error('neighborhood')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="city" class="form-label">Cidade</label>
                                                <input type="text" class="form-control" id="cidade" name="city" value="{{ old('city') }}">
                                                @error('city')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mt-3 p-3">
                                <a href="{{ route('adm.customers.table-customers') }}" class="btn btn-outline-warning me-3">Voltar</a>
                                <button type="submit" class="btn btn-outline-primary mb-4">Criar novo Cliente</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 
        </form>
        

    </div>

</x-layout-app>

