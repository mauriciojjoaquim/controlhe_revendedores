<x-layout-app page-title="Client details" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 {{ $conf['bg_color_site'] }} p-4">

        <h3>Client details</h3>

        <hr>

        <div class="container-fluid">
            <div class="row mb-3 d-flex justify-content-center">

                <div class="col-12">
                    
                    <div class="row">
                        <div class="col">
                            <H5>User - {{ $client->user->name }}</H5>
                            <p>name: <strong>{{ $client->name }}</strong></p>
                            <p>Email: <strong>{{ $client->email }}</strong></p>
                            <p>RG: <strong>{{ $client->rg }}</strong></p>
                            <p>CPF: <strong>{{ $client->cpf }}</strong></p>
                        </div>
                        <div class="col">
                            <H5>Client Detail</H5>
                            <p>Zip Code: <strong>{{ $client->clientdetail->zip_code }}</strong></p>
                            <p>Address: <strong>{{ $client->clientdetail->address }}</strong></p> 
                            <p>Number: <strong>{{ $client->clientdetail->number }}</strong></p> 
                            <p>Complement: <strong>{{ $client->clientdetail->complement }}</strong></p> 
                            <p>Neighborhood: <strong>{{ $client->clientdetail->neighborhood }}</strong></p> 
                            <p>City: <strong>{{ $client->clientdetail->city }}</strong></p> 
                            <p>Phone: <strong>{{ $client->clientdetail->phone }}</strong></p>
                            <p>Register Date: <strong>{{ $client->clientdetail->register_date }}</strong></p>

                        </div>
                        <div class="col-12">
                            <button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Back</button>
                        </div>
                        <div class="col-12 border {{ $conf['color-border'] }} p-4">
                            @if ($clientordendetails->count() === 0)
                            <div class="text-center">
                                <p>No Client Orden Details found.</p>
                            </div>
                            
                            @else
                            <div class="d-flex justify-content-center">
                                <div class="text-center bg-dark">
                                    <H5 class="">Client Order Detail</H5>
                                </div>
                                


                            </div>
                                
                            @endif
                        </div>
                        
                    </div>
 
                </div>
                
                
            </div>
        </div>
{{-- 
       
    </div>

</x-layout-app>

