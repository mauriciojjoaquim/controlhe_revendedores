<x-layout-app page-title="Enviar Comprovante" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Enviar comprovante</h3>

        <hr>
        {{-- disabled --}}
        <form action="{{ route('client-dealer.client-confirma-form-payment-detail') }}" method="post" enctype="multipart/form-data">

            @csrf
            <div class="container-fluid">
                <div class="justify-content-center">
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 g-2 p-3">
                        {{-- Client --}}
                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <ul>
                                <li><p>Caro clente depois do envio do comprovante o revendedor tera 48 Horas para confirmação</p></li>
                                <li> <p>Para obter uma resposta mais rapida acione no <i class="fa-brands fa-square-whatsapp h3"></i> whatsapp seu revendedor</p></li>
                            </ul>
                            
                           
                            <p></p>
                        </div>
                            <div class="col-sm-12 col-md-12 col-xl-12">
                            <div class="border {{ $conf['color-border'] }}">
                                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 g-2 p-3">
                                    
                                    <div class="col-sm-12 col-md-12 col-xl-12">
                                        <div class="col border {{ $conf['color-border'] }} p-4">
                                            <div class="row cols-2 row-cols-sm-1 row-cols-md-2 row-cols-lg-2">
    
                                                <div class="col-sm-12 col-md-12 col-xl-3">
                                                    <div class="img-vis  border {{ $conf['color-border'] }}">
                                                        <img id="preview-user" src="{{ url('storage/app/public/imagens/tamanho/150x150.png') }}" alt="" >
                                                    </div>
                                                </div>
                
                                                <div class="col-sm-12 col-md-12 col-xl-9">
                                                    <div class="mb-3">
                                                        <label for="imagem" class="form-label">Comprovante</label>
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

                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <input type="hidden" name="id" id="id" value="{{ $client->id }}">
                            <div class="mt-3 d-flex justify-content-center">
                                <a href="{{ route('admin.dealers.clients.client.table-vende-clients') }}" class="btn btn-outline-warning me-3">Voltar</a>
                                <button type="submit" class="btn btn-outline-primary">Confirmar envio</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </form>
        

    </div>

</x-layout-app>

{{-- colaborators.colaborator.edit-colaborators-manager --}}