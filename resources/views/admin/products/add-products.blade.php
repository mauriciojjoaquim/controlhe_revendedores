<x-layout-app page-title="New Product" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-1">

        <h3>New Product</h3>

        <hr>

        <form action="{{ route('admin.products.created-product') }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="container-fluid">
                <div class="row gap-3 justify-content-center">
                    <div class="col-6">
                        {{-- user --}}
                        <div class="col border {{ $conf['color-border'] }} p-4">

                            <div class="row cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1">

                                <div class="col">
                                    <div class="col border {{ $conf['color-border'] }} p-4">
                                        <div class="row cols-2 row-cols-sm-1 row-cols-md-2 row-cols-lg-2">

                                            <div class="col">
                                                <div class="img-vis  border {{ $conf['color-border'] }}">
                                                    <img id="preview-user" src="{{ url('storage/app/public/imagens/tamanho/150x150.png') }}" alt="" >
                                                </div>
                                            </div>
            
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="imagem" class="form-label">Photo</label>
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
                                                <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}">
                                                @error('code')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Name --}}
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Departament --}}
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="departament" class="form-label">Departament</label>
                                                <input type="text" class="form-control" id="departament" name="departament" value="{{ old('departament') }}">
                                                @error('departament')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
        
                                        {{-- Description --}}
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Description</label>
                                                <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}">
                                                @error('description')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Percentage --}}
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Percentage</label>
                                                <input type="number" class="form-control" id="percentage" name="percentage" value="{{ old('percentage') }}">
                                                @error('percentage')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- points --}}
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="points" class="form-label">Point</label>
                                                <input type="number" class="form-control" id="points" name="points" value="{{ old('points') }}">
                                                @error('points')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
        
                                        {{-- Purchase Price --}}
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="purchase_price" class="form-label">Purchase Price</label>
                                                <input type="number" class="form-control" @disabled(true) id="purchase_price" name="purchase_price" step=".01" placeholder="0,00" value="{{ old('purchase_price') }}">
                                                @error('purchase_price')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
        
                                        {{-- Resale Price --}}
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="resale_price" class="form-label">Resale Price</label>
                                                <input type="number" class="form-control" id="resale_price" name="resale_price" step=".01" placeholder="0,00" value="{{ old('resale_price') }}">
                                                @error('resale_price')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Suppliers --}}
                                        <div class="col">
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col12 pe-3">
                                                        <label for="supplier_id">Suppliers</label>
                                                        <select class="form-select" id="supplier_id" name="supplier_id">
                                                            <option value="0" selected>Selecione um Supplier</option>
                                                            @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}">{{ $supplier->supplier }}</option>
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
                                                            <option value="0" selected>Selecione um Category</option>
                                                            @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
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
                        <div class="mt-3">
                            <a href="{{ route('admin.colaborators.table-colaborator') }}" class="btn btn-outline-warning me-3">Cancel</a>
                            <button type="submit" class="btn btn-outline-primary mb-4">Create Product</button>
                        </div>
                    </div>

                </div>

            </div>
        </form>

    </div>

</x-layout-app>



