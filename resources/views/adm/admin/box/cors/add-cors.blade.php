<x-layout-app page-title="New Cors" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100  p-4">

        <h3>New  Cors</h3>

        <hr>
        {{-- disabled --}}
        <form action="{{ route('adm.cors.created-cors') }}" method="post">

            @csrf
        
            <div class="container-fluid">
                <div class="row gap-3 d-flex justify-content-center">
        
                    {{-- access --}}
                    <div class="col-6 border {{ $conf['color-border'] }} p-4">
        
                        <div class="mb-3">
                            <label for="cor_name_br" class="form-label">Nome em Portugues</label>
                            <input type="text" class="form-control" id="cor_name_br" name="cor_name_br" value="{{ old('cor_name_br') }}">
                            @error('cor_name_br')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
        
                        <div class="mb-3">
                            <label for="email" class="form-label">Cor da tags</label>
                            <input type="text" class="form-control" id="cor_tag" name="cor_tag" value="{{ old('cor_tag') }}">
                            @error('cor_tag')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="text_cor" class="form-label">Cor do texto</label>
                            <input type="text" class="form-control" id="text_cor" name="text_cor" value="{{ old('text_cor') }}">
                            @error('text_cor')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
        
                    </div>
        

                </div>
                <div class="mt-3 d-flex justify-content-center">
                    <a href="{{ route('adm.cors.table-cors') }}" class="btn btn-outline-warning me-3">Cancel</a>
                    <button type="submit" class="btn btn-outline-primary">New Cors</button>
                </div>
        
            </div>
        
        </form>
        

    </div>

</x-layout-app>

{{-- colaborators.colaborator.edit-colaborators-manager --}}