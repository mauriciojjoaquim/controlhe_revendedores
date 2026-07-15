<x-layout-app page-title="Editar Produto" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-2">

        <h3>Editar Produto</h3>

        <hr>

        <form action="{{ route('adm.Leaders.leader-seller-product.updated-leader-seller-product') }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="container-fluid">
                <div class="row gap-3 justify-content-center">
                    <div class="col-6">
                        {{-- user --}}
                        <div class="col border {{ $conf['color-border'] }} p-4">

                            <div class="row cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1">

                                <div class="col">
                                    {{-- Photo --}}
                                    <div class="col border {{ $conf['color-border'] }} p-4">
                                        <div class="row cols-2 row-cols-sm-1 row-cols-md-2 row-cols-lg-2">

                                            <div class="col">
                                                <div class="img-vis  border {{ $conf['color-border'] }}">
                                                    @if ($product->photo_url == '150x150.png')
                                                        <img id="preview-user" src="{{ url('storage/imagens/tamanho/150x150.png') }}" alt="150x150">
                                                    @else
                                                        <img id="preview-user" src="{{ url('storage/imagens/products/'.$product->supplier_id.'/'.$product->photo_url) }}" alt="{{ $product->photo_url }}">
                                                    @endif

                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="imagem" class="form-label">Foto</label>
                                                    <input type="file" class="form-control" name="imagem" onchange="previewImagem();">
                                                    @error('imagem')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="row cols-2 row-cols-sm-1 row-cols-md-2 row-cols-lg-2">

                                        {{-- Code --}}
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="code" class="form-label">Code</label>
                                                <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $product->code) }}">
                                                @error('code')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Name --}}
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nome</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}">
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Departament --}}
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="departament" class="form-label">Departamento</label>
                                                <input type="text" class="form-control" id="departament" name="departament" value="{{ old('departament', $product->departament) }}">
                                                @error('departament')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Description --}}
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Descrição</label>
                                                <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $product->description) }}">
                                                @error('description')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Percentage --}}
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Porcentage</label>
                                                <input type="number" class="form-control" id="percentage" name="percentage" value="{{ old('percentage', $product->percentage) }}">
                                                @error('percentage')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- points --}}
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="points" class="form-label">Ponto</label>
                                                <input type="number" class="form-control" id="points" name="points" value="{{ old('points', $product->points) }}">
                                                @error('points')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Purchase Price --}}
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="purchase_price" class="form-label">Preço de compra</label>
                                                <input type="number" class="form-control" @disabled(true) id="purchase_price" name="purchase_price" step=".01" placeholder="0,00" value="{{ old('purchase_price', $product->purchase_price) }}">
                                                @error('purchase_price')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Resale Price --}}
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="resale_price" class="form-label">Preço de revenda</label>
                                                <input type="number" class="form-control" id="resale_price" name="resale_price" step=".01" placeholder="0,00" value="{{ old('resale_price', $product->resale_price) }}">
                                                @error('resale_price')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row cols-2 row-cols-sm-1 row-cols-md-1 row-cols-lg-1">
                                        {{-- non_production and confirmed --}}
                                        <div class="col mb-3">
                                            <div class="border {{ $conf['color-border'] }} p-4">
                                                <p class="mb-0">Abulutar/Dezabilitar </p>
                                            <div class="border {{ $conf['color-border'] }}">
                                                <div class="d-flex justify-content-start p-2">
                                                    <div class="me-3">
                                                        @if ($product->confirmed == 1)
                                                        <input type="checkbox" class="btn-check" id="confirmed" autocomplete="off" wire:model="confirmed" checked>
                                                        <label class="btn btn-outline-primary" for="confirmed">Confirmed</label><br>
                                                            @else
                                                            <input type="checkbox" class="btn-check" id="confirmed" autocomplete="off" wire:model="confirmed">
                                                            <label class="btn btn-outline-primary" for="confirmed">Confirmed</label><br>
                                                            @endif

                                                    </div>
                                                    <div class="me-3">
                                                        @if ($product->non_production == 1)
                                                            <input type="checkbox" class="btn-check" id="non_production" autocomplete="off" wire:model="non_production" checked>
                                                            <label class="btn btn-outline-primary" for="non_production">Fora de produçao</label>
                                                        @else
                                                            <input type="checkbox" class="btn-check" id="non_production" autocomplete="off" wire:model="non_production">
                                                            <label class="btn btn-outline-primary" for="non_production">Fora de produçao</label>
                                                    @endif
                                                       </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="row cols-2 row-cols-sm-1 row-cols-md-2 row-cols-lg-2">

                                            {{-- Suppliers --}}
                                            <div class="col">
                                                <div class="mb-3">
                                                    <div class="row">
                                                        <div class="col12 pe-3">
                                                            <label for="supplier_id">Suppliers</label>
                                                            <select class="form-select" id="supplier_id" name="supplier_id">
                                                                <option value="0">Selecione um Supplier</option>
                                                                @foreach ($suppliers as $supplier)
                                                                @if ($supplier->id == $product->supplier->id)
                                                                    <option value="{{ $supplier->id }}" selected>{{ $supplier->supplier }}</option>
                                                                @else
                                                                    <option value="{{ $supplier->id }}">{{ $supplier->supplier }}</option>
                                                                    @endif
                                                                @endforeach


                                                            </select>
                                                            @error('supplier_id')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Categories --}}
                                            <div class="col">
                                                <div class="mb-3">
                                                    <div class="row">
                                                        <div class="col12 pe-3">
                                                            <label for="category_id">Categories</label>
                                                            <select class="form-select" id="category_id" name="category_id">
                                                                <option value="0">Selecione um Category</option>
                                                                @foreach ($categories as $category)
                                                                @if ($category->id == $product->category_id)
                                                                    <option value="{{ $category->id }}" selected>{{ $category->category }}</option>
                                                                @else
                                                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                                                @endif

                                                                @endforeach
                                                            </select>
                                                            @error('category_id')
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
                    </div>
                    <div class="col-6">
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="mt-3 pb-4 d-flex justify-content-center">
                            <a href="{{ route('adm.Leaders.leader-seller-product.table-leader-seller-product') }}" class="btn btn-outline-warning me-3 mb-4">Cancelar</a>
                            <button type="submit" class="btn btn-outline-primary mb-4">Editar Produto</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>

</x-layout-app>

