<x-layout-app page-title="Detalhe da Configuração" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-2">


        <h3>Detalhe da Configuração</h3>

        <hr>

        <div class="container-fluid">
            <div class="row mb-3 d-flex justify-content-center">

                <div class="col-6">

                    <h3>Name: 
                        <strong>
                        @foreach ($users as $user)
                            @if ($setting->user_id == $user->id)
                                {{ $user->name }}
                            @endif 
                        @endforeach
                        </strong>
                    </h3>
                    <h5>Cor do texto do site: <strong class="{{ $setting->text_color_site }}">{{ $setting->text_color_site }}</strong></h5>
                    <div class="row">
                        <div class="col">
                            <h5>Cor da pagína do site do cliente: 
                            </h5>
                        </div>
                        <div class="col">
                            @foreach ($cors as $cor)
                            @if ($setting->bg_color_site == $cor->cor_tag)
                            <div class="{{ $cor->cor_tag }} {{ $cor->text_cor }}">
                                {{ $cor->cor_name_br }}
                            </div>
                            @endif
                        @endforeach
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <h5>Cor da pagína do site do vendedor:</h5>
                        </div>
                        <div class="col">
                            @if ($setting->color_site_bg != null)
                                @foreach ($cors as $cor)
                                    @if ($setting->color_site_bg === $cor->cor_tag)
                                        <div class="{{ $cor->cor_tag }} {{ $setting->text_color_site }}">
                                            {{ $cor->cor_name_br }} teste
                                        </div>
                                    
                                    @endif
                                @endforeach
                            @else
                            <div class="">Não foi encontrado es cor</div>
                            @endif
                            
                        </div>
                    </div>

                    
                    <h5>Cor do texto do site: <strong class="{{ $setting->text_color }}">{{ $setting->text_color }}</strong></h5>
                    <h5>Pix: <strong>{{ $setting->pix }}</strong></h5>
                    <h5>Preço: <strong>R$ {{ number_format($setting->price, 2, ',', '.')}}</strong></h5>

                    <button class="btn btn-outline-warning" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Voltar</button>

                    
                </div>
            </div>
        </div>
{{-- 
       
    </div>

</x-layout-app>