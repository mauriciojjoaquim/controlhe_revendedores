<x-layout-app page-title="Todos Clientes" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-2">

        <h3>Todos Clientes</h3>
       @if(session('status'))
            <div class="d-flex justify-content-center">
                <div class="w-100">
                    <div class="alert alert-{{ session('tipo_alert') }} {{ session('paricin') }} text-center mt-4 p-2" role="alert">
                        <div class="p-1">
                            <p class="pt-2 h1  {{ session('paricin') }}"><i class="{{ session('icon') }}"></i></p>
                            <p class="fs-4">{{ session('mesagem') }}</p>
                            <p class="fs-5"></p>
                        </div>

                    </div>
                </div>
            </div>
       @endif
        @if ($clients->count() === 0)
        <div class="text-center my-5">
            <p>No Clients found.</p>
            <a href="{{ route('admin.dealers.clients.client.add-vende-clients') }}" class="btn btn-primary">Criar novo Cliente</a>
        </div>
    @else
    <div class="mb-3">
        <a href="{{ route('admin.dealers.clients.client.add-vende-clients') }}" class="btn btn-primary">Criar novo Cliente</a>
    </div>
<div class="table-responsive">
    <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100" id="table">
        <thead class="{{ $conf['bg_color_table'] }}">
            <th>Nome</th>
            <th>E-mail</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                @if ($client->user_id == Auth::user()->id)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>

                    <td>
                        <div class="d-flex gap-1 justify-content-end">

                            <div class="btn-lg-display d-flex gap-1 justify-content-end">
                                <div class="">
                                    <form action="{{ route('admin.dealers.clients.client.add-installment-client-detail') }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                                        <button type="submit" class="btn btn-sm btn-outline-success ms-2"><i class="fa-solid fa-cart-shopping me-2"></i>Fazer Pedido</button>
                                    </form>
                                </div>

                                <a href="{{ route('client-dealer.online-installment-client-detail', ['id' => $client->id])  }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fa-solid fa-user me-2"></i>Libera Online</a>
                                <a href="{{ route('admin.dealers.clients.client.show-vende-clients', ['id' => $client->id])  }}" class="btn btn-sm btn-outline-warning ms-2"><i class="fas fa-eye me-2"></i>Detalhe</a>
                                <a href="{{ route('admin.dealers.clients.client.edit-vende-clients', ['id' => $client->id]) }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a>
                                <a href="{{ route('admin.dealers.clients.client.conf-delete-vende-clients', ['id' => $client->id]) }}" class="btn btn-sm btn-outline-danger ms-2"><i class="fa-regular fa-trash-can me-2"></i>Excluir</a>

                            </div>
                            <div class="btn-group btn-sm-display" role="group" aria-label="action">
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu " aria-labelledby="btnGroupDrop1">
                                        <li>
                                            <form action="{{ route('admin.dealers.clients.client.add-installment-client-detail') }}" method="GET">
                                                @csrf
                                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                                <button type="submit" class="dropdown-item"><i class="fa-solid fa-cart-shopping me-2"></i>Fazer Pedido</button>
                                            </form>
                                        </li>
                                        <li><a href="{{ route('client-dealer.online-installment-client-detail', ['id' => $client->id]) }}" class="dropdown-item"><i class="fa-solid fa-cart-shopping me-2"></i>Libera Online</a></li>
                                        <li><a href="{{ route('admin.dealers.clients.client.show-vende-clients', ['id' => $client->id]) }}" class="dropdown-item"><i class="fas fa-eye me-2"></i>Detalhe</a></li>
                                        <li><a href="{{ route('admin.dealers.clients.client.edit-vende-clients', ['id' => $client->id]) }}" class="dropdown-item"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a></li>
                                        <li><a href="{{ route('admin.dealers.clients.client.conf-delete-vende-clients', ['id' => $client->id]) }}" class="dropdown-item"><i class="fa-regular fa-trash-can me-2"></i>Excluir</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endif


            @endforeach

        </tbody>
    </table>
</div>

@endif

    </div>
    </x-layout-app>
