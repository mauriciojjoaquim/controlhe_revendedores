<x-layout-app page-title="Fazer Venda" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100 p-4">

        <h3>Fazer Venda</h3>
        <div class="mt-2">
            <a href="{{ route('admin.dealers.clients.client.table-vende-clients') }}" class="btn btn-outline-warning me-3">Voltar</a>

        </div>

        <hr>
        {{-- disabled --}}
        <form action="{{ route('admin.dealers.clients.client-search.search-vende-clients') }}" method="post">

            @csrf
            <div class="container-fluid">
                <div class="d-flex justify-content-center">
                    <div class="w-100">
                        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-1 g-2 p-md-2 p-sm-1 p-xl-4 m-auto">
                            {{-- Search Client --}}
                            <div class="col">
                                <div class="border {{ $conf['color-border'] }}">
                                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 g-2 p-1">

                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="search" class="form-label"></label>
                                                <input type="text" class="form-control" id="search" name="search" value="{{ old('name') }}">
                                                @error('search')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mt-3 p-1">
                                                <button type="submit" class="btn btn-outline-primary mb-4">Fazer Venda</button>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </form>


    </div>

</x-layout-app>

