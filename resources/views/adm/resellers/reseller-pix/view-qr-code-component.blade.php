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



    // chave pix
    $chave = $conf->pix. '<br/>';
    $chaveT = $conf->pix. '<br/>';

    // Valor da transação
    $valorTransacao = $user->installmentClientDetail->installment_price;

    // Identificador único da transação, caso exista
    $idTransacao = $user->installmentClientDetail->client_id;

    // Obtem código copia e cola do PIX
    $codigoPix = geraPix($chave, $idTransacao, $valorTransacao);
    $codigoPixT = geraPix($chaveT, $idTransacao, $valorTransacao);

    // Exibe o QRCode com o PIX


    

@endphp

<x-layout-pdf-app page-title="Fatura da compra">
    

    <div class="container-fluid fs-4">
        <div class="d-flex">
            <div class="fs-2">
                <img src="{{ asset('assets/images/fatura-logo.png') }}" alt="Logo" width="250px">
            </div>
            <div class="w-100 h-100 pt-4 text-center">
                <img class="pt-4 m-3" src="{{ asset('assets/images/header-fatura.png') }}" alt="Logo" width="800px">
            </div>
        </div>

        {{-- dado da fatura --}}
        <div class="p-3">
            <table class="text-center w-100">
                <thead>
                    <tr>
                        <th class="text-start">Nº do pedido</th>
                        <th class="text-center">Número de parcela</th>
                        <th class="text-center">Data do Pedido</th>
                        <th class="text-cernter">Data do vencimento</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">{{ $user->installmentClientDetail->order_number_id }}</td>
                        <td class="text-center">{{ $user->installmentClientDetail->installment_number }}</td>
                        <td class="text-center">{{  date('d/m/Y', strtotime($user->installmentClientDetail->created_at)) }}</td>
                        <td class="text-center">{{  date('d/m/Y', strtotime($user->installmentClientDetail->due_date)) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Cliente --}}
        <div class="p-3">
            <table class="text-center w-100 pt-3">
                <thead>
                    <tr>
                        <th class="text-start">Conta para</th>
                        <th class="text-center">Logradouro</th>
                        <th class="text-center">Número</th>
                        <th class="text-center">Cep</th>
                        <th>Contato</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-start">{{ $client->name }}</td>
                        <td class="text-cernter"> {{ $client->clientdetail->address }}</td>
                        <td class="text-center">{{ $client->clientdetail->number }}</td>
                        <td class="text-center">{{ $client->clientdetail->zip_code }}</td>
                        <td class="text-center">{{ $client->clientdetail->phone }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Vendedora --}}
        <div class="p-3">
            <table class="text-center w-100">
                <thead>
                    <tr>
                        <th class="text-start">conta para</th>
                        <th class="text-center">Logradouro</th>
                        <th class="text-center">Número</th>
                        <th class="text-center">Cep</th>
                        <th class="text-cernter">Contato</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-start">{{ $user->name }}</td>
                        <td class="text-center">{{ $user->detail->address }}</td>
                        <td class="text-center">{{ $user->detail->number }}</td>
                        <td class="text-center">{{ $user->detail->zip_code }}</td>
                        <td class="text-center">{{ $user->detail->phone }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- detalhe da fatura & total da fatura --}}
        <div class="p-3">
            <table class="w-100 pt-3">
                <thead>
                    <tr>
                        <th>Code|Nome</th>
                        <th class="text-end">Preço</th>
                        <th class="text-center">Quant.</th>
                        <th class="text-end">Preço Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cartproducts as $cartproduct)
                    <tr>
                        <td>
                            @foreach ($products as $product)
                                @if ($product->code == $cartproduct->code)
                                {{ $product->code }} - {{ $product->name }}
                                @endif
                            @endforeach
                            
                        </td>

                        <td class="text-end">R$ 
                            {{ number_format($cartproduct->price, 2, ',', '.') }}
                        </td>

                        <td class="text-center">
                            {{ $cartproduct->amount }}
                        </td>

                        <td class="text-end">R$ 
                            {{ number_format($cartproduct->total_price, 2, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <td colspan="4">Nenhuma venda encontrada!</td>
                    @endforelse
                    <tr>
                        <td colspan="4" class="text-end fs-3 p-3">
                            <p>
                                Quant.Total <span> {{ $user->installmentClientDetail->quantity_product }}</span> und - 
                                Preço Total <span>R$ {{ number_format($user->installmentClientDetail->installment_price, 2, ',', '.') }}</span>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="p-3">
            <div class="d-flex justify-content-end pt-3 pb-3">
                <div class="w-100 h-100 text-start mt-4 pt-4">
                    <p>Link QrCode Pix: <br/><span><?php echo $codigoPixT; ?></span></p>
                    
                </div>
                <div class="p-3">
                    <p class="p-0 m-0 text-center"> QrCode Pix: <br/>
                        <span class="p-0 m-0">
                            <?php echo '<p><img src="https://quickchart.io/qr?text='. urlencode($codigoPix) .'" width="250px"></p>'; ?>
                        </span>
                        
                    </p>
                </div>
            </div>
        </div>
        <div class="p-4">
            <div class="text-center pb-4">
                <a href="" class="print" onclick="window.print() ;">Imprimir</a>
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
                
            </div>
            <div class="text-card-cop">
                <div class=""><p><span>Chave_pix: </span>{{  $conf->pix }}</p></div>
                    <input type="text" id="link" name="link" value="<?php echo $codigoPix; ?>" disabled> <button>Copiar Texto</button>
                </div>
            </div>
        </div>
    

    purchase_price
    order_date
    purchase date


--}}