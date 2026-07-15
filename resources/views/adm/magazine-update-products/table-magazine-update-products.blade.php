<x-layout-app page-title="Magazine Update Products" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
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
        <div class="row">
            <div class="col"><h3>All Magazine Update Products</h3></div>
            @if ($magazineUpdate)
                <div class="col"><h3>ciclo: <strong>{{ $magazineUpdate->number }}</strong></h3></div>
            @endif

        </div>

        @if ($products->count() === 0)
            <div class="text-center my-5">
                <p>No Products found.</p>
                <div class="mb-2 pt-4">
                    <a href="{{ route('adm.products.table-magazine-update-product') }}" class="btn btn-sm btn-outline-primary p-2">
                        <i class="fa-solid fa-eraser me-1"></i>Limpar
                    </a>
                </div>

            </div>
        @else


            <div class="mb-3">
                <form action="{{ route('adm.products.table-magazine-update-product') }}" method="get">
                    @csrf
                    <div class="container-fluid">
                        <div class="border {{ $conf['color-border'] }} p-4">
                            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-3 mb-sm-2 mb-md-2">

                                {{-- Code --}}
                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="mb-3">
                                        <label for="code" class="form-label">Code</label>
                                        <input type="number" class="form-control" id="amount" name="code" value="{{ old('code', $code) }}">
                                        @error('code')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Suppliers --}}
                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="mb-3">
                                            <label class="form-label" for="supplier_id"><span class="text-danger">*</span>  Fornrcedor</label>
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


                                {{-- action --}}
                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 pt-2 mt-1">
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-start">
                                            <div class="mb-2  pt-4 me-3">
                                                <button type="submit" class="btn btn-sm btn-outline-info ms-2 p-2">
                                                    <i class="fa-solid fa-magnifying-glass me-1"></i>Pesquisar
                                                </button>
                                            </div>
                                            <div class="mb-2 pt-4">
                                                <a href="{{ route('adm.products.table-magazine-update-product') }}" class="btn btn-sm btn-outline-primary p-2">
                                                    <i class="fa-solid fa-eraser me-1"></i>Limpar
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </form>

            </div>
            <hr>

            <div class="table-responsive">
                <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100">
                    <thead class="{{ $conf['bg_color_table'] }}">
                       <tr>
                            <th>Foto</th>
                            <th>ciclo</th>
                            <th>Code</th>
                            <th>Purchase Price</th>
                            <th>Resale Price</th>
                            <th>Confirmed</th>
                            <th>Non Production</th>
                            <th class="text-center">Update</th>
                            <th></th>
                       </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>
                                <div class="tb-img">
                                    <a class="img-pro" href="{{ url('storage/imagens/products/'.$product->supplier_id.'/'.$product->photo_url) }}">
                                        <img class="img-tb" src="{{ url('storage/imagens/products/'.$product->supplier_id.'/'.$product->photo_url) }}" alt="{{ $product->photo_url }}">
                                    </a>
                                </div>
                            </td>
                            <td>{{ $product->magazine_number }}</td>
                            <td>{{ $product->code }}</td>
                            <td>R$ {{ number_format($product->purchase_price, 2, ',', '.') }}</td>
                            <td>R$ {{ number_format($product->resale_price, 2, ',', '.') }}</td>
                            <td>
                                <div class="text-center">
                                    @if ($product->confirmed == 1)
                                    <a href="{{ route('adm.products.confirmed-magazine-update-product', ['id' => $product->id]) }}" class="btn btn-sm btn-outline-success ms-2"><i class="fa-regular fa-circle-check"></i></a>
                                    @else
                                    
                                    <a href="{{ route('adm.products.confirmed-magazine-update-product', ['id' => $product->id]) }}" class="btn btn-sm btn-outline-danger ms-2"><i class="fa-regular fa-circle-xmark"></i></a>
                                    @endif

                                </div>
                            </td>
                            <td class="text-center">
                                @if ($product->non_production == 1)
                                    <a href="{{ route('adm.products.non-production-magazine-update-product', ['id' => $product->id]) }}" class="btn btn-sm btn-outline-success ms-2"><i class="fa-regular fa-circle-check"></i></a>
                                @else
                                    <a href="{{ route('adm.products.non-production-magazine-update-product', ['id' => $product->id]) }}" class="btn btn-sm btn-outline-danger ms-2"><i class="fa-regular fa-circle-xmark"></i></a>
                                @endif
                            </td>

                            <td class="">
                                <div class="col-12 d-flex justify-content-end">
                                    <form action="{{ route('adm.products.updated-magazine-update-product') }}" method="post">
                                        @csrf
                                        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-2">
                                            <div class="col">
                                                <input type="number" class="form-control p-1" id="resale_price" name="resale_price" step=".01" placeholder="0,00" value="{{ old('resale_price', $product->resale_price) }}">
                                            </div>
    
                                            <div class="col">
                                                <input type="hidden" class="form-control p-1" name="magazine_number" id="magazine_number" value="{{ $magazineUpdate->number }}">
                                                <input type="hidden" class="form-control p-1" name="percentage" id="percentage" value="{{ $product->percentage }}">
                                                <input type="hidden" class="form-control p-1" name="id" id="id" value="{{ $product->id }}">
                                                <button type="submit" class="btn btn-sm btn-outline-primary ms-2">Add</button>
                                            </div>
    
                                        </div>
    
    
    
                                    </form>
                                </div>
                            </td>
                            <td>

                            </td>
                        </tr>

                        @endforeach

                    </tbody>
                </table>
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
    </x-layout-app>
