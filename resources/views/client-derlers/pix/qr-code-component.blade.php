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
    $valorTransacao = $client->clientorderdetail->total_price;

    // Identificador único da transação, caso exista
    $idTransacao = $client->clientorderdetail->id;

    // Obtem código copia e cola do PIX
    $codigoPix = geraPix($chave, $idTransacao, $valorTransacao);

    // Exibe o QRCode com o PIX
@endphp
       

</div>



{{-- http://rifas.test/order_client_buy/eyJpdiI6IldTNWhWT2tUSnI0Uk5lL2lJeUhHWlE9PSIsInZhbHVlIjoiZ2FXRExSU083R1lJQmR6MEdvbHlSUT09IiwibWFjIjoiMTRkMmZhNDJmNDRiOTU1NTVkMDYwMDIyZWRlZjUzMjJlNTI3N2M4MzMzMWM1MzZkYTU2MmMxNGU1MmYzMzg4YSIsInRhZyI6IiJ9/eyJpdiI6Inh5SkNQK2VxdTc0Q3ppWnVDbEJwR2c9PSIsInZhbHVlIjoiUi9lWVBWMGlYdFZtZ1NPdDRUYlBTdz09IiwibWFjIjoiNTc0YTg3OGJmZjk2MmZkZDBhYWIxMmYwZTI4ZDdkNjMzZTlhZDJmOWYwOTM2Y2ZlZjdhMDhiYWUxMjAxYjNlNSIsInRhZyI6IiJ9 --}}

<x-layout-app page-title="Home">
    <div class="w-100 p-4">
        <h3>Pagamento do Carrinho de Compra</h3>
         <hr>
         @if (session('staus'))
           <div class="alert alert-{{ (session('tipo_alert')) }} text-dark text-center mt-4 p-2">
               {{ session('mesagem') }}
           </div>
           <hr>
       @endif
       <hr>
       <div class="d-flex row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-5 g-2 g-lg-5">

            <div class="col-xl-2 col-md-2 col-md-12 col-sm-12">
                @if ($client->clientorderdetail->count() > 0)

                <div class="col-12">
                    <div class="qr-code-card">
                        <h5>Pague com qrcode</h5>
                        <div class="img-qr-card">
                            <?php echo '<p><img src="https://quickchart.io/qr?text='. urlencode($codigoPix) .'"></p>'; ?>
                        </div>
                        <div class="text-card-cop">
                            <div class=""><p><span>Chave_pix: </span>{{  $user->settingsdetail->pix }}</p></div>
                            
                    {{-- <input type="text" id="link" name="link" value="<?php echo $codigoPix; ?>" disabled> <button>Copiar Texto</button> --}}
                        </div>
                    </div>
                </div>
             
                @endif
            </div>

            <div class="col-xl-10 col-md-10 col-md-12 col-sm-12">
                <div class="justify-content-end w-100">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <th class="text-center">Revendedor</th>
                                <th class="text-center">Numero da Ordem</th>
                                <th class="text-end">Total Preço</th>
                            </thead>
                            <tbody>

                                    @if ($client->user_id == Auth::user()->id)
                                    <tr>
                                        <td class="text-center">{{ $user->name }}</td>
                                        <td class="text-center">{{ $user->installmentClientDetail->order_number_id }}</td>
                                        <td class="text-end">R$ {{ number_format($client->clientorderdetail->total_price, 2, ',', '.') }}</td>
                                    </tr>
                                    @endif
                                
            

            
                            </tbody>
               
                        </table>
                        <div class="w-100"><p><span> Link Chave pix: </span><?php echo $codigoPix; ?></p></div>
                        @can('clent')
                        <div class="w-100"><p><span> Apos pagamento envie o comprovante para este contato: </span>{{ $user->detail->phone }}</p></div>
                        @endcan
                        
                        <div class="bg-dark w-100 d-flex justify-content-end">
                            
                           
                            <div class="p-3 text-success h3 text-end"><span class="text-success h4 text-end">Preço Total: </span>R$ {{ number_format($client->clientorderdetail->total_price, 2, ',', '.') }}</div>
                            <div class="p-3">
                                @can('vende')
                                    <a href={{ route('admin.dealers.clients.client.confirma-cart-payment-detail', ['id' => $client->id]) }}" class="btn btn-success me-2">Confirma Pagamento</a>
                                @endcan
                                @can('client')
                                    <a href="{{ route('client-dealer.client-confirma-cart-payment-detail', ['id' => $client->id]) }}" class="btn btn-success me-2">Confirma Pagamento</a>
                                @endcan
                                
                            </div>
                                
                            </div>

                        </div>
                    </div> 
                </div>
            </div>

       </div>



    </div>

</x-layout-app>