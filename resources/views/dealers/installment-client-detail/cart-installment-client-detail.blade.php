<x-layout-app page-title="Carinho de Compra" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100 p-4">

        <h3>Carinho de Compra</h3>
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
            <p>No Clients found.</p>
        </div>
    @else
    <div class="justify-content-end w-100">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <th class="text-center">imagem</th>
                    <th class="text-center">Descrição</th>
                    <th class="text-center">Excluir</th>
                    <th class="text-center">Quant.</th>
                    <th class="text-center">Preço</th>
                    <th class="text-end">Total Preço</th>
                </thead>
                <tbody>
                    @foreach ($addtocarts as $addtocart)
                        @if ($addtocart->user_id == Auth::user()->id)
                        <tr>
                            <td>
                                @foreach ($products as $product)
                                    @if ($addtocart->product_id === $product->id)
                                        <div class="tb-img">
                                            <a class="img-pro" href="{{ url('storage/app/public/imagens/products/'.$product->supplier->supplier.'/'.$product->photo_url) }}">
                                                <img class="img-tb" src="{{ url('storage/app/public/imagens/products/'.$product->supplier->supplier.'/'.$product->photo_url) }}" alt="{{ $product->photo_url }}">
                                            </a>
                                        </div>
                                    @endif
                                @endforeach

                            </td>
                            <td>
                                @foreach ($products as $product)
                                    @if ($addtocart->product_id === $product->id)
                                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-1 p-2">
                                        <div class="col-xl-12 col-md-12 col-md-12 col-sm-12">
                                            {{ $product->code }}
                                        </div>
                                        <div class="col-xl-12 col-md-12 col-md-12 col-sm-12">
                                            {{ $product->name }}
                                        </div>
                                    </div>
                                        </div>
                                    @endif
                                @endforeach
                            </td>
                            <td><a href="{{ route('admin.dealers.clients.client.confirma-cart-delete-detail', ['id' => $addtocart->id]) }}"><i class="fa-regular fa-trash-can"></i></a></td>
                            <td class="text-center">{{ $addtocart->amount }}</td>
                            <td class="text-center">{{ $addtocart->price }}</td>
                            <td class="text-end">{{ $addtocart->total_price }}</td>
                        </tr>
                        @endif


                    @endforeach

                </tbody>

            </table>
            <div class="bg-dark w-100 d-flex justify-content-end">

                <div class="p-3 text-success h3 text-end"><span class="text-success h4 text-end">Quant. Total: </span> {{ $data['total_quant'] }}</div>
                <div class="p-3 text-success h3 text-end"><span class="text-success h4 text-end">Preço Total: </span>R$ {{ $data['total_price'] }}</div>
                <div class="p-3">
                    <form action="{{ route('admin.dealers.clients.product-clients.closing-to-cart') }}" method="post">
                    @csrf
                        <input type="hidden" name="client_id" value="{{ $addtocart->client_id }}">
                        <input type="hidden" name="total_quant" value="{{ $data['total_quant'] }}">
                        <input type="hidden" name="total_price" value="{{ $data['total_price_sf'] }}">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success me-2">Finalizar Compra</button>
                        {{-- <input type="text" class="form-controle text-center" name="quant_parcela" value="{{ old('quant_parcela') }}" placeholder="Quant. parcela"> --}}
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endif

    </div>
    </x-layout-app>
