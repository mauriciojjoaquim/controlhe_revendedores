@php



    function formataCampo($id, $valor) {
            return $id . str_pad(strlen($valor), 2, '0', STR_PAD_LEFT) . $valor;
    }

    function calculaCRC16($dados) {
        $resultado = 0xFFFF;
        for ($i = 0; $i < strlen($dados); $i++) {
            $resultado ^= (ord($dados[$i]) << 8);
            for ($j = 0; $j < 8; $j++) {
                if ($resultado & 0x8000) {
                    $resultado = ($resultado << 1) ^ 0x1021;
                } else {
                    $resultado <<= 1;
                }
                $resultado &= 0xFFFF;
            }
        }
        return strtoupper(str_pad(dechex($resultado), 4, '0', STR_PAD_LEFT));
    }

    function geraPix($chave, $idTx = '', $valor = 0.00) {
        $resultado = "000201";
        $resultado .= formataCampo("26", "0014br.gov.bcb.pix" . formataCampo("01", $chave));
        $resultado .= "52040000"; // Código fixo
        $resultado .= "5303986";  // Moeda (Real)

        if ($valor > 0) {
            $resultado .= formataCampo("54", number_format($valor, 2, '.', ''));
        }

        $resultado .= "5802BR"; // País
        $resultado .= "5901N";  // Nome
        $resultado .= "6001C";  // Cidade
        $resultado .= formataCampo("62", formataCampo("05", $idTx ?: '***'));
        $resultado .= "6304"; // Início do CRC16
        $resultado .= calculaCRC16($resultado); // Adiciona o CRC16 ao final
        return $resultado;
    }

    // Exemplos de chave PIX
    //
    // E-mail: nome@exemplo.com.br
    // CPF: 12345678901 (só números)
    // CNPJ: 12345678000123 (só números)
    // Celular: +5511912345678 (+55 + DDD + número)
    //
    //$chave = "nome@exemplo.com.br";

    // Valor da transação
    //$valorTransacao = 1.23;

    // Identificador único da transação, caso exista
    //$idTransacao = "";

    // Obtem código copia e cola do PIX
    //$codigoPix = geraPix($chave, $idTransacao, $valorTransacao);

    // Exibe o QRCode com o PIX
    //echo '<p><img src="https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=' . urlencode($codigoPix) . '"></p>';

    // Exibe o Código PIX (copia e cola)
    //echo "<p>Código PIX: " . $codigoPix . "<p>";





// Exibe o Código PIX (copia e cola)


@endphp
<div class="row">


@php
    // chave pix
    $chave = $user->settingsdetail->pix;

    // Valor da transação
    $valorTransacao = $user->installmentClientDetail->installment_price;

    // Identificador único da transação, caso exista
    $idTransacao = $user->installmentClientDetail->client_id;

    // Obtem código copia e cola do PIX
    $codigoPix = geraPix($chave, $idTransacao, $valorTransacao);

    // Exibe o QRCode com o PIX


    

