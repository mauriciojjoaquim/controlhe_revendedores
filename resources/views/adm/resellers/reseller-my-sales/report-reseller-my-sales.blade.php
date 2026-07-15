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
        <thead style="background-color: #abd5bd; ">
            <tr>
                <th style="border:1px solid #cccccc;">Nome</th>
                <th style="border:1px solid #cccccc;">Nº do pedido</th>
                <th style="border:1px solid #cccccc;">Ponto</th>
                <th style="border:1px solid #cccccc;">Quantidade do produto</th>
                <th style="border:1px solid #cccccc;">Nº da parcela</th>
                <th style="border:1px solid #cccccc;">Preço da parcela</th>
                <th style="border:1px solid #cccccc;">Data de vencimento</th>
                <th style="border:1px solid #cccccc;">Data de pagamento</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mysales as $mysale)
                <tr>
                    <td style="border: 1px solid #cccccc; border-top: none;">
                        @foreach ($clients as $client)
                            @if ($client->id == $mysale->client_id)
                            {{ $client->name }}
                            @endif
                        @endforeach
                        
                    </td>
                    <td style="border: 1px solid #cccccc; border-top: none; text-align: center;">{{ $mysale->order_number_id }}</td>
                    <td style="border: 1px solid #cccccc; border-top: none; text-align: center;">{{ $mysale->point }}</td>
                    <td style="border: 1px solid #cccccc; border-top: none; text-align: center;">{{ $mysale->quantity_product }}</td>
                    <td style="border: 1px solid #cccccc; border-top: none; text-align: center;">{{ $mysale->installment_number }}</td>
                    <td style="border: 1px solid #cccccc; border-top: none; text-align: center;">R$ {{ number_format($mysale->installment_price, 2, ',', '.') }}</td>
                    <td style="border: 1px solid #cccccc; border-top: none; text-align: center;">{{ date('d/m/Y', strtotime($mysale->due_date)) }}</td>
                    <td style="border: 1px solid #cccccc; border-top: none; text-align: center;">
                        @if ($mysale->payment_date != null)
                            {{ date('d/m/Y', strtotime($mysale->payment_date)) }}
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
Número do pedido
Quantidade do produto
Número da parcela
Preço da parcela
Data_de_vencimento
Data_de_pagamento

order_number_id
quantity_product
installment_number
installment_price
due_date
payment_date

--}}