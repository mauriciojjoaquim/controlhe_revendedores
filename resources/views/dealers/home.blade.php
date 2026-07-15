<x-layout-app page-title="Home" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100 p-4">
     <h3>Home</h3>
      <hr>
      @if (session('staus'))
        <div class="alert alert-{{ (session('tipo_alert')) }} text-dark text-center mt-4 p-2">
            {{ session('mesagem') }}
        </div>
        <hr>
    @endif
    <hr>
    <h4>Atalhos</h4>
    <div class="d-flex row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-5 row-cols-xl-5 row-cols-xxl-5 g-2 g-lg-5">
        <div class="col">
            <a class="btn btn-outline-primary" href="{{ route('admin.dealers.clients.client-search.search-vende-clients') }}">Fazer Venda</a>
        </div>
    </div>
    <hr>
     <div class="d-flex row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-4 g-2 g-lg-4">
         <div class="col">
             <div class="card {{ $conf['bg_color_menu'] }} {{ $conf['text_color'] }} p-4 m-2">
                 <h5 class="text-dark">Total de Clientes Ativado</h5>
                 <span class="border-bottom w-100"></span>
                 <h1 class="text-center">{{ $data['total_clients'] }}</h1>
             </div>
         </div>

         <div class="col">
             <div class="card {{ $conf['bg_color_menu'] }} {{ $conf['text_color'] }} p-4 m-2">
                 <h5 class="text-dark">Total de Clientes Desativado</h5>
                 <h1 class="text-center">{{ $data['total_clients_deleted'] }}</h1>
             </div>
         </div>

         <div class="col">
            <div class="card {{ $conf['bg_color_menu'] }} {{ $conf['text_color'] }} p-4 m-2">
                <h5 class="text-dark">Total de Divida em pacelas Clientes</h5>
                <h1 class="text-center">R$ {{ $data['total_debt_installment_by_deve'] }}</h1>
            </div>
        </div>

         <div class="col">
             <div class="card {{ $conf['bg_color_menu'] }} {{ $conf['text_color'] }} p-4 m-2">
                 <h5 class="text-dark">Total de Divida Clientes</h5>
                 <h1 class="text-center">R$ {{ $data['total_clients_debt'] }}</h1>
             </div>
         </div>

     </div>
     <hr>

   <div class="d-flex">
    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-lg-3">
        <div class="col">
            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1">

                <div class="col">
                    <div class="card {{ $conf['bg_color_menu'] }} {{ $conf['text_color'] }} p-4 m-2">
                        <h5 class="text-dark">Total Cliente da sua Carteira</h5>
                        <div class="table-responsive">
                            <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-striped table-hover table-borderless table-primary align-middle">
                                <tbody class="table-group-divider">
                                   @if ($data['total_clients_per_vende']->count() == 0)
                                   <p class="{{ $conf['text_color'] }}">No department</p>
                                   @else
                                       @foreach ($data['total_clients_per_vende'] as $collection)
                                           <tr class="{{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }}">
                                               <td scope="row">Clientes</td>
                                               <td class="text-end">{{ $collection['total'] }}</td>
                                           </tr>
                                       @endforeach
                                   @endif
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card {{ $conf['bg_color_menu'] }} {{ $conf['text_color'] }} p-4 m-2">
                        <h5 class="text-dark">Total de Divida dos Clientes</h5>
                        <div class="table-responsive">
                            <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-striped table-hover table-borderless table-primary align-middle">
                                <tbody class="table-group-divider">
                                   @if ($data['total_debt_by_deve']->count() == 0)
                                       <p class="{{ $conf['text_color'] }}">No Divida</p>
                                   @else
                                       @foreach ($data['total_debt_by_deve'] as $collection)
                                       <tr class="{{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }}">
                                           <td scope="row">Clientes</td>
                                           <td class="text-end"><strong>R$ {{ $collection['total'] }}</strong></td>
                                       </tr>
                                   @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

             </div>
        </div>
        <div class="col">
            <div class="card {{ $conf['bg_color_menu'] }} {{ $conf['text_color'] }} p-4 m-2">
                <h5 class="text-dark">Confirmar pagamento de clientes</h5>
                <div class="table-responsive">
                    <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-striped table-hover table-borderless table-primary align-middle">
                        <tbody class="table-group-divider">
                           @if ($clients->count() == 0)
                               <p class="{{ $conf['text_color'] }}">Não costa divida de cliente</p>
                           @else
                               @foreach ($clients as $client)
                               <tr class="{{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }}">
                                   <td scope="row">{{ $client->name }}</td>
                                   <td class="text-end">
                                        <strong>
                                           @php
                                               $total = number_format($client->clientorderdetail->total_price, 2, ',', '.');
                                           @endphp
                                            R$ {{ $total }}
                                        </strong>
                                    </td>
                                    <td class="text-end">
                                        <strong>
                                           @php
                                            $datatotal = $client->clientorderdetail->total_price;
                                            $data = $client->clientorderdetail->installment_payment_date;
                                            $datastatus = $client->clientorderdetail->customer_status;
                                           @endphp
                                           @if ($datastatus == 'NC')
                                           @if ($datatotal != 0.00)
                                           <a href={{ route('admin.dealers.clients.client.confirma-cart-payment-detail', ['id' => $client->id]) }}" class="btn btn-sm btn-success me-2">C-PG</a>
                                           @else
                                           {{ $client->clientorderdetail->customer_status }}
                                           @endif

                                           @elseif($datastatus == 'PG')
                                           {{ $client->clientorderdetail->customer_status }}
                                           @endif

                                        </strong>
                                    </td>
                               </tr>
                           @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card {{ $conf['bg_color_menu'] }} {{ $conf['text_color'] }} p-4 m-2">
                <h5 class="text-dark">Total de Parcela por Clientes</h5>
                <div class="table-responsive">
                    <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-striped table-hover table-borderless table-primary align-middle">
                        <tbody class="table-group-divider">
                           @if ($clients->count() == 0)
                               <p class="{{ $conf['text_color'] }}">No salary</p>
                           @else
                               @foreach ($clients as $client)
                               <tr class="{{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }}">
                                   <td scope="row">{{ $client->name }}</td>
                                   <td class="text-end"><strong> {{ $client->clientorderdetail->number_of_installments }}/{{ $client->clientorderdetail->installments_paid }}</strong></td>
                               </tr>
                           @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

     </div>
     <hr>
    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2">
        <div class="col">
            <div class="card {{ $conf['bg_color_menu'] }} {{ $conf['text_color'] }} p-4 m-2">
                <h5 class="text-dark">Data de pagamento</h5>
                <div class="table-responsive">
                    <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-striped table-hover table-borderless table-primary align-middle">
                        <tbody class="table-group-divider">
                            @if ($clients->count() == 0)
                                <p class="{{ $conf['text_color'] }}">Não foi encontrado pagamento</p>
                            @else
                                @foreach ($clients as $client)
                                <tr class="{{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }}">
                                    <td scope="row">{{ $client->name }}</td>
                                    <td class="text-end">Venc.: <strong>
                                        @if ($client->clientorderdetail->installment_due_date != null)
                                        {{ date('d/m/Y', strtotime($client->clientorderdetail->installment_due_date)) }}
                                        @else
                                        NC
                                        @endif
                                        </strong></td>
                                    <td class="text-end">Pag.:<strong>


                                        @if (now() > $client->clientorderdetail->installment_payment_date)
                                            @if ($client->clientorderdetail->installment_payment_date == null and
                                            $client->clientorderdetail->customer_status == 'NC')
                                                @if ($client->clientorderdetail->installment_due_date == null)
                                                    NC
                                                @else
                                                A Vencer - NC
                                                @endif

                                            @elseif ($client->clientorderdetail->installment_payment_date ==
                                                            $client->clientorderdetail->installment_payment_date and
                                                            $client->clientorderdetail->customer_status == 'C-PG')
                                            utimo dia vencido
                                            @if ($client->clientorderdetail->customer_status == 'PG')
                                                PG
                                            @endif
                                            @else
                                            Vencimento
                                            @endif
                                            @else
                                            @if ($client->clientorderdetail->customer_status == 'PG')
                                            {{ date('d/m/Y', strtotime($client->clientorderdetail->installment_payment_date)) }} - PG
                                            @else
                                            A Veencer - NC
                                            @endif

                                        @endif
                                    </strong></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <hr>
    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2">
        <div class="col">
            <div class="card {{ $conf['bg_color_menu'] }} {{ $conf['text_color'] }} p-4 m-2">
                <h5 class="text-dark">Total Fechamento Mês</h5>
                <div class="table-responsive">
                    <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-striped table-hover table-borderless table-primary align-middle">
                        <tbody class="table-group-divider">
                           @if ($total_monthly_closings->count() == 0)
                               <p class="{{ $conf['text_color'] }}">Não foi encotrado Fechamento</p>
                           @else
                           <thead>
                            <tr>
                                <th>Mês</th>
                                <th>Ano</th>
                                <th>Quant. Produto</th>
                                <th>Preço gasto</th>
                                <th>Preço Recebido</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                               @foreach ($total_monthly_closings as $total_monthly_closing)
                               <tr class="{{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }}">
                                   <td scope="row">{{ $total_monthly_closing->month }}</td>
                                   <td class="text-end">{{ $total_monthly_closing->year }}</td>
                                   <td class="text-end">{{ $total_monthly_closing->product_quantity }}</td>
                                   <td class="text-end">{{ $total_monthly_closing->reselle_price }}</td>
                                   <td class="text-end">{{ $total_monthly_closing->magazine_price }}</td>
                               </tr>
                           @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card {{ $conf['bg_color_menu'] }} {{ $conf['text_color'] }} p-4 m-2">
                <h5 class="text-dark">Total Fechamento Anos</h5>
                <div class="table-responsive">
                    <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-striped table-hover table-borderless table-primary align-middle">
                        @if ($total_annual_closings->count() == 0)

                        <tbody class="table-group-divider">

                               <p class="{{ $conf['text_color'] }}">Não foi encotrado Fechamento</p>
                           @else

                           <thead>
                            <tr>
                                <th>Ano</th>
                                <th>Quant. Produto</th>
                                <th>Preço gasto</th>
                                <th>Preço Recebido</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                               @foreach ($total_annual_closings as $total_annual_closing)
                               <tr class="{{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }}">
                                <td class="text-end">{{ $total_monthly_closing->year }}</td>
                                <td class="text-end">{{ $total_monthly_closing->product_quantity }}</td>
                                <td class="text-end">{{ $total_monthly_closing->reselle_price }}</td>
                                   <td class="text-end">{{ $total_monthly_closing->magazine_price }}</td>
                               </tr>
                           @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

     </div>
     <hr>



 </div>

 </x-layout-app>
