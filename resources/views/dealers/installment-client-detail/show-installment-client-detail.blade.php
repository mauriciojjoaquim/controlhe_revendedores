<x-layout-app page-title="Detalhe do Cliente" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100 p-4">

        <h3>Detalhe do Cliente">
        </h3>

        <hr>
        <div class="container-fluid">
            <div class="justify-content-center">
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 g-2 p-3">
                    {{-- Client --}}
                    <div class="col">
                        <div class="border {{ $conf['color-border'] }}">
                            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 g-2 p-3">
                                <div class="col">
                                    <H5>Vendedor -
                                        @foreach ($users as $user)
                                            @if ($client->user_id == $user->id)
                                            {{ $user->name }}
                                            @endif
                                        @endforeach
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

                    <div class="col">
                        <button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Voltar</button>
                    </div>
                </div>
            </div>
            <div class="w-100">
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-1 g-2 p-2">
                    {{-- Client --}}
                    <div class="col">
                        <div class="border {{ $conf['color-border'] }} p-2">
                            @if ($clientordendetails->count() === 0)
                            <div class="text-center">
                                <p>Nenhum detalhe do pedido do cliente encontrado.</p>
                            </div>

                            @else
                                <div class="text-center">
                                    <H5 class="p-3 text-center bg-dark text-light">Detalhes do pedido do cliente</H5>
                                </div>
                               <hr>
                                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-1 g-1 p-1">
                                    <div class="col table-responsive">
                                        <table class="table" id="table">
                                            <thead class="table-dark">
                                                <th>Name</th>
                                                <th>Preço Total</th>
                                                <th>preço por parcela</th>
                                                <th>parcelas pagas</th>
                                                <th>ID/User</th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                @foreach ($clientordendetails as $clientordendetail)
                                                @if ($client->clientorderdetail->client_id == $clientordendetail->client_id)
                                                    @if ($client->clientorderdetail->user_id == Auth::user()->id)
                                                    <tr>
                                                        <td>{{ $client->name }}</td>
                                                        <td>R$ {{ number_format($client->clientorderdetail->total_price, 2, ',', '.') }}</td>
                                                        <td>R$ {{ number_format($client->clientorderdetail->price_per_installment, 2, ',', '.') }}</td>
                                                        <td>{{ $client->clientorderdetail->installments_paid }}</td>
                                                        <td>
                                                            @foreach ($users as $user)
                                                                @if ($client->clientorderdetail->user_id == $user->id)
                                                                    {{ $client->clientorderdetail->user_id }} | {{ $user->name }}
                                                                @endif
                                                            @endforeach

                                                        </td>

                                                        <td>
                                                            <div class="d-flex gap-1 justify-content-end">

                                                                <div class="btn-lg-display d-flex gap-1 justify-content-end">
                                                                    <a href="{{ route('admin.dealers.clients.client-search.detail.show-order-vende-clients', ['id' => $client->id])  }}" class="btn btn-sm btn-outline-warning ms-2"><i class="fas fa-eye me-2"></i>Detalhe</a>
                                                                <a href="{{ route('admin.dealers.clients.client.edit-vende-clients', ['id' => $client->id]) }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a>
                                                                <a href="{{ route('admin.dealers.clients.client.conf-delete-vende-clients', ['id' => $client->id]) }}" class="btn btn-sm btn-outline-danger ms-2"><i class="fa-regular fa-trash-can me-2"></i>Excluir</a>

                                                                </div>
                                                                <div class="btn-group btn-sm-display" role="group" aria-label="action">
                                                                    <div class="btn-group" role="group">
                                                                    <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <ul class="dropdown-menu " aria-labelledby="btnGroupDrop1">
                                                                        <li><a href="{{ route('admin.dealers.clients.client-search.detail.show-order-vende-clients', ['id' => $client->id]) }}" class="dropdown-item"><i class="fas fa-eye me-2"></i>Detalhe</a></li>
                                                                        <li><a href="{{ route('admin.dealers.clients.client.edit-vende-clients', ['id' => $client->id]) }}" class="dropdown-item"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a></li>
                                                                        <li><a href="{{ route('admin.dealers.clients.client.conf-delete-vende-clients', ['id' => $client->id]) }}" class="dropdown-item"><i class="fa-regular fa-trash-can me-2"></i>Excluir</a></li>
                                                                    </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endif



                                                @endforeach

                                            </tbody>
                                        </table>
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