@endphp

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
                            <h2 style="margin-left: 200px;  text-align: center;">Fatura de Pagamento</h2>
                            <p style="">
                                Dados do recebedor: <span>{{ $user->name }}</span> 
                                Endereço: {{ $user->detail->address }}</span>, 
                                {{ $user->detail->number }}</span> - 
                                {{ $user->detail->zip_code }}</span> - 
                                {{ $user->detail->phone }}</span>
                            </p>
                            <p style="">
                                Dados do Comprador: <span>{{ $client->name }}</span> 
                                Endereço: {{ $client->clientdetail->address }}</span>, 
                                {{ $client->clientdetail->number }}</span> - 
                                {{ $client->clientdetail->zip_code }}</span> - 
                                {{ $client->clientdetail->phone }}</span>
                            </p>
                        </div>
                    </td>

                </tr>
            </tbody>
        </table>
        
        
    </div>
    <div style="border: 1px solid black;">
        <table style="border-collapse:collapse; width:100%;">
            <thead style="background-color: #abd5bd;">
                <tr>
                    <th style="border:1px solid #cccccc;">Code|Nome</th>

                    <th style="border:1px solid #cccccc; text-align: end;">Preço</th>
                    <th style="border:1px solid #cccccc; text-align: center;">Quant.</th>
                    <th style="border:1px solid #cccccc; text-align: end; padding-right: 20px;">Preço Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cartproducts as $cartproduct)
                    <tr>
                        <td style="border: 1px solid #cccccc; border-top: none;">
                            @foreach ($products as $product)
                                @if ($product->code == $cartproduct->code)
                                {{ $product->code }} - {{ $product->name }}
                                @endif
                            @endforeach
                            
                        </td>

                        <td style="border: 1px solid #cccccc; border-top: none; text-align: end;">R$ 
                            {{ number_format($cartproduct->price, 2, ',', '.') }}
                        </td>

                        <td style="border: 1px solid #cccccc; border-top: none; text-align: center;">
                            {{ $cartproduct->amount }}
                        </td>

                        <td style="border: 1px solid #cccccc; border-top: none; text-align: end; padding-right: 20px;">R$ 
                            {{ number_format($cartproduct->total_price, 2, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Nenhuma venda encontrada!</td>
                    </tr>
                @endforelse
    
            </tbody>
        </table>
        <div style="border: 1px solid black; border-top: none;">
            <table style="border-collapse:collapse; width:100%;">
                <tbody style="background-color: #abd5bd;">
                    <tr>
                        <td style="font-size: 14px;  text-align: end;">
                            {{-- <p>Código PIX -> <span><?php echo $codigoPix; ?></span></p> --}}
                        </td>
                        <td style="font-size: 14px;  text-align: end;">
                            <div style="padding-left: 20px; padding-right: 20px;">
                                {{-- <img src="data:image/png;base64,{{ $codigoPix }}" alt="QR Code" />
                                <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code">
                                <img src="data:image/png;base64,{{ base64_encode($codigoPix) }}" alt="QR Code">
                                <p> --}}
                                    <span style="border: 1px solid black;"><?php echo '<p><img src="https://quickchart.io/qr?text='. urlencode($codigoPix) .'"></p>'; ?></span>
                                </p>
                            </div>
                        </td>

                        
                    </tr>
                    <tr>
                        <td></td>
                        <td style="font-size: 14px;  text-align: end; padding-right: 20px;">
                            <p style="font-size: 20px;  text-align: end; font-weight: bold; padding-top: 10px;">
                                Quant.Total <span> {{ $user->installmentClientDetail->quantity_product }}</span> und - 
                                Preço Total <span>R$ {{ number_format($user->installmentClientDetail->installment_price, 2, ',', '.') }}</span>
                            </p>
                           
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>
    
   </div>
   
</x-layout-pdf-app>
{{-- 


    preço_compra
    data_pedido
    data_compra

                        <td style="border: 1px solid #cccccc; border-top: none; text-align: center;">
                            @if ($cartproduct->order_date != null)
                            {{ date('d/m/Y', strtotime($cartproduct->order_date)) }}
                            @else
                                NC
                            @endif
                            
                        </td>
                        <td style="border: 1px solid #cccccc; border-top: none; text-align: center;">
                            @if ($cartproduct->purchase_date != null)
                                {{ date('d/m/Y', strtotime($cartproduct->purchase_date)) }}
                            @else
                                NC
                            @endif
                        </td>

        <div class="col-12">
            <div class="qr-code-card">
            <h5>Pague com qrcode</h5>
            <div class="img-qr-card">
                <?php echo '<p><img src="https://quickchart.io/qr?text='. urlencode($codigoPix) .'"></p>'; ?>
            </div>
            <div class="text-card-cop">
                <div class=""><p><span>Chave_pix: </span>{{  $user->settingsdetail->pix }}</p></div>
                    <input type="text" id="link" name="link" value="<?php echo $codigoPix; ?>" disabled> <button>Copiar Texto</button>
                </div>
            </div>
        </div>
    

    purchase_price
    order_date
    purchase date


--}}