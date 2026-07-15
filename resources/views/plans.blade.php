<x-layout-app page-title="Home" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">


    <div class="w-100 p-4">

    <div class="container my-5">
        <p class="display-6 text-center my-5">Bem Vindo ao sitema de controle de vendas</p>
        <hr>
        <div class="text-center">

    </div>
        <hr>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center">

            <div class="col-4 p-3">
                <div class="border border-2 rounded-3 border-secondary p-5 text-center">
                    <h3>Plano {{ $plans[0]->name }}</h1>
                    <hr>
                    <h1 class="text-center text-white">{{ $plans[0]->price }} / Mês</h4>
                    <a href="{{ route('adm.plans.selected-plans', ['id' => Crypt::encryptString($plans[0]->product_id .'|'.$plans[0]->price_id)]) }}" class="btn btn-primary mt-3 w-100">ASSINAR</a>
                </div>
            </div>
            
            <div class="col-4 p-3">
                <div class="border border-5 bg-black rounded-3 border-success p-5 text-center">
                    <h3>Plano {{ $plans[1]->name }}</h1>
                    <hr>
                    <h1 class="text-center text-white">{{ $plans[1]->price }} / 3-Mês</h4>
                    <a href="{{ route('adm.plans.selected-plans', ['id' => Crypt::encryptString($plans[1]->product_id .'|'.$plans[1]->price_id)]) }}]) }}" class="btn btn-success mt-3 w-100">ASSINAR</a>
                    <p class="text-center text-warning mt-2">Mais popular!</p>
                </div>
            </div>
            
            <div class="col-4 p-3">
                <div class="border border-2 rounded-3 border-warning p-5 text-center">
                    <h3>Plano {{ $plans[2]->name }}</h1>
                    <hr>
                    <h1 class="text-center text-white">{{ $plans[2]->price }} / ano</h4>
                    <a href="{{ route('adm.plans.selected-plans', ['id' => Crypt::encryptString($plans[2]->product_id .'|'.$plans[2]->price_id)]) }}" class="btn btn-warning mt-3 w-100">ASSINAR</a>
                </div>
            </div>
            
        </div>
    </div>

</div>

</x-layout-app>