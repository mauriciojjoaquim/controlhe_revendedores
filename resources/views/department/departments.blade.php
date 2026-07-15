<x-layout-app page-title="Departments" bg-color-menu="{{ $conf['bg_color_menu'] }}" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
<div class="w-100 p-4">

    <h3>Departments</h3>


    @if ($departments->count() === 0)
        <div class="text-center my-5">
            <p>No departments found.</p>
            <a href="{{ route('departments.new-department') }}" class="btn btn-primary">Create a new department</a>
        </div>
    @else
        <div class="mb-3">
            <a href="{{ route('departments.new-department') }}" class="btn btn-primary">Create a new department</a>
        </div>
        @if (session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
        @endif
        <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100" id="table">
            <thead class="{{ $conf['bg_color_table'] }}">
                <th>Departments</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($departments as $department)
                <tr>
                    <td>{{ $department->name }}</td>
                    <td>
                        @if ($department->id > 2)
                        <div class="d-flex gap-3 justify-content-end">
                            <a href="{{ route('departments.edit-department', ['id' => $department->id]) }}" class="btn btn-sm btn-outline-warning ms-3"><i class="fa-regular fa-pen-to-square me-2"></i>Edit</a>
                            <a href="{{ route('departments.del-department', ['id' => $department->id])}}" class="btn btn-sm btn-outline-danger ms-3"><i class="fa-regular fa-trash-can me-2"></i>Delete</a>
                        </div>
                        @else
                        <div class="d-flex gap-3 justify-content-end">
                            <p><i class="fa-solid fa-lock me-2"></i>Edit</p>
                            <p><i class="fa-solid fa-lock me-2"></i>Delete</p>
                        </div>
                        @endif

                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>
    @endif

</div>
</x-layout-app>
