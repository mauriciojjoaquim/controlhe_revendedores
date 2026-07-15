<x-layout-app page-title="Editar minha venda" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Editar minha venda</h3>

        <hr>
        
        
        <div class="row">
            <div class="col-12">
                {{-- disabled --}}
                <form action="{{ route('adm.resellers.reseller-my-sales.updated-reseller-my-sales') }}" method="post">

                    @csrf

                    <div class="container-fluid">
                        <div class="border {{ $conf['color-border'] }} p-4">
                            <div class="row cols-5 row-cols-sm-5 row-cols-md-5 row-cols-lg-5">

                                {{-- Code --}}
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="due_date" class="form-label">Code</label>
                                        <input type="number" class="form-control" id="due_date" name="due_date" value="{{ old('due_date', $mysale->due_date) }}">
                                        @error('due_date')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
            
                                {{-- Amont --}}
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="amont" class="form-label">Amont</label>
                                        <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount', $mysale->amount) }}">
                                        @error('amount')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Percentage --}}
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="code" class="form-label">Percentage</label>
                                        <input type="number" class="form-control" id="percentage" name="percentage" value="{{ old('percentage', $mysale->percentage) }}">
                                        @error('percentage')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Resale Price --}}
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="code" class="form-label">Resale Price</label>
                                        <input type="number" class="form-control" id="resale_price" name="resale_price" step=".01" placeholder="0,00" value="{{ old('resale_price', $mysale->resale_pric) }}">
                                        @error('resale_price')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Clients --}}
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="code" class="form-label">Client</label>
                                        <select class="form-select" id="client_id" name="client_id">
                                            <option value="0">Selecione um client</option>
                                            @foreach ($clients as $client)
                                            @if ($client->id == $mysale->client_id)
                                            <option value="{{ $client->id }}" selected>{{ $client->name }}</option>
                                            @else
                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                            @endif)
                                            
                                            @endforeach
                                        </select>
                                        @error('client_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>  
                        </div>
                    </div>
                    <div class="mb-3 pt-4">
                        <div class="mt-3 d-flex justify-content-center">
                            <a href="{{ route('adm.resellers.reseller-my-sales.table-reseller-my-sales') }}" class="btn btn-outline-warning me-3">Cancel</a>
                            <button type="submit" class="btn btn-outline-primary">Update Customer Stock Detail</button>
                        </div>
                    </div>
                
                </form>
            </div>

        </div>

    </div>
    
</x-layout-app>


{{-- 
Número do pedido
Quantidade do produto
Número da parcela
Preço_da_parcela
Data_de_vencimento
Data_de_pagamento

order_number_id
quantity_product
installment_number
installment_price
due_date
payment_date

--}}