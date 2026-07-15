<x-layout-app page-title="New Customer Stock Detail" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>New  Customer Stock Detail</h3>

        <hr>

        <div class="mb-3">
            <form action="{{ route('adm.resellers.reseller-stock-detail.created-reseller-stock-details') }}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="container-fluid">
                    <div class="border {{ $conf['color-border'] }} p-4">
                        <div class="row cols-6 row-cols-sm-6 row-cols-md-6 row-cols-lg-6">

                            {{-- Code --}}
                            <div class="col">
                                <div class="mb-3">
                                    <label for="code" class="form-label">Code</label>
                                    <input type="number" class="form-control" id="amount" name="code" value="{{ old('code') }}">
                                    @error('code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Amont --}}
                            <div class="col">
                                <div class="mb-3">
                                    <label for="amont" class="form-label">Quantidade</label>
                                    <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount') }}">
                                    @error('amount')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Percentage --}}
                            <div class="col">
                                <div class="mb-3">
                                    <label for="code" class="form-label">Porcentagem</label>
                                    <input type="number" class="form-control" id="percentage" name="percentage" value="{{ old('percentage') }}">
                                    @error('percentage')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Resale Price --}}
                            <div class="col">
                                <div class="mb-3">
                                    <label for="code" class="form-label">Preço de revenda</label>
                                    <input type="number" class="form-control" id="resale_price" name="resale_price" step=".01" placeholder="0,00" value="{{ old('resale_price') }}">
                                    @error('resale_price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                             {{-- Clients --}}
                             {{-- <div class="col">
                                <div class="mb-3">
                                    <label for="code" class="form-label">Cliente</label>
                                    <select class="form-select" id="client_id" name="client_id">
                                        <option value="0" selected>Selecione um client</option>
                                        @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('client_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="col">
                                <div class="mb-3 pt-4">

                                    <div class="d-flex gap-1 justify-content-end">
                                        <div class="d-flex gap-1 justify-content-end">
                                            <a href="{{ route('adm.resellers.reseller-stock-detail.table-reseller-stock-details') }}" class="btn btn-outline-warning me-3">Cancel</a>
                                            <button type="submit" class="btn btn-sm btn-outline-success ms-2"><i class="fas fa-add me-2"></i>Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </form>

        </div>
            <div class="mb-3">
            @if ($products->count() == 0)
                <p>No Product</p>
            @else
            <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100" id="table">
                <thead class="{{ $conf['bg_color_table'] }}">
                        <th>Foto</th>
                        <th>Produto</th>
                        <th></th>
                </thead>
                <tbody>
                        @foreach ($products as $product)

                                <tr>
                                    <td>
                                        {{-- Photo --}}
                                        <div class="tb-search-img">
                                            <a class="img-pro" href="{{ url('storage/imagens/products/'.$product->supplier_id.'/'.$product->photo_url) }}">
                                                <img class="img-tb" src="{{ url('storage/imagens/products/'.$product->supplier_id.'/'.$product->photo_url) }}" alt="{{ $product->photo_url }}">
                                            </a>
                                        </div>
                                    </td>

                                    <td>
                                        <p>Code: {{ $product->code }} <br>
                                        {{ $product->name }}</p>
                                    </td>

                 
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <form action="{{ route('adm.resellers.reseller-stock-detail.created-reseller-stock-details') }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">

                                                        <div class="col">
                                                            <div class="mt-3">
                                                                <label>Quant</label>
                                                                <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount') }}">
                                                                @error('amount')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="mt-3">
                                                                <label for="percentage">Porcentagem</label>
                                                                <input type="number" class="form-control" id="percentage" name="percentage" value="{{ old('percentage', $product->percentage) }}">
                                                                @error('percentage')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="mt-3">
                                                                <label for="resale_price">Preço de revenda</label>
                                                                <input type="number" class="form-control" id="resale_price" name="resale_price" step=".01" placeholder="0,00" value="{{ old('resale_price', $product->resale_price) }}">
                                                                @error('resale_price')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        {{-- <div class="col">
                                                            <div class="col-12 pe-3">
                                                                <label for="client_id">Selecione Cliente</label>
                                                                <select class="form-select" id="client_id" name="client_id">
                                                                    <option value="0" selected>Selecione um client</option>
                                                                    @foreach ($clients as $client)
                                                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('client_id')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div> --}}

                                                        <div class="col">
                                                            <div class="d-flex gap-1 justify-content-end">
                                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                <div class="btn-lg-display d-flex gap-1 justify-content-end">
                                                                    <button type="submit" class="btn btn-sm btn-outline-success ms-2"><i class="fas fa-add me-2"></i>Add</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                           
                                        </div>
                                    </td>
                                </tr>

                        @endforeach
                    </tbody>
                </table>

            @endif


        </div>






    </div>

</x-layout-app>

