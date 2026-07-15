<x-layout-customer-app page-title="Todos Minhas Compra Aberta" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100 p-4">

        <h3>Minhas Compra Aberta</h3>
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
        @if ($addtocarts->count() === 0)
        <div class="text-center my-5">
            <p>Nenhum compra encontrado.</p>
            {{-- <a href="{{ route('admin.dealers.clients.client.add-vende-clients') }}" class="btn btn-primary">Criar novo Cliente</a> --}}
        </div>
    @else
        <div class="mb-3">
            {{-- <a href="{{ route('admin.dealers.clients.client.add-vende-clients') }}" class="btn btn-primary">Criar novo Cliente</a> --}}
        </div>
        <div class="table-responsive">
            <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100" id="table">
                <thead class="{{ $conf['bg_color_table'] }}">
                    <tr>
                        <th class="text-center me-2">Imagem</th>
                        <th class="text-start me-2">Code</th>
                        <th class="text-start me-2">Produto</th>
                        <th class="text-start me-2">Vendedora</th>
                        <th class="text-end me-2">Preço</th>
                        <th class="text-center me-2">Quant.</th>
                        <th class="text-end me-2">Preço Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($addtocarts as $addtocart)

                    <tr>
                        
                        <td class="text-center me-2">{{-- img-row --}}
                            @foreach ($products as $product)
                                @if ($product->id === $addtocart->product_id)
                                    <a class="img-pro" href="{{ url('storage/imagens/products/'.$product->supplier_id.'/'.$product->photo_url) }}">
                                        <img class="" src="{{ url('storage/imagens/products/'.$product->supplier_id.'/'.$product->photo_url) }}" alt="{{ $product->photo_url }}" width="30px" height="50px">
                                    </a>
                                @endif
                            @endforeach
                        </td>

                        <td class="text-start me-2">
                            @foreach ($products as $product)
                                @if ($product->id === $addtocart->product_id)
                                    {{ $product->code }}
                                @endif
                            @endforeach
                        </td>

                        <td class="text-start me-2">
                            @foreach ($products as $product)
                                @if ($product->id === $addtocart->product_id)
                        
                                {{ $product->name }}
                                @endif
                            @endforeach
                        </td>
                            
                        <td class="text-start me-2">
                            @foreach ($users as $user)
                                @if ($user->id == $addtocart->user_id)
                                    {{ $user->name }}
                                @endif
                            @endforeach
                        </td>

                        
                        <td class="text-end me-2">R$ {{ number_format($addtocart->price, 2, ',', '.') }}</td>
                        <td class="text-center me-2">{{ $addtocart->amount }}</td>
                        <td class="text-end me-2">R$ {{ number_format($addtocart->total_price, 2, ',', '.') }}</td>

                    </tr>
            
                    @endforeach

                </tbody>
            </table>
        </div>

    @endif

    </div>
</x-layout-customer-app>
