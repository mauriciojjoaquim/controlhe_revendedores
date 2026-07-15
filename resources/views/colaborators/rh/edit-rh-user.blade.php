<x-layout-app page-title="Edit RH User" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Edit Human Resources Colaborator</h3>

        <hr>
        {{-- disabled --}}
@if ($colaborator->user_id === Auth::user()->id)
<x-rh-user-form-rh :colaborator="$colaborator" :departments="$departments" />
@else
    
    <x-rh-user-form-adm :colaborator="$colaborator" :departments="$departments" />
@endif
        

    </div>

</x-layout-app>

