@extends('layout.sablon')

@section('baslik','Fatura Detayı')

@section('icerik')

<div class="content" id='app'>
    <h3>{{ $data->FIRMAADI }}</h3>
    <hr>
    <table  class="text-left m-4" style="border-collapse:collapse">
        <thead>
            <tr>
                <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">Fatura No</th>
                <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">Fatura Tarih</th>
                <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">KDV Matrahi</th>
                <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">KDV Tutar</th>
                <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">Genel Toplam</th>
            </tr>
        </thead>
        <tbody>
            @php
             $top_kdv = 0;
             $top_tutar = 0;
             $top_toplam = 0;   
            @endphp  
            @foreach($detay as $fatura)
            <tr  class="hover:bg-blue-lightest">
                <td class="py-4 px-6 border-b border-grey-light">{{ $fatura->EVRAKNO }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ $fatura->EVRAKTARIH }}</td>
                <td class="py-4 px-6 border-b border-grey-light text-right">{{ number_format($fatura->KDV,2,',','.') }}</td>
                <td class="py-4 px-6 border-b border-grey-light text-right">{{  number_format($fatura->TUTAR,2,',','.') }}</td>
                <td class="py-4 px-6 border-b border-grey-light text-right">{{  number_format($fatura->TOPLAMTUTAR,2,',','.') }}</td>
            </tr>
            @php
             $top_kdv += $fatura->KDV;
             $top_tutar += $fatura->TUTAR;
             $top_toplam += $fatura->TOPLAMTUTAR;   
            @endphp            
            @endforeach
            <tr  class="hover:bg-red-lightest">
                <td colspan="2" class="py-4 px-6 border-b border-grey-light text-red-dark">{{ $detay->count() }} Adet Fatura </td>
                <td class="py-4 px-6 border-b border-grey-light text-right text-red-dark">{{ number_format($top_kdv,2,',','.') }}</td>
                <td class="py-4 px-6 border-b border-grey-light text-right text-red-dark">{{ number_format($top_tutar,2,',','.') }}</td>
                <td class="py-4 px-6 border-b border-grey-light text-right text-red-dark">{{ number_format($top_toplam,2,',','.') }}</td>
            </tr>
        </tbody>
    </table>
    @if($data->ISLEM == 0)
    <div class="flex flex-justified">
        <div class="flex-1">
            <button class="bg-transparent hover:bg-red text-red-dark font-semibold hover:text-white py-2 px-4 border border-red hover:border-transparent rounded">Bilgi</button>
        </div>
        <div class="">
            <a href='onay/{{ $data->GUID }}' class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded">Onalıyorum</a>
        </div>
    </div>
    @endif
</div>
@endsection

@section('script')

@endsection