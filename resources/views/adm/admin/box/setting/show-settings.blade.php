<x-layout-app page-title="Setting details" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-2">

    <div class="w-100 p-4">

        <h3>Colaborator details</h3>

        <hr>

        <div class="container-fluid">
            <div class="row mb-3 d-flex justify-content-center">

                <div class="col-6 border {{ $conf['color-border'] }}">

                    <p>Name: 
                        <strong>
                        @foreach ($users as $user)
                            @if ($setting->user_id == $user->id)
                                {{ $user->name }}
                            @endif 
                        @endforeach
                        </strong>
                    </p>
                    <p>Cor do texto do site: <strong>{{ $setting->text_color_site }}</strong></p>
                    <p>Cor da pagína do site: 
                        <strong>
                            @foreach ($cors as $cor)
                                @if ($setting->cor_id == $cor->id)
                                    <div class="{{ $cor->cor_tag }} {{ $cor->text_cor }}">
                                        {{ $cor->cor_name_br }}
                                    </div>
                                @endif
                            @endforeach
                            {{ $setting->user_id }}
                        </strong>
                    </p>
                    
                    <p>Cor do texto: <strong>{{ $setting->text_color }}</strong></p>
                    <p>Pix: <strong>{{ $setting->pix }}</strong></p>

                    <button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Back</button>

                    
                </div>
            </div>
        </div>
{{-- 
       
    </div>

</x-layout-app>