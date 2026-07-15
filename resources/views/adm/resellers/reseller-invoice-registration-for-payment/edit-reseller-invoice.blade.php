<x-layout-app page-title="Editar boleto" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class=code"w-100 p-2">

        <h3>Editar boleto</h3>

        <hr>
        {{-- disabled --}}
        <form action="{{ route('adm.resellers.reseller-invoice-registration-for-payments.updated-reseller-invoice') }}" method="post" enctype="multipart/form-data">

            @csrf
        
            <div class="container-fluid">
                <div class="d-flex justify-content-center p-2">
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1 row-cols-xl-1 row-cols-xxl-1">

                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                {{-- user --}}
                                <div class="col border {{ $conf['color-border'] }} p-4">
        
                                    <div class="row cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1">
        
                                        {{-- imagens --}}
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <div class="col border {{ $conf['color-border'] }} p-4">
                                                <div class="row cols-2 row-cols-sm-1 row-cols-md-2 row-cols-lg-2">
        
                                                    {{-- imagens --}}
                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
                                                        <div class="img-vis-bol  border {{ $conf['color-border'] }}">
                                                            <img id="preview-user" src="{{ url('storage/imagens/tamanho/150x150.png') }}" alt="" >
                                                        </div>
                                                    </div>
                    
                                                    {{-- input imagens --}}
                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                                        <div class="mb-3">
                                                            <label for="imagem" class="form-label">Foto</label>
                                                            <input type="file" class="form-control" name="imagem" onchange="previewImagem();" value="{{ old('imagem', $invoice->imagem) }}">
                                                            @error('imagem')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
        
                                                </div>
                                            </div>
                                        </div>
        
                                        {{-- numero_da_nota_fiscal, numero_da_parcela  --}}
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <div class="row cols-2 row-cols-sm-1 row-cols-md-2 row-cols-lg-2">
                                                {{-- numero_da_nota_fiscal --}}
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                                    <div class="mb-3">
                                                        <label for="invoice_number" class="form-label">número da nota fiscal</label>
                                                        <input type="text" class="form-control" id="invoice_number" name="invoice_number" value="{{ old('invoice_number', $invoice->invoice_number) }}">
                                                        @error('invoice_number')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
        
                                                {{-- numero_da_parcela --}}
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                                    <div class="mb-3">
                                                        <label for="installment_number" class="form-label">Número da parcela</label>
                                                        <input type="number" class="form-control" id="installment_number" name="installment_number" value="{{ old('installment_number', $invoice->installment_number) }}">
                                                        @error('installment_number')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
        
                                                {{-- Price --}}
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                                    <div class="mb-3">
                                                        <label for="price" class="form-label">Preço do boleto</label>
                                                        <input type="number" class="form-control" id="price" name="price" step=".01" placeholder="0,00" value="{{ old('price', $invoice->price) }}">
                                                        @error('price')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
        
                                                {{-- due_date --}}
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                                    <div class="mb-3">
                                                        <label for="due_date" class="form-label">Data vencimemto</label>
                                                        <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date', date('Y-m-d',strtotime($invoice->due_date))) }}">
                                                        @error('due_date')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        
        
                                        {{-- description --}}
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Descrição do Boleto</label>
                                                <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $invoice->description) }}">
                                                @error('description')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
        
                                        {{-- barinvoice_number --}}
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <div class="mb-3">
                                                <label for="barcode" class="form-label">Código de barra</label>
                                                <input type="text" class="form-control" id="barcode" name="barcode" value="{{ old('barcode', $invoice->barcode) }}">
                                                @error('barcode')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
        
                                        {{-- pix_invoice_number --}}
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <div class="mb-3">
                                                <label for="pix_invoice_number" class="form-label">Código PIX</label>
                                                <input type="text" class="form-control" id="pix_invoice_number" name="pix_invoice_number" value="{{ old('pix_invoice_number', $invoice->pix_code) }}">
                                                @error('pix_invoice_number')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
        
                                    </div>
        
                                </div>
                            </div>
        
                        </div>
                    </div>
                </div>
               
                <div class="col-xl-12 col-md-12 col-md-12 col-sm-12">
                    <input type="hidden" name="id" id="id" value="{{ $invoice->id }}">
                    <div class="mt-3 d-flex justify-content-center">
                        <a href="{{ route('adm.resellers.reseller-invoice-registration-for-payments.table-reseller-invoice') }}" class="btn btn-outline-warning me-3">Voutar</a>
                        <button type="submit" class="btn btn-outline-primary">Editar boleto</button>
                    </div>
                </div>
        
            </div>
        
        </form>
        

    </div>

</x-layout-app>
