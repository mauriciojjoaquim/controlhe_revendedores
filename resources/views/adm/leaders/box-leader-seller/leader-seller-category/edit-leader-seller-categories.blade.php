<x-layout-app page-title="Editar categoria" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-2">

        <h3>Editar categoria</h3>

        <hr>
        {{-- disabled --}}
        <form action="{{ route('adm.Leaders.leader-seller-category.updated-leader-seller-category') }}" method="post">

            @csrf
        
            <div class="container-fluid">
                <div class="row gap-3 d-flex justify-content-center">
        
                    {{-- Categorys --}}
                    <div class="col-sm-12 col-md-12 border {{ $conf['color-border'] }} p-4">
        
                        <div class="mb-3">
                            <label for="name" class="form-label">categoria</label>
                            <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $category->category) }}">
                            @error('category')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

        
                    </div>
        

                </div>
                <input type="hidden" name="id" id="id" value="{{ $category->id }}">
                <div class="mt-3 d-flex justify-content-center">
                    <a href="{{ route('adm.Leaders.leader-seller-category.table-leader-seller-category') }}" class="btn btn-outline-warning me-3">voltar</a>
                    <button type="submit" class="btn btn-outline-primary">Atualizar categoria</button>
                </div>
        
            </div>
        
        </form>
        

    </div>

</x-layout-app>

