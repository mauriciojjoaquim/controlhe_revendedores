<x-layout-app page-title="Delete cor" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100  p-4">

        <h3>Delete cor</h3>

        <hr>
        <div class="d-flex justify-content-center">
            <div class="text-center">
                <p>Tem certeza de que deseja excluir este arquivo cor?</p>
                <h3 class="my-5">{{ $cor->cor_name_br}}</h3>
                <p>Cor: <strong class="{{ $cor->cor_tag }} pe-4 ps-4">{{ $cor->cor_name_br }}</strong></p>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.settings.cors.table-cors') }}" class="btn btn-warning px-5">No</a>
                <form action="{{ route('admin.settings.cors.deleted-cors') }}" method="post" class="px-2">
                    @csrf
                    <input type="hidden" name="id" value="{{ $cor->id }}">
                    <button type="submit" class="btn btn-danger px-5">Yes</button>
                </form>
        
                </div>
            </div>
        </div>
       
        
        

    </div>

</x-layout-app>