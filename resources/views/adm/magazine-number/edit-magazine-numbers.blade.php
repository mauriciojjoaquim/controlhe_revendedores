<x-layout-app page-title="Edit magazine cycle" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Edit magazine cycle</h3>

        <hr>
        {{-- disabled --}}
        <form action="{{ route('adm.magazine-numbers.updated-magazine-numbers') }}" method="post">

            @csrf

            <div class="container-fluid">
                <div class="gap-3 d-flex justify-content-center">
                    <div class="col-7 border {{ $conf['color-border'] }} p-4">
                        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-2 mb-sm-2 mb-md-2">

                            {{-- number --}}
                            <div class="col-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 col-xxl-2">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Number</label>
                                    <input type="text" class="form-control" id="number" name="number" value="{{ old('number', $magazineNumber->number) }}">
                                    @error('number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div> 
                            </div>
                            
    
                            {{-- Suppliers --}}
                            <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                                <div class="mb-3">
                                        <label class="form-label" for="supplier_id"><span class="text-danger">*</span>  Fornrcedor</label>
                                        <select class="form-select" id="supplier_id" name="supplier_id">
                                            <option>Selecione um Fornecedor</option>
                                            @foreach ($suppliers as $supplier)
                                                @if ($supplier->id == $magazineNumber->supplier_id)
                                                    <option value="{{ $supplier->id }}" selected>{{ $supplier->supplier }}</option>
                                                @else
                                                    <option value="{{ $supplier->id }}">{{ $supplier->supplier }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                </div>
                            </div>

                            {{-- start_date --}}
                            <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', date($magazineNumber->year.'-m-d', strtotime($magazineNumber->start_date))) }}">
                                    @error('start_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div> 
                            </div>

                            {{-- end_date --}}
                            <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', date($magazineNumber->year.'-m-d', strtotime($magazineNumber->end_date))) }}">
                                    @error('end_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div> 
                            </div>

                        </div>
                    </div>

                    


                </div>
                <input type="hidden" name="id" id="id" value="{{ $magazineNumber->id }}">
                <div class="mt-3 d-flex justify-content-center">
                    <a href="{{ route('adm.magazine-numbers.table-magazine-numbers') }}" class="btn btn-outline-warning me-3">Cancel</a>
                    <button type="submit" class="btn btn-outline-primary">Update magazine cycle</button>
                </div>

            </div>

        </form>


    </div>

</x-layout-app>

{{-- colaborators.colaborator.edit-colaborators-manager --}}
