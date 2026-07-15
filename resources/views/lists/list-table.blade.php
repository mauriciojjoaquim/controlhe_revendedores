<x-layout-app page-title="Stocks" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100 p-4">
    
        <h3>All Lists</h3>
        @if ($lists->count() === 0)
            <div class="text-center my-5">
                <p>No Stocks found.</p>
                <a href="{{ route('lists.list-new') }}" class="btn btn-primary">Create a new Order List</a>
            </div>
        @else
            <div class="mb-3">
                <a href="{{ route('lists.list-new') }}" class="btn btn-primary mt-3">Create a new Order List</a>
                <a href="{{ route('lists.list-vis-total') }}" class="btn btn-primary mt-3">List Total</a>
            </div>
            <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl table-responsive-xxl">
            <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-sm table-hover" id="table">
                <thead class="{{ $conf['bg_color_table'] }}">
                    <th scope="col" class="">Confirm</th>
                    <th scope="col" class="">Description</th>
                    <th scope="col" class="">Amount</th>
                    <th scope="col" class="">Unitatio Price</th>
                    <th scope="col" class="">Wholesale Price</th>
                    <th scope="col" class="">Total Price</th>
                    <th scope="col" class=""></th>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($lists as $list)
                    <tr>
                        <th scope="row" class="">
                            <div>
                                @if ($list->confirmed_purchase == false)
                                    <form action="{{ route('lists.list-check') }}" method="post">
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
                                    <form action="{{ route('lists.list-check') }}" method="post">
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
                        </th>
                        <td class="text-start">{{ $list->description }}</td>
                        <td class="text-center">{{ $list->amount }}</td>
                        <td class="text-end">R$ {{ number_format($list->unitatio_price, 2, ',', '.') }}</td>
                        <td class="text-end">R$ {{ number_format($list->wholesale_price, 2, ',', '.') }}</td>
                        <td class="text-end">R$ {{ number_format($list->total_price, 2, ',', '.') }}</td>
                        <td class="">
                            <div class="d-flex gap-1 justify-content-end">
                                
                                
                                
                                <a href="{{ route('lists.list-vis', ['id' => $list->id]) }}" class="btn btn-sm btn-outline-warning ms-1"><i class="fas fa-eye me-1"></i>Detail</a>
                                <a href="{{ route('lists.list-edit', ['id' => $list->id]) }}" class="btn btn-sm btn-outline-primary ms-1"><i class="fa-regular fa-pen-to-square me-1"></i>Edit</a>
                                 <a href="{{ route('lists.list-confirm-delete', ['id' => $list->id])}}" class="btn btn-sm btn-outline-danger ms-1"><i class="fa-regular fa-trash-can me-1"></i>Delete</a>
                               
                             </div>
                        </td>
                    </tr>
    
                    @endforeach
    
                </tbody>
            </table>
        </div>
@endif
    
    </div>
    </x-layout-app>
    