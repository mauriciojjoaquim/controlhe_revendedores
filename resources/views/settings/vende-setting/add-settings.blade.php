<x-layout-app page-title="New Settings" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-2">


        <h3>New  Settings</h3>

        <hr>
        {{-- disabled --}}
        <form action="{{ route('adm.settings-resellers.created-vende-settings') }}" method="post">

            @csrf
        
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1 row-cols-xl-1 row-cols-xxl-1 d-flex justify-content-center">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                        <div class="d-flex justify-content-center">
                            <div class="border {{ $conf['color-border'] }} p-2">
                                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-2">
                
                                    {{-- user_id --}}
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                        <div class="mb-3">
                                            <label for="cor_id" class="form-label">Nome do Usuária</label>
                                                <select class="form-select" name="user_id" aria-label="Floating label select example">
                                                  <option value="">Selecione uma Usuária</option>
                                                  @foreach ($users as $user)
                                                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                  @endforeach
                                                </select>
                                                @error('user_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>

                                    {{-- pix --}}
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Pix</label>
                                            <input type="text" class="form-control" id="pix" name="pix" value="{{ old('pix') }}">
                                            @error('pix')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
        
                                    {{-- purchase_price --}}
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                        <div class="mb-3">
                                            <label for="purchase_price" class="form-label">Preço</label>
                                            <input type="number" class="form-control" id="price" name="price" step=".01" placeholder="0,00" value="{{ old('price') }}">
                                            @error('price')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
    
                                    {{-- bg_color_site --}}
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                        <div class="mb-3">
                                            <label for="bg_color_site" class="form-label">Cor da site opcional</label>
                                                <select class="form-select" name="bg_color_site" aria-label="Floating label select example">                               
                                                    <option value="" selected>Selecione uma cor para site</option>
                                                    @foreach ($boots as $item)
                                                    <option class="{{ $item->color_bg }}" value="{{ $item->color_bg }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('bg_color_site')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
        
                                    {{-- color_site_bg --}}
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                        <div class="mb-3">
                                            <label for="color_site_bg" class="form-label">Cor da site</label>
                                                <select class="form-select" name="color_site_bg" aria-label="Floating label select example">                               
                                                    <option value="" selected>Selecione uma cor para site</option>
                                                    @foreach ($boots as $item)
                                                    <option class="{{ $item->color_bg }}" value="{{ $item->color_bg }}">{{ $item->name }}</option>
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
                                                <option value="" selected>Selecione uma cor para texto do site</option>
                                                @foreach ($boots as $item)
                                                    <option class="{{ $item->color_text }}" value="{{ $item->color_text }}">{{ $item->name }}</option>
                                                @endforeach
                                                </select>
                                                @error('color_card_text')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
        
                                    {{-- bg_color_table --}}
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                        <div class="mb-3">
                                            <label for="bg_color_table" class="form-label">Cor da tabela</label>
                                                <select class="form-select" name="bg_color_table" aria-label="Floating label select example">                               
                                                    <option value="" selected>Selecione uma cor para  as tables</option>
                                                    @foreach ($boots as $item)
                                                    <option class="{{ $item->color_bg }}" value="{{ $item->color_table_bg }}">{{ $item->name }}</option>
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
                                                <option value="" selected>Selecione uma cor para o texto da tabela</option>
                                                @foreach ($boots as $item)
                                                    <option class="{{ $item->color_text }}" value="{{ $item->color_text }}">{{ $item->name }}</option>
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
                                                <option value="">Selecione uma cor para os Card</option>
                                                @foreach ($boots as $item)
                                                <option class="{{ $item->color_card_bg }}" value="{{ $item->color_card_bg }}">{{ $item->name }}</option>
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
                                                <option value="" selected>Selecione uma cor para texto do card</option>
                                                @foreach ($boots as $item)
                                                    <option class="{{ $item->color_text }}" value="{{ $item->color_text }}">{{ $item->name }}</option>
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
                                            <label for="bg_color_menu" class="form-label">Cor do fundo site</label>
                                                <select class="form-select" name="bg_color_menu" aria-label="Floating label select example">
                                                <option value="">Selecione uma cor para fundo site</option>
                                                @foreach ($boots as $item)
                                                <option class="{{ $item->color_card_bg }}" value="{{ $item->color_bg }}">{{ $item->name }}</option>
                                                @endforeach
                                                </select>
                                                @error('bg_color_menu')
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
                                                    <option class="{{ $item->color_text }}" value="{{ $item->color_text }}">{{ $item->name }}</option>      
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
                            </div>
                           
                        </div>
                    </div>
                    
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                        <div class="mt-3 d-flex justify-content-center">
                            <a href="{{ route('adm.settings-resellers.table-vende-settings') }}" class="btn btn-outline-warning me-3">Cancel</a>
                    <button type="submit" class="btn btn-outline-primary">New Settings</button>
                        </div>
                    </div>
                   </div>
            </div>
        
        </form>
        

    </div>

</x-layout-app>

{{-- colaborators.colaborator.edit-colaborators-manager --}}