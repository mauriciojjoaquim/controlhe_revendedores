<x-layout-app page-title="Home" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">

    <div class="w-100 p-4">
     <h3>Home</h3>
      <hr>
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

     <div class="d-flex row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 g-2 g-lg-3">
         <div class="col">
             <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                 <h5 class="{{ $conf['text_color_site'] }}">Total de Vendedores Ativado</h5>
                 <span class="border-bottom w-100"></span>
                 <h1 class="text-center">{{ $data['total_vendedors'] }}</h1>
             </div>
         </div>
         <div class="col">
             <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                 <h5 class="{{ $conf['text_color_site'] }}">Total de Vendedores Desativado</h5>
                 <span class="border-bottom w-100"></span>
                 <h1 class="text-center">{{ $data['total_vendedors_deleted'] }}</h1>
             </div>
         </div>
         <div class="col">
             <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                 <h5 class="{{ $conf['text_color_site'] }}">Total de Lider Salarios</h5>
                 <span class="border-bottom w-100"></span>
                 <h1 class="text-center">R$ {{ $data['total_vendedors_salary'] }}</h1>
             </div>
         </div>
     </div>
     <hr>
     <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-3 mb-sm-2 mb-md-2">
        <div class="col"></div>

        <div class="col">
            <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                <h5 class="{{ $conf['text_color_site'] }}">Total Vendedor por Departamentos</h5>
                <span class="border-bottom w-100"></span>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-borderless table-primary align-middle">
                        <tbody class="table-group-divider">
                           @if ($data['total_vendedors_per_department']->count() == 0)
                           <p>No department</p>
                           @else
                               @foreach ($data['total_vendedors_per_department'] as $collection)
                                   <tr class="{{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }}">
                                       <td scope="row">{{ $collection['department'] }}</td>
                                       <td class="text-end">{{ $collection['total'] }}</td>
                                   </tr>
                               @endforeach
                           @endif
                        </tbody>
   
                    </table>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card {{ $conf['color_card_bg'] }} {{ $conf['color_card_text'] }} p-4 m-2">
                <h5 class="{{ $conf['text_color_site'] }}">Total Salario por Departamentos</h5>
                <span class="border-bottom w-100"></span>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-borderless table-primary align-middle">
                        <tbody class="table-group-divider">
                           @if ($data['total_salary_by_department']->count() == 0)
                               <p>No salary</p>
                           @else
                               @foreach ($data['total_salary_by_department'] as $collection)
                               <tr class="{{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }}">
                                   <td scope="row">{{ $collection['department'] }}</td>
                                   <td class="text-end"><strong>R$ {{ $collection['total'] }}</strong></td>
                               </tr>
                           @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- Amont --}}
         

         
     </div>


 </div>

 </x-layout-app>
