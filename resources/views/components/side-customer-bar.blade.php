<div class="offcanvas offcanvas-start {{ $colorSiteBg }}" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">



    <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="flex-link-0 p-3 {{ $colorSiteBg }}" style="width: 380px;">
        <a href="{{ route('home') }}" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
            <span class="fs-5 fw-semibold"><i class="fas fa-home me-3"></i>Home</span>
        </a>


        <ul class="list-unstyled ps-0">
            @can('admin')
            {{-- Colaborators --}}
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                        <i class="fas fa-users me-2"></i>Colaborators
                    </button>
                    <div class="collapse" id="dashboard-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="{{ route('colaborators.colaborator.colaborators')}}" class="link-dark rounded"><i class="fas fa-users me-3"></i>Colaborator</a></li>
                            <li><a href="{{ route('colaborators.rh.colaborators') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>RH Colaborator</a></li>
                            <li><a href="{{ route('departments') }}" class="link-dark rounded"><i class="fas fa-industry me-3"></i>Departaments</a></li>
                            <li><a href="{{ route('adm.all-colaborators.table-all-colaborators') }}" class="link-dark rounded"><i class="fas fa-industry me-3"></i>All Colaborator</a></li>
                        </ul>

                    </div>
                </li>
                 {{-- payments resellers --}}
                 <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#payments-resellers-collapse" aria-expanded="false">
                        <i class="fa-solid fa-money-bill me-2"></i>Payments Resellers
                    </button>
                    <div class="collapse" id="payments-resellers-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="{{ route('admin.user-installment-details.table-user-installment-details') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>Payments Resellers</a></li>

                    </ul>
                    </div>
                </li>

                {{-- Customers --}}
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                        <i class="fas fa-users me-2"></i><Cap></Cap>Customers
                    </button>
                    <div class="collapse" id="account-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        {{-- <li><a href="{{ route('adm.customers.table-customers') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>Clients</a></li> --}}
                        <li><a href="{{ route('adm.customers.customer.table-customers') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>customers</a></li>
                        <li><a href="{{ route('adm.customers.customer-order-detail.table-customer-order-detail') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>customer Order Details</a></li>
                       
                    </ul>
                    </div>
                </li>

                 {{-- resellers --}}
                 <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#resellers-collapse" aria-expanded="false">
                        <i class="fas fa-users me-2"></i>Resellers
                    </button>
                    <div class="collapse" id="resellers-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="{{ route('adm.resellers.reseller-stock-detail.table-adm-reseller-stock-detail') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>Reseller Stock Details</a></li>
                    </ul>
                    </div>
                </li>

                {{-- settings --}}
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#settings-collapse" aria-expanded="false">
                        <i class="fas fa-gear me-2"></i>Settings
                    </button>
                    <div class="collapse" id="settings-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="{{ route('adm.plans.table-plans') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>Plans</a></li>
                        <li><a href="{{ route('adm.settings.table-settings') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>Settings</a></li>
                        <li><a href="{{ route('adm.cors.table-cors') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>cors</a></li>
                        <li><a href="{{ route('adm.cor-bootstraps.table-cor-bootstraps') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>cor Bootstraps</a></li>
                        <li><a href="{{ route('admin.settings.access.table-access') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>Accesses</a></li>
                        <li><a href="{{ route('adm.suppliers.table-suppliers') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>Suppliers</a></li>
                        <li><a href="{{ route('adm.categories.table-category') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>Categories</a></li>
                    </ul>
                    </div>
                </li>

                {{-- Products --}}
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#products-collapse" aria-expanded="false">
                        <i class="fa-solid fa-money-bill me-2"></i>Products
                    </button>
                    <div class="collapse" id="products-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="{{ route('adm.products.table-product') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>All Products</a></li>
                    </ul>
                    </div>
                </li>

            @endcan


            @can('vende')
                {{-- Clientes --}}
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#clientes-collapse" aria-expanded="false">
                        Clientes
                    </button>
                    <div class="collapse" id="clientes-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="{{ route('adm.resellers.table-resellers') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>Clientes</a></li>
                        </ul>
                    </div>
                </li>
                {{-- Estoques --}}
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#estoques-collapse" aria-expanded="false">
                        Departamentos
                    </button>
                    <div class="collapse" id="estoques-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="{{ route('adm.resellers.reseller-my-products.table-reseller-my-products') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>Meus Produtos</a></li>
                        <li><a href="{{ route('adm.resellers.reseller-stock-detail.table-reseller-stock-details') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>Meu estoque</a></li>
                        <li><a href="{{ route('adm.resellers.reseller-products.table-reseller-products') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>Revistas Produtos</a></li>
                        <li><a href="{{ route('adm.resellers.reseller-suppliers.table-reseller-suppliers') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>Sua Fornecedores</a></li>
                        <li><a href="{{ route('adm.resellers.reseller-categories.table-reseller-categories')}}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>Sua Categorias</a></li>
                    </ul>
                    </div>
                </li>

                {{-- Vendas --}}
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#vendas-collapse" aria-expanded="false">
                        Vendas
                    </button>
                    <div class="collapse" id="vendas-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="{{ route('adm.resellers.reseller-search.search-resellers') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>Fazer uma Venda</a></li>
                        <li><a href="{{ route('adm.resellers.reseller-my-sales.table-reseller-my-sales') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>Vendas</a></li>
                        <li><a href="{{ route('adm.resellers.reseller-my-sales-products.table-reseller-my-sales-products') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>Pedidos de Produtos</a></li>
                        <li><a href="{{ route('adm.resellers.reseller-my-sales-products.order-completed-reseller-my-sales-products') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>Pedido Finalizado</a></li>
                        <li><a href="#" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>Finaceiro</a></li>
                    </ul>
                    </div>
                </li>

                {{-- settings --}}
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#settings-collapse" aria-expanded="false">
                        Configurações
                    </button>
                    <div class="collapse" id="settings-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="{{ route('adm.settings-resellers.table-vende-settings') }}" class="link-dark rounded"><i class="fas fa-user-gear me-3"></i>Configuração</a></li>
                    </ul>
                    </div>
                </li>

            @endcan
            @can('client')
                {{-- Customers --}}
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#vendas-collapse" aria-expanded="false">
                        <i class="fa-solid fa-money-bill me-2"></i>Finaceiro
                    </button>
                    <div class="collapse" id="vendas-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="{{ route('customers.customer-financial.customer-my-closed-purchases') }}" class="link-dark rounded"><i class="fa-solid fa-money-bill me-2"></i>Minhas Compra Fechada</a></li>
                        <li><a href="{{ route('customers.customer-financial.customer-my-open-purchases') }}" class="link-dark rounded"><i class="fa-solid fa-money-bill me-2"></i>Minhas Compra Aberta</a></li>
                        <li><a href="{{ route('customers.customer-financial.customer-my-payments') }}" class="link-dark rounded"><i class="fa-solid fa-money-bill me-2"></i>Meu Pagamentos</a></li>
                        <li><a href="{{ route('adm.customers.customer-proof-payment.table-customer-proof-payment') }}" class="link-dark rounded"><i class="fa-solid fa-money-bill me-2"></i>Meu coprovantes</a></li>
                        <li><a href="{{ route('customers.customer-financial.customer-order-status') }}" class="link-dark rounded"><i class="fa-solid fa-money-bill me-2"></i>Estatus do pedido</a></li>
                        <li><a href="{{ route('adm.magazine-numbers.show-custome-magazine-numbers') }}" class="link-dark rounded"><i class="fa-solid fa-money-bill me-2"></i>Ciclo da Revista</a></li>
                        
                    </ul>
                    </div>
                </li>
            @endcan

        </ul>


    </div>

    <div class="offcanvas-body">
        <div class="d-flex flex-column sidebar">

            <hr>
            <a href="{{ route('customers.customer-profile') }}" class=""><i class="fas fa-cog me-3"></i>User Profile</a>
            <hr>


            {{-- LOGOUT --}}

            <div class="text-center mt-3">
                <form action="{{ route('logout')}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-sign-out-alt me-3"></i>Logout</button>
                </form>
            </div>
        </div>
    </div>
  </div>


