<x-layout-app page-title="Colaborator details"  color-site-bg="{{ $conf['color_site_bg'] }}" bg-color-table="{{ $conf['bg_color_table'] }}" color-table-text="{{ $conf['color_table_text'] }}" color-card-bg="{{ $conf['color_card_bg'] }}" color-card-text="{{ $conf['color_card_text'] }}" bg-color-menu="{{ $conf['bg_color_menu'] }}" text-color-site="{{ $conf['text_color_site'] }}">

    <div class="w-100 p-2">

        <h3>Colaborator details</h3>

        <hr>

        <div class="container-fluid">
            <div class="row mb-3">

                <div class="col">

                    <p>Nome: <strong>{{ $colaborator->name }}</strong></p>
                    <p>Email: <strong>{{ $colaborator->email }}</strong></p>
                    <p>Função: <strong>{{ $colaborator->role }}</strong></p>
                    <p>Permição: </p>

                    <!-- permissions -->
                    @php
                        $permissions = explode(',', $colaborator->permissions);
                    @endphp
                    <ul>

                        @foreach ($permissions as $permission)
                            <li>{{ $permission }}</li>
                        @endforeach
                    </ul>

                    <p>Departamento: <strong>{{ $colaborator->department->name }}</strong></p>
                    <p>Ativado: 
                        @empty($colaborator->email_verified_at)
                        <span class="badge bg-danger">No</span>
                        @else
                        <span class="badge bg-success">Yes</span>
                        @endif
                            
                            
                    </p>
                </div>

                <div class="col">
                    <p>Cep: <strong>{{ $colaborator->detail->zip_code }}</strong></p>
                    <p>Endereço: <strong>{{ $colaborator->detail->address }}</strong></p>
                    <p>Numero: <strong>{{ $colaborator->detail->number }}</strong></p>
                    <p>Complemento: <strong>{{ $colaborator->detail->complement }}</strong></p>
                    <p>Bairro: <strong>{{ $colaborator->detail->neighborhood }}</strong></p>
                    <p>Cidede: <strong>{{ $colaborator->detail->city }}</strong></p>
                    <p>Contato: <strong>{{ $colaborator->detail->phone }}</strong></p>
                    <p>Data Cadastro: <strong>{{ $colaborator->detail->admission_date }}</strong></p>
                    <p>Bonus: <strong>R$ {{ $colaborator->detail->salary }}</strong></p>
                </div>
            </div>
        </div>

        <button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fas fa-arrow-left me-2"></i>Voltar</button>

    </div>

</x-layout-app>