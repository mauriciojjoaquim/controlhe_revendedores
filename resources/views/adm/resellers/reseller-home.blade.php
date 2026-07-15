<x-layout-app page-title="Home" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100 p-4">
     <h3>Home</h3>
      <hr>
      @if (session('staus'))
        <div class="alert alert-{{ (session('tipo_alert')) }} {{ $conf['color_card_text'] }} text-center mt-4 p-2">
            {{ session('mesagem') }}
        </div>
        <hr>
    @endif
    <hr>
    <h4>Atalhos</h4>
    <div class="d-flex row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-5 row-cols-xl-5 row-cols-xxl-5 g-2 g-lg-5">
        <div class="col">
            <a class="btn btn-outline-primary" href="{{ route('adm.resellers.reseller-search.search-resellers') }}">Fazer Venda</a>
        </div>
    </div>
    <hr>
     <div class="d-flex row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-4 g-2 g-lg-4">
         
        <div class="col">
             <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                 <h5 class="{{ $conf['color_card_text'] }}">Total de Clientes Ativado</h5>
                 <span class="border-bottom w-100"></span>
                 <h1 class="text-center">{{ $data['total_clients'] }}</h1>
             </div>
         </div>

         <div class="col">
             <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                 <h5 class="{{ $conf['color_card_text'] }}">Total de Clientes Desativado</h5>
                 <span class="border-bottom w-100"></span>
                 <h1 class="text-center">{{ $data['total_clients_deleted'] }}</h1>
             </div>
         </div>

         <div class="col">
            <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                <h5 class="{{ $conf['color_card_text'] }}">Total de Divida em p/ Clientes</h5>
                <span class="border-bottom w-100"></span>
                <h1 class="text-center">R$ {{ $data['total_debt_installment_by_deve'] }}</h1>
            </div>
        </div>

         <div class="col">
             <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                 <h5 class="{{ $conf['color_card_text'] }}">Total de Divida Clientes</h5>
                 <span class="border-bottom w-100"></span>
                 <h1 class="text-center">R$ {{ $data['total_clients_debt'] }}</h1>
             </div>
         </div>

     </div>

     <hr>
     
        <div class="d-flex row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-4 g-2 g-lg-4">

            {{-- Total de clentes --}}
            <div class="col">
                <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                    <h5 class="{{ $conf['color_card_text'] }}">Total Cliente da sua Carteira</h5>
                    <span class="border-bottom w-100"></span>
                    <div class="table-responsive">
                        <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-striped table-hover table-borderless align-middle">
                            <tbody class="table-group-divider">
                                @if ($data['total_clients_per_vende']->count() == 0)
                                    <p class="{{ $conf['text_color'] }}">No Divida</p>
                                @else
                                    @foreach ($data['total_clients_per_vende'] as $collection)
                                        <tr class="{{ $conf['bg_color_table'] }}">
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

            {{-- Total de divida clientes--}}
            <div class="col">
                <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                    <h5 class="{{ $conf['color_card_text'] }}">Total de Divida dos Clientes</h5>
                    <span class="border-bottom w-100"></span>
                    <div class="table-responsive">
                        <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-striped table-hover table-borderless align-middle">
                            <tbody class="table-group-divider">
                                @if ($data['total_debt_by_deve']->count() == 0)
                                    <p class="{{ $conf['text_color'] }}">No Divida</p>
                                @else
                                    @foreach ($data['total_debt_by_deve'] as $collection)
                                        <tr class="{{ $conf['bg_color_table'] }}">
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

            {{-- Total product lucro --}}
            <div class="col">
                <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                    <h5 class="{{ $conf['color_card_text'] }}">Total de lucro</h5>
                    <span class="border-bottom w-100"></span>
                    <div class="table-responsive">
                        <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-striped table-hover table-borderless align-middle">
                            <tbody class="table-group-divider">
                                @if ($data['total_product_lucro']->count() == 0)
                                    <p class="{{ $conf['text_color'] }}">No Divida</p>
                                @else
                                    @foreach ($data['total_product_lucro'] as $collection)
                                        <tr class="{{ $conf['bg_color_table'] }}">
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

            {{-- Total product lucro --}}
            <div class="col">
                <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                    <h5 class="{{ $conf['color_card_text'] }}">Total de gasto produtos</h5>
                    <span class="border-bottom w-100"></span>
                    <div class="table-responsive">
                        <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-striped table-hover table-borderless align-middle">
                            <tbody class="table-group-divider">
                                @if ($data['total_gasto_product']->count() == 0)
                                    <p class="{{ $conf['text_color'] }}">No Divida</p>
                                @else
                                    @foreach ($data['total_gasto_product'] as $collection)
                                        <tr class="{{ $conf['bg_color_table'] }}">
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

        <hr>
     

        <div class="d-flex row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-4 g-2 g-lg-4">
            
             {{-- Total de Lucro --}}
             <div class="col">
                <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                    <h5 class="{{ $conf['color_card_text'] }}">Total produto p/ fornecedor</h5>
                    <span class="border-bottom w-100"></span>
                    <div class="table-responsive Scroll-table">
                        <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-striped table-hover table-borderless align-middle">
                            <tbody class="table-group-divider {{ $conf['bg_color_table'] }}">
                            @if ($data['total_products_per_supplier']->count() == 0)
                                <p class="{{ $conf['text_color'] }}">No department</p>
                            @else
                                @foreach ($data['total_products_per_supplier'] as $collection)
                                    <tr class="{{ $conf['bg_color_table'] }}">
                                        <td scope="row" class="text-start">
                                            {{ $collection['supplier'] }}
                                        </td>
                                        <td class="text-end">Unt.: {{ $collection['total'] }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Total de Lucro --}}
            <div class="col">
                <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                    <h5 class="{{ $conf['color_card_text'] }}">Total de lucro por client</h5>
                    <span class="border-bottom w-100"></span>
                    <div class="table-responsive Scroll-table">
                        <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-striped table-hover table-borderless align-middle">
                            <tbody class="table-group-divider {{ $conf['bg_color_table'] }}">
                            @if ($data['total_product_by_deve']->count() == 0)
                                <p class="{{ $conf['text_color'] }}">No department</p>
                            @else
                                @foreach ($data['total_product_by_deve'] as $collection)
                                    <tr class="{{ $conf['bg_color_table'] }}">
                                        <td scope="row">
                                            @foreach ($clients as $client)
                                                @if ($collection['client_id'] == $client->id)
                                                    {{ $client->name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-end">R$ {{ $collection['lucro'] }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Total de venda por cliente --}}
            <div class="col">
                <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                    <h5 class="{{ $conf['color_card_text'] }}">Total de venda por cliente</h5>
                    <span class="border-bottom w-100"></span>
                    <div class="table-responsive Scroll-table">
                        <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-striped table-hover table-borderless align-middle">
                            <tbody class="table-group-divider {{ $conf['bg_color_table'] }}">
                            @if ($data['total_product_by_deve']->count() == 0)
                            <p class="{{ $conf['text_color'] }}">No department</p>
                            @else
                                @foreach ($data['total_product_by_deve'] as $collection)
                                    <tr class="{{ $conf['bg_color_table'] }}">
                                        <td scope="row">
                                            @foreach ($clients as $client)
                                                @if ($collection['client_id'] == $client->id)
                                                    {{ $client->name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-end">R$ {{ $collection['total'] }}</td>
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
            <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                <h5 class="{{ $conf['color_card_text'] }}">Confirmar pagamento de clientes</h5>
                <span class="border-bottom w-100"></span>
                <div class="table-responsive Scroll-table">
                    <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-striped table-hover table-borderless align-middle">
                        <tbody class="table-group-divider {{ $conf['bg_color_table'] }}">
                           @if ($data['confirm_installment_paid']->count() == 0)
                               <p class="{{ $conf['text_color'] }}">Não costa divida de cliente</p>
                           @else
                           @foreach ($data['confirm_installment_paid'] as $collection)
                               @if (true)
                                    <tr class="{{ $conf['bg_color_table'] }}">
                                            <td scope="row">
                                                @foreach ($clients as $client)
                                                    @if ($collection->user_id == Auth::user()->id && $collection->client_id == $client->id)
                                                        {{ $client->name }}
                                                    @endif
                                                @endforeach
                                            </td>

                                            <td>{{ $collection->installment_number }}</td>

                                            <td class="text-end">
                                                <strong>
                                                    @php
                                                        $total = number_format($collection->installment_price, 2, ',', '.');
                                                    @endphp
                                                    R$ {{ $total }}
                                                </strong>
                                            </td>

                                            <td class="text-end">
                                                <strong>
                                                    @php
                                                        $datatotal = $collection->installment_price;
                                                    @endphp

                                                    @if ($datatotal != 0.00 && $collection->payment_date == null)
                                                        <a href="{{ route('adm.resellers.reseller-installment-detail.confirma-cart-payment-detail', ['id' => $collection->id]) }}" class="btn btn-sm btn-success me-2">C-PG</a>
                                                    @else
                                                        PG
                                                    @endif


                                                </strong>
                                            </td>

                                    </tr>
                               @endif
                           @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                <h5 class="{{ $conf['color_card_text'] }}">Data de pagamento</h5>
                <span class="border-bottom w-100"></span>
                <div class="table-responsive Scroll-table">
                    <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-striped table-hover table-borderless align-middle">
                        <tbody class="table-group-divider {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }}">
                          @if ($data['confirm_installment_paid']->count() == 0)
                                <p class="{{ $conf['text_color'] }}">Não foi encontrado pagamento</p>
                            @else
                            @foreach ($data['confirm_installment_paid'] as $collection)
                                <tr class="{{ $conf['bg_color_table'] }}">
                                    
                                    <td scope="row">
                                        @foreach ($clients as $client)
                                            @if ($collection->user_id == Auth::user()->id && $collection->client_id == $client->id)
                                                {{ $client->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    
                                    <td class="text-end">Venc.: 
                                        <strong>
                                            @if ($collection->due_date != null)
                                                {{ date('d/m/Y', strtotime($collection->due_date)) }}
                                            @else
                                                NC
                                            @endif
                                        </strong>
                                    </td>

                                    <td class="text-end">Pag.:
                                        <strong>
                                            @if ($data['status']->count() == 0)
                                                
                                            @else
                                                @php
                                                    $date = date("d/m/Y");
                                                    $dateHoje = date('d/m/Y', strtotime('+1 week'));
                                                    $payment_date = date('d/m/Y', strtotime($collection->payment_date));

                                                @endphp
                                                @foreach ($data['status'] as $item)
                                                    @if ($collection->purchase_status_id == $item->id)
                                                        {{ $payment_date }} - PG
                                                    @endif
                                                @endforeach
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

    </div>
    <hr>

    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2">

        <div class="col">
            <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                <h5 class="{{ $conf['color_card_text'] }}">Total Fechamento Mês</h5>
                <span class="border-bottom w-100"></span>
                <div class="table-responsive Scroll-table">
                    <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-striped table-hover table-borderless align-middle">
                        <tbody class="table-group-divider {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }}">
                           @if ($total_monthly_closings->count() == 0)
                               <p class="{{ $conf['text_color'] }}">Não foi encotrado Fechamento</p>
                           @else
                           <thead>
                            <tr class="{{ $conf['bg_color_table'] }}">
                                <th class="text-start">Mês</th>
                                <th class="text-start">Ano</th>
                                <th class="text-center">Quant./P.</th>
                                <th class="text-center">Pontos</th>
                                <th class="text-end">Preço gasto</th>
                                <th class="text-end">Preço Recebido</th>
                                <th class="text-end">Lucro</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }}">
                               @foreach ($total_monthly_closings as $total_monthly_closing)
                               <tr class="{{ $conf['bg_color_table'] }}">
                                   <td scope="row" class="text-start">{{ $total_monthly_closing->month }}</td>
                                   <td class="text-start">{{ $total_monthly_closing->year }}</td>
                                   <td class="text-center">{{ $total_monthly_closing->product_quantity }}</td>
                                   <td class="text-center">{{ $total_monthly_closing->point }}</td>
                                   <td class="text-end">{{ $total_monthly_closing->reselle_price }}</td>
                                   <td class="text-end">{{ $total_monthly_closing->magazine_price }}</td>
                                   <td class="text-end">{{ $total_monthly_closing->reseller_profit }}</td>
                               </tr>
                           @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                <h5 class="{{ $conf['color_card_text'] }}">Total Fechamento Anos</h5>
                <span class="border-bottom w-100"></span>
                <div class="table-responsive Scroll-table">
                    <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-striped table-hover table-borderless align-middle">
                        @if ($total_annual_closings->count() == 0)

                        <tbody class="table-group-divider {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }}">

                               <p class="{{ $conf['text_color'] }}">Não foi encotrado Fechamento</p>
                           @else

                           <thead>
                            <tr class="{{ $conf['bg_color_table'] }}">
                                <th>Ano</th>
                                <th>Quant. Produto</th>
                                <th>Preço gasto</th>
                                <th>Preço Recebido</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider {{ $conf['bg_color_table'] }}  {{ $conf['color_table_text'] }}">
                               @foreach ($total_annual_closings as $total_annual_closing)
                               <tr class="{{ $conf['bg_color_table'] }}">
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
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>

<script>
    const data = {
    labels: ['Red', 'Blue','Yellow'],
    datasets: [{
        label: 'My First Dataset',
        data: [300, 50, 100],
        backgroundColor: [
        'rgb(255, 99, 132)',
        'rgb(54, 162, 235)',
        'rgb(255, 205, 86)'
        ],
        hoverOffset: 4
    }]
    };

    const ctx = document.getElementById('myAddToCartChartB');

    new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        color: 'rgba(0, 0, 0, 0.9)',
        datasets: [{
        label: '# Quantidede de Produtos',
        data: [12, 30, 3, 5, 2, 3],
        borderColor: 'rgba(0, 0, 0, 0.4)',
        backgroundColor: 'rgba(100, 192, 192, 0.7)',
        borderWidth: 1,
        
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
        
    },
    plugins: []
    });
    // const codes = @json($codes)
    // const amounts = @json($amounts)
    // const ctx = document.getElementById('myAddToCartChart').getContext('2d');

    // const myAddToCartChart = new Chart(ctx, {
    //     type: 'bar',
    //     data: {
    //     labels: codes,
    //     datasets: [{
    //         label: 'Quantidede de produtos',
    //         data: amounts,
    //         backgroundColor: 'rgb(255, 255, 255)',
    //         borderColor: 'rgba(75, 192, 192, 1)',
    //         color: 'rgb(255, 255, 255)',
    //         borderWidth: 1
    //     }]
    //     },
    //     options: {
    //     scales: {
    //         y: {
    //         beginAtZero: true
    //         }
    //     }
    //     }
    // });
    
</script>

 </x-layout-app>
