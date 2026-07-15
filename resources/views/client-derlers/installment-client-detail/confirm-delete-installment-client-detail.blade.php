<x-layout-app page-title="Excluir Cliente" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Excluir Cliente</h3>

        <hr>

        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-xl-3 g-2 p-3">
            <div class="col"></div>
            <div class="col">
                <p>Tem certeza de que deseja excluir este cliente?</p>
        
                <div class="text-center">
                    <h3 class="my-5">{{ $client->name}}</h3>
                    <p>{{ $client->short_name }}</p>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.dealers.clients.client.table-vende-clients') }}" class="btn btn-warning px-5">Não</a>
                    <form action="{{ route('admin.dealers.clients.client.deleted-vende-clients') }}" method="post" class="px-2">
                        @csrf
                        <input type="hidden" name="id" value="{{ $client->id }}">
                        <button type="submit" class="btn btn-danger px-5">Sim</button>
                    </form>
            </div>
            <div class="col"></div>
        </div>

       
    
            </div>
        </div>

    </div>

</x-layout-app>