<x-layout-app page-title="User Profile" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">
        <h3>User Profile</h3>
        <hr>
        <x-profile-user-data />
        <hr>
        <div class="container-fluid m-0 p-0 mt-5">
            <div class="row row-cols row-cols-sm-1 row-cols-lg-2 row-cols-xl-3 row-cols-xxl-4  gap-3">
                    {{-- Autera senha  --}}

                    <div class="col-12">
                        <div class="border {{ $conf['color-border'] }} p-2">
                        <x-profile-user-change-password />
                    </div>
                    </div>
                    {{-- autera nome e email --}}
                    <div class="col-12">
                        <div class="border {{ $conf['color-border'] }} p-2">
                        <x-profile-user-change-data :colaborator="$colaborator" />
                        </div>
                    </div>
                    {{-- autera Detail --}}
                    <div class="col-12">
                        <div class="border {{ $conf['color-border'] }} p-2">
                        <x-profile-user-change-detail :colaborator="$colaborator->detail" />
                        </div>
                    </div>

            </div>

        </div>
    </div>

</x-layout-app>
