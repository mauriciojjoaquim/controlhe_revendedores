<x-layout-customer-app page-title="Comprovante de Pagamento" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Todos Comprovantes dos Pagamentos</h3>
        @if ($proofPayments->count() === 0)
        <div class="text-center my-5">
            <p>Nenhum Comprovante de Pagamento encontrado.</p>
            {{-- <a href="{{ route('adm.customers.customer-proof-payment.add-customer-proof-payment') }}" class="btn btn-primary">Adicionar novo comprovante</a> --}}
        </div>
    @else
    <div class="mb-3">
        {{-- <a href="{{ route('adm.customers.customer-proof-payment.add-customer-proof-payment') }}" class="btn btn-primary">Adicionar novo comprovante</a> --}}
    </div>

    <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100" id="table">
        <thead class="{{ $conf['bg_color_table'] }}">
                    <th>Nome do vendedor</th>
                    <th>URL do Mês/Ano de envio</th>
                    <th>URL do Comprovante</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($proofPayments as $proofPayment)
                    <tr>
                        <td>
                            @foreach($users as $user)
                                @if ($user->id == $proofPayment->user_id)
                                    {{ $user->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $proofPayment->month }}/{{ $proofPayment->year }}</td>
                        <td>{{ $proofPayment->url_voucher }}</td>

                        <td>
                             <div class="d-flex gap-1 justify-content-end">

                                <div class="btn-lg-display d-flex gap-1 justify-content-end">
                                    <a href="{{ route('adm.customers.customer-proof-payment.show-customer-proof-payment', ['id' => $proofPayment->id])  }}" class="btn btn-sm btn-outline-warning ms-2"><i class="fas fa-eye me-2"></i>Detalhe</a>
                                <a href="{{ route('adm.customers.customer-proof-payment.edit-customer-proof-payment', ['id' => $proofPayment->id]) }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a>
                                 <a href="{{ route('adm.customers.customer-proof-payment.conf-delete-customer-proof-payment', ['id' => $proofPayment->id]) }}" class="btn btn-sm btn-outline-danger ms-2"><i class="fa-regular fa-trash-can me-2"></i>Excluir</a>

                                </div>
                                 <div class="btn-group btn-sm-display" role="group" aria-label="action">
                                    <div class="btn-group" role="group">
                                      <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                      </button>
                                      <ul class="dropdown-menu " aria-labelledby="btnGroupDrop1">
                                        <li><a href="{{ route('adm.customers.customer-proof-payment.show-customer-proof-payment', ['id' => $proofPayment->id]) }}" class="dropdown-item"><i class="fas fa-eye me-2"></i>Detalhe</a></li>
                                        <li><a href="{{ route('adm.customers.customer-proof-payment.edit-customer-proof-payment', ['id' => $proofPayment->id]) }}" class="dropdown-item"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a></li>
                                        <li><a href="{{ route('adm.customers.customer-proof-payment.conf-delete-customer-proof-payment', ['id' => $proofPayment->id]) }}" class="dropdown-item"><i class="fa-regular fa-trash-can me-2"></i>Excluir</a></li>
                                      </ul>
                                    </div>
                                  </div>
                             </div>
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
@endif

    </div>
    </x-layout-customer-app>
