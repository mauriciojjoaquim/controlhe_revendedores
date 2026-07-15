<x-layout-customer-app page-title="Carinho de Compra" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
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

    @php
        $quant_total = 0;
        $point_total = 0;
         $installment_number = $conf['installment_number'];
        $total =  $data['total_price_sf'];
        $installment_price = $total / $installment_number;
         $installment_data = [];
         

        $quant = $addtocarts->count();
        for($i = 0; $i < $quant; $i++) {
            $quant_total += $addtocarts[$i]['amount'];
            $point_total += $addtocarts[$i]['point'];

        }

        for($i = 1; $i <= $installment_number; $i++) {
            $installment_data[$i]['number'] = $i;
            $installment_data[$i]['price'] = number_format($installment_price, 2, ',', '.');

        }

    @endphp
    <div class="justify-content-center mb-3">
        <div class="table-responsive mb-4">
            <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }}">
                <thead class="{{ $conf['bg_color_table'] }}">
                    <th class="text-start">imagem</th>
                    <th class="text-start">Code/Descrição</th>
                    <th class="text-center">Excluir</th>
                    <th class="text-center">Quant.</th>
                    <th class="text-center">Preço</th>
                    <th class="text-end me-4">Total Preço</th>
                </thead>
                <tbody>
                    @foreach ($addtocarts as $addtocart)
                        @if ($addtocart->user_id == Auth::user()->leader_id)
                        <tr>
                            <td class="text-start">
                                @foreach ($products as $product)
                                    @if ($addtocart->product_id === $product->id)
                                        <div class="tb-img">
                                            <a class="img-pro" href="{{ url('storage/imagens/products/'.$product->supplier_id.'/'.$product->photo_url) }}">
                                                <img class="img-tb" src="{{ url('storage/imagens/products/'.$product->supplier_id.'/'.$product->photo_url) }}" alt="{{ $product->photo_url }}">
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                                
                            </td>
                            <td class="text-start">
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
                            <td class="text-center">
                                <form action="{{ route('customers.customer-dealer.cart-delete') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="cart_id" value="{{ $addtocart->id }}">
                                    <input type="hidden" name="user_id" value="{{ $addtocart->user_id }}">
                                    <input type="hidden" name="client_id" value="{{ $addtocart->client_id }}">
                                    
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-regular fa-trash-can"></i></button>
                                </form>
                                
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <div class="me-3">
                                        <form action="{{ route('customers.customer-dealer.cart-up') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="cart_id" value="{{ $addtocart->id }}">
                                            <input type="hidden" name="user_id" value="{{ $addtocart->user_id }}">
                                            <input type="hidden" name="client_id" value="{{ $addtocart->client_id }}">
                                            <button type="submit" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-angle-up"></i></button>
                                        </form>
                                        
                                    </div>
                                    <div class="me-3">
                                        {{ $addtocart->amount }}
                                    </div>
                                    <div class="me-3">
                                        <form action="{{ route('customers.customer-dealer.cart-down') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="cart_id" value="{{ $addtocart->id }}">
                                            <input type="hidden" name="user_id" value="{{ $addtocart->user_id }}">
                                            <input type="hidden" name="client_id" value="{{ $addtocart->client_id }}">
                                            @if ($addtocart->amount === 1)
                                            <button type="submit" class="btn btn-sm btn-outline-success" disabled><i class="fa-solid fa-angle-down"></i></button>
                                            @else
                                            <button type="submit" class="btn btn-sm btn-outline-success"><i class="fa-solid fa-angle-down"></i></button>
                                    @endif
                                            
                                        </form>
                                        
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">{{ $addtocart->price }}</td>
                            <td class="text-end me-4">{{ $addtocart->total_price }}</td>
                        </tr>
                        @endif
                    

                    @endforeach

                </tbody>
   
            </table>
        </div>
            <div class="bg-dark w-100 d-flex justify-content-end">
                <div class="pt-4 mt-3">
                    <a href="{{ route('home') }}" class="btn btn-success me-2">Voltar as compras</a>
                </div>
                <div class="p-3 text-success h3 text-end pt-4 mt-3"><span class="text-success h4 text-end">Quant. Total: </span> {{ $quant_total }}</div>
                <div class="p-3 text-success h3 text-end pt-4 mt-3"><span class="text-success h4 text-end">Preço Total: </span>R$ {{ $data['total_price'] }}</div>
                <div class="p-3">
                    <form action="{{ route('customers.customer-dealer.closing-to-cart') }}" method="post">
                    @csrf
                        <input type="hidden" name="point" value="{{ $addtocart->point }}">
                        <input type="hidden" name="client_id" value="{{ $addtocart->client_id }}">
                        <input type="hidden" name="user_id" value="{{ $addtocart->user_id }}">
                        <input type="hidden" name="total_quant" value="{{ $quant_total }}">
                        <input type="hidden" name="total_price" value="{{ $data['total_price_sf'] }}">
                        <div class="d-flex justify-content-end">
                        <select class="form-select me-3" aria-label="Default select example" id="total_installment" name="total_installment">
                            <option selected>Selecione uma parcela</option>
                            @if ($data['total_price_sf'] >= $conf['minimum_price_for_installment'])
                                @for ($a = 1; $a <= $installment_number; $a++)
                                <option value="{{ $installment_data[$a]['number'] }}">Parcela {{ $installment_data[$a]['number'] }} - valor R$ {{ $installment_data[$a]['price'] }}</option>
                                @endfor
                            @else
                            <option value="1">Parcela 1 - valor R$ {{ number_format($data['total_price_sf'], 2, ',', '.') }}</option>
                            @endif
                                
                               

                          </select>
                        
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
    </x-layout-customer-app>
