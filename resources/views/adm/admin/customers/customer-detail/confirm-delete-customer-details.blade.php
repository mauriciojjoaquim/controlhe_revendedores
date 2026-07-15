<x-layout-app page-title="Delete colaborator" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100 p-4">

        <h3>Delete colaborator</h3>

        <hr>

        <p>Are you sure you want to delete this colaborator?</p>
        
        <div class="text-center">
            <h3 class="my-5">{{ $clientdetail->address}}</h3>
            <p>{{ $clientdetail->number }}</p>
            <div class="d-flex justify-content-end">
                <a href="{{ route('adm.customers.customer-detail.table-customer-detail') }}" class="btn btn-warning px-5">No</a>
            <form action="{{ route('adm.customers.customer-detail.deleted-customer-detail') }}" method="post" class="px-2">
                @csrf
                <input type="hidden" name="id" value="{{ $clientdetail->id }}">
                <button type="submit" class="btn btn-danger px-5">Yes</button>
            </form>
    
            </div>
        </div>

    </div>

</x-layout-app>