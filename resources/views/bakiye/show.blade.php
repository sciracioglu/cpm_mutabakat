@extends('layout.sablon')
@section('logo')
    <img src="/img/{{ $data->SIRKETNO }}.png" style="height:54px" class="d-inline-block align-top" alt="" />
    <span class="ml-3 text-xl tracking-tight font-sans text-4xl">{{ $firma->KISAAD }}</span>
@endsection
@section('baslik','Fatura Detayı')

@section('icerik')

<div class="" id='app'>
    <h3>{{ $data->FIRMAADI }}</h3>
    <hr>
    <table  class="text-left m-4 " style="border-collapse:collapse">
        <thead>
            <tr>
                <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">Evrak No</th>
                <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">Evrak Tarih</th>
                <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">İşlem</th>
                <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">BA</th>
                <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">Tutar</th>
                <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">Kullanılan</th>
                <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">Bakiye</th>
                <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">Döviz Tutar</th>
                <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">Döviz Cinsi</th>
                <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">Döviz Kullanılan</th>
                <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">Döviz Kalan</th>
                <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">Döviz Bakiye</th>
                <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">Vade Gün Fark</th>
            </tr>
        </thead>
        <tbody>
            @php
             $top_bakiye = 0;
             $top_doviz_bakiye = 0;
             $top_toplam = 0;   
            @endphp  
            @foreach($detay as $fatura)
            <tr  class="hover:bg-blue-lightest">
                <td class="py-2 px-3 border-b text-sm border-grey-light">{{ $fatura->EVRAKNO }}</td>
                <td class="py-2 px-3 border-b text-sm border-grey-light">{{ $fatura->EVRAKTARIH }}</td>
                <td class="py-2 px-3 border-b text-sm border-grey-light">{{ $fatura->ISLEMTIPI }}</td>
                <td class="py-2 px-3 border-b text-sm border-grey-light">{{ $fatura->BA }}</td>
                <td class="py-2 px-3 border-b text-sm border-grey-light text-right">{{  number_format($fatura->TUTAR,2,',','.') }}</td>
                <td class="py-2 px-3 border-b text-sm border-grey-light text-right">{{ number_format($fatura->KULLANILAN,2,',','.') }}</td>
                <td class="py-2 px-3 border-b text-sm border-grey-light text-right">{{  number_format($fatura->BAKIYE,2,',','.') }}</td>
                <td class="py-2 px-3 border-b text-sm border-grey-light text-right">{{  number_format($fatura->DOVIZTUTAR,2,',','.') }}</td>
                <td class="py-2 px-3 border-b text-sm border-grey-light text-right">{{  $fatura->DOVIZCINS }}</td>
                <td class="py-2 px-3 border-b text-sm border-grey-light text-right">{{  number_format($fatura->DOVIZKULLANILAN,2,',','.') }}</td>
                <td class="py-2 px-3 border-b text-sm border-grey-light text-right">{{  number_format($fatura->DOVIZKALAN,2,',','.') }}</td>
                <td class="py-2 px-3 border-b text-sm border-grey-light text-right">{{  number_format($fatura->DOVIZBAKIYE,2,',','.') }}</td>
                <td class="py-2 px-3 border-b text-sm border-grey-light text-right">{{  $fatura->VADEGUNFARKI }}</td>
            </tr>
            @php
             $top_bakiye += $fatura->BAKIYE;
             $top_doviz_bakiye += $fatura->DOVIZBAKIYE;
            @endphp            
            @endforeach
            <tr  class="hover:bg-red-lightest">
                <td colspan="2" class="py-2 px-3 border-b text-sm border-grey-light text-red-dark">Toplam</td>
                <td colspan="5"class="py-2 px-3 border-b text-sm border-grey-light text-right text-red-dark">{{ number_format($top_bakiye,2,',','.') }}</td>
                <td colspan="4" class="py-2 px-3 border-b text-sm border-grey-light text-right text-red-dark">{{ number_format($top_doviz_bakiye,2,',','.') }}</td>
                <td colspan="2" class="py-2 px-3 border-b text-sm border-grey-light text-right text-red-dark"></td>
            </tr>
        </tbody>
    </table>
    @if($data->ISLEM == 0)
    <div class="flex flex-justified">
        <div class="flex-1">
            <a href='/mesaj/{{ $data->GUID }}/Bakiye' class="bg-transparent hover:bg-red text-base text-red-dark font-semibold hover:text-white text-base py-2 px-4 border border-red hover:border-transparent rounded">Mesaj Gonder</a>
        </div>
        <div class="">
            <a href='/bakiye_onay/{{ $data->GUID }}' class="bg-blue hover:bg-blue-dark text-white text-base font-bold py-2 px-4 rounded">Onaylıyorum</a>
        </div>
    </div>
    @endif
</div>
@endsection

@section('script')
<script>
var vue = new Vue({
    el:'#v',
    data:{
        id:'{!! $data->GUID !!}',
        mesaj:null,
    },
   
})

</script>
@endsection