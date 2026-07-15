<x-layout-app page-title="Customer Stock Details" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">
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
        <h3>All Customer Stock Details</h3>
        @if ($resellerstockdetails->count() === 0)
        <div class="text-center my-5">
            <p>No Clients found.</p>
            <a href="{{ route('adm.resellers.reseller-stock-detail.add-reseller-stock-details') }}" class="btn btn-primary">Create a new Customer Stock Details</a>
        </div>
    @else
    <div class="mb-3">
        <a href="{{ route('adm.resellers.reseller-stock-detail.add-reseller-stock-details') }}" class="btn btn-primary">Create a new Customer Stock Details</a>
    </div>

    <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100" id="table">
        <thead class="{{ $conf['bg_color_table'] }}">
                    <th>Photo</th>
                    <th>Data</th>
                    <th>Amount</th>
                    <th>Percentage</th>
                    <th>Resale Price</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($resellerstockdetails as $resellerstockdetail)
                    <tr>
                        <td>
                            {{-- Photo --}}
                            <div class="tb-img">
                                <a class="img-pro" href="{{ url('storage/imagens/products/'.$resellerstockdetail->product->supplier_id.'/'.$resellerstockdetail->product->photo_url) }}">
                                    <img class="img-tb" src="{{ url('storage/imagens/products/'.$resellerstockdetail->product->supplier_id.'/'.$resellerstockdetail->product->photo_url) }}" alt="{{ $resellerstockdetail->product->photo_url }}">
                                </a>
                            </div>
                        </td>
                        <td>
                            <p>Code: {{ $resellerstockdetail->product->code }} <br>
                              {{ $resellerstockdetail->product->name }}

                            </p>
                        </td>
                        <td>{{ $resellerstockdetail->amount }} und</td>
                        <td>{{ $resellerstockdetail->percentage }}%</td>
                        <td>R$ {{ number_format($resellerstockdetail->resale_price, 2, ',', '.') }}</td> 


                        <td>
                             <div class="d-flex gap-1 justify-content-end">

                                <div class="btn-lg-display d-flex gap-1 justify-content-end">
                                    <a href="{{ route('adm.resellers.reseller-stock-detail.show-reseller-stock-details', ['id' => $resellerstockdetail->id])  }}" class="btn btn-sm btn-outline-warning ms-2"><i class="fas fa-eye me-2"></i>Detail</a>
                                    <a href="{{ route('adm.resellers.reseller-stock-detail.edit-reseller-stock-details', ['id' => $resellerstockdetail->id]) }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fa-regular fa-pen-to-square me-2"></i>Edit</a>
                                    <a href="{{ route('adm.resellers.reseller-stock-detail.conf-delete-reseller-stock-details', ['id' => $resellerstockdetail->id]) }}" class="btn btn-sm btn-outline-danger ms-2"><i class="fa-regular fa-trash-can me-2"></i>Delete</a>

                                </div>
                                 <div class="btn-group btn-sm-display" role="group" aria-label="action">
                                    <div class="btn-group" role="group">
                                      <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                      </button>
                                      <ul class="dropdown-menu " aria-labelledby="btnGroupDrop1">
                                        <li><a href="{{ route('adm.resellers.reseller-stock-detail.show-reseller-stock-details', ['id' => $resellerstockdetail->id]) }}" class="dropdown-item"><i class="fas fa-eye me-2"></i>Detail</a></li>
                                        <li><a href="{{ route('adm.resellers.reseller-stock-detail.edit-reseller-stock-details', ['id' => $resellerstockdetail->id]) }}" class="dropdown-item"><i class="fa-regular fa-pen-to-square me-2"></i>Edit</a></li>
                                        <li><a href="{{ route('adm.resellers.reseller-stock-detail.conf-delete-reseller-stock-details', ['id' => $resellerstockdetail->id]) }}" class="dropdown-item"><i class="fa-regular fa-trash-can me-2"></i>Delete</a></li>
                                      </ul>
                                    </div>
                                  </div>
                             </div>
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
@endif

    </div>
    </x-layout-app>
