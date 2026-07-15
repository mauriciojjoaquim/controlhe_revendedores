<x-layout-app page-title="Edit Clients" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Edit Clients</h3>

        <hr>
        {{-- disabled --}}
        <form action="{{ route('adm.clients.client-order-detail.updated-client-order-detail') }}" method="post">

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
                                                    <option class="text-center " value="0">Selecione um Vendedor</option>
                                                    @foreach ($users as $user)
                                                    @if ($user->id == $ClientOrderDetail->user_id)
                                                         <option class="text-center " value="{{ $user->id }}" selected>{{ $user->role }} - {{ $user->name }}</option>
                                                    @else
                                                        <option class="text-center " value="{{ $user->id }}">{{ $user->role }} - {{ $user->name }}</option>
                                                    @endif
                                                   
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
                                                    <option class="text-center" value="0">Selecione um cliente</option>
                                                    @foreach ($clients as $client)
                                                    @if ($client->id == $ClientOrderDetail->client_id)
                                                        <option class="text-center" value="{{ $client->id }}" selected>{{ $client->name }}</option>
                                                    @else
                                                        <option class="text-center" value="{{ $client->id }}">{{ $client->name }}</option> 
                                                    @endif
                                                    
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
                                                <input type="number" class="form-control" id="price_per_installment" name="price_per_installment" step=".01" placeholder="0,00" value="{{ old('price_per_installment', $ClientOrderDetail->price_per_installment) }}">
                                                @error('price_per_installment')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="total_price" class="form-label">Preço Total</label>
                                                <input type="number" class="form-control" id="total_price" name="total_price" step=".01" placeholder="0,00" value="{{ old('total_price', $ClientOrderDetail->total_price) }}">
                                                @error('total_price')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="number_of_installments" class="form-label">Número de parcelas</label>
                                                <input type="number" class="form-control" id="number_of_installments" name="number_of_installments" value="{{ old('number_of_installments', $ClientOrderDetail->number_of_installments) }}">
                                                @error('number_of_installments')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="mb-3">
                                                <label for="installments_paid" class="form-label">Parcelas pagas</label>
                                                <input type="number" class="form-control" id="installments_paid" name="installments_paid" value="{{ old('installments_paid', $ClientOrderDetail->installments_paid) }}">
                                                @error('installments_paid')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="customer_status">status do cliente</label>
                                                <select class="form-select" id="customer_status" name="customer_status">
                                                    @if ($ClientOrderDetail->customer_status == '')
                                                        <option class="text-center " value="0" selected>Selecione um status</option>
                                                        <option class="text-center " value="NC">Nada consta</option>
                                                        <option class="text-center " value="C-PG">Confirmar pagamento</option>
                                                        <option class="text-center " value="PG">Pago</option>
                                                    @elseif ($ClientOrderDetail->customer_status == 'NC')
                                                        <option class="text-center " value="0">Selecione um status</option>
                                                        <option class="text-center " value="NC" selected>Nada consta</option>
                                                        <option class="text-center " value="C-PG">Confirmar pagamento</option>
                                                        <option class="text-center " value="PG">Pago</option>
                                                    @elseif ($ClientOrderDetail->customer_status == 'C-PG')
                                                        <option class="text-center " value="0">Selecione um status</option>
                                                            <option class="text-center " class="text-center " value="NC">Nada consta</option>
                                                            <option class="text-center " value="C-PG" selected>Confirmar pagamento</option>
                                                            <option class="text-center " value="PG">Pago</option>
                                                    @elseif ($ClientOrderDetail->customer_status == 'PG')
                                                    <option class="text-center " value="0">Selecione um status</option>
                                                            <option class="text-center " class="text-center " value="NC">Nada consta</option>
                                                            <option class="text-center " value="C-PG" >Confirmar pagamento</option>
                                                            <option class="text-center " value="PG" selected>Pago</option>
                                                        
                                                    @endif
                                                    
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
                                <input type="hidden" name="id" id="id" value="{{ $client->id }}">
                                <div class="mt-3 d-flex justify-content-center">
                                    <a href="{{ route('adm.clients.client-order-detail.table-client-order-detail') }}" class="btn btn-outline-warning me-3">Cancel</a>
                                    <button type="submit" class="btn btn-outline-primary">Update Clients</button>
                                </div></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        

    </div>

</x-layout-app>

{{-- colaborators.colaborator.edit-colaborators-manager --}}