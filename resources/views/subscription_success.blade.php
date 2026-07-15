<x-layout-app page-title="Home" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">


    <div class="w-100 p-4">


    
    <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-4 col-sm-8">

                    <p class="display-6 text-center my-5">Laravel Cashier (Stripe)</p>

                    <div class="card p-4 text-center">
                        <p class="display-6 text-success">Muito obrigado pela sua subscrição!</p>
                        <p>Já pode avançar para a dashboard!</p>
                        <div class="text-center">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary px-5 mt-3">Dashboard</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>

</x-layout-app>