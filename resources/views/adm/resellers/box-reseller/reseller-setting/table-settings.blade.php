<x-layout-app page-title="Todas Configurações" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-2">

        <h3>Todas Configurações</h3>
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
        @if ($settings->count() === 0)
        <div class="text-center my-5">
            <p>Nenhuma configuração encontrada.</p>
            <a href="{{ route('adm.settings-resellers.add-vende-settings') }}" class="btn btn-primary">Create a new Settings</a>
        </div>
    @else
    <div class="mb-3">
        
<p>Personalize seu ste no stilo permitido pelas opçoes disponivel.</p>
        
        
    </div>

    <div class="table-responsive">
                <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100" id="table">
                    <thead class="{{ $conf['bg_color_table'] }}">
                        <th>Name</th>
                        <th>Pix</th>
                        <th>Cor do texto do site</th>
                        <th>Cor do pagina do site Vendedor</th>
                        <th>Cor do pagina do site cliente</th>
                        <th>Preço</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($settings as $setting_detail)
                       @if ($setting_detail->user_id == Auth::user()->id)
                       <tr>
    
                        <td>
                            @foreach ($users as $user)
                                @if ($user->id == $setting_detail->user_id)
                                {{ $user->name }}
                                @endif
                            @endforeach
                           </td>
                        <td>{{ $setting_detail->pix }}</td>
                        <td>{{ $setting_detail->text_color_site }}</td>
                        <td>
                            <div class="text-center {{ $setting_detail->color_site_bg }} {{ $setting_detail->text_color_site }}">
                                {{ $setting_detail->color_site_bg }}
                            </div>
                        </td>
                        <td>
                            <div class="text-center {{ $setting_detail->bg_color_site }} {{ $setting_detail->text_color }}">
                                {{ $setting_detail->bg_color_site }}
                            </div>
                        </td>
                        <td>R$ {{ number_format($setting_detail->price, 2, ',', '.') }}</td>
                        <td>
                             <div class="d-flex gap-1 justify-content-end">
                                <div class="btn-lg-display d-flex gap-1 justify-content-end">
                                    <a href="{{ route('adm.settings-resellers.show-vende-settings', ['id' => $setting_detail->id])  }}" class="btn btn-sm btn-outline-warning ms-2"><i class="fas fa-eye me-2"></i>Detalhe</a>
                                    <a href="{{ route('adm.settings-resellers.edit-vende-settings', ['id' => $setting_detail->id]) }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a>
                                    {{-- <a href="{{ route('adm.settings-resellers.conf-delete-vende-settings', ['id' => $setting_detail->id]) }}" class="btn btn-sm btn-outline-danger ms-2"><i class="fa-regular fa-trash-can me-2"></i>Excluir</a> --}}
    
                                </div>
                                 <div class="btn-group btn-sm-display" role="group" aria-label="action">
                                    <div class="btn-group" role="group">
                                      <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                      </button>
                                      <ul class="dropdown-menu " aria-labelledby="btnGroupDrop1">
                                        <li><a href="{{ route('adm.settings-resellers.show-vende-settings', ['id' => $setting_detail->id]) }}" class="dropdown-item"><i class="fas fa-eye me-2"></i>Detalhe</a></li>
                                        <li><a href="{{ route('adm.settings-resellers.edit-vende-settings', ['id' => $setting_detail->id]) }}" class="dropdown-item"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a></li>
                                        {{-- <li><a href="{{ route('adm.settings-resellers.conf-delete-vende-settings', ['id' => $setting_detail->id]) }}" class="dropdown-item"><i class="fa-regular fa-trash-can me-2"></i>Excluir</a></li> --}}
                                      </ul>
                                    </div>
                                  </div>
                             </div>
                        </td>
                    </tr>
                           
                       @endif
    
                        @endforeach
    
                    </tbody>
                </table>
            </div>
@endif

    </div>
    </x-layout-app>
