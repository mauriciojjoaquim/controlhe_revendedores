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
                                    <H5>Vendedora - 
                                        @if ($users->count() != 0)
                                            @foreach ($users as $user)
                                                @if ($user->id == $client->user_id)
                                                    {{ $user->name }}
                                                @endif
                                            @endforeach
                                        @else
                                            NC
                                        @endif
                                        1
                                    </H5>
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
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-outline-warning" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Voltar</button>
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
                            <div class="d-flex justify-content-center">
                                <div class="text-center bg-dark">
                                    <H5 class="">Detalhes do pedido do cliente</H5>
                                </div>
                                


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

