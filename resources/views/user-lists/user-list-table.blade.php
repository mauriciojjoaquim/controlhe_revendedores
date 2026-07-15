<x-layout-app page-title="User Order Lists" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>All User Order Lists</h3>
        @if(session('status'))
        <div class="d-flex justify-content-center">
            <div class="w-100">
                <div class="alert alert-{{ session('tipo_alert') }} {{ session('paricin') }} text-center mt-4 p-2" role="alert">
                    <div class="p-1">
                        <p class="pt-2 h1  {{ session('paricin') }}"><i class="{{ session('icon') }}"></i></p>
                        <p class="fs-4">{{ session('mesagem') }}</p>
                        <p class="fs-5"></p>
                    </div>
                </div>
            </div>
        </div>
   @endif
        @if ($userLists->count() === 0)
            <div class="text-center my-5">
                <p>No Stocks found.</p>
                <a href="{{ route('user-lists.user-list-new') }}" class="btn btn-primary">Create a new User Order List</a>
            </div>
        @else
            <div class="mb-3">
                <a href="{{ route('user-lists.user-list-new') }}" class="btn btn-primary mt-3">Create a User new Order List</a>

            </div>
            <div class="table-responsive-sm">
            <table class="table {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} table-hover w-100" id="table">
                <thead class="{{ $conf['bg_color_table'] }} fs-5">
                    <th scope="col">Confirmar</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Preço Total</th>
                    <th scope="col"></th>
                </thead>
                <tbody>
                    @foreach ($userLists as $userList)
                    <tr>
                        <td>
                            <div>
                                 @if ($userList->confirmed_purchase == false)
                                    <form action="{{ route('user-lists.user-list-check') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $userList->id }}">
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
                                        <input type="hidden" name="id" value="{{ $userList->id }}">
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
                        <td class="">{{ $userList->description }}</td>
                        <td class="text-center">{{ $userList->amount }}</td>
                        <td class="text-end">R${{ number_format($userList->price, 2, ',', '.') }}</td>
                        <td class="text-end">R${{ number_format($userList->total_price, 2, ',', '.') }}</td>
                        <td>
                            <div class="d-flex gap-1 justify-content-end">

                                <div class="btn-lg-display d-flex gap-1 justify-content-end">
                                    <a href="{{ route('user-lists.user-list-vis', ['id' => $userList->id]) }}" class="btn btn-sm btn-outline-warning ms-2"><i class="fas fa-eye me-2"></i>Detail</a>
                                <a href="{{ route('user-lists.user-list-edit', ['id' => $userList->id]) }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fa-regular fa-pen-to-square me-2"></i>Edit</a>
                                 <a href="{{ route('user-lists.user-list-confirm-delete', ['id' => $userList->id])}}" class="btn btn-sm btn-outline-danger ms-2"><i class="fa-regular fa-trash-can me-2"></i>Delete</a>

                                </div>
                                 <div class="btn-group btn-sm-display" role="group" aria-label="action">
                                    <div class="btn-group" role="group">
                                      <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                      </button>
                                      <ul class="dropdown-menu " aria-labelledby="btnGroupDrop1">
                                        <li><a href="{{ route('user-lists.user-list-vis', ['id' => $userList->id]) }}" class="dropdown-item"><i class="fas fa-eye me-2"></i>Detail</a></li>
                                        <li><a href="{{ route('user-lists.user-list-edit', ['id' => $userList->id]) }}" class="dropdown-item"><i class="fa-regular fa-pen-to-square me-2"></i>Edit</a></li>
                                        <li><a href="{{ route('user-lists.user-list-confirm-delete', ['id' => $userList->id])}}" class="dropdown-item"><i class="fa-regular fa-trash-can me-2"></i>Delete</a></li>
                                      </ul>
                                    </div>
                                  </div>
                             </div>

                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
            <div class="table-responsive-sm w-100">
                <table class="table p-1 fs-5">
                    <thead class="table-dark">
                <tr>
                    <td class="text-end"></td>
                    <td class="text-end">Quant Product:</td>
                    <td class="text-end">{{ $data['quant_product'] }}</td>
                    <td class="text-end"> </td>
                    <td class="text-end"></td>
                    <td class="text-end">Price Total:</td>
                    <td class="text-end">{{ $data['total_gasto'] }}</td>
                </tr>
            </thead>
            </table>
        </div>
        </div>
@endif

    </div>
    </x-layout-app>
