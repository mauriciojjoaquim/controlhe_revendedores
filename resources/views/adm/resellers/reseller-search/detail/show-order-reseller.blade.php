<x-layout-app page-title="Detalhe da Ordem do Cliente" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100 p-4">

        <h3>Detalhe da Ordem do Cliente</h3>
        </h3>

        <hr>
        <div class="container-fluid">
            <div class="justify-content-center">
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 g-2 p-3">
                    {{-- Client --}}
                    <div class="col">
                        <div class="border {{ $conf['color-border'] }}">
                            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 g-2 p-3">
                                <div class="col">
                                    <H5>Cliente - {{ $client->name }}</H5>
                                    <p>nome: <strong>{{ $client->name }}</strong></p>
                                    <p>Email: <strong>{{ $client->email }}</strong></p>
                                    <p>CPF: <strong>{{ $client->cpf }}</strong></p>
                                    <p>Contato / Whatsapp: <strong>{{ $client->clientdetail->phone }}</strong></p>
                                    <p>Data do Cadastro: <strong>{{ date("d/m/Y H:i:s", strtotime($client->clientdetail->register_date)) }}</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Client - detail --}}
                    <div class="col">
                        <div class="border {{ $conf['color-border'] }}">
                            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 g-2 p-3">
                                <div class="col">
                                    <H5>Cliente Detalhe</H5>
                                    <p>Cep: <strong>{{ $client->clientdetail->zip_code }}</strong></p>
                                    <p>Endereço: <strong>{{ $client->clientdetail->address }}</strong></p>
                                    <p>Numero: <strong>{{ $client->clientdetail->number }}</strong></p>
                                    <p>Complemento: <strong>{{ $client->clientdetail->complement }}</strong></p>
                                    <p>Bairro: <strong>{{ $client->clientdetail->neighborhood }}</strong></p>
                                    <p>Cidade: <strong>{{ $client->clientdetail->city }}</strong></p>

                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- Client - order - detail --}}
                    <div class="col">
                        <div class="border {{ $conf['color-border'] }}">
                            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 g-2 p-3">
                                <div class="col">
                                    <p>ID do usuário: <strong>{{ $client->clientorderdetail->user_id }}</strong></p>
                                    <p>Preço total: <strong>{{ $client->clientorderdetail->total_price }}</strong></p>
                                    <p>Número de parcelas: <strong>{{ $client->clientorderdetail->number_of_installments }}</strong></p>
                                    <p>Preço por parcela: <strong>{{ $client->clientorderdetail->price_per_installment }}</strong></p>
                                    <p>Parcelas pagas: <strong>{{ $client->clientorderdetail->installments_paid }}</strong></p>
                                    <p>Data de vencimento da parcela: <strong>{{ date("d/m/Y", strtotime($client->clientorderdetail->installment_due_date)) }}</strong></p>
                                    <p>Data de pagamento da parcela: <strong>{{ date("d/m/Y", strtotime($client->clientorderdetail->installment_payment_date)) }}</strong></p>
                                    <p>Status do cliente: <strong>
                                        @if ($client->clientorderdetail->customer_status == 'NC')
                                        NC - Nada Costa
                                        @elseif ($client->clientorderdetail->customer_status == 'PG')
                                            PG - Pagamentos Efetuado
                                            @elseif ($client->clientorderdetail->customer_status == 'ED')
                                            Debito em Aberto
                                            @else
                                            Nenhuma situação foi informada
                                        @endif
                                    </strong></p>
                                    <p>Situação:
                                        <strong>
                                            @if ($client->clientorderdetail->situation == 'liberado')
                                                <div class="alert-success p-2 text-center">
                                                    Liberado
                                                </div>
                                            @elseif ($client->clientorderdetail->situation == 'emdebito')
                                                <div class="alert-warning p-2 text-center">
                                                    Em Debito
                                                </div>
                                            @elseif ($client->clientorderdetail->situation == 'devedor')
                                                <div class="alert-danger p-2 text-center">
                                                    Devedor
                                                </div>
                                            @else
                                                <div class="alert-warning p-2 text-center">
                                                    Sem Situação
                                                </div>

                                            @endif

                                        </strong>
                                    </p>
                                    <p>Criado em: <strong>{{ date("d/m/Y H:i:s", strtotime($client->clientorderdetail->created_at)) }}</strong></p>
                                    <p>Atualizado em: <strong>{{ date("d/m/Y H:i:s", strtotime($client->clientorderdetail->updated_at)) }}</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <a href="{{ route('admin.dealers.clients.client.table-vende-clients') }}" class="btn btn-outline-dark"><i class="fas fa-arrow-left me-2"></i>Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</x-layout-app>

