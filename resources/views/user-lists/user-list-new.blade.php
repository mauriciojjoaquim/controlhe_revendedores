<x-layout-app page-title="New User Order List" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>New User Order List</h3>

        <hr>




        @if(Empty($list))

        <h3>Simple Barcode scanner</h3>
        <strong>Last scanned barcode:</strong>
        <div id="last-barcoda"></div>


        <div class="">
            <form action="{{ route('user-lists.user-list-new') }}" method="post">
                @csrf
                <div class="row ">
                    <div class="col d-flex gap-1 justify-content-end">
                        <div class="">Search:</div>
                        <div class="">
                        <input type="number w-100" name="search">
                    </div>
                    <div class=""><button type="submit" class="btn btn-primary">Buscar</button></div>
                </div>
                    </div>

            </form>
        </div>



        @else
         <form action="{{ route('user-lists.user-list-add') }}" method="post">

            @csrf

        <div class="container-fluid">

            <div class="border {{ $conf['color-border'] }} p-2">
                <div class="row row-cols-sm-1 row-cols-2 row-cols-lg-4 gap-3">
                    <div class="col">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $list[0]->description) }}">
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                        <div class="col">
                            <div class="mb-3">
                                <label for="code" class="form-label">Code</label>
                                <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $list[0]->code) }}">
                                @error('code')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>




                    <div class="col">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Quant</label>
                            <input type="number" class="form-control" id="amount" name="amount" placeholder="00" value="{{ old('amount') }}">
                            @error('amount')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col">
                        <div class="mb-3">
                            <label for="unitatio_price" class="form-label">Unitatio Price</label>
                            <input type="number" class="form-control" id="unitatio_price" name="unitatio_price" step=".01" placeholder="0,00" value="{{ old('unitatio_price', $list[0]->unitatio_price) }}">
                            @error('unitatio_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col">
                        <div class="mb-3">
                            <label for="wholesale_amount" class="form-label">Wholesale Quant</label>
                            <input type="number" class="form-control" id="wholesale_amount" name="wholesale_amount" placeholder="00" value="{{ old('wholesale_amount', $list[0]->wholesale_amount) }}">
                            @error('wholesale_amount')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col">
                        <div class="mb-3">
                            <label for="wholesale_price" class="form-label">Wholesale Price</label>
                            <input type="number" class="form-control" id="wholesale_price" name="wholesale_price" step=".01" placeholder="0,00" value="{{ old('wholesale_price', $list[0]->wholesale_price) }}">
                            @error('wholesale_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

<input type="hidden" name="id" value="{{ $list[0]->id }}">
<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                </div>
                <div class="mt-3">
                    <a href="{{ route('user-lists.user-list-table') }}" class="btn btn-outline-warning me-3">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create stock</button>
                </div>
            </div>
        </div>


        </form>

        @endif
    </div>
<script>
    var barcode = '';
    var interval;

    document.addEventListener('keydown', function(evt){
        if(interval)
            clearInterval(interval);
        if(evt.code == 'Enter') {
            if(barcode)
                handleBarcode(barcode);

            barcode = '';
            return;
        }
        if(evt.code != 'shift')
            barcode += evt.key;
        interval = setInterval(() => barcode = '', 20);
    });

    function handleBarcode(scanned_barcode) {
        document.querySelector('#last-barcoda').innerHTML = scanned_barcode;
    }

</script>
</x-layout-app>

