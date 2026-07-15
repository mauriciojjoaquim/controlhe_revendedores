<x-layout-app page-title="Product details" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-2">

        <h3>Product details</h3>

        <hr>

        <div class="container-fluid">
            <div class="row mb-3 p-4">

                <div class="col-3">
                    <div class="dt-img">
                        <img class="img-dt" src="{{ url('storage/app/public/imagens/products/'.$product->supplier->supplier.'/'.$product->photo_url) }}" alt="{{ $product->photo_url }}">
                    </div>


                </div>

                <div class="col">
                    <p>Code: <strong>{{ $product->code }}</strong></p>
                    <p>Name: <strong>{{ $product->name }}</strong></p>
                    <p>Description: <strong>{{ $product->description }}</strong></p>
                    <p>Departament: <strong>{{ $product->departament }}</strong></p>
                    <p>Supplier: <strong>{{ $product->supplier->supplier }}</strong></p>
                    <p>Category: <strong>{{ $product->category->category }}</strong></p>
                    <p>purchase Price: <strong>{{ number_format($product->purchase_price, 2, ',', '.') }}</strong></p>
                    <p>Resale Price: <strong>{{ number_format($product->resale_price, 2, ',', '.') }}</strong></p>
                    <p>Percentage: <strong>{{ $product->percentage }}</strong>%</p>
                    <p>Photo Name: <strong>{{ $product->photo_url }}</strong></p>
                    <p>point: <strong>{{ $product->points }}</strong></p>
                </div>

            </div>
        </div>

        <button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Back</button>

    </div>

</x-layout-app>
