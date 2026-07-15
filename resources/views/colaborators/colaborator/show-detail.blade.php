<x-layout-app page-title="Colaborator details" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">

        <h3>Colaborator details</h3>

        <hr>

        <div class="container-fluid">
            <div class="row mb-3">

                <div class="col">

                    <p>Name: <strong>{{ $colaborator->name }}</strong></p>
                    <p>Email: <strong>{{ $colaborator->email }}</strong></p>
                    <p>Role: <strong>{{ $colaborator->role }}</strong></p>
                    <p>Permissions: </p>

                    <!-- permissions -->
                    @php
                        $permissions = json_decode($colaborator->permissions);
                    @endphp
                    <ul>
                        @foreach ($permissions as $permission)
                            <li>{{ $permission }}</li>
                        @endforeach
                    </ul>

                    <p>Department: <strong>{{ $colaborator->department->name }}</strong></p>
                    <p>Active: 
                        @empty($colaborator->email_verified_at)
                        <span class="badge bg-danger">No</span>
                        @else
                        <span class="badge bg-success">Yes</span>
                        @endif
                            
                            
                    </p>
                </div>

                <div class="col">
                    <p>Address: <strong>{{ $colaborator->detail->address }}</strong></p>
                    <p>Zip code: <strong>{{ $colaborator->detail->zip_code }}</strong></p>
                    <p>City: <strong>{{ $colaborator->detail->city }}</strong></p>
                    <p>Phone: <strong>{{ $colaborator->detail->phone }}</strong></p>
                    <p>Admission date: <strong>{{ $colaborator->detail->admission_date }}</strong></p>
                    <p>Salary: <strong>R$ {{ $colaborator->detail->salary }}</strong></p>
                </div>
            </div>
        </div>
{{-- 
        <button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Back</button> --}}

    </div>

</x-layout-app>