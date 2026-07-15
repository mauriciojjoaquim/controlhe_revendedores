<x-layout-app page-title="Colaboradores" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100 p-4">
    
        <h3>Recursos Humanos Colaboradores</h3>
    
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
        @if ($colaborators->count() === 0)
            <div class="text-center my-5">
                <p>No nolaborators found.</p>
                <a href="{{ route('colaborators.rh.new-rh-user') }}" class="btn btn-primary">Criar novo colaborador</a>
            </div>
        @else
            <div class="mb-3">
                <a href="{{ route('colaborators.rh.new-rh-user') }}" class="btn btn-primary">Criar novo colaborador</a>
            </div>
    
            <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100" id="table">
                <thead class="{{ $conf['bg_color_table'] }}">
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Ativo</th>
                    <th>Departamento</th>
                    <th>Cargo</th>
                    <th>Data de cadastro</th>
                    <th>Salário</th>
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
                            <div class="d-flex gap-3 justify-content-end">
                                
                                 @if (empty($colaborator->deleted_at))
                                 <a href="{{ route('colaborators.rh.edit-rh-user', ['id' => $colaborator->id]) }}" class="btn btn-sm btn-outline-dark ms-3"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a>
                                 <a href="{{ route('colaborators.rh.del-rh-user', ['id' => $colaborator->id])}}" class="btn btn-sm btn-outline-danger ms-3"><i class="fa-regular fa-trash-can me-2"></i>Excluir</a>
                                @else
                                <a href="{{ route('colaborators.rh.retore-rh-user', ['id' => $colaborator->id])}}" class="btn btn-sm btn-outline-danger ms-3"><i class="fa-solid fa-trash-arrow-up me-2"></i>Restalrar</a>
                            
                                 @endif   
                                
                                </div>
                        </td>
                    </tr>
    
                    @endforeach
    
                </tbody>
            </table> 
        @endif
    
    </div>
    </x-layout-app>
    