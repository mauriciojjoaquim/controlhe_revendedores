<x-layout-app page-title="Confirmação de exclusão da Configuração" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-2">

        <h3>Confirmação de exclusão da Configuração</h3>

        <hr>

        <p>Tem certeza de que deseja excluir essas configurações?</p>
        
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-1 p-2">

            <div class="col-xl-12 col-md-12 col-md-12 col-sm-12">
                <div class="text-center">
                    <h3 class="my-5">
                        @foreach ($users as $user)
                            @if ($setting->user_id == $user->id)
                                {{ $user->name }}
                            @endif
                        @endforeach
                        
                    </h3>
                    <p>
                        @foreach ($users as $user)
                            @if ($setting->user_id == $user->id)
                                {{ $user->name }}
                            @endif
                        @endforeach
                    </p>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('adm.Leaders.leader-seller-setting.table-leader-seller-setting') }}" class="btn btn-warning px-5">No</a>
                    <form action="{{ route('adm.Leaders.leader-seller-setting.deleted-leader-seller-setting') }}" method="post" class="px-2">
                        @csrf
                        <input type="hidden" name="id" value="{{ $setting->id }}">
                        <button type="submit" class="btn btn-danger px-5">Yes</button>
                    </form>
            
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-layout-app>