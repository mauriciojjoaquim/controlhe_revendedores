<x-layout-app page-title="Todo Pedido Finalizado" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

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

        <h3>Todo Pedido Finalizado</h3>
        @if ($mysalesproducts->count() === 0)
            <div class="text-center my-5">
                <p>No Clients found.</p>
 {{-- <a href="{{ route('adm.resellers.reseller-my-sales-products.reload-reseller-my-sales-products') }}" class="btn btn-sm btn-outline-primary ms-2 p-2">
                                        <i class="fa-solid fa-magnifying-glass me-1"></i>atualizar pedido
                                    </a> --}}
            </div>
        @else
        <div class="my-5">
<a href="{{ route('adm.resellers.reseller-my-sales-products.reload-reseller-my-sales-products') }}" class="btn btn-sm btn-outline-primary ms-2 p-2">
                                    <i class="fa-solid fa-magnifying-glass me-1"></i>atualizar pedido
                                </a>
        </div>
            <div class="border {{ $conf['color-border'] }} shadow mb-3">
                <div class="card-header {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-2">
                    <form action="{{ route('adm.resellers.reseller-my-sales-products.order-completed-reseller-my-sales-products') }}" method="get">
                        <div class="d-flex justify-content-between">
                            <div class="row w-100">
                                <div class="col-sm-12 col-md-1">
                                    <label for="year" class="form-label">ano</label>
                                    <input type="number" name="year" id="year" class="form-control" value="{{ $year }}">
                                </div>
                                <div class="col-sm-12 col-md-1">
                                    <label for="month" class="form-label">Mês</label>
                                    <input type="number" name="month" id="month" class="form-control" value="{{ $month }}">
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <label for="start_date" class="form-label">Data Inicio</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $start_date }}">
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <label for="end_date" class="form-label">Data Fim</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $end_date }}">
                                </div>
                                <div class="col-sm-5 col-md-2 mt-2 d-flex justify-content-end pt-4">
                                    <button type="submit" class="btn btn-sm btn-outline-info ms-2 p-2">
                                        <i class="fa-solid fa-magnifying-glass me-1"></i>Pesquisar
                                    </button>
                                    <a href="{{ route('adm.resellers.reseller-my-sales-products.order-completed-reseller-my-sales-products') }}" class="btn btn-sm btn-outline-primary ms-2 pt-3">
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
                    <a href="{{ url('/adm/resellers/reseller-my-sales-products/relatorio-oder-completed-reseller-my-sales-products?' . request()->getQueryString()) }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fa-regular fa-file-lines me-2"></i>Gerar PDF</a>

                    {{-- <a href="{{ route('adm.resellers.reseller-my-sales-products.relatorio-reseller-my-sales-products') }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fa-regular fa-file-lines me-2"></i>Gerar Relatório em PDF</a> --}}
                </div>
            </div>
                <div class="mb-1">
                {{-- adm.resellers.reseller-my-sales-products.relatorio-reseller-my-sales --}}

            <div class="table-resposive shadow mb-3">
            <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100">
                <thead class="{{ $conf['bg_color_table'] }}">
                    <th>Code</th>
                    <th class="text-center">Mês</th>
                    <th class="text-center">Ano</th>
                    <th class="text-center">Ponto</th>
                    <th class="text-center">Quantidade</th>
                    <th class="text-center">Preço Compra</th>
                    <th class="text-center">Preço</th>
                    <th class="text-center">Preço Total Compra</th>
                    <th class="text-center">Data Compra</th>
                    <th class="text-center">Data Pedido</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($mysalesproducts as $mysalesproduct)
                    <tr>
                        <td>{{ $mysalesproduct->code }}</td>
                        <td class="text-center">{{ $mysalesproduct->month }}</td>
                        <td class="text-center">{{ $mysalesproduct->year }}</td>
                        <td class="text-center">{{ $mysalesproduct->point }}</td>
                        <td class="text-center">{{ $mysalesproduct->quantity }}</td>
                        <td class="text-center">R$ {{ number_format($mysalesproduct->purchase_price, 2, ',', '.') }}</td>
                        <td class="text-center">R$ {{ number_format($mysalesproduct->price, 2, ',', '.') }}</td>
                        <td class="text-center">R$ {{ number_format($mysalesproduct->total_purchase, 2, ',', '.') }}</td>
                        <td class="text-center">
                            @if ($mysalesproduct->purchase_date != null)
                            {{ date('d/m/Y', strtotime($mysalesproduct->purchase_date)) }}
                            @else
                            NC
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($mysalesproduct->order_date != null)
                            {{ date('d/m/Y', strtotime($mysalesproduct->order_date)) }}
                            @else
                                NC
                            @endif
                            
                        </td>

                        <td>
                             <div class="d-flex gap-1 justify-content-end">


                                <div class="btn-lg-display d-flex gap-1 justify-content-end">
                                    <a href="{{ route('adm.resellers.reseller-my-sales-products.show-reseller-my-sales-products', ['id' => $mysalesproduct->id])  }}" class="btn btn-sm btn-outline-warning ms-2"><i class="fas fa-eye me-2"></i>Detalhe</a>
                                    <a href="{{ route('adm.resellers.reseller-my-sales-products.edit-reseller-my-sales-products', ['id' => $mysalesproduct->id]) }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a>
                                    {{-- <a href="{{ route('adm.resellers.reseller-my-sales-products.conf-delete-reseller-my-sales-products', ['id' => $mysalesproduct->id]) }}" class="btn btn-sm btn-outline-danger ms-2"><i class="fa-regular fa-trash-can me-2"></i>Excluir</a> --}}

                                </div>
                                 <div class="btn-group btn-sm-display" role="group" aria-label="action">
                                    <div class="btn-group" role="group">
                                      <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Ação
                                      </button>
                                      <ul class="dropdown-menu " aria-labelledby="btnGroupDrop1">
                                        <li><a href="{{ route('adm.resellers.reseller-my-sales-products.show-reseller-my-sales-products', ['id' => $mysalesproduct->id]) }}" class="dropdown-item"><i class="fas fa-eye me-2"></i>Detalhe</a></li>
                                        <li><a href="{{ route('adm.resellers.reseller-my-sales-products.edit-reseller-my-sales-products', ['id' => $mysalesproduct->id]) }}" class="dropdown-item"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a></li>
                                        {{-- <li><a href="{{ route('adm.resellers.reseller-my-sales-products.conf-delete-reseller-my-sales-products', ['id' => $mysalesproduct->id]) }}" class="dropdown-item"><i class="fa-regular fa-trash-can me-2"></i>Ecluir</a></li> --}}
                                      </ul>
                                    </div>
                                  </div>
                             </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $mysalesproducts->links('pagination::bootstrap-5') }}
        </div>
        @endif

    </div>
</x-layout-app>
