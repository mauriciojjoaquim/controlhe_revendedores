<x-layout-app page-title="List detail" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">
        @if(session('status'))
        <div class="d-flex justify-content-center">
            <div class="w-100">
                <div class="alert alert-{{ session('tipo_alert') }} {{ session('paricin') }} text-center mt-4 p-2" role="alert">
                    <div class="p-1">
                        <p class="pt-2 h1  {{ session('paricin') }}"><i class="{{ session('icon') }}"></i></p>
                        <p class="fs-4">{{ session('mesagem') }}</p>
                        <p class="fs-5"></p>
                    </div>
                    
                </div>
            </div>
        </div>
   @endif
        <h3>List detail</h3>

        <hr>

        <div class="container-fluid">
            <div class="row mb-3">

                <div class="col">

                    <p>Description: <strong>{{ $list->description }}</strong></p>
                    <p>amount: <strong>{{ $list->amount }}</strong></p>
                    
                    <p>Code: <strong>{{ $listPro->code }}</strong></p>

                    
                

                    <p>Unitatio price: <strong>R$ {{ $list->unitatio_price }}</strong></p>
                    <p>Wholesale amount: <strong>{{ $listPro->wholesale_amount }}</strong></p>
                    <p>Wholesale price: <strong>R$ {{ $list->wholesale_price }}</strong></p>
                    <p>Total price: <strong>R$ {{ $list->total_price }}</strong></p>

                </div>


            </div>
        </div>

        <button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Back</button>

    </div>

</x-layout-app>