<x-layout-app page-title="Home" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}"  bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}" text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">


   <div class="w-100 p-4">
    <h3>Home</h3>
     <hr> 


    <div class="d-flex row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-4 g-2 g-lg-3">
        
        <div class="col">
            <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                <h5 class="{{ $conf['text_color_site'] }}">Total de Produtos</h5>
                <span class="border-bottom w-100"></span>
                <h1 class="text-center">{{ $data['total_produtos'] }}</h1>
            </div>
        </div>

        <div class="col">
            <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                <h5 class="{{ $conf['text_color_site'] }}">Total de Colaboradores Admitidos</h5>
                <span class="border-bottom w-100"></span>
                <h1 class="text-center">{{ $data['total_colaborators'] }}</h1>
            </div>
        </div>

        <div class="col">
            <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                <h5 class="{{ $conf['text_color_site'] }}">Total de usuario dezativado</h5>
                <span class="border-bottom w-100"></span>
                <h1 class="text-center">{{ $data['total_colaborators_deleted'] }}</h1>
            </div>
        </div>

        <div class="col">
            <div class="card  {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                <h5 class="{{ $conf['text_color_site'] }}">Total de da arrecadação</h5>
                <span class="border-bottom w-100"></span>
                <h1 class="text-center">R$ {{ $data['pagamento_vededores'] }}</h1>
            </div>
        </div>

    </div>
    <hr>
    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-4 mb-sm-2 mb-md-2">
        

        {{-- total products per supplier --}}
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
        <div class="col">
            <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                <h5 class="{{ $conf['text_color_site'] }}">Total Colaborador por Departamentos</h5>
                <div class="table-responsive Scroll-table">
                    <table class="table table-striped table-hover table-borderless align-middle">
                        <tbody class="table-group-divider">
                            @foreach ($data['total_products_per_supplier'] as $collection)
                            <tr class="{{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }}">
                                <td scope="row">{{ $collection['supplier'] }}</td>
                                <td class="text-end">{{ $collection['total'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
    
                    </table>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                <h5 class="{{ $conf['text_color_site'] }}">Total Colaborador por Departamentos</h5>
                <div class="table-responsive Scroll-table">
                    <table class="table table-striped table-hover table-borderless align-middle">
                        <tbody class="table-group-divider">
                            @foreach ($data['total_colaborators_per_department'] as $collection)
                            <tr class="{{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }}">
                                <td scope="row">{{ $collection['department'] }}</td>
                                <td class="text-end">{{ $collection['total'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
    
                    </table>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card  {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                <h5 class="{{ $conf['text_color_site'] }}">Total Salario por Departamentos</h5>
                <div class="table-responsive Scroll-table">
                    <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-striped table-hover table-borderless align-middle">
                        <tbody class="table-group-divider">
                            @foreach ($data['total_salary_by_department'] as $collection)
                            <tr class="{{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }}">
                                <td scope="row">{{ $collection['department'] }}</td>
                                <td class="text-end"><strong>R$ {{ $collection['total'] }}</strong></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


</div>

</x-layout-app>



