<x-layout-app page-title="Detalhe do Produto" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Detalhe do Produto</h3>

        <hr>

        <div class="container-fluid">
            <div class="row cols-1 row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-lg-3 mb-3 p-2">

                <div class="col mb-3">
                    <div class="dt-img">
                        <img class="img-dt" src="{{ url('storage/app/public/imagens/products/'.$product->supplier->supplier.'/'.$product->photo_url) }}" alt="{{ $product->photo_url }}">
                    </div>
                </div>

                <div class="col ">
                    <p>Cod: <strong>{{ $product->code }}</strong></p>
                    <p>Nome: <strong>{{ $product->name }}</strong></p>
                    <p>Descrição: <strong>{{ $product->description }}</strong></p>
                    <p>Departamento: <strong>{{ $product->departament }}</strong></p>
                    <p>Fornecedor: <strong>{{ $product->supplier->supplier }}</strong></p>
                    <p>Categoria: <strong>{{ $product->category->category }}</strong></p>
                    <p>Preço de compra: <strong>{{ number_format($product->purchase_price, 2, ',', '.') }}</strong></p>
                    <p>Preço de revenda: <strong>{{ number_format($product->resale_price, 2, ',', '.') }}</strong></p>
                    <p>Porcentagem: <strong>{{ $product->percentage }}</strong>%</p>
                    <p>Foto Nome: <strong>{{ $product->photo_url }}</strong></p>
                    <p>pontos: <strong>{{ $product->points }}</strong></p>
                </div>

            </div>
        </div>

        <button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Voltar</button>

    </div>

</x-layout-app>
