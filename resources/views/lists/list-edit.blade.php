<x-layout-app page-title="Edit Stock" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Edit Stock</h3>

        <hr>

        <form action="{{ route('lists.list-update') }}" method="post">

            @csrf

            <div class="container-fluid">
                <div class="row row-cols-sm-1 row-cols-2 row-cols-lg-4 gap-3">
                    <div class="col">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $list->description) }}">
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                        <div class="col">
                            <div class="mb-3">
                                <label for="code" class="form-label">Code</label>
                                <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $product->code) }}">
                                @error('code')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                   



                    <div class="col">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Quant</label>
                            <input type="number" class="form-control" id="amount" name="amount" placeholder="00" value="{{ old('amount', $list->amount) }}">
                            @error('amount')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col">
                        <div class="mb-3">
                            <label for="unitatio_price" class="form-label">Unitatio Price</label>
                            <input type="number" class="form-control" id="unitatio_price" name="unitatio_price" step=".01" placeholder="0,00" value="{{ old('unitatio_price', $list->unitatio_price) }}">
                            @error('unitatio_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col">
                        <div class="mb-3">
                            <label for="wholesale_amount" class="form-label">Wholesale Quant</label>
                            <input type="number" class="form-control" id="wholesale_amount" name="wholesale_amount" placeholder="00" value="{{ old('wholesale_amount') }}">
                            @error('wholesale_amount')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col">
                        <div class="mb-3">
                            <label for="wholesale_price" class="form-label">Wholesale Price</label>
                            <input type="number" class="form-control" id="wholesale_price" name="wholesale_price" step=".01" placeholder="0,00" value="{{ old('wholesale_price', $list->wholesale_price) }}">
                            @error('wholesale_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    
                   
                </div>
            <input type="hidden" name="id" id="id" value="{{ $list->id }}">
                <div class="mt-3">
                    <a href="{{ route('lists.list-table') }}" class="btn btn-outline-warning me-3">Cancel</a>
                    <button type="submit" class="btn btn-primary">Edit Stock</button>
                </div>
            </div>
        </div>
    </div>

        </form>

    </div>

</x-layout-app>

