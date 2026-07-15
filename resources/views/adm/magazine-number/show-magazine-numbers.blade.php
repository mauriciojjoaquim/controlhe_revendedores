<x-layout-app page-title="Category details" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Category details</h3>

        <hr>
        <div class="container-fluid">
        <div class="d-flex justify-content-center">

            <div class="row mb-3">

                <div class="col-12">
                    <p>número do ciclo: <strong>{{ $magazineNumber->number }}</strong></p>
                    <p>Ativado: 
                        @if ($magazineNumber->activated == 1)
                               <strong class="alert-success p-1 ps-4 pe-4"><i class="fa-regular fa-circle-check me-3"></i>Ativado</strong> 
                            @else
                            <a href="{{ route('adm.magazine-numbers.activated-magazine-numbers', ['id' => $magazineNumber->id]) }}" class="btn btn-sm btn-danger ms-2">
                                <i class="fa-regular fa-circle-xmark"></i>
                                <strong class="p-1">Desativado</strong>
                            </a>
                                 
                            @endif
                    </p>
                    <p>Inicio Data: <strong>{{ $magazineNumber->start_date }}</strong></p>
                    <p>Fim Data: <strong>{{ $magazineNumber->end_date }}</strong></p>
                </div>
                <div class="col-12">
                    <button class="btn btn-outline-warning" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Back</button>
                </div>
        </div>

    </div>
</div>




    </div>

</x-layout-app>
