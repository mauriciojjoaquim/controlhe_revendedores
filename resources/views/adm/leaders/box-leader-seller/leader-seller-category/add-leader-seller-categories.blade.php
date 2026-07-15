<x-layout-app page-title="Nova Categoria" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-2">

        <h3>Nova Categoria</h3>

        <hr>
        {{-- disabled --}}
        <form action="{{ route('adm.Leaders.leader-seller-category.created-leader-seller-category') }}" method="post">

            @csrf
        
            <div class="container-fluid">
                    <div class="d-flex justify-content-center">
                        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-1">

                            <div class="col-xl-12 col-md-12 col-md-12 col-sm-12">
                                <div class="border {{ $conf['color-border'] }} p-4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Categoria</label>
                                        <input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}">
                                        @error('category')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 col-md-12 col-md-12 col-sm-12">
                                <div class="mt-3 d-flex justify-content-center">
                                    <a href="{{ route('adm.Leaders.leader-seller-category.table-leader-seller-category') }}" class="btn btn-outline-warning me-3">Voltar</a>
                                    <button type="submit" class="btn btn-outline-primary">Nova categoria</button>
                                </div>
                            </div>


                        </div>
                </div>
            </div>
        
        </form>
        

    </div>

</x-layout-app>

{{-- colaborators.colaborator.edit-colaborators-manager --}}