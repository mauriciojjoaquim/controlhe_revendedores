<x-layout-app page-title="List Total" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>List Total</h3>

        <hr>

        <div class="container-fluid">
            <div class="row mb-3">

        <div class="col">
            @if ($lists->count() === 0)
            <div class="text-center my-5">
                <p>No Stocks found.</p>
                <a href="{{ route('user-lists.user-list-new') }}" class="btn btn-primary">Create a new Order List</a>
            </div>
        @else

            <div class="table-responsive-sm">
            <table class="table w-100" id="table">
                <thead class="table-dark">
                    <th>Confirm</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Unitatio Price</th>
                    <th>Wholesale Price</th>
                    <th>Total Price</th>
                </thead>
                <tbody>
                    @foreach ($lists as $list)
                    <tr>
                        <td>
                            <div>
                                @if ($list->confirmed_purchase == false)
                                    <form action="{{ route('user-lists.user-list-check') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $list->id }}">
                                        <input type="hidden" name="confirmed_purchase" value="1">
                                        <button type="submit">
                                            <div class="mb-3 form-check">
                                                <input type="checkbox" class="form-check-input" id="confirmed_purchase">
                                            </div>
                                        </button>
                                    
                                    </form>
                                @else
                                    <form action="{{ route('user-lists.user-list-check') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $list->id }}">
                                        <input type="hidden" name="confirmed_purchase" value="0">
                                        <button type="submit">
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="confirmed_purchase" checked>
                                        </div>
                                    </button>
                                    </form>

                                @endif
                                
                            </div>
                        </td>
                        <td>{{ $list->description }}</td>
                        <td>{{ $list->amount }}</td>
                        <td>{{ $list->unitatio_price }}</td>
                        <td>{{ $list->wholesale_price }}</td>
                        <td>{{ $list->total_price }}</td>
                      
                    </tr>
    
                    @endforeach
                    
                </tbody>
            </table>
            <div class="table-responsive-sm ">
                <table class="table w-100">
                    <thead class="table-dark">
                <tr>
                    <td></td>
                    <td class="text-end">Quant Product:</td>
                    <td class="text-end">{{ $lists->count() }}</td>
                    <td> </td>
                    <td></td>
                    <td class="text-end">Price Total:</td>
                    <td class="text-end">{{ $data['total_gasto'] }}</td>
                </tr>
            </thead>
            </table>
        </div>
        </div>
@endif
        </div>
                


            </div>
        </div>

        <button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Back</button>

    </div>

</x-layout-app>