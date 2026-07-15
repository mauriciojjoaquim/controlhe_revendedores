<x-layout-app page-title="Supplier details" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-2">

        <h3>Supplier details</h3>

        <hr>

        <div class="container-fluid">
            <div class="d-flex justify-content-center p-2">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1 row-cols-xl-1 row-cols-xxl-1">

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <p>Número da nota fiscal: 
                                <strong>{{ $invoice->invoice_number }}</strong>
                            </p>
                        </div>
                        
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <p>Status da nota: 
                                @if ($invoice->invoice_status == 'NC')
                                    <a href="{{ route('adm.resellers.reseller-invoice-registration-for-payments.confirm_payment-reseller-invoice', ['id' => $invoice->id]) }}">
                                        <strong class="text-dark alert-warning pe-2 ps-2">{{ $invoice->invoice_status }}</strong> 
                                    </a>
                                @elseif ($invoice->invoice_status == 'PG')
                                    <strong class="text-dark alert-success pe-2 ps-2">{{ $invoice->invoice_status }}</strong>
                                @endif
                               
                            </p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <p>Descrição: <strong>{{ $invoice->description }}</strong></p>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <p>Preço: <strong>R$ {{ number_format($invoice->price, 2, ',', '.') }}</strong></p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <p>Código de barra: <strong>{{ $invoice->barcode }}</strong></p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <p>Código PIX: <strong>{{ $invoice->pix_code }}</strong></p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <p>número da parcela: <strong>{{ $invoice->installment_number }}</strong></p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <p>arquivo da nota: 
                                <strong class="pe-3">{{ $invoice->invoice_file }}
                                    <a href="{{ URL::to('/storage/imagens/invoices/'.Auth::user()->id.'/'.$invoice->invoice_file) }}" target="_blank" class="ps-1">
                                        <button class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download File</button>
                                    </a>
                                   
                                    
                                </strong>
                            </p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <p>Data vencimemto: 
                                <strong>{{ date('d/m/Y', strtotime($invoice->due_date)) }}</strong>
                            </p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <p>Data pagamento: 
                                @if ($invoice->payment_date == null)
                                    <strong class="text-dark alert-warning pe-2 ps-2">NC</strong>
                                @else
                                    <strong class="text-dark alert-success pe-2 ps-2">{{ date('d/m/Y', strtotime($invoice->payment_date)) }}</strong>
                                @endif 
                            </p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <a class="btn btn-outline-warning" href="{{ route('adm.resellers.reseller-invoice-registration-for-payments.table-reseller-invoice') }}"><i class="fas fa-arrow-left me-2"></i>Back</a>
                        </div>       
                    </div>
                </div>
            </div>

        

    </div>

</x-layout-app>