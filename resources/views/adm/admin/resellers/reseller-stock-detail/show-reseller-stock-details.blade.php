<x-layout-app page-title="Reseller Stock Detail" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Reseller Stock Detail</h3>

        <hr>

        <div class="container-fluid">
            <div class="row mb-3 d-flex justify-content-center">

                <div class="col-12">
                    
                    <div class="row">

                        <div class="col-3">
                            <div class="dt-img">
                                @foreach ($products as $product)
                                @if ($customerstockdetail->product_id == $product->id)
                                <a class="img-pro" href="{{ url('storage/imagens/products/'.$product->supplier_id.'/'.$product->photo_url) }}">
                                    <img class="img-tb" src="{{ url('storage/imagens/products/'.$product->supplier_id.'/'.$product->photo_url) }}" alt="{{ $product->photo_url }}">
                                </a>
                                @endif
                                    
                                @endforeach
                            </div>
                        </div>

                            <div class="col-9">
                            <H5>Vendedora - {{ $customerstockdetail->user->name }}</H5>
                            <p>Code: <strong>{{ $customerstockdetail->product->code }}</strong></p>
                            <p>Name: <strong>{{ $customerstockdetail->product->name }}</strong></p>
                            <p>Percentage: <strong>{{ $customerstockdetail->product->percentage }}%</strong></p>
                            <p>Amount: <strong>{{ $customerstockdetail->amount }}</strong> Und</p>
                            <p>Purchase Price: <strong>R$ {{ number_format($customerstockdetail->purchase_price, 2, ',', '.') }}</strong></p>
                            <p>Resale Price: <strong>R$ {{ number_format($customerstockdetail->resale_price, 2, ',', '.') }}</strong></p>

                        </div>{{--  number_format($customerstockdetail->purchase_price, 2, ',', '.') --}}

                    </div>

                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-outline-warning" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Back</button>
                </div>
                

            </div>
        </div>


    </div>

</x-layout-app>

