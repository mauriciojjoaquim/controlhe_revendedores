<x-layout-app page-title="Produtos" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100 p-4">
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
        <h3>Todos os Produtos</h3>
        @if ($products->count() === 0)
        <div class="text-center my-5">
            <p>No Products found.</p>
            <a href="{{ route('admin.leadership.products.add-product') }}" class="btn btn-primary">Criar Novo Product</a>
        </div>
    @else
    <div class="mb-3">
        <a href="{{ route('admin.leadership.products.add-product') }}" class="btn btn-primary">Criar Novo Product</a>
    </div>
    @if (session('status'))
        <div class="alert alert-{{ (session('tipo_alert')) }} text-dark text-center mt-4 p-2">
            {{ session('mesagem') }}
        </div>
        <hr>
    @endif
        <div class="table-responsive">
            <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100" id="table">
                <thead class="{{ $conf['bg_color_table'] }}">
                    <th>Foto</th>
                    <th>Cod</th>
                    <th>Nome</th>
                    <th>Supplier</th>
                    <th>Categoria</th>
                    <th>Preço de compra</th>
                    <th>Preço de revenda</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>
                            <div class="tb-img">
                                <a class="img-pro" href="{{ url('storage/app/public/imagens/products/'.$product->supplier->supplier.'/'.$product->photo_url) }}">
                                    <img class="img-tb" src="{{ url('storage/app/public/imagens/products/'.$product->supplier->supplier.'/'.$product->photo_url) }}" alt="{{ $product->photo_url }}">
                                </a>
                            </div>
                        </td>
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->supplier->supplier }}</td>
                        <td>{{ $product->category->category }}</td>
                        <td>R$ {{ number_format($product->purchase_price, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($product->resale_price, 2, ',', '.') }}</td>

                        <td>
                             <div class="d-flex gap-1 justify-content-end">

                                <div class="btn-lg-display d-flex gap-1 justify-content-end">
                                    <a href="{{ route('admin.leadership.products.show-product', ['id' => $product->id])  }}" class="btn btn-sm btn-outline-warning ms-2"><i class="fas fa-eye me-2"></i>Detalhe</a>
                                <a href="{{ route('admin.leadership.products.edit-product', ['id' => $product->id]) }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a>
                                 <a href="{{ route('admin.leadership.products.conf-delete-product', ['id' => $product->id]) }}" class="btn btn-sm btn-outline-danger ms-2"><i class="fa-regular fa-trash-can me-2"></i>Excluir</a>

                                </div>
                                 <div class="btn-group btn-sm-display" role="group" aria-label="action">
                                    <div class="btn-group" role="group">
                                      <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                      </button>
                                      <ul class="dropdown-menu " aria-labelledby="btnGroupDrop1">
                                        <li><a href="{{ route('admin.leadership.products.show-product', ['id' => $product->id]) }}" class="dropdown-item"><i class="fas fa-eye me-2"></i>Detalhe</a></li>
                                        <li><a href="{{ route('admin.leadership.products.edit-product', ['id' => $product->id]) }}" class="dropdown-item"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a></li>
                                        <li><a href="{{ route('admin.leadership.products.conf-delete-product', ['id' => $product->id]) }}" class="dropdown-item"><i class="fa-regular fa-trash-can me-2"></i>Excluir</a></li>
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
