<x-layout-app page-title="Client details" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100 p-4">

        <h3>Client details</h3>

        <hr>

        <div class="container-fluid">
            <div class="row mb-3 d-flex justify-content-center">

                <div class="col-12">
                    
                    <div class="row mb-3 d-flex justify-content-center">
                        <div class="col-6">
                            <H5>Detail</H5>
                            <p>Zip Code: <strong>{{ $clientdetail->zip_code }}</strong></p>
                            <p>Address: <strong>{{ $clientdetail->address }}</strong></p> 
                            <p>Number: <strong>{{ $clientdetail->number }}</strong></p> 
                            <p>Complement: <strong>{{ $clientdetail->complement }}</strong></p> 
                            <p>Neighborhood: <strong>{{ $clientdetail->neighborhood }}</strong></p> 
                            <p>City: <strong>{{ $clientdetail->city }}</strong></p> 
                            <p>Phone: <strong>{{ $clientdetail->phone }}</strong></p>
                            <p>Register Date: <strong>{{ $clientdetail->register_date }}</strong></p>

                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Back</button>
                        </div>

                        
                    </div>
 
                </div>
                
                
            </div>
        </div>
{{-- 
       
    </div>

</x-layout-app>

