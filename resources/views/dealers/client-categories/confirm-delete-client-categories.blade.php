<x-layout-app page-title="Delete Category" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-2">

        <h3>Delete Category</h3>

        <hr>
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-1">

            <div class="col-xl-12 col-md-12 col-md-12 col-sm-12">
                <p>Tem certeza de que deseja excluir esta categoria?</p>

                <div class="text-center">
                    <h3 class="my-5">{{ $category->category }}</h3>
                    <p>category: {{ $category->category }}</p>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('admin.dealers.client-categories.table-client-category') }}" class="btn btn-warning px-5">Não</a>
                    <form action="{{ route('admin.dealers.client-categories.deleted-client-category') }}" method="post" class="px-2">
                        @csrf
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        <button type="submit" class="btn btn-danger px-5">Sim</button>
                    </form>

                    </div>
                </div>
            </div>
        </div>


    </div>

</x-layout-app>
