<x-layout-app page-title="New Plano" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-2">

        <h3>New  Plano</h3>

        <hr>
        {{-- disabled --}}
        <form action="{{ route('adm.plans.created-plans') }}" method="post">

            @csrf
        
            <div class="container-fluid">

                
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-1">
                        <div class="col-xl-12 col-md-12 col-md-12 col-sm-12">
                            <div class="border {{ $conf['color-border'] }} p-4">
                                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-xl-2">

                                    {{-- Name --}}
                                    <div class="col-xl-6 col-md-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nome</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Price --}}
                                    <div class="col-xl-6 col-md-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Preço</label>
                                            <input type="number" class="form-control" id="price" name="price" step=".01" placeholder="0,00" value="{{ old('price') }}">
                                            @error('price')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                     {{-- -percente --}}
                                     <div class="col-xl-6 col-md-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label for="percente" class="form-label">-Porcentagem</label>
                                            <input type="number" class="form-control" id="percente" name="percente" value="{{ old('percente') }}">
                                            @error('percente')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- status --}}
                                    <div class="col-xl-6 col-md-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label for="customer_status" class="form-label">Status</label>
                                            <input type="text" class="form-control" id="customer_status" name="customer_status" value="{{ old('customer_status') }}">
                                            @error('customer_status')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Product ID --}}
                                    <div class="col-xl-6 col-md-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label for="product_id" class="form-label">Produto id</label>
                                            <input type="text" class="form-control" id="product_id" name="product_id" value="{{ old('product_id') }}">
                                            @error('product_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Price ID --}}
                                    <div class="col-xl-6 col-md-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label for="price_id" class="form-label">Preço id</label>
                                            <input type="text" class="form-control" id="price_id" name="price_id" value="{{ old('product_id') }}">
                                            @error('price_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                </div>

                            </div>
                        </div>

                        <div class="col-xl-12 col-md-12 col-md-12 col-sm-12">
                            <div class="mt-3 d-flex justify-content-center">
                                <a href="{{ route('adm.plans.table-plans') }}" class="btn btn-outline-warning me-3">Voltar</a>
                                <button type="submit" class="btn btn-outline-primary">Nova Plano</button>
                            </div>
                        </div>


                    </div>


            </div>
        
        </form>
        

    </div>

</x-layout-app>

