<x-layout-app page-title="Editar Configuração" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-2">

    <div class="w-100 p-4">

        <h3>Editar Configuração</h3>

        <hr>
        {{-- disabled --}}
        <form action="{{ route('adm.settings-resellers.updated-vende-settings') }}" method="post">

            @csrf

            <div class="container-fluid">
                <div class="d-flex justify-content-center">
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1 row-cols-xl-1 row-cols-xxl-1">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="d-flex justify-content-center">
    
    
                                <div class="border {{ $conf['color_border'] }} p-2">
    
                                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1 row-cols-xl-2 row-cols-xxl-2">
    
                                        {{-- user_id --}}
                                        {{-- <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="user_id" class="form-label">Nome do Usuária</label>
                                                    <select class="form-select" name="user_id" aria-label="Floating label select example">
                                                    <option value="">Selecione uma Usuária</option>
                                                    @foreach ($users as $user)
                                                    @if ($user->id == $setting->user_id)
                                                    <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                                    @else
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endif
    
                                                    @endforeach
                                                    </select>
                                                    @error('user_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div> --}}
    
                                        {{-- pix --}}
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="pix" class="form-label">Pix</label>
                                                <input type="text" class="form-control" id="pix" name="pix" value="{{ old('pix', $setting->pix) }}">
                                                @error('pix')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
    
    
                                        {{-- price --}}
                                        {{-- <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="price" class="form-label">Preço</label>
                                                <input type="number" class="form-control" id="price" name="price" step=".01" placeholder="0,00" value="{{ old('price', $setting->price) }}">
                                                @error('price')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div> --}}
    
                                        {{-- minimum_price_for_installment --}}
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="minimum_price_for_installment" class="form-label">Preço minimo para parcela</label>
                                                <input type="number" class="form-control" id="minimum_price_for_installment" name="minimum_price_for_installment" step=".01" placeholder="0,00" value="{{ old('minimum_price_for_installment', $setting->minimum_price_for_installment) }}">
                                                @error('minimum_price_for_installment')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
    
                                        {{-- percentage --}}
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="percentage" class="form-label">Porcentagem</label>
                                                <input type="number" class="form-control" id="percentage" name="percentage" placeholder="00" value="{{ old('percentage', $setting->percentage) }}">
                                                @error('percentage')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
    
                                        {{-- installment number --}}
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="installment_number" class="form-label">Número de parcela</label>
                                                <input type="number" class="form-control" id="installment_number" name="installment_number" placeholder="00" value="{{ old('installment_number', $setting->installment_number) }}">
                                                @error('installment_number')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
    
                                        {{-- bg_color_site --}}
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="color_id" class="form-label">Cor do site opcional</label>
                                                    <select class="form-select" name="cor_id" aria-label="Floating label select example">
                                                        <option value="">Selecione uma cor para o site Cliente</option>
                                                        @foreach ($cors as $item)
                                                            @if ($setting->cor_id == $item->id)
                                                                <option class="{{ $item->cor_tag }} {{ $item->text_cor }}" value="{{ $item->id }}" selected>{{ $item->cor_name_br }}</option>
                                                            @else
                                                                <option class="{{ $item->cor_tag }} {{ $item->text_cor }}" value="{{ $item->id }}">{{ $item->cor_name_br }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('cor_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
    
                                        {{-- color_site_bg --}}
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="color_site_bg" class="form-label">Cor do site</label>
                                                    <select class="form-select" name="color_site_bg" aria-label="Floating label select example">
                                                        <option value="">Selecione uma cor para o site</option>
                                                        @foreach ($cors as $item)
                                                            @if ($setting->color_site_bg == $item->cor_tag)
                                                                <option class="{{ $item->cor_tag }} {{ $item->text_cor }}" value="{{ $item->cor_tag }}" selected>{{ $item->cor_name_br }}</option>
                                                            @else
                                                                <option class="{{ $item->cor_tag }} {{ $item->text_cor }}" value="{{ $item->cor_tag }}">{{ $item->cor_name_br }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('color_site_bg')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
    
                                        {{-- text_color_site --}}
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="text_color_site" class="form-label">Cor do texto do site</label>
                                                    <select class="form-select" name="text_color_site" aria-label="Floating label select example">
                                                    <option value="">Selecione uma cor para o texto do site</option>
                                                    @foreach ($boots as $item)
                                                        @if ($setting->color_table_text == $item->color_text)
                                                            <option class="{{ $item->color_text }}" value="{{ $item->color_text }}" selected>{{ $item->name }}</option>
                                                        @else
                                                            <option class="{{ $item->color_text }}" value="{{ $item->color_text }}">{{ $item->name }}</option>
                                                        @endif
                                                    @endforeach
                                                    </select>
                                                    @error('text_color_site')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
    
                                        {{-- bg_color_table --}}
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="cor_id" class="form-label">Cor da tabela</label>
                                                    <select class="form-select" name="bg_color_table" aria-label="Floating label select example">
                                                        <option value="">Selecione uma cor para  as tables</option>
                                                        @foreach ($boots as $item)
                                                            @if ($setting->bg_color_table == $item->color_table_bg)
                                                                <option class="{{ $item->color_bg }}" value="{{ $item->color_table_bg }}" selected>{{ $item->name }}</option>
                                                            @else
                                                                <option class="{{ $item->color_bg }}" value="{{ $item->color_table_bg }}">{{ $item->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('bg_color_table')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
    
                                        {{-- color_table_text --}}
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="cor_id" class="form-label">Cor do texto da tabela</label>
                                                    <select class="form-select" name="color_table_text" aria-label="Floating label select example">
                                                    <option value="">Selecione uma cor para o texto da tabela</option>
                                                    @foreach ($boots as $item)
                                                        @if ($setting->color_table_text == $item->color_text)
                                                            <option class="{{ $item->color_text }}" value="{{ $item->color_text }}" selected>{{ $item->name }}</option>
                                                        @else
                                                            <option class="{{ $item->color_text }}" value="{{ $item->color_text }}">{{ $item->name }}</option>
                                                        @endif
                                                    @endforeach
                                                    </select>
                                                    @error('color_table_text')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
    
                                        {{-- color_card_bg --}}
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="color_card_bg" class="form-label">Cor do card</label>
                                                    <select class="form-select" name="color_card_bg" aria-label="Floating label select example">
                                                    <option>Selecione uma cor para os Card</option>
                                                    @foreach ($boots as $item)
                                                    @if ($setting->color_card_bg == $item->color_card_bg)
                                                        <option class="{{ $item->color_card_bg }}" value="{{ $item->color_card_bg }}" selected>{{ $item->name }}</option>
                                                    @else
                                                        <option class="{{ $item->color_card_bg }}" value="{{ $item->color_card_bg }}">{{ $item->name }}</option>
                                                    @endif
    
                                                    @endforeach
                                                    </select>
                                                    @error('color_card_bg')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
    
                                        {{-- color_card_text --}}
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="color_card_text" class="form-label">Cor do texto do card</label>
                                                    <select class="form-select" name="color_card_text" aria-label="Floating label select example">
                                                    <option value="">Selecione uma cor para texto do card</option>
                                                    @foreach ($boots as $item)
                                                    @if ($setting->color_card_text == $item->color_text)
                                                        <option class="{{ $item->color_text }}" value="{{ $item->color_text }}" selected>{{ $item->name }}</option>
                                                    @else
                                                        <option class="{{ $item->color_text }}" value="{{ $item->color_text }}">{{ $item->name }}</option>
                                                    @endif
    
                                                    @endforeach
                                                    </select>
                                                    @error('color_card_text')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
    
                                        {{-- bg_color_menu --}}
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="bg_color_menu" class="form-label">Cor do Menu</label>
                                                    <select class="form-select" name="bg_color_menu" aria-label="Floating label select example">
                                                    <option value="">Selecione uma cor para menu site</option>
                                                    @foreach ($cors as $item)
                                                        @if ($setting->bg_color_menu == $item->cor_tag)
                                                        <option class="{{ $item->cor_tag }} {{ $item->text_cor }}" value="{{ $item->cor_tag }}" selected>{{ $item->cor_name_br }}</option>
                                                        @else
                                                        <option class="{{ $item->cor_tag }} {{ $item->text_cor }}" value="{{ $item->cor_tag }}">{{ $item->cor_name_br }}</option>
                                                    @endif
                                                    @endforeach
                                                    </select>
                                                    @error('bg_color_menu')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
    
                                        {{-- color_menu_vertical_text --}}
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="color_menu_vertical_text" class="form-label">Cor do texto do menu</label>
                                                    <select class="form-select" name="color_menu_vertical_text" aria-label="Floating label select example">
                                                    <option value="">Selecione uma cor para texto do menu</option>
                                                    @foreach ($boots as $item)
                                                        @if ($setting->color_menu_vertical_text == $item->color_text)
                                                        <option class="{{ $item->color_text }}" value="{{ $item->color_text }}" selected>{{ $item->name }}</option>
                                                        @else
                                                        <option class="{{ $item->color_text }}" value="{{ $item->color_text }}">{{ $item->name }}</option>
                                                    @endif
                                                    @endforeach
                                                    </select>
                                                    @error('color_menu_vertical_text')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
    
                                         {{-- color border --}}
                                         <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="color_border" class="form-label">Cor das Bordas</label>
                                                    <select class="form-select" name="color_border" aria-label="Floating label select example">
                                                        <option value="">Selecione uma cor para o site</option>
                                                        @foreach ($boots as $item)
                                                            @if ($setting->color_border == $item->color_border)
                                                                <option class="{{ $item->color_bg }}" value="{{ $item->color_border }}" selected>{{ $item->name }}</option>
                                                            @else
                                                                <option class="{{ $item->color_bg }}" value="{{ $item->color_border }}">{{ $item->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('color_border')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
    
                                        {{-- text_color --}}
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="text_color" class="form-label">Cor do texto</label>
                                                    <select class="form-select" name="text_color" aria-label="Floating label select example">
                                                    <option value="">Selecione uma cor para texto</option>
                                                    @foreach ($boots as $item)
                                                    @if ($setting->text_color == $item->color_text)
                                                        <option class="{{ $item->color_text }}" value="{{ $item->color_text }}" selected>{{ $item->name }}</option>
                                                    @else
                                                        <option class="{{ $item->color_text }}" value="{{ $item->color_text }}">{{ $item->name }}</option>
                                                    @endif
    
                                                    @endforeach
                                                    </select>
                                                    @error('text_color')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
    
                                        
    
                                    </div>
                            </div>
                        </div>
    
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <input type="hidden" name="id" id="id" value="{{ $setting->id }}">
                            <div class="mt-3 d-flex justify-content-center">
                                <a href="{{ route('adm.settings-resellers.table-vende-settings') }}" class="btn btn-outline-warning me-3">Voltar</a>
                        <button type="submit" class="btn btn-outline-primary">Atualizar configuração</button>
                            </div>
                        </div>
                    </div>
                </div>
                

            </div>

        </form>


    </div>

</x-layout-app>

