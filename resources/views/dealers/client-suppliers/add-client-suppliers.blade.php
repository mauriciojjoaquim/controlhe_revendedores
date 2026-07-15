<x-layout-app page-title="Novo Fornecedor" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-2">

        <h3>Novo Fornecedor</h3>

        <hr>
        {{-- disabled --}}
        <form action="{{ route('admin.dealers.client-suppliers.created-client-supplier') }}" method="post">

            @csrf

            <div class="container-fluid">
                <div class="row gap-3 d-flex justify-content-center">

                    {{-- access --}}
                    <div class="col-6 border {{ $conf['color-border'] }} p-4">

                        <div class="mb-3">
                            <label for="name" class="form-label">Fornecedor</label>
                            <input type="text" class="form-control" id="supplier" name="supplier" value="{{ old('supplier') }}">
                            @error('supplier')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                    </div>


                </div>
                <div class="mt-3 d-flex justify-content-center">
                    <a href="{{ route('admin.dealers.client-table-suppliers.table-client-supplier') }}" class="btn btn-outline-warning me-3">Voutar</a>
                    <button type="submit" class="btn btn-outline-primary">New supplier</button>
                </div>

            </div>

        </form>


    </div>

</x-layout-app>

{{-- colaborators.colaborator.edit-colaborators-manager --}}
