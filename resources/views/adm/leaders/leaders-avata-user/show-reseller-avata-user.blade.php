<x-layout-customer-app page-title="Category details" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Category details</h3>

        <hr>
        <div class="container-fluid">
            <div class="d-flex justify-content-center p-2">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1 row-cols-xl-1 row-cols-xxl-1">

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <p>Vendedor(a):
                                <strong>
                                    @foreach ($users as $user)
                                        @if($user->id == $proofPayment->user_id)
                                            {{ $user->name }}
                                        @endif
                                    @endforeach
                                </strong>

                            </p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <p>Mês/Ano do pagamento: 
                                <strong>{{ $proofPayment->month }}/{{ $proofPayment->year }}</strong>
                            </p>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <p>Dowload do Comprovante: 
                                <strong class="me-2">
                                    {{ $proofPayment->url_voucher }}
                                    <a href="{{ asset('storage/imagens/customer_vouchers/'.$proofPayment->user_id.'/'.$proofPayment->client_id.'/'.$proofPayment->url_voucher) }}" target="_blank" rel="noopener noreferrer" >
                                        <button class="btn btn-success btn-sm"><i class="fa-solid fa-download me-2"></i>Dowload</button>
                                    </a>
                                </strong>
                            </p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <button class="btn btn-outline-warning" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout-customer-app>
