<x-layout-app page-title="Excluir boleto" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-2">

        <h3>Excluir boleto</h3>

        <hr>

        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-1">

            <div class="col-xl-6 col-md-6 col-md-12 col-sm-12 text-center">
                <p>Tem certeza de que deseja excluir este boleto?</p>
        
        <div class="text-center">
            <h3 class="my-5">Número da nota fiscal: {{ $invoice->invoice_number }}</h3>
            <p>boleto: {{ $invoice->description }}</p>
            <div class="d-flex justify-content-center">
                <a href="{{ route('adm.resellers.reseller-invoice-registration-for-payments.table-reseller-invoice') }}" class="btn btn-warning px-5">Não</a>
            <form action="{{ route('adm.resellers.reseller-invoice-registration-for-payments.deleted-reseller-invoice') }}" method="post" class="px-2">
                @csrf
                <input type="hidden" name="id" value="{{ $invoice->id }}">
                <button type="submit" class="btn btn-danger px-5">Sim</button>
            </form>
    
            </div>
        </div>
            </div>
        </div>
        

    </div>

</x-layout-app>