<x-layout-app page-title="Supplier" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100  p-4">

        <h3>All Supplier</h3>
        @if ($suppliers->count() === 0)
        <div class="text-center my-5">
            <p>No access found.</p>
            <a href="{{ route('adm.suppliers.add-suppliers') }}" class="btn btn-primary">Create a new Supplier</a>
        </div>
    @else
    <div class="mb-3">
        <a href="{{ route('adm.suppliers.add-suppliers') }}" class="btn btn-primary">Create a new Supplier</a>
    </div>

            <table class="table table-hover {{  $conf->bg_color_table }} {{  $conf->color_table_text }} w-100" id="table">
                <thead class="{{  $conf->bg_color_table }}">
                    <th>Supplier</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->supplier }}</td>

                        <td>
                             <div class="d-flex gap-1 justify-content-end">

                                <div class="btn-lg-display d-flex gap-1 justify-content-end">
                                    <a href="{{ route('adm.suppliers.show-suppliers', ['id' => $supplier->id])  }}" class="btn btn-sm btn-outline-warning ms-2"><i class="fas fa-eye me-2"></i>Detail</a>
                                <a href="{{ route('adm.suppliers.edit-suppliers', ['id' => $supplier->id]) }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fa-regular fa-pen-to-square me-2"></i>Edit</a>
                                 <a href="{{ route('adm.suppliers.conf-delete-suppliers', ['id' => $supplier->id]) }}" class="btn btn-sm btn-outline-danger ms-2"><i class="fa-regular fa-trash-can me-2"></i>Delete</a>

                                </div>
                                 <div class="btn-group btn-sm-display" role="group" aria-label="action">
                                    <div class="btn-group" role="group">
                                      <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                      </button>
                                      <ul class="dropdown-menu " aria-labelledby="btnGroupDrop1">
                                        <li><a href="{{ route('adm.suppliers.show-suppliers', ['id' => $supplier->id]) }}" class="dropdown-item"><i class="fas fa-eye me-2"></i>Detail</a></li>
                                        <li><a href="{{ route('adm.suppliers.edit-suppliers', ['id' => $supplier->id]) }}" class="dropdown-item"><i class="fa-regular fa-pen-to-square me-2"></i>Edit</a></li>
                                        <li><a href="{{ route('adm.suppliers.conf-delete-suppliers', ['id' => $supplier->id]) }}" class="dropdown-item"><i class="fa-regular fa-trash-can me-2"></i>Delete</a></li>
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
