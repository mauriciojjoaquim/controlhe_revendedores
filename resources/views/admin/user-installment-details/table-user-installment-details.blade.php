<x-layout-app page-title="User Installment Details" color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu-vert="{{ $conf['bg_color_menu_vertical'] }}" color-menu-vert-text="{{ $conf['color_menu_vertical_text'] }}" bg-color-menu-hor="{{ $conf['bg_color_menu_horisontal'] }}" color-menu-hor-text="{{ $conf['color_menu_horisontal_text'] }}"  text-color-site="{{ $conf['text_color_site'] }}" op-bg-color-site="{{ $conf['bg_color_site'] }}">
    <div class="w-100 p-4">

        <h3>All User Installment Details</h3>
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
        @if ($userinstallmentdetails->count() === 0)
        <div class="text-center my-5">
            <p>No user installment details found.</p>
            <a href="{{ route('admin.user-installment-details.add-user-installment-details') }}" class="btn btn-primary">Create a new User Installment Detail</a>
        </div>
    @else
    <div class="mb-3">
        <a href="{{ route('admin.user-installment-details.add-user-installment-details') }}" class="btn btn-primary">Create a new User Installment Detail</a>
    </div>

            <div class="table-responsive">
                <table class="table table-hover {{ $conf['bg_color_table'] }} {{ $conf['color_table_text'] }} w-100" id="table">
                    <thead class="{{ $conf['bg_color_table'] }}">
                        <th>Nome</th>
                        <th>status</th>
                        <th>mês/Ano</th>
                        <th>Data de Vencimento</th>
                        <th class="text-end">Preço</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($userinstallmentdetails as $userinstallmentdetail)
                        <tr>
                            <td>
                                @foreach ($users as $user)
                                @if ($userinstallmentdetail->user_id == $user->id)
                                    {{ $user->name }}
                                @endif
                                    
                                @endforeach
                                </td>
                            <td>
                                @if($userinstallmentdetail->customer_status == 'NC')
                                <div class="bg-warning text-center">
                                    <i class="fa-regular fa-money-bill-1 me-2"></i>
                                    Nada Consta
                                </div>
                                @elseif($userinstallmentdetail->customer_status == 'C-PG')
                                <div class="bg-danger text-center text-light">
                                    <i class="fa-regular fa-money-bill-1 me-2"></i>
                                    Aguardando confirmação
                                </div>
                                @elseif($userinstallmentdetail->customer_status == 'PG')
                                <div class="bg-success text-center">
                                    <i class="fa-regular fa-money-bill-1 me-2"></i>
                                    Pagamento Efetuado
                                </div>
                                @endif
                            </td>
                            <td>{{ $userinstallmentdetail->month }}/{{ $userinstallmentdetail->year }}</td>
                            <td>{{ date("d/m/Y", strtotime($userinstallmentdetail->due_date)) }}</td>
                            <td class="text-end">R$ {{ number_format($userinstallmentdetail->installment_price, 2, ',', '.') }}
                            <td>
                                 <div class="d-flex gap-1 justify-content-end">
                                   
                                    <div class="btn-lg-display d-flex gap-1 justify-content-end">
                                        @php

                                            $dataSomada1 = strtotime('+2 day');
                                            $month = date("m", strtotime($dataSomada1));
                                            $year = date("Y", strtotime($dataSomada1));
                                        @endphp
                                        @if ($userinstallmentdetail->month >= $month and $userinstallmentdetail->year == $year)
                                            @if($userinstallmentdetail->customer_status == 'NC' or $userinstallmentdetail->customer_status == 'C-PG')
                                                <a href="{{ route('admin.user-installment-details.payment-user-installment-details', ['id' => $userinstallmentdetail->id])  }}" class="btn btn-sm btn-outline-success ms-2"><i class="fa-regular fa-money-bill-1 me-2"></i>C-PG</a>
                                            @endif
                                        @endif
                                        
                                        <a href="{{ route('admin.user-installment-details.show-user-installment-details', ['id' => $userinstallmentdetail->id])  }}" class="btn btn-sm btn-outline-warning ms-2"><i class="fas fa-eye me-2"></i>Detail</a>
                                        <a href="{{ route('admin.user-installment-details.edit-user-installment-details', ['id' => $userinstallmentdetail->id]) }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fa-regular fa-pen-to-square me-2"></i>Edit</a>
                                        <a href="{{ route('admin.user-installment-details.conf-delete-user-installment-details', ['id' => $userinstallmentdetail->id]) }}" class="btn btn-sm btn-outline-danger ms-2"><i class="fa-regular fa-trash-can me-2"></i>Delete</a>
    
                                    </div>
                                     <div class="btn-group btn-sm-display" role="group" aria-label="action">
                                        <div class="btn-group" role="group">
                                          <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                          </button>
                                          <ul class="dropdown-menu " aria-labelledby="btnGroupDrop1">
                                            @if ($userinstallmentdetail->month == date("m", strtotime(now()) and $userinstallmentdetail->year == date("d/m/Y", strtotime(now())))
                                                @if($userinstallmentdetail->customer_status == 'NC' or $userinstallmentdetail->customer_status == 'C-PG')
                                                    <li><a href="{{ route('admin.user-installment-details.payment-user-installment-details', ['id' => $userinstallmentdetail->id]) }}" class="dropdown-item"><i class="fa-regular fa-money-bill-1 me-2"></i>C-PG</a></li>
                                                @endif
                                            @endif
                                            @if($userinstallmentdetail->customer_status == 'NC' or $userinstallmentdetail->customer_status == 'C-PG')
                                                <li><a href="{{ route('admin.user-installment-details.payment-user-installment-details', ['id' => $userinstallmentdetail->id]) }}" class="dropdown-item"><i class="fa-regular fa-money-bill-1 me-2"></i>C-PG</a></li>
                                            @endif
                                            <li><a href="{{ route('admin.user-installment-details.show-user-installment-details', ['id' => $userinstallmentdetail->id]) }}" class="dropdown-item"><i class="fas fa-eye me-2"></i>Detail</a></li>
                                            <li><a href="{{ route('admin.user-installment-details.edit-user-installment-details', ['id' => $userinstallmentdetail->id]) }}" class="dropdown-item"><i class="fa-regular fa-pen-to-square me-2"></i>Edit</a></li>
                                            <li><a href="{{ route('admin.user-installment-details.conf-delete-user-installment-details', ['id' => $userinstallmentdetail->id]) }}" class="dropdown-item"><i class="fa-regular fa-trash-can me-2"></i>Delete</a></li>
                                          </ul>
                                        </div>
                                      </div>
                                 </div>
                            </td>
                        </tr>
    
                        @endforeach
    
                    </tbody>
                </table>
            </div>
@endif

    </div>
    </x-layout-app>
