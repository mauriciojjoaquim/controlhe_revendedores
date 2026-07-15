<x-layout-app page-title="Colaborators" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
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
        <h3>All colaborators</h3>
        @if ($colaborators->count() === 0)
        <div class="text-center my-5">
            <p>No Colaborators found.</p>
            <a href="{{ route('adm.all-colaborators.add-all-colaborators') }}" class="btn btn-primary">Create a new colaborator</a>
        </div>
    @else
    <div class="mb-3">
        <a href="{{ route('adm.all-colaborators.add-all-colaborators') }}" class="btn btn-primary">Create a new colaborator</a>
    </div>
    
    <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100" id="table">
        <thead class="{{ $conf['bg_color_table'] }}">
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Active</th>
                    <th>Department</th>
                    <th>Role</th>
                    <th>Admission date</th>
                    <th>salary</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($colaborators as $colaborator)
                    <tr>
                        <td>{{ $colaborator->name }}</td>
                        <td>{{ $colaborator->email }}</td>
                        <td>
                            @empty($colaborator->email_verified_at)
                            <span class="badge bg-danger">No</span>
                            @else
                            <span class="badge bg-success">Yes</span>
                            @endif
                        </td>
                        <td>{{ $colaborator->department->name }}</td>
                        <td>{{ $colaborator->role }}</td>
                        <td>{{ $colaborator->detail->admission_date }}</td>
                        <td>R$ {{ $colaborator->detail->salary }}</td>
                        <td>
                             <div class="d-flex gap-1 justify-content-end">

                                <div class="btn-lg-display d-flex gap-1 justify-content-end">
                                    @if (empty($colaborator->deleted_at))
                                        <a href="{{ route('adm.all-colaborators.detail-all-colaborators', ['id' => $colaborator->id])  }}" class="btn btn-sm btn-outline-warning ms-2"><i class="fas fa-eye me-2"></i>Detail</a>
                                        <a href="{{ route('adm.all-colaborators.edit-all-colaborators', ['id' => $colaborator->id]) }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fa-regular fa-pen-to-square me-2"></i>Edit</a>
                                        <a href="{{ route('adm.all-colaborators.conf-delete-all-colaborators', ['id' => $colaborator->id]) }}" class="btn btn-sm btn-outline-danger ms-2"><i class="fa-regular fa-trash-can me-2"></i>Delete</a>
                                    @else
                                        <a href="{{ route('colaborators.colaborator.retoreall-colaborators', ['id' => $colaborator->id])}}" class="btn btn-sm btn-outline-danger ms-3"><i class="fa-solid fa-trash-arrow-up me-2"></i>Restore</a>
                            
                                    @endif
                                </div>
                                 <div class="btn-group btn-sm-display" role="group" aria-label="action">
                                    <div class="btn-group" role="group">
                                      <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                      </button>
                                      <ul class="dropdown-menu " aria-labelledby="btnGroupDrop1">
                                        @if (empty($colaborator->deleted_at))
                                            <li><a href="{{ route('adm.all-colaborators.detail-all-colaborators', ['id' => $colaborator->id]) }}" class="dropdown-item"><i class="fas fa-eye me-2"></i>Detail</a></li>
                                            <li><a href="{{ route('adm.all-colaborators.edit-all-colaborators', ['id' => $colaborator->id]) }}" class="dropdown-item"><i class="fa-regular fa-pen-to-square me-2"></i>Edit</a></li>
                                            <li><a href="{{ route('adm.all-colaborators.conf-delete-all-colaborators', ['id' => $colaborator->id]) }}" class="dropdown-item"><i class="fa-regular fa-trash-can me-2"></i>Delete</a></li>
                                        @else
                                            <li><a href="{{ route('adm.all-colaborators.conf-delete-access', ['id' => $colaborator->id]) }}" class="dropdown-item"><i class="fa-solid fa-trash-arrow-up me-2"></i>Restore</a></li>
                                        @endif
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
    