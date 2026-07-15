<x-layout-app page-title="Minhas Vendas" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">
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
        <h3>Todas Minhas Vendas</h3>
        @if ($mysales->count() === 0)
            <div class="text-center my-5">
                <p>No Clients found.</p>

            </div>
        @else
            <div class="border {{ $conf['color-border'] }} shadow mb-3">
                <div class="card-header {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-2">
                    <form action="{{ route('adm.resellers.reseller-my-sales.table-reseller-my-sales') }}" method="get">
                        <div class="d-flex justify-content-between">
                            <div class="row w-100">
                                <div class="col-sm-12 col-md-2">
                                    <label for="client_id" class="form-label">ID do Cliente</label>
                                    <input type="number" name="client_id" id="client_id" class="form-control" value="{{ $client_id }}">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="start_date" class="form-label">Data Inicio</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $start_date }}">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="end_date" class="form-label">Data Fim</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $end_date }}">
                                </div>
                                <div class="col-sm-5 col-md-2 mt-3 pt-4">
                                    <button type="submit" class="btn btn-sm btn-outline-info ms-2 p-2">
                                        <i class="fa-solid fa-magnifying-glass me-1"></i>Pesquisar
                                    </button>
                                    <a href="{{ route('adm.resellers.reseller-my-sales.table-reseller-my-sales') }}" class="btn btn-sm btn-outline-primary ms-2 p-2">
                                        <i class="fa-solid fa-eraser me-1"></i>Limpar
                                    </a>
                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>
                <div class="mb-1">
                <div class="mb-3 d-flex justify-content-end p-1">
                    <a href="{{ url('adm/resellers/reseller-my-sales/relatorio-reseller-my-sales?' . request()->getQueryString()) }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fa-regular fa-file-lines me-2"></i>Gerar PDF</a>
                    {{-- <a href="{{ route('adm.resellers.reseller-my-sales.relatorio-reseller-my-sales') }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fa-regular fa-file-lines me-2"></i>Gerar Relatório em PDF</a> --}}
                </div>
            </div>
                <div class="mb-1">
                {{-- adm.resellers.reseller-my-sales.relatorio-reseller-my-sales --}}

            <div class="table-resposive pt-3">
            <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100">
                <thead class="{{ $conf['bg_color_table'] }}">
                    <tr>
                        <th>Nº do pedido</th>
                        <th>ID/ Nome do cliente</th>
                        <th>Ponto</th>
                        <th class="text-center">Quant/ Produtos</th>
                        <th class="text-center">Nº de Parcela</th>
                        <th class="text-center">Preço da parcela</th>
                        <th class="text-center">Data de Vencimento</th>
                        <th class="text-center">Data de Pagamento</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mysales as $mysale)
                    <tr>
                        <td class="text-center">{{ $mysale->order_number_id }}</td>
                        <td>
                            @if ($clients->count() > 0)
                                @foreach ($clients as $client)
                                    @if ($mysale->client_id == $client->id)
                                        {{ $client->id }} - {{ $client->name }}
                                    @endif
                                @endforeach
                            @else
                                Não foi encontrado cliente
                            @endif
                        </td>

                        <td class="text-center">{{ $mysale->point }}</td>
                        <td class="text-center">{{ $mysale->quantity_product }}</td>
                        <td class="text-center">{{ $mysale->installment_number }}</td>
                        <td class="text-center">R$ {{ number_format($mysale->installment_price, 2, ',', '.') }}</td>
                        <td class="text-center">{{ date('d/m/Y', strtotime($mysale->due_date)) }}</td>
                        <td class="text-center">
                            @if ($mysale->payment_date != null)
                                {{ date('d/m/Y', strtotime($mysale->payment_date)) }}
                            @else
                                NC
                            @endif
                        </td>
                        <td>
                             <div class="d-flex gap-1 justify-content-end">


                                <div class="btn-lg-display d-flex gap-1 justify-content-end">
                                    <a href="{{ route('adm.resellers.reseller-my-sales.show-reseller-my-sales', ['id' => $mysale->id])  }}" class="btn btn-sm btn-outline-warning ms-2"><i class="fas fa-eye me-2"></i>Detalhe</a>
                                    <a href="{{ route('adm.resellers.reseller-my-sales.edit-reseller-my-sales', ['id' => $mysale->id]) }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a>
                                    {{-- <a href="{{ route('adm.resellers.reseller-my-sales.conf-delete-reseller-my-sales', ['id' => $mysale->id]) }}" class="btn btn-sm btn-outline-danger ms-2"><i class="fa-regular fa-trash-can me-2"></i>Excluir</a> --}}

                                </div>
                                 <div class="btn-group btn-sm-display" role="group" aria-label="action">
                                    <div class="btn-group" role="group">
                                      <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Ação
                                      </button>
                                      <ul class="dropdown-menu " aria-labelledby="btnGroupDrop1">
                                        <li><a href="{{ route('adm.resellers.reseller-my-sales.show-reseller-my-sales', ['id' => $mysale->id]) }}" class="dropdown-item"><i class="fas fa-eye me-2"></i>Detalhe</a></li>
                                        <li><a href="{{ route('adm.resellers.reseller-my-sales.edit-reseller-my-sales', ['id' => $mysale->id]) }}" class="dropdown-item"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a></li>
                                        {{-- <li><a href="{{ route('adm.resellers.reseller-my-sales.conf-delete-reseller-my-sales', ['id' => $mysale->id]) }}" class="dropdown-item"><i class="fa-regular fa-trash-can me-2"></i>Ecluir</a></li> --}}
                                      </ul>
                                    </div>
                                  </div>
                             </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $mysales->links('pagination::bootstrap-5') }}
        </div>
        @endif

    </div>
</x-layout-app>
