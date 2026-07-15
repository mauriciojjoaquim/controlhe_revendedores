<x-layout-pdf-app page-title="Relatório das Vendas">

   <div style="font-size: 12px; width:100%;">
    <div style="border: 1px solid black;">
        <table>
            <tbody>
                <tr>
                    <td style="width:10%;">
                        <div style="text-align: start; width:100%;">
                            <img src="{{ public_path('assets/images/logo.png') }}" alt="Logo" width="100px">
                        </div>

                    </td>
                    <td style="width:90%;">
                        <div style="text-align: justify-all; width:100%;">
                            <h2 style="margin-left: 200px;  text-align: center;">Relatório de Vendas</h2>
                        </div>
                    </td>

                </tr>
            </tbody>
        </table>
        
        
    </div>
    <table style="border-collapse:collapse; width:100%;">
        <thead style="background-color: #abd5bd;">
            <tr>
                <th style="border:1px solid #cccccc;">Code|Nome</th>
                <th style="border:1px solid #cccccc;">Ponto</th>
                <th style="border:1px solid #cccccc;">Quant.</th>
                <th style="border:1px solid #cccccc;">Mês/Ano</th>
                <th style="border:1px solid #cccccc;">Preço</th>
                <th style="border:1px solid #cccccc;">Data Pedido</th>
                <th style="border:1px solid #cccccc;">Data Compra</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mysalesproducts as $mysalesproduct)
                <tr>
                    <td style="border: 1px solid #cccccc; border-top: none;">
                        @foreach ($products as $product)
                            @if ($product->code == $mysalesproduct->code)
                            {{ $product->code }} - {{ $product->name }}
                            @endif
                        @endforeach
                        
                    </td>

                    <td style="border: 1px solid #cccccc; border-top: none; text-align: center;">
                        {{ $mysalesproduct->point }}
                    </td>
                    <td style="border: 1px solid #cccccc; border-top: none; text-align: center;">
                        {{ $mysalesproduct->quantity }}
                    </td>
                    <td style="border: 1px solid #cccccc; border-top: none; text-align: center;">
                        {{ $mysalesproduct->month }}/{{ $mysalesproduct->year }}
                    </td>
                    <td style="border: 1px solid #cccccc; border-top: none; text-align: center;">R$ 
                        {{ number_format($mysalesproduct->price, 2, ',', '.') }}
                    </td>
                    <td style="border: 1px solid #cccccc; border-top: none; text-align: center;">
                        @if ($mysalesproduct->order_date != null)
                        {{ date('d/m/Y', strtotime($mysalesproduct->order_date)) }}
                        @else
                            NC
                        @endif
                        
                    </td>
                    <td style="border: 1px solid #cccccc; border-top: none; text-align: center;">
                        @if ($mysalesproduct->purchase_date != null)
                            {{ date('d/m/Y', strtotime($mysalesproduct->purchase_date)) }}
                        @else
                            NC
                        @endif
                    </td>
                </tr>
                
                
            @empty
                <tr>
                    <td colspan="7">Nenhuma venda encontrada!</td>
                </tr>
            @endforelse

        </tbody>
    </table>
   </div>
   
</x-layout-pdf-app>
{{-- 


    preço_compra
    data_pedido
    data_compra


    

    purchase_price
    order_date
    purchase date


--}}