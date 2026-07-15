<x-layout-app page-title="Edit Reseller Stock Detail" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Edit Reseller Stock Detail</h3>

        <hr>
        
        
        <div class="row">
            <div class="col-12">
                {{-- disabled --}}
                <form action="{{ route('adm.resellers.reseller-stock-detail.updated-adm-reseller-stock-detail') }}" method="post">

                    @csrf

                    <div class="container-fluid">
                        <div class="border {{ $conf['color-border'] }} p-4">
                            <div class="row cols-5 row-cols-sm-5 row-cols-md-5 row-cols-lg-5">

                                {{-- Code --}}
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="code" class="form-label">Code</label>
                                        <input type="number" class="form-control" id="code" name="code" value="{{ old('code', $product->code) }}">
                                        @error('code')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
            
                                {{-- Amont --}}
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="amont" class="form-label">Amont</label>
                                        <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount', $customerstockdetail->amount) }}">
                                        @error('amount')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Percentage --}}
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="code" class="form-label">Percentage</label>
                                        <input type="number" class="form-control" id="percentage" name="percentage" value="{{ old('percentage', $customerstockdetail->percentage) }}">
                                        @error('percentage')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Resale Price --}}
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="code" class="form-label">Resale Price</label>
                                        <input type="number" class="form-control" id="resale_price" name="resale_price" step=".01" placeholder="0,00" value="{{ old('resale_price', $customerstockdetail->resale_price) }}">
                                        @error('resale_price')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Clients --}}
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="code" class="form-label">Reseller</label>
                                        <select class="form-select" id="user_id" name="user_id">
                                            <option value="0">Selecione um client</option>
                                            @foreach ($users as $user)
                                            @if ($user->id == $customerstockdetail->user_id)
                                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                            @else
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endif)
                                            
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>



                            </div>
                            
                        </div>
                    </div>
                    <div class="mb-3 pt-4">
                        <input type="hidden" name="id" id="id" value="{{ $customerstockdetail->id }}">
                        <input type="hidden" name="product_id" id="product_id" value="{{ $customerstockdetail->product_id }}">
                        <div class="mt-3 d-flex justify-content-center">
                            <a href="{{ route('adm.resellers.reseller-stock-detail.table-adm-reseller-stock-detail') }}" class="btn btn-outline-warning me-3">Cancel</a>
                            <button type="submit" class="btn btn-outline-primary">Update Customer Stock Detail</button>
                        </div>
                    </div>
                
                </form>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    @if ($products->count() == 0)
                    <p>No Product</p>
                    @else
            
                    <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100" id="table">
                        <thead class="{{ $conf['bg_color_table'] }}">
                            <tr>
                                <th>Photo</th>
                                <th>Produto</th>
                                <th>Amount</th>
                                <th>Percentage</th>
                                <th>Resale Price</th>
                                <th>Select Reseller</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                
            
                                    <tr>
                                                <td>
                                                    {{-- Photo --}}
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
                                                    {{-- Amont --}}
                                                    <div class="col">
                                                        <div class="">
                                                            <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount') }}">
                                                            @error('amount')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{-- Percentage --}}
                                                    <div class="col">
                                                        <div class="">
                                                            <input type="number" class="form-control" id="percentage" name="percentage" value="{{ old('percentage', $product->percentage) }}">
                                                            @error('percentage')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{-- Resale Price --}}
                                                    <div class="col">
                                                        <div class="">
                                                            <input type="number" class="form-control" id="resale_price" name="resale_price" step=".01" placeholder="0,00" value="{{ old('resale_price', $product->resale_price) }}">
                                                            @error('resale_price')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{-- Clients --}}
                                            <div class="col">
                                                <div class="mb-3">
                                                    <div class="row">
                                                        <div class="col12 pe-3">
                                                            <select class="form-select" id="$user_id" name="$user_id">
                                                                <option value="0" selected>Selecione um client</option>
                                                                @foreach ($users as $user)
                                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('client_id')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                    
                                                    </div>
                                                </div>
                                            </div>
                                                </td>
            
                        
                                                <td>
                                                    <div class="d-flex gap-1 justify-content-end">
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        <div class="btn-lg-display d-flex gap-1 justify-content-end">
                                                            <button type="submit" class="btn btn-sm btn-outline-success ms-2"><i class="fas fa-add me-2"></i>Add</button>
                                                        </div> 
                                                    </div>
                                                </td>
                                    </tr>
                        
                            @endforeach
                        </tbody>
                    </table>
                        
                    @endif)
            
                   
                </div>
            </div>
        </div>

    </div>
    
</div>

</x-layout-app>
