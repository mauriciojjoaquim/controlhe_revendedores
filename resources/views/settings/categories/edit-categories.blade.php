<x-layout-app page-title="Edit category" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Edit category</h3>

        <hr>
        {{-- disabled --}}
        <form action="{{ route('admin.settings.categories.updated-category') }}" method="post">

            @csrf

            <div class="container-fluid">
                <div class="row gap-3 d-flex justify-content-center">

                    {{-- Categorys --}}
                    <div class="col-6 border {{ $conf['color-border'] }} p-4">

                        <div class="mb-3">
                            <label for="name" class="form-label">category</label>
                            <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $category->category) }}">
                            @error('category')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                    </div>


                </div>
                <input type="hidden" name="id" id="id" value="{{ $category->id }}">
                <div class="mt-3 d-flex justify-content-center">
                    <a href="{{ route('admin.settings.categories.table-category') }}" class="btn btn-outline-warning me-3">Cancel</a>
                    <button type="submit" class="btn btn-outline-primary">Update category</button>
                </div>

            </div>

        </form>


    </div>

</x-layout-app>

{{-- colaborators.colaborator.edit-colaborators-manager --}}
