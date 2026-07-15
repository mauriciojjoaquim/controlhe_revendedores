<x-layout-app page-title="Adicionar a sua carteira de Cliente" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100 p-4">

        <h3>Adicionar a sua carteira de Cliente</h3>
        <div class="d-flex justify-content-center">
            <div class="w-100 p-3">
                @if (session('status'))
            <div class="alert alert-{{ (session('tipo_alert')) }} text-dark text-center mt-4 p-2" role="alert">
                <div class="p-1">
                    <p class="pt-2 h1  {{ session('paricin') }}"><i class="{{ session('icon') }}"></i></p>
                    <p class="fs-4">{{ session('mesagem') }}</p>
                    <p class="fs-5">{{ session('data') }}</p>
                </div>

            </div>
        @endif
            </div>

         </div>

        <hr>
        @if (session('cod') == 'mcgsd')
        <div class="d-flex justify-content-center">
            <div class="w-100">
                <form action="{{ route('admin.dealers.clients.client-search.info-vende-clients') }}" method="post">
                    @csrf
                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                    <div class="mt-3 p-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-primary mb-4">Criar novo Adicionar a minha carteira</button>
                    </div>
                </form>
            </div>
        </div>


        @elseif (session('cod') == 'mczsd')
        <div class="d-flex justify-content-center">
            <div class="w-100">
                <div class="mt-3 p-3 d-flex justify-content-center">
                    <a href="{{ route('admin.dealers.clients.client-search.show-info-vende-clients', ['id' => $client->id]) }}" class="btn btn-outline-primary mb-4"><i class="fas fa-eye me-2"></i>Detalhe</a>
                </div>
            </div>
        </div>


        @else
            <div class="d-flex justify-content-center">
                <div class="w-50">
                    <div class="alert alert-danger text-dark text-center mt-4 p-2" role="alert">
                        <div class="p-1">
                            <p class="pt-2 h1  text-dark"><i class="fas fa-exclamation-triangle"></i></p>
                            <p class="fs-4"></p>
                            <p class="fs-5"></p>
                        </div>

                    </div>
                </div>
            </div>

        @endif



    </div>

</x-layout-app>

