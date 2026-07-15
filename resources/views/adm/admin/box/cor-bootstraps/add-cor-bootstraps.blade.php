<x-layout-app page-title="New Cors" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100  p-4">

        <h3>New  Cors</h3>

        <hr>
        {{-- disabled --}}
        <form action="{{ route('adm.cor-bootstraps.created-cor-bootstraps') }}" method="post">

            @csrf
        
            <div class="container-fluid">
                <div class="row gap-3 d-flex justify-content-center">
        
                    {{-- access --}}
                    <div class="col-6 border {{ $conf['color-border'] }} p-4">
        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
        
                        <div class="mb-3">
                            <label for="email" class="form-label">Cor</label>
                            <input type="text" class="form-control" id="color_bg" name="color_bg" value="{{ old('color_bg') }}">
                            @error('color_bg')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="color_table_bg" class="form-label">Cor da tabela</label>
                            <input type="text" class="form-control" id="color_table_bg" name="color_table_bg" value="{{ old('color_table_bg') }}">
                            @error('color_table_bg')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="color_card_bg" class="form-label">Cor da card</label>
                            <input type="text" class="form-control" id="color_card_bg" name="color_card_bg" value="{{ old('color_card_bg') }}">
                            @error('color_card_bg')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="color_border" class="form-label">Cor da borda</label>
                            <input type="text" class="form-control" id="color_border" name="color_border" value="{{ old('color_border') }}">
                            @error('color_border')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="color_text" class="form-label">Cor do texto</label>
                            <input type="text" class="form-control" id="color_text" name="color_text" value="{{ old('color_text') }}">
                            @error('color_text')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
        
                    </div>
        

                </div>
                <div class="mt-3 d-flex justify-content-center">
                    <a href="{{ route('adm.cor-bootstraps.table-cor-bootstraps') }}" class="btn btn-outline-warning me-3">Cancel</a>
                    <button type="submit" class="btn btn-outline-primary">New Cors</button>
                </div>
        
            </div>
        
        </form>
        

    </div>

</x-layout-app>

