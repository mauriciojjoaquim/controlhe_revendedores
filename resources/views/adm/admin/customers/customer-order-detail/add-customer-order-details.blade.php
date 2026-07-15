<x-layout-app page-title="New Client Order Detail" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-2">

        <h3>New  Client Order Detail</h3>

        <hr>
        {{-- disabled --}}
        <form action="{{ route('adm.customers.customer-order-detail.created-customer-order-detail') }}" method="post">

            @csrf
            <div class="container-fluid">
                <div class="d-flex justify-content-center">
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1 row-cols-xl-1 row-cols-xxl-1 p-2">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="col border {{ $conf['color-border'] }} p-2">
                                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-2 p-2">


                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="user_id">Vendedorres</label>
                                                <select class="form-select" id="user_id" name="supplier_id">
                                                    <option class="text-center " value="0" selected>Selecione um Vendedor</option>
                                                    @foreach ($users as $user)
                                                    <option class="text-center " value="{{ $user->id }}">{{ $user->role }} - {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('user_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="client_id">Vendedorres</label>
                                                <select class="form-select" id="client_id" name="supplier_id">
                                                    <option class="text-center " value="0" selected>Selecione um cliente</option>
                                                    @foreach ($clients as $client)
                                                    <option class="text-center " value="{{ $client->id }}">{{ $client->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('client_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="price_per_installment" class="form-label">Preço da Parcela</label>
                                                <input type="number" class="form-control" id="price_per_installment" name="price_per_installment" step=".01" placeholder="0,00" value="{{ old('price_per_installment') }}">
                                                @error('price_per_installment')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="total_price" class="form-label">Preço Total</label>
                                                <input type="number" class="form-control" id="total_price" name="total_price" step=".01" placeholder="0,00" value="{{ old('total_price') }}">
                                                @error('total_price')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="number_of_installments" class="form-label">Número de parcelas</label>
                                                <input type="number" class="form-control" id="number_of_installments" name="number_of_installments" value="{{ old('number_of_installments') }}">
                                                @error('number_of_installments')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="installments_paid" class="form-label">Parcelas pagas</label>
                                                <input type="number" class="form-control" id="installments_paid" name="installments_paid" value="{{ old('installments_paid') }}">
                                                @error('installments_paid')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="customer_status">status do cliente</label>
                                                <select class="form-select" id="customer_status" name="customer_status">
                                                    <option value="0" selected>Selecione um status</option>
                                                    <option class="text-center " value="NC">Nada consta</option>
                                                    <option value="C-PG">Confirmar pagamento</option>
                                                    <option class="text-center " value="PG">Pago</option>
                                                </select>
                                                @error('customer_status')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    {{-- <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6"></div>

                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6"></div>


                                         <div class="col">
                                          
                                            'installment_due_date',
                                            'installment_payment_date',
                                            'situation',
                                        </div> --}}

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="mt-3">
                                <div class="mt-3 d-flex justify-content-center">
                                    <a href="{{ route('adm.customers.customer-order-detail.table-customer-order-detail') }}" class="btn btn-outline-warning me-3">Cancel</a>
                                    <button type="submit" class="btn btn-outline-primary mb-4">Create Client</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        

    </div>

</x-layout-app>

