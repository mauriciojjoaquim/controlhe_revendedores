<x-layout-app page-title="Edit userinstallmentdetail" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Edit userinstallmentdetail</h3>
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
        <form action="{{ route('admin.user-installment-details.updated-user-installment-details') }}" method="post">

            @csrf
        
            <div class="container-fluid">
                <div class="row gap-3 d-flex justify-content-center">
        
                    {{-- userinstallmentdetails --}}
                    <div class="col-6 border {{ $conf['color-border'] }} p-4">
        
                        <div class="mb-3">
                            <label for="name" class="form-label">userinstallmentdetail</label>
                            <input type="text" class="form-control" id="userinstallmentdetail" name="userinstallmentdetail" value="{{ old('userinstallmentdetail', $userinstallmentdetail->userinstallmentdetail) }}">
                            @error('userinstallmentdetail')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

        
                    </div>
        

                </div>
                <input type="hidden" name="id" id="id" value="{{ $userinstallmentdetail->id }}">
                <div class="mt-3 d-flex justify-content-center">
                    <a href="{{ route('admin.user-installment-details.table-user-installment-details') }}" class="btn btn-outline-warning me-3">Cancel</a>
                    <button type="submit" class="btn btn-outline-primary">Update userinstallmentdetail</button>
                </div>
        
            </div>
        
        </form>
        

    </div>

</x-layout-app>

{{-- colaborators.colaborator.edit-colaborators-manager --}}