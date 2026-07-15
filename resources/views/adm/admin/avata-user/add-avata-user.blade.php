<x-layout-customer-app page-title="Criar nova imagem" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-1">

        <h3>Criar nova imagem</h3>

        <hr>

        <form action="{{ route('adm.admin.avata-users.created-avata-users') }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="container-fluid">
                <div class="row gap-3 justify-content-center">
                    <div class="col-sm-12 col-lg-6">
                        {{-- user --}}
                        <div class="border {{ $conf['color-border'] }} p-4">

                            <div class="row cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1">

                                <div class="col">
                                    <div class="col border {{ $conf['color-border'] }} p-4">
                                        <div class="row cols-2 row-cols-sm-1 row-cols-md-1 row-cols-lg-1">

                                            <div class="col-sm-12 col-lg-12">
                                                <div class="avata-img">
                                                    @if (Auth::user()->avata_user != null)
                                                    <img class="rounded" id="preview-user" src="{{ asset('assets/imagens/avata-users/'.Auth::user()->id.'/'.Auth::user()->avata_user) }}" alt="avata-user.png" width="50px" height="50px">
                                                    @else
                                                    <img class="rounded" id="preview-user" src="{{ asset('assets/images/avata-user.png') }}" alt="avata-user.png" width="50px" height="50px">
                                                    @endif
                                                    
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-12">
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

                            </div>

                        </div>
                    </div>

                    <div class="col-sm-12 d-flex justify-content-center">
                        <div class="mt-3">
                            <a href="{{ route('adm.customers.customer-proof-payment.table-customer-proof-payment') }}" class="btn btn-outline-warning mb-4 me-3">Cancel</a>
                            <button type="submit" class="btn btn-outline-primary mb-4">Criar nova imagem</button>
                        </div>
                    </div>

                </div>

            </div>
        </form>

    </div>

</x-layout-customer-app>


{{--

'user_id',
        'supplier_id',
        'category_id',
        'name',
        'description',
        'departament',
        'purchase_price',
        'resale_price',
        'percentage',
        'photo_url',
        'code',
        'non_production',
        'confirmed',


--}}
