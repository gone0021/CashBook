@extends('layouts.cardapp')
@section('card')
<div class="card-header">
    {{ __(' Cash Book')}}
</div>

<div class="card-body">

    <div class="">
        <div>{{$items[0]->book_no}}</div>
        <div>{{$items[0]->date}}</div>
    </div>

    <table class="table" id="tb-item">
        {{-- 表示タイトル --}}
        <thead>
            <tr>
                <th colspan="2" class="text-center">
                    <span class="debit">{{ __('Debit') }}</span>
                </th>

                <th colspan="2" class="text-center">
                        <span class="credit">{{ __('Credit')}}</span>
                </th>
            </tr>
        </thead>

        {{-- 表示内容 --}}
        <tbody>
            @foreach ($items as $k => $item)
            <tr>
                {{-- 借方 --}}
                <td class="debit" class="align-middle" width="25%">
                    <p class="ml-2">
                        @if($item->debit_credit == 1)
                        {{ $item->category->category_name }}
                            @if ($item->kubun)
                            <br>{{ $item->kubun->kubun_name }}
                            @else <br>小区分なし
                            @endif
                        @endif
                    </p>
                </td>

                <td class="debit" class="align-middle" width="25%">
                    <p class="ml-2">
                        @if($item->debit_credit == 1)
                        {{ number_format($item->price) }} 円
                        @endif
                    </p>
                </td>

                {{-- 貸方 --}}
                <td class="credit" class="align-middle text-center" width="25%">
                    <p class="ml-2">
                        @if($item->debit_credit == 2)
                        {{ $item->category->category_name }}
                            @if ($item->kubun)
                            <br>{{ $item->kubun->kubun_name }}
                            @else <br>小区分なし
                            @endif
                        @endif
                    </p>
                </td>

                <td class="credit" class="align-middle" width="25%">
                    <p class="ml-2">
                        @if($item->debit_credit == 2)
                        {{ number_format($item->price) }} 円
                        @endif
                    </p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    <div>
        {{-- group_idでwhereをしているためappendsでクエリに表示する --}}
        {{-- {{ $items->appends(['group_id' => $gid])->links() }} --}}
    </div>

    <div class="col-md-10">
        <a href="{{ route('items/index') }}" class="btn btn-info mr-3">
            {{ __('Return') }}
        </a>
        <span class="btn btn-info btEdit mr-3">{{ __('Edit') }}</span>
        <span class="btn btn-info">{{ __('Delete') }}</span>
    </div>

</div>

@endsection
