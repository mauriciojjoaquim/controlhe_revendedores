<x-layout-app page-title="List detail" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>List detail</h3>

        <hr>

        <div class="container-fluid">
            <div class="row mb-3">

                <div class="col">

                    <p>Description: <strong>{{ $product->description }}</strong></p>

                    <p>Code: <strong>{{ $product->code }}</strong></p>

        
                    <p>Unitatio price: <strong>R$ {{ $product->unitatio_price }}</strong></p>
                    <p>Wholesale price: <strong>R$ {{ $product->wholesale_price }}</strong></p>
                    <h5>Lista de Compra </h5>
                    <p>amount: <strong>{{ $userList->amount }}</strong></p>
                    <p>price: <strong>R$ {{ $userList->price }}</strong></p>
                    <p>Total price: <strong>R$ {{ $userList->total_price }}</strong></p>

                </div>


            </div>
        </div>

        <button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Back</button>

    </div>

</x-layout-app>