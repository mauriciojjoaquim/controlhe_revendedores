<x-layout-customer-app page-title="Category details" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Category details</h3>

        <hr>
        <div class="container-fluid">
        <div class="d-flex justify-content-center">

            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1 row-cols-xl-1 row-cols-xxl-1">
                <div class="col d-flex justify-content-center">
                    <div class="mb-3">
                        <form action="{{ route('adm.magazine-numbers.show-custome-magazine-numbers') }}" method="get">
                            @csrf
                            <div class="container-fluid">
                                <div class="border {{ $conf['color-border'] }} p-4">
                                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-2 mb-sm-2 mb-md-2">
    
    
                                        {{-- Suppliers --}}
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4">
                                            <div class="mb-3">
                                                    <label class="form-label" for="supplier_id"><span class="text-danger">*</span>  Fornrcedor</label>
                                                    <select class="form-select" id="supplier_id" name="supplier_id">
                                                        <option>Selecione um Fornecedor</option>
                                                        @foreach ($suppliers as $supplier)
                                                            @if ($supplier->id == $supplier_id)
                                                                <option value="{{ $supplier->id }}" selected>{{ $supplier->supplier }}</option>
                                                            @else
                                                                <option value="{{ $supplier->id }}">{{ $supplier->supplier }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
    
    
                                        {{-- action --}}
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 pt-2 mt-1">
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-start">
                                                    <div class="mb-2  pt-4 me-3">
                                                        {{-- <input type="hidden" name=""> --}}
                                                        <button type="submit" class="btn btn-sm btn-outline-info ms-2 p-2">
                                                            <i class="fa-solid fa-magnifying-glass me-1"></i>Pesquisar
                                                        </button>
                                                    </div>
                                                    <div class="mb-2 pt-4">
                                                        <a href="{{ route('adm.magazine-numbers.show-custome-magazine-numbers') }}" class="btn btn-sm btn-outline-primary p-2">
                                                            <i class="fa-solid fa-eraser me-1"></i>Limpar
                                                        </a>
                                                    </div>
    
                                                </div>
                                            </div>
                                        </div>
    
                                    </div>
                                </div>
    
    
                            </div>
                        </form>
    
                    </div>
                </div>
                

                <div class="col d-flex justify-content-center">
                    <div class="col-7 border {{ $conf['color-border'] }} p-4">
                        @if ($magazineNumbers->count() != 0)
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-3">
                                @foreach ($magazineNumbers as $magazineNumber)
                                    <div class="col">
                                        <div class="border {{ $conf['color-border'] }} p-2 m-2">
                                            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1 row-cols-xl-1 row-cols-xxl-1">

                                                <div class="col d-flex justify-content-center m-0">
                                                    @if ($magazineNumber->activated == 1)
                                                    <div class="bg-success text-ligth w-25 border {{ $conf['color-border'] }} p-1 text-center">
                                                        <h2>{{ $magazineNumber->number }}</h2>
                                                    </div>
                                                    @else
                                                    <div class="bg-danger text-ligth w-25 border {{ $conf['color-border'] }} p-1 text-center">
                                                        <h2>{{ $magazineNumber->number }}</h2>
                                                    </div>
                                                    @endif
                                                </div>

                                                <div class="col text-center mt-1">
                                                    <h4>{{ $magazineNumber->start_day }}/{{ $magazineNumber->start_month }}</h4>
                                                </div>

                                                <div class="col text-center mt-1">
                                                    <h4>{{ $magazineNumber->end_day }}/{{ $magazineNumber->end_month }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                            
                        @else
                            <h2>Nenhum ciclo foi encontrado</h2>
                        @endif
                        
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    @can('client')
                    <button class="btn btn-outline-warning" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Back</button>
                
                    
                    @endcan
                    @can('vende')
                        <button class="btn btn-outline-warning" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Back</button>
                    @else
                        <a class="btn btn-outline-warning" href="{{ route('adm.magazine-numbers.table-magazine-numbers') }}"><i class="fas fa-arrow-left me-2"></i>Back</a>
                    @endcan

                </div>
            </div>
            
            


    </div>
</div>




    </div>

</x-layout-customer-app>
