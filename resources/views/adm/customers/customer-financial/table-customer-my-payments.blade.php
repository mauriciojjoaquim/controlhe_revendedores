<x-layout-customer-app page-title="Meu Pagamentos" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100 p-4">

        <h3>Meu Pagamentos</h3>
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
        @if ($payments->count() === 0)
            <div class="text-center my-5">
                <p>Nenhum pagamentos foi encontrado.</p>
                {{-- <a href="{{ route('admin.dealers.clients.client.add-vende-clients') }}" class="btn btn-primary">Criar novo Cliente</a> --}}
            </div>
        @else
            <div class="mb-3">
                {{-- <a href="{{ route('admin.dealers.clients.client.add-vende-clients') }}" class="btn btn-primary">Criar novo Cliente</a> --}}
            </div>
            <div class="table-responsive">
                <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100" id="table">
                    <thead class="{{ $conf['bg_color_table'] }}">
                        <th class="text-start">Nº Pedido</th>
                        <th class="text-start">Vendedora (o)</th>
                        <th class="text-center">Quant. Produto</th>
                        <th class="text-center">Nº Parcela</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Mês/Ano - PG.</th>
                        <th class="text-end">Preço</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)

                        <tr>
                            <td class="text-start">{{ $payment->order_number_id }}</td>

                            <td class="text-start">
                                @foreach ($users as $user)
                                    @if ($payment->user_id == $user->id)
                                        {{ $user->name }}
                                    @endif
                                @endforeach
                            </td>

                            <td class="text-center">{{ $payment->quantity_product }}</td>

                            <td class="text-center">{{ $payment->installment_number }}</td>

                            <td class="text-center">
                                @if ($payment->month != null && $payment->year != null)
                                <span class="text-success">PG</span> 
                                @else
                                <span class="text-danger">NC</span> 
                                @endif
                            </td>

                            <td class="text-center text-success">
                                @if ($payment->month != null && $payment->year != null)
                            <span class="text-success">{{ $payment->month }}/{{ $payment->year }} - PG</span> 
                                @else
                                <span class="text-danger">00/0000 - NC</span> 
                                @endif
                            </td>

                            <td class="text-end">R$ {{ number_format($payment->installment_price, 2, ',', '.') }}</td>

                            <td class="text-center">
                                <div class="d-flex gap-1 justify-content-end">

                                    <div class="btn-lg-display d-flex gap-1 justify-content-end">
                                        @if ($payment->payment_date == null)
                                            <a href="{{ route('customers.customer-financial.customer-qr-pix-my-payments', ['id' => $payment->client_id])  }}" class="btn btn-sm btn-outline-warning ms-2"><i class="fa-solid fa-money-bill me-2"></i>Fazer Pagamento</a>
                                        @else
                                            <a href="{{ route('customers.customer-financial.customer-show-my-payments', ['id' => $payment->id])  }}" class="btn btn-sm btn-outline-warning ms-2"><i class="fas fa-eye me-2"></i>Detalhe</a>
                                        @endif
                                        
                                        <a href="{{ route('customers.customer-financial.customer-send-proof-my-payments', ['id' => $payment->client_id]) }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fa-regular fa-pen-to-square me-2"></i>Enviar Comprovante</a>
                                        {{-- <a href="{{ route('admin.dealers.clients.client.conf-delete-vende-clients', ['id' => $payment->id]) }}" class="btn btn-sm btn-outline-danger ms-2"><i class="fa-regular fa-trash-can me-2"></i>Excluir</a> --}}

                                    </div>
                                    <div class="btn-group btn-sm-display" role="group" aria-label="action">
                                        <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu " aria-labelledby="btnGroupDrop1">
                                            @if ($payment->payment_date == null)
                                                <li><a href="{{ route('customers.customer-financial.customer-qr-pix-my-payments', ['id' => $payment->id]) }}" class="dropdown-item"><i class="fas fa-eye me-2"></i>Fazer Pagamento</a></li>
                                            @else
                                                <li><a href="{{ route('customers.customer-financial.customer-show-my-payments', ['id' => $payment->id]) }}" class="dropdown-item"><i class="fas fa-eye me-2"></i>Detalhe</a></li>
                                            @endif
                                            
                                            <li><a href="{{ route('customers.customer-financial.customer-send-proof-my-payments', ['id' => $payment->client_id]) }}" class="dropdown-item"><i class="fa-regular fa-pen-to-square me-2"></i>Enviar Comprovante</a></li>
                                            {{--  <li><a href="{{ route('admin.dealers.clients.client.conf-delete-vende-clients', ['id' => $payment->id]) }}" class="dropdown-item"><i class="fa-regular fa-trash-can me-2"></i>Excluir</a></li> --}}
                                        </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                        </tr>



                        @endforeach

                    </tbody>
                </table>
            </div>

        @endif

    </div>
    </x-layout-customer-app>
