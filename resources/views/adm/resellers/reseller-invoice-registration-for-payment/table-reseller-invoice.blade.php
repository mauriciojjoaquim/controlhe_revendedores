<x-layout-app page-title="Boletos Bancarios" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-2">

        <h3>Boletos Bancarios</h3>
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
        @if ($invoices->count() === 0)
        <div class="text-center my-5">
            <p>Não foi poxivel encontrar seu Boleto para pagar.</p>
            <a href="{{ route('adm.resellers.reseller-invoice-registration-for-payments.add-reseller-invoice') }}" class="btn btn-primary">Criar novo boleto</a>
        </div>
    @else
    <div class="mb-3">
        <a href="{{ route('adm.resellers.reseller-invoice-registration-for-payments.add-reseller-invoice') }}" class="btn btn-primary">Criar novo boleto</a>
    </div>

        <div class="table-responsive">
            <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100" id="table">
                <thead class="{{ $conf['bg_color_table'] }}">
                    <tr>
                        
                        <th class="text-center">Status</th>
                        <th class="text-center">Nº nota fiscal</th>
                        <th class="text-center">Descreção</th>
                        <th class="text-center">Preço</th>
                        <th class="text-center">Nº parcela</th>
                        <th class="text-center">Data vencimemto</th>
                        <th class="text-center">Data pagamento</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                    <tr>
                        
                        <td class="text-center">
                            @if($invoice->invoice_status == 'NC')
                            <a href="{{ route('adm.resellers.reseller-invoice-registration-for-payments.confirm_payment-reseller-invoice', ['id' => $invoice->id]) }}">
                                <span class="alert-warning text-dark pe-2 ps-2">Nada consta</span>
                            </a>
                            @elseif ($invoice->invoice_status == 'PG')
                            <span class="alert-success text-dark pe-2 ps-2">Pagamento efetuado</span>
                            @endif
                            
                        </td>
                        <td class="text-center">{{ $invoice->invoice_number }}</td>
                        <td class="text-center">{{ $invoice->description }}</td>
                        <td class="text-center">R$ {{ number_format($invoice->price, 2, ',', '.') }}</td>
                        <td class="text-center">{{ $invoice->installment_number }}</td>
                        <td class="text-center">{{ date('d/m/Y', strtotime($invoice->due_date)) }}</td>
                        <td class="text-center">
                            @if ($invoice->payment_date == null)
                               <strong class="alert-warning text-dark pe-2 ps-2">NC</strong> 
                            @else
                            {{ date('d/m/Y', strtotime($invoice->payment_date)) }}
                            @endif
                            
                        </td>

                        <td>
                             <div class="d-flex gap-1 justify-content-end">

                                <div class="btn-lg-display d-flex gap-1 justify-content-end">
                                    <a href="{{ route('adm.resellers.reseller-invoice-registration-for-payments.show-reseller-invoice', ['id' => $invoice->id])  }}" class="btn btn-sm btn-outline-warning ms-2"><i class="fas fa-eye me-2"></i>Detalhe</a>
                                <a href="{{ route('adm.resellers.reseller-invoice-registration-for-payments.edit-reseller-invoice', ['id' => $invoice->id]) }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a>
                                 <a href="{{ route('adm.resellers.reseller-invoice-registration-for-payments.conf-delete-reseller-invoice', ['id' => $invoice->id]) }}" class="btn btn-sm btn-outline-danger ms-2"><i class="fa-regular fa-trash-can me-2"></i>Excluir</a>

                                </div>
                                 <div class="btn-group btn-sm-display" role="group" aria-label="action">
                                    <div class="btn-group" role="group">
                                      <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                      </button>
                                      <ul class="dropdown-menu " aria-labelledby="btnGroupDrop1">
                                        <li><a href="{{ route('adm.resellers.reseller-invoice-registration-for-payments.show-reseller-invoice', ['id' => $invoice->id]) }}" class="dropdown-item"><i class="fas fa-eye me-2"></i>Detalhe</a></li>
                                        <li><a href="{{ route('adm.resellers.reseller-invoice-registration-for-payments.edit-reseller-invoice', ['id' => $invoice->id]) }}" class="dropdown-item"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a></li>
                                        <li><a href="{{ route('adm.resellers.reseller-invoice-registration-for-payments.conf-delete-reseller-invoice', ['id' => $invoice->id]) }}" class="dropdown-item"><i class="fa-regular fa-trash-can me-2"></i>Excluir</a></li>
                                      </ul>
                                    </div>
                                  </div>
                             </div>
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
            
@endif

    </div>
    </x-layout-app>
