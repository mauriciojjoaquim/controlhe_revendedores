<x-layout-app page-title="Vendas" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100 p-4">

        <h3>Venda
            @if ($client['name'] != '')
          Cliente: {{ $client->name }}
            @else
                <p>Não foi selecionado um cliente!</p>
            @endif

            @if($addtocarts->count() > 0)
                @php
                    $quant_total = 0;
                    $point_total = 0;
    
                    $quant = $addtocarts->count();
                    for($i = 0; $i < $quant; $i++) {
                        $quant_total += $addtocarts[$i]['amount'];
                        $point_total += $addtocarts[$i]['point'];
    
                    }
                @endphp
            <div class=""><p>Pontos: {{ $point_total }}</p></div>
                <a href="{{ route('adm.resellers.reseller-installment-detail.cart-reseller-installment-detail', ['id' => $client->id ]) }}" class="btn-cart">
                    <div class="cart-cicle">
                        <i class="fa-solid fa-cart-shopping me-2"></i>
                        
                        
                        <div class="cart-cicle-text"><p>{{ $quant_total }}</p></div>
                    </div>
                </a>
            @endif
        </h3>
        <hr>
        {{-- <div class="">
            <form action="{{ route('adm.resellers.reseller-installment-detail.add-reseller-installment-detail') }}" method="GET">
                @csrf
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-1 text-center">
                    <div class="col-xl-6 col-md-6 col-md-12 col-sm-12">
                        <input type="text" class="form-control mt-2" name="search" placeholder="Buscar code..." value="{{ request('search') }}">
                    </div>

                    <div class="col-xl-4 col-md-4 col-md-12 col-sm-12">
                        <button type="submit" class="btn btn-primary mt-2">Buscar</button>
                    </div>
                    
                </div>
            </form>
        </div> --}}


        <div class="d-flex justify-content-center">
            <div class="w-100 p-3">
                @if (session('status'))
                    <div class="alert alert-{{ (session('tipo_alert')) }} text-dark text-center mt-4 p-2" role="alert">
                        <div class="">
                            <p class="pt-2 h1  {{ session('paricin') }}"><i class="{{ session('icon') }}"></i></p>
                            <p class="fs-4">{{ session('mesagem') }}</p>
                            <p class="fs-5">{{ session('data') }}</p>
                        </div>

                    </div>
                @endif
            </div>
         </div>

         <div class="justify-content-center">
            <form action="{{ route('adm.resellers.reseller-installment-detail.add-reseller-installment-detail') }}" method="get">
                @csrf
                <div class="border {{ $conf['color-border'] }} h-100 p-3">
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-5 row-cols-xl-5 row-colsxxl-5">
                    
                        {{-- code --}}
                        <div class="col-12 col-sm-12 col-md-3 col-lg-2 col-xl-2 col-xxl-2">
                            <div class="mb-3">
                                <label for="code" class="form-label"><span class="text-danger">*</span> Code</label>
                                <input type="text" class="form-control" id="code" name="code" value="{{ $code }}">
                            </div>
                        </div>
    
                         {{-- name --}}
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                            <div class="mb-3">
                                <label for="name" class="form-label"><span class="text-danger">*</span>  Decrição</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $name }}">
                            </div>
                        </div>

                         {{-- Suppliers --}}
                         <div class="col-12 col-sm-6 col-md-6 col-lg-2 col-xl-2 col-xxl-2">
                            <div class="mb-3">
                                    <label for="supplier_id"><span class="text-danger">*</span>  Fornrcedor</label>
                                    <select class="form-select" id="supplier_id" name="supplier_id">
                                        <option>Selecione um Fornecedor</option>
                                        @foreach ($suppliers as $supplier)
                                            @if ($supplier->id == $supplier_id)
                                                <option value="{{ $supplier->id }}" selected>{{ $supplier->supplier }}</option>
                                            @else
                                                <option value="{{ $supplier->id }}">{{ $supplier->supplier }}</option>
                                            @endif  
                                        @endforeach
                                    </select>
                            </div>
                        </div>

                        {{-- Categories --}}
                        <div class="col-12 col-sm-6 col-md-6 col-lg-2 col-xl-2 col-xxl-2">
                            <div class="mb-3">
                                <label for="category_id"><span class="text-danger">*</span>  Categoria</label>
                                <select class="form-select" id="category_id" name="category_id">
                                    <option>Selecione um Categoria</option>
                                    @foreach ($categories as $category)
                                        @if ($category->id == $category_id)
                                            <option value="{{ $category->id }}" selected>{{ $category->category }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endif  
                                    @endforeach
                                </select>  
                            </div>
                        </div>

                        {{-- action --}}
                        <div class="col-12 col-sm-6 col-md-6 col-lg-2 col-xl-2 col-xxl-2 mb-3 pl-4">
                            <input type="hidden" name="client_id" value="{{ $client->id }}">
                            <div class="d-flex justify-content-start">
                                <div class="mb-2  pt-4">
                                    <button type="submit" class="btn btn-sm btn-outline-info ms-2 p-2">
                                        <i class="fa-solid fa-magnifying-glass me-1"></i>Pesquisar
                                    </button>
                                </div>
                                <div class="mb-2  pt-4">
                                    <a href="{{ route('adm.resellers.reseller-installment-detail.add-reseller-installment-detail', ['client_id' => $client->id]) }}" class="btn btn-sm btn-outline-primary p-2">
                                        <i class="fa-solid fa-eraser me-1"></i>Limpar
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                    <p class="text-center"><span class="text-danger">*</span> Para menhor pesquisa do produto devera ser preenchido todos os campo.</p>
                </div>
                
            </form>
         </div>

        <hr>
        {{-- revista tabela --}}
        <div class="table-responsive">
            <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100">
                <thead class="{{ $conf['bg_color_table'] }}">
                        <th class="text-start">Descrição</th>

                </thead>
                <tbody class="border {{ $conf['color-border'] }} p-2">
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <div class="col-12 col-xl-12 col-md-12 col-md-12 col-sm-12">
                                    <div class="border {{ $conf['color-border'] }} p-2">

                                        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-4">

                                            <div class="col-xxl-1 col-xl-1 col-lg-1 col-md-12 col-sm-12">
                                                <a class="img-pro" href="{{ url('storage/imagens/products/'.$product->supplier_id.'/'.$product->photo_url) }}">
                                                    <img class="img-tb" src="{{ url('storage/imagens/products/'.$product->supplier_id.'/'.$product->photo_url) }}" alt="{{ $product->photo_url }}">
                                                </a>
                                            </div>

                                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-md-12 col-sm-12">
                                                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-1">
                                                    <div class="col"><strong>Code: </strong>{{ $product->code }}</div>
                                                    <div class="col">{{ $product->name }}</div>
                                                    <div class="col">{{ $product->description }}</div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-1 col-xl-1 col-lg-1 col-md-1 col-md-12 col-sm-12">
                                                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-1">
                                                        <div class="col-xl-12 col-md-12 col-md-12 col-sm-12">
                                                            <div class="text-center">
                                                                <span>Quant.:</span>

                                                                @if ($stocks->count() < 0 and $stocks->user_id == Auth::user()->id)
                                                                    @foreach ($stocks as $stock)
                                                                        @if ($stock->product_id == $product->id)
                                                                            <div class=" border {{ $conf['color-border'] }} text-center">
                                                                                {{ $stock->amount }}
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <div class=" border {{ $conf['color-border'] }} text-center">
                                                                        0
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                            <div class="text-center">
                                                                <span>Valor:</span>

                                                            @if ($stocks->count() < 0 and $stocks->user_id == Auth::user()->id)
                                                            @foreach ($stocks as $stock)
                                                                @if ($stock->product_id == $product->id)
                                                                    <div class="w-100 border {{ $conf['color-border'] }} text-center">
                                                                        {{ $stock->resale_price }}
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                            @else
                                                            <div class="border {{ $conf['color-border'] }} text-center">
                                                                R$ {{ $product->resale_price }}
                                                            </div>
                                                            @endif
                                                            </div>

                                                        </div>
                                                </div>

                                            </div>

                                            <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-md-12 col-sm-12">
                                                <form action="{{ route('adm.resellers.reseller-installment-detail.add-to-cart') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="point" value="{{ $product->points }}">
                                                    <input type="hidden" name="code" value="{{ $product->code }}">
                                                    <input type="hidden" name="price" value="{{ $product->resale_price }}">
                                                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-xl-3">

                                                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-12 col-sm-12 text-center">
                                                            <div class="">
                                                                <label for="quant_comp" class="form-label">Quant.:</label>
                                                                <input type="number" min="0" max="10" class="form-control border {{ $conf['color-border'] }} text-center" id="quant_comp" name="quant_comp" value="{{ old('quant_comp', 0) }}">
                                                                @error('quant_comp')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-12 col-md-12 col-sm-12 align-h">
                                                        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1 row-cols-xl-1 row-cols-xxl-1 mt-xl-1">

                                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-2 mt-3">
                                                                <button type="submit"w-100 class="w-100 btn btn-primary btn-sm" name="adcr" value="true"><i class="fa-solid fa-cart-shopping me-2"></i>Adicionar ao Carinho</button>
                                                            </div>

                                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                                <button type="submit" class="w-100 btn btn-success btn-sm" name="adpr" value="true"><i class="fa-solid fa-cart-shopping me-2"></i>Comprar</button>
                                                            </div>

                                                        </div>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>

</x-layout-app>
