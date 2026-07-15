<x-layout-customer-app page-title="Editar imagem" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Editar imagem</h3>

        <hr>
        {{-- disabled --}}
        <form action="{{ route('adm.customers.customer-avata-users.updated-avata-users') }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="container-fluid">
                <div class="row gap-3 justify-content-center">
                    <div class="col-sm-6 col-lg-3">
                        {{-- user --}}
                        <div class="border {{ $conf['color-border'] }} p-4">

                            <div class="row cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1">

                                <div class="col">
                                    <div class="col border {{ $conf['color-border'] }} p-4">
                                        <div class="row cols-2 row-cols-sm-1 row-cols-md-1 row-cols-lg-1">

                                            <div class="col-sm-12 col-lg-12">
                                                <div class="avata-img text-center">
                                                    @if (Auth::user()->avata_user != null)
                                                    <img class="rounded" id="preview-user" src="{{ url('storage/imagens/photousers/'.Auth::user()->id.'/'.Auth::user()->avata_user) }}" alt="avata">
                                                    @else
                                                    <img class="rounded" id="preview-user" src="{{ asset('assets/images/avata-user.png') }}" alt="avata-user.png">
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
                         <input type="hidden" name="id" id="id" value="{{ $avataUser->id }}">
                <div class="mt-3 d-flex justify-content-center">
                    <a href="{{ route('home') }}" class="btn btn-outline-warning me-3">Cancel</a>
                    <button type="submit" class="btn btn-outline-primary">Atualizar imagem</button>
                </div></div>


            </div>

        </form>


    </div>

</x-layout-customer-app>

{{-- https://controlhe-revendedores.cse-eletric.com.br/storage/app/public/imagens/avata-users/3/Picture_4_1776200023.png --}}
