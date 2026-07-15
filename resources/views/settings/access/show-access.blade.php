<x-layout-app page-title="Colaborator details" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Colaborator details</h3>

        <hr>

        <div class="container-fluid {{ $conf['bg_color_site'] }} p-4">
            <div class="row mb-3 d-flex justify-content-center">

                <div class="col-6">

                    <p>Name: <strong>{{ $aces->name }}</strong></p>
                    <p>Email: <strong>{{ $aces->short_name }}</strong></p>

                    <button class="btn btn-outline-warning" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Back</button>

                    
                </div>
            </div>
        </div>
{{-- 
       
    </div>

</x-layout-app>