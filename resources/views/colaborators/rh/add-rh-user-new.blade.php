<x-layout-app page-title="Novo Colaborador" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Novo(a) Colaborador(a) de Recursos Humanos</h3>

        <hr>

        <form action="{{ route('colaborators.rh.create-rh-user') }}" method="post">

            @csrf

            <div class="container-fluid">

                <div class="justify-content-center">
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-2 g-2 p-2">

                        <div class="col-sm-12 col-md-12 cols-xl-12">
                            <div class="border {{ $conf['color-border'] }} p-4">
                                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-1">
                                    <div class="col-sm-12 col-md-12 cols-xl-12">
                                        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-2">

                                            <div class="col-sm-12 col-md-12 cols-xl-6">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nome:</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                                    @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
        
                                            <div class="col-sm-12 col-md-12 cols-xl-6">
                                                <div class="mb-3">
                                                    <label for="cpf" class="form-label">CPF</label>
                                                    <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf') }}">
                                                    @error('cpf')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
        
                                            <div class="col-sm-12 col-md-12 cols-xl-6">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                                    @error('email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
        
                                            {{-- <div class="col-sm-12 col-md-12 cols-xl-6">
                                                <div class="mb-3">
                                                    <label for="new_password" class="form-label">Senha</label>
                                                    <input type="password" class="form-control" id="new_password" name="new_password" value="{{ old('new_password') }}">
                                                    @error('new_password')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
        
                                            <div class="col-sm-12 col-md-12 cols-xl-6">
                                                <div class="mb-3">
                                                    <label for="new_password_confirmation" class="form-label">Confirmar Senha</label>
                                                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" value="{{ old('new_password_confirmation') }}">
                                                    @error('new_password_confirmation')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> --}}
        
                                            <div class="col-sm-12 col-md-12 cols-xl-12">
                                                <div class="pe-3">
                                                    <label for="select_department">Departmento</label>
                                                    <select class="form-select" id="select_department" name="select_department">
                                                        <option selected>Selecione um departamento</option>
                                                        @foreach ($departments as $department)
                                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('select_department')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
        
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 cols-xl-12">
                                        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-1">
                                            @can('admin')
                                                        <div class="col-sm-12 col-md-12 cols-xl-12">
                                                            <div class="border {{ $conf['color-border'] }} p-2">
                                                                <div class="justify-content-start">
                                                                    <div class="mb-3">
                                                                        <p class="">Acesso:</p>
                                                                        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                                                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-3">
                                                                            @foreach ($access as $aces)
                                                                            <div class="col-sm-12 col-md-4 cols-xl-3 mt-2">
                                                                            <input type="checkbox" class="btn-check text-dark" name="permicao[]" value="{{ $aces->short_name }}" id="{{ $aces->name }}">
                                                                            <label class="btn btn-sm btn-outline-success w-100" for="{{ $aces->name }}">{{ $aces->name }}</label>
                                                                            </div>
                                                                        @endforeach
                                                                        
                                                                        </div>
                                                                    </div>
                
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('permicao')
                                                                 <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    @endcan
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 cols-xl-12">
                            <div class="border {{ $conf['color-border'] }} p-4">
                                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-2 p-1">

                                    <div class="col-sm-12 col-md-12 cols-xl-12">
                                        <div class="mb-3">
                                            <label for="zip_code" class="form-label">Cep:</label>
                                            <input type="text" class="form-control" id="cep" name="zip_code" value="{{ old('zip_code') }}">
                                            @error('zip_code')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 cols-xl-12">
                                        <div class="mb-3">
                                            <label for="Address" class="form-label">Endereço:</label>
                                            <input type="text" class="form-control" id="rua" name="address" value="{{ old('address') }}">
                                            @error('address')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 cols-xl-12">
                                        <div class="mb-4">
                                            <label for="number" class="form-label">Numero:</label>
                                            <input type="text" class="form-control" id="number" name="number" value="{{ old('number') }}">
                                            @error('number')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 cols-xl-12">
                                        <div class="mb-3">
                                            <label for="complement" class="form-label">Complemento:</label>
                                            <input type="text" class="form-control" id="complement" name="complement" value="{{ old('complement') }}">
                                            @error('complement')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 cols-xl-12">
                                        <div class="mb-3">
                                            <label for="neighborhood" class="form-label">Bairro:</label>
                                            <input type="text" class="form-control" id="bairro" name="neighborhood" value="{{ old('neighborhood') }}">
                                            @error('neighborhood')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 cols-xl-12">
                                        <div class="mb-3">
                                            <label for="city" class="form-label">Cidade:</label>
                                            <input type="text" class="form-control" id="cidade" name="city" value="{{ old('city') }}">
                                            @error('city')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 cols-xl-12">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Contato/Whatsapp:</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                                            @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 cols-xl-12">
                                        <div class="mb-3">
                                            <label for="salary" class="form-label">alario:</label>
                                            <input type="number" class="form-control" id="salary" name="salary" step=".01" placeholder="0,00" value="{{ old('salary') }}">
                                            @error('salary')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 cols-xl-12">
                                        <div class="mb-3">
                                            <label for="admission_date" class="form-label">Data do Cadastro:</label>
                                            <input type="text" class="form-control" id="admission_date" name="admission_date" placeholder="YYYY-mm-dd" value="{{ old('admission_date') }}">
                                            @error('admission_date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 cols-xl-12">
                            <div class="mt-3">
                                <a href="{{ route('admin.colaborators.table-colaborator') }}" class="btn btn-outline-warning me-3">Cancel</a>
                                <button type="submit" class="btn btn-outline-primary mb-4">Create colaborator</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </form>

    </div>

</x-layout-app>

