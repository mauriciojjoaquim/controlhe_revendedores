<x-layout-app page-title="New User Installment Details" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>New  User Installment Details</h3>
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
        <hr>
        {{-- disabled --}}
        <form action="{{ route('admin.user-installment-details.created-user-installment-details') }}" method="post">

            @csrf
        
            <div class="container-fluid">
                <div class="row gap-3 d-flex justify-content-center">
        
                    {{-- User Installment Detailss --}}
                    <div class="col-6 border {{ $conf['color-border'] }} p-4">
        
                        <div class="row">
                            <div class="col-12 pe-3">
                                <label for="user_id">Department</label>
                                <select class="form-select" id="user_id" name="user_id">
                                    @if (old('user_id') != '')
                                    <option>Selecione um departamento</option>
                                    @else
                                    <option selected>Selecione um departamento</option>
                                    @endif
                                    @foreach ($users as $user)
                                    @if ($user->id == old('user_id'))
                                    <option value="{{ $user->id }}" selected>{{ $user->name }} - {{ $user->role }}</option>
                                    @else
                                    <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->role }}</option>
                                    @endif
                                    
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
        

                </div>
                <div class="mt-3 d-flex justify-content-center">
                    <a href="{{ route('admin.user-installment-details.table-user-installment-details') }}" class="btn btn-outline-warning me-3">Cancel</a>
                    <button type="submit" class="btn btn-outline-primary">New User Installment Details</button>
                </div>
        
            </div>
        
        </form>
        

    </div>

</x-layout-app>

{{-- colaborators.colaborator.edit-colaborators-manager --}}