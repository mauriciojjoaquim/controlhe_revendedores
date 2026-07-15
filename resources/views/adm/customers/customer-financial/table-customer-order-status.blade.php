<x-layout-customer-app page-title="Status dos fretes" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100 p-4">

        <h3>Status dos fretes</h3>
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
        @if ($customerFreights->count() === 0)
        <div class="text-center my-5">
            <p>Nenhum frete foi encontrado.</p>
            
        </div>
    @else
        <div class="mb-3">
            
        </div>
        <div class="table-responsive">
            <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100" id="table">
                <thead class="{{ $conf['bg_color_table'] }}">
                    <th class="text-start">Nº da Order</th>
                    <th class="text-start">Vendedor(a)</th>
                    <th class="text-start">Fretista</th>
                    <th class="text-start">Status</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($customerFreights as $customerFreight)
                    <tr>

                        <td class="text-start">{{ $customerFreight->order_number_id }}</td>

                        <td class="text-start">
                            @foreach ($users as $user)
                                @if ($user->id == $customerFreight->user_id)
                                {{ $user->name }}
                                @endif
                            @endforeach
                            
                        </td>
                    
                        <td class="text-start">{{ $customerFreight->freight_id }}</td>

                        <td class="text-start">
                            @if ($customerFreight->confirmation_status == 'acaminho')
                                <strong class="text-warning">A Caminho...<i class="fa-solid fa-triangle-exclamation ms-2"></i></strong>
                                @elseif ($customerFreight->confirmation_status == 'entregue')
                                <strong class="text-success">Entregue<i class="fa-regular fa-circle-check ms-2"></i></strong>
                                @elseif ($customerFreight->confirmation_status == 'aguardando pagamente')
                                <strong class="text-success">Aguardando Pagamente<i class="fa-solid fa-circle-question ms-2"></i>OK</strong>
                            @endif
                        </td>

                        <td>
                            <div class="d-flex gap-1 justify-content-end">

                                <div class="btn-lg-display d-flex gap-1 justify-content-end">
                                    @if ($customerFreight->confirmation_status != 'entregue')
                                    <a href="{{ route('customers.customer-financial.customer-confirmation-order-status', ['id' => $customerFreight->id])  }}" class="btn btn-sm btn-outline-success ms-2"><i class="fa-regular fa-circle-check me-2"></i>Confirmar entrega</a> 
                                    @else
                                        <strong class="alert-success text-dark pe-2 ps-2"><i class="fa-regular fa-circle-check m3-4"></i></strong>
                                    @endif
                                    
                                </div>
                                <div class="btn-group btn-sm-display" role="group" aria-label="action">
                                    <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu " aria-labelledby="btnGroupDrop1">
                                        @if ($customerFreight->confirmation_status != 'entregue')
                                            <li><a href="{{ route('customers.customer-financial.customer-confirmation-order-status', ['id' => $customerFreight->id]) }}" class="dropdown-item"><i class="fa-regular fa-circle-check me-2"></i>Detalhe</a></li>
                                        @else
                                            <strong class="alert-success text-dark pe-2 ps-2"><i class="fa-regular fa-circle-check m3-4"></i></strong>
                                        @endif
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
