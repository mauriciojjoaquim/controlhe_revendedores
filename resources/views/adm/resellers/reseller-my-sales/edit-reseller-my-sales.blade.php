<x-layout-app page-title="Edit Customer Stock Detail" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Edit Customer Stock Detail</h3>

        <hr>
        
        
        <div class="row">
            <div class="col-12">
                {{-- disabled --}}
                <form action="{{ route('adm.resellers.reseller-my-sales.updated-reseller-my-sales') }}" method="post">

                    @csrf
                    
                    <div class="container-fluid">
                        <div class="d-flex justify-content-center">
                            <div class="border {{ $conf['color-border'] }} p-4">
                                <div class="row cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2">
    
                                    <div class="col-lg-2"><p>Data atual: </p></div>
                                    <div class="col-lg-10"><p>{{ date('d/m/Y H:i:s',strtotime($mysale->due_date)) }}</p></div>
                                    {{-- due_date --}}
                                    <div class="col">
                                        <div class="mb-3">
                                            
                                            <label for="due_date" class="form-label">coloque o número de dias</label>
                                            <input type="number" class="form-control" id="due_date" name="due_date" placeholder="00" value="{{ old('day_number') }}">
                                            @error('due_date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
    
                                    {{-- Resale Price --}}
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="installment_price" class="form-label">Preço da parcela</label>
                                            <input type="number" class="form-control" id="installment_price" name="installment_price" step=".01" placeholder="0,00" value="{{ old('installment_price', $mysale->installment_price) }}">
                                            @error('installment_price')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                    <div class="mb-3 pt-4">
                        <input type="hidden" name="id" id="id" value="{{ $mysale->id }}">
                        <input type="hidden" name="id" id="product_id" value="{{ $mysale->id }}">
                        <div class="mt-3 d-flex justify-content-center">
                            <a href="{{ route('adm.resellers.reseller-my-sales.table-reseller-my-sales') }}" class="btn btn-outline-warning me-3">Cancelar</a>
                            <button type="submit" class="btn btn-outline-primary">Atualizar minha venda</button>
                        </div>
                    </div>
                
                </form>
            </div>
        </div>

    </div>
    
</div>

</x-layout-app>


{{-- 
Número do pedido
Quantidade do produto
Número da parcela
Preço da parcela
Data_de_vencimento
Data_de_pagamento

order_number_id
quantity_product
installment_number
installment_price
due_date
payment_date

--}}