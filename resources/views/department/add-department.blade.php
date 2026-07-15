<x-layout-app page-title="New Department" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100 p-4">
        <h3>New department</h3>

        <hr>

        <form action="{{ route('departments.create-department') }}" method="post">
             @csrf

             <div class="d-flex justify-content-center">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="name" class="form-label">Department name</label>
                            <input type="text" class="form-control" id="name" name="name">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <a href="{{ route('departments') }}" class="btn btn-warning me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create department</button>
                        </div>
                    </div>
                 </div>
             </div>

        </form>

    </div>

</x-layout-app>
