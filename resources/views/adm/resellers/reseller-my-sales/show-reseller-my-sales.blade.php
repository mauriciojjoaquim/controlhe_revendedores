<x-layout-app page-title="Detalhe da Venda" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Detalhe da Venda</h3>

        <hr>

        <div class="container-fluid">
            <div class="row row-cols row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1">
                <div class="col mb-3 d-flex justify-content-center p-3">
 
                    <div class="border {{ $conf['color-border'] }} p-4">
                            <div class="row row-cols row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1">
    
                                <div class="col col-sm-12 col-md-12 col-lg-12">
                                    <H5>Client - 
                                        @if ($clients->count() > 0)
                                            @foreach ($clients as $client)
                                                @if ($mysale->client_id == $client->id)
                                                    {{ $client->name }}
                                                @endif 
                                            @endforeach
                                        @else
                                            Não foi encontrado cliente
                                        @endif
                                    </H5>
                                </div>
                                <div class="col col-sm-10 col-md-10 col-lg-10">
                                    <p><strong></strong></p>
                                    <p>Pontos <strong>{{ $mysale->point }}</strong></p>
                                    <p>Número do pedido <strong>{{ $mysale->order_number_id }}</strong></p>
                                    <p>Quantidade do produto <strong>{{ $mysale->quantity_product }}</strong></p>
                                    <p>Número da parcela <strong>{{ $mysale->installment_number }}</strong></p>
                                    <p>Preço da parcela <strong>R$ {{ number_format($mysale->installment_price, 2, ',', '.') }} </strong></p>
                                    <p>Data de vencimento <strong>{{ date('d/m/Y', strtotime($mysale->due_date)) }}</strong></p>
                                    <p>Data de pagamento 
                                        <strong>
                                            @if ($mysale->payment_date != null)
                                                {{ date('d/m/Y', strtotime($mysale->payment_date)) }}
                                            @else
                                                NC
                                            @endif
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col mb-3 d-flex justify-content-center p-3">
                    <button class="btn btn-outline-warning" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Back</button>
                </div>
            </div>
            
        </div>


    </div>

</x-layout-app>

