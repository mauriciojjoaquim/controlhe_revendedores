<x-layout-app page-title="All magazine cycle" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>All magazine cycle</h3>
        @if ($magazineNumbers->count() === 0)
        <div class="text-center my-5">
            <p>No Categorys found.</p>
            <a href="{{ route('adm.magazine-numbers.add-magazine-numbers') }}" class="btn btn-primary">Create a new magazine cycle</a>
        </div>
    @else
    <div class="mb-3">
        
        <a href="{{ route('adm.magazine-numbers.add-magazine-numbers') }}" class="btn btn-primary">Create a new magazine cycle</a>
        <a href="{{ route('adm.magazine-numbers.show-table-magazine-numbers') }}" class="btn btn-warning">view magazine cycle</a>
    </div>

    <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100" id="table">
        <thead class="{{ $conf['bg_color_table'] }}">
                    <tr>
                        <th class="text-center">Ciclo</th>
                        <th class="text-center">Activated</th>
                        <th class="text-center">Supplier</th>
                        <th class="text-center">Start Date</th>
                        <th class="text-center">End Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($magazineNumbers as $magazineNumber)
                    <tr>
                        <td class="text-center">{{ $magazineNumber->number }}</td>
                        <td class="text-center">
                            @if ($magazineNumber->activated == 1)
                               <strong class="alert-success p-1 ps-4 pe-4"><i class="fa-regular fa-circle-check me-3"></i>Ativado</strong> 
                            @else
                            <a href="{{ route('adm.magazine-numbers.activated-magazine-numbers', ['id' => $magazineNumber->id]) }}" class="btn btn-sm btn-danger ms-2">
                                <i class="fa-regular fa-circle-xmark"></i>
                                <strong class="p-1">Desativado</strong>
                            </a>
                                 
                            @endif
                        </td>
                        <td class="text-center">{{ $magazineNumber->supplier->supplier }}</td>
                        <td class="text-center">{{ $magazineNumber->start_date }}</td>
                        <td class="text-center">{{ $magazineNumber->end_date }}</td>

                        <td>
                             <div class="d-flex gap-1 justify-content-end">

                                <div class="btn-lg-display d-flex gap-1 justify-content-end">
                                    <a href="{{ route('adm.magazine-numbers.show-magazine-numbers', ['id' => $magazineNumber->id])  }}" class="btn btn-sm btn-outline-warning ms-2"><i class="fas fa-eye me-2"></i>Detail</a>
                                <a href="{{ route('adm.magazine-numbers.edit-magazine-numbers', ['id' => $magazineNumber->id]) }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fa-regular fa-pen-to-square me-2"></i>Edit</a>
                                 <a href="{{ route('adm.magazine-numbers.conf-delete-magazine-numbers', ['id' => $magazineNumber->id]) }}" class="btn btn-sm btn-outline-danger ms-2"><i class="fa-regular fa-trash-can me-2"></i>Delete</a>

                                </div>
                                 <div class="btn-group btn-sm-display" role="group" aria-label="action">
                                    <div class="btn-group" role="group">
                                      <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                      </button>
                                      <ul class="dropdown-menu " aria-labelledby="btnGroupDrop1">
                                        <li><a href="{{ route('adm.magazine-numbers.show-magazine-numbers', ['id' => $magazineNumber->id]) }}" class="dropdown-item"><i class="fas fa-eye me-2"></i>Detail</a></li>
                                        <li><a href="{{ route('adm.magazine-numbers.edit-magazine-numbers', ['id' => $magazineNumber->id]) }}" class="dropdown-item"><i class="fa-regular fa-pen-to-square me-2"></i>Edit</a></li>
                                        <li><a href="{{ route('adm.magazine-numbers.conf-delete-magazine-numbers', ['id' => $magazineNumber->id]) }}" class="dropdown-item"><i class="fa-regular fa-trash-can me-2"></i>Delete</a></li>
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
