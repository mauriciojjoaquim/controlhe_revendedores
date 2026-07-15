<x-layout-app page-title="Cor details" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100  p-4">


        <h3>Cor details</h3>

        <hr>

        <div class="container-fluid">
            <div class="row mb-3 d-flex justify-content-center">

                <div class="col-6">

                    <h3>Name da Cor: <strong>{{ $cor->name }}</strong></h3>
                    
                    <p>
                        fundo colorido:
                        <strong class="{{ $cor->color_bg }} pe-4 ps-4">{{ $cor->name }}</strong>
                    </p>
                   
                    <p>
                        fundo de tabela colorido:
                        <table class="table {{ $cor->color_table_bg }} pe-4 ps-4">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>nome</th>
                                </tr>
                            </tbody>
                        </table>
                    </p>
                    
                    <p>
                        fundo de cartão colorido:
                        <strong class="card {{ $cor->color_card_bg }} text-light pe-4 ps-4">Card</strong>
                    </p>
                    
                    <p>
                        texto colorido:
                        <strong class="{{ $cor->color_text }} pe-4 ps-4">{{ $cor->name }}</strong>
                    </p>
                    
                    <p>
                        borda colorida:
                        <strong class="border {{ $cor->color_border }} pe-4 ps-4">{{ $cor->name }}</strong>
                    </p>

                    <button class="btn btn-outline-warning" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Voltar</button> 
                </div>
              
            </div>
        </div>
       
    </div>

</x-layout-app>

{{-- 

            name  
            color_bg
            color_table_bg
            color_card_bg
            color_text
            color_border

--}}