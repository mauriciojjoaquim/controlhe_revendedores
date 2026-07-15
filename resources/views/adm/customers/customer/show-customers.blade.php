<x-layout-app page-title="Detalhe do Cliente" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100 p-4">

        <h3>Detalhe do Cliente</h3>

        <hr>
        <div class="container-fluid">
            <div class="justify-content-center">
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 g-2 p-3">
                    {{-- Client --}}
                    <div class="col">
                        <div class="border {{ $conf['color-border'] }}">
                            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 g-2 p-3">
                                <div class="col">
                                    <H5>Colaborador - {{ $client->user->name }}</H5>
                                    <p>nome: <strong>{{ $client->name }}</strong></p>
                                    <p>Email: <strong>{{ $client->email }}</strong></p>
                                    <p>CPF: <strong>{{ $client->cpf }}</strong></p>
                                    <p>Contato / Whatsapp: <strong>{{ $client->clientdetail->phone }}</strong></p>
                                    <p>Data do Cadastro: <strong>{{ $client->clientdetail->register_date }}</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Client - detail --}}
                    <div class="col">
                        <div class="border {{ $conf['color-border'] }}">
                            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 g-2 p-3">
                                <div class="col">
                                    <H5>Cliente Detalhe</H5>
                                    <p>Cep: <strong>{{ $client->clientdetail->zip_code }}</strong></p>
                                    <p>Endereço: <strong>{{ $client->clientdetail->address }}</strong></p> 
                                    <p>Numero: <strong>{{ $client->clientdetail->number }}</strong></p> 
                                    <p>Complemento: <strong>{{ $client->clientdetail->complement }}</strong></p> 
                                    <p>Bairro: <strong>{{ $client->clientdetail->neighborhood }}</strong></p> 
                                    <p>Cidade: <strong>{{ $client->clientdetail->city }}</strong></p>
                                    
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Voltar</button>
                    </div>
                </div>
            </div>
            <div class="justify-content-center">
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-1 g-2 p-3">
                    {{-- Client --}}
                    <div class="col">
                        <div class="border {{ $conf['color-border'] }} p-2">
                            @if ($clientordendetails->count() === 0)
                            <div class="text-center">
                                <p>Nenhum detalhe do pedido do cliente encontrado.</p>
                            </div>
                            
                            @else
                            <div class="justify-content-center">
                                <div class="text-center mt-1">
                                    <H5 class="">Detalhes do pedido do cliente</H5>
                                </div>
                                @if($addcards->count() === 0)
                                <div class="text-center mt-3">
                                    <p>Não foi encotrado nenhum pedido neste cliente</p>
                                </div>
                                @else
                                <div class="table-responsive">
                                    <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100" id="table">
                                        <thead class="{{ $conf['bg_color_table'] }}">
                                            <th>Produto</th>
                                            <th>Quant.:</th>
                                            <th>Preço unit.:</th>
                                            <th>Preço Total</th>
                                            <th>Data da Compra</th>
                                            <th>Data de Conclusão</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($addcards as $addcard)
                                            @if($client->id === $addcard->client_id)
                                            <tr>
                                                <td>{{ $addcard->product_id }}</td>
                                                <td>{{ $addcard->amount }}</td>
                                                <td>{{ $addcard->price }}</td>
                                                <td>{{ $addcard->total_price }}</td>

                                                <td>
                                                    @if($addcard->purchase_date != null)
                                                    {{ date('d/m/Y H:i:s', strToTime($addcard->purchase_date)) }}
                                                    @endif
                                                </td>

                                                <td>
                                                    @if($addcard->completion_date != null)
                                                    {{ date('d/m/Y H:i:s', strToTime($addcard->completion_date)) }}
                                                    @else
                                                    Não foi concluido a compra
                                                    @endif
                                                </td>

                                              </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif


                            </div>
                                
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</x-layout-app>

{{-- 

            client_id
            product_id
            code
            amount
            price
            total_price
            purchase_date
            completion_date

--}}