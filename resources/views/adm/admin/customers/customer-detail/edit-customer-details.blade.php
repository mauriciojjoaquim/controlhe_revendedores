<x-layout-app page-title="Edit Clients"borderob-ackcolor-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}">
    <div class="w-100 p-4">

        <h3>Edit Clients</h3>

        <hr>
        {{-- disabled --}}
        <form action="{{ route('adm.customers.customer-detail.updated-customer-detail') }}" method="post">

            @csrf
        
            <div class="container-fluid">
                <div class="row gap-3 justify-content-center">
        
                    <div class="col">
                        {{-- user details --}}
                    <div class="col border {{ $conf['color-border'] }} p-4">

                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="zip_code" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" id="cep" name="zip_code" value="{{ old('zip_code', $clientdetail->zip_code) }}">
                                    @error('zip_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="mb-3">
                                    <label for="Address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="rua" name="address" value="{{ old('address', $clientdetail->address) }}">
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-cols-2 row-cols-sm-2 row-cols-md-2 row-cols-xl-2 g-2">
                            <div class="col-2">
                                <div class="mb-4">
                                    <label for="number" class="form-label">Number</label>
                                    <input type="text" class="form-control" id="number" name="number" value="{{ old('number', $clientdetail->number) }}">
                                    @error('number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="complement" class="form-label">Complement</label>
                                    <input type="text" class="form-control" id="complement" name="complement" value="{{ old('complement', $clientdetail->complement) }}">
                                    @error('complement')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="neighborhood" class="form-label">neighborhood</label>
                                    <input type="text" class="form-control" id="bairro" name="neighborhood" value="{{ old('neighborhood', $clientdetail->neighborhood) }}">
                                    @error('neighborhood')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="cidade" name="city" value="{{ old('city', $clientdetail->city) }}">
                                    @error('city')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-cols-3 row-cols-sm-1 row-cols-md-2 row-cols-xl-3 g-2">
                            <div class="col col-sm-12">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $clientdetail->phone) }}">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>


                    </div>
                    </div>

                <input type="hidden" name="id" id="id" value="{{ $clientdetail->id }}">
                <div class="mt-3 d-flex justify-content-center">
                    <a href="{{ route('adm.customers.customer-detail.table-customer-detail') }}" class="btn btn-outline-warning me-3">Cancel</a>
                    <button type="submit" class="btn btn-outline-primary">Update Clients</button>
                </div>
        
            </div>
        
        </form>
        

    </div>

</x-layout-app>

{{-- colaborators.colaborator.edit-colaborators-manager --}}