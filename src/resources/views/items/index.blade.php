@extends('layouts.cardapp')
@section('card')
<div class="card-header">
    {{ __(' Cash Book')}}
</div>

<div class="card-body">
    {{-- 年月の選択 --}}
    <form action="" method="get" class="yearMonth mb-3 mr-4">
        <select name="year" id="year" class="form-control">
            @for ($i=2000; $i<=$thisYear; $i++)
                @if ($getYear == $i)
                    <option value=" {{ $getYear }}" selected> {{ $getYear }}</option>
                @else
                    <option value=" {{ $i }}"> {{ $i }}</option>
                @endif
            @endfor
        </select>
        <span>年</span>

        <select name="month" id="month" class="form-control">
            @for ($i=1; $i<=12; $i++)
                @if ($getMonth == $i)
                <option value=" {{ $getMonth }}" selected> {{ $getMonth }}</option>
                @else
                <option value=" {{ $i }}"> {{ $i }}</option>
                @endif
            @endfor
        </select>
        <span>月</span>
        <input type="submit" name="" id="" value="表示" class="btn btn-light">
    </form>

    {{-- 支出計 --}}
    <span class="totalPrice font-weight-bold">支出合計：{{ number_format($cashTotal) }}</span>

    <table class="table" id="tb-item">
        {{-- 表示タイトル --}}
        <thead>
            <tr>
                <th>
                    <span class="mr-2">{{ __('No.') }}</span>
                </th>

                <th>
                    <span class="mr-2">{{ __('Date')}}</span>
                    <a href="" class="sort_date_a">↑</a>
                    <a href="" class="sort_date_d">↓</a>
                </th>

                <th>
                    <span>{{ __('Debit') }}</span>
                    <a href="" class="sort_title_a">↑</a>
                    <a href="" class="sort_title_d">↓</a>
                </th>

                <th>
                    <span class="mr-2">{{ __('Credit')}}</span>
                    <a href="" class="sort_date_a">↑</a>
                    <a href="" class="sort_date_d">↓</a>
                </th>

                <th>
                    <span class="mr-2">{{ __('Price')}}</span>
                    <a href="" class="sort_date_a">↑</a>
                    <a href="" class="sort_date_d">↓</a>
                </th>

                <th>
                    <span>
                        {{ __('Edit')}}
                    </span>
                </th>
            </tr>
        </thead>

        {{-- 表示内容 --}}
        <tbody>
            @foreach ($items as $item)
            <tr>
                <td id="bookNo" class="align-middle">
                    {{ $item->book_no }}
                </td>

                {{-- 日付 --}}
                <td id="date" class="align-middle">
                    {{ date('m月d日', strtotime($item->date)) }}
                </td>

                {{-- 借方 --}}
                <td id="debit" class="align-middle">
                    @if ($item->debit_credit == 1)
                    {{ $item->category_id }}：
                    {{ $item->category->category_name }}
                    <br>
                        @if ($item->kubun)
                        / {{ $item->kubun_id }}：
                        {{ $item->kubun->kubun_name }}
                        @endif
                    @else
                    @endif
                </td>

                {{-- 貸方 --}}
                <td id="credit" class="align-middle">
                    @if ($item->debit_credit == 2)
                    {{ $item->category_id }}：
                    {{ $item->category->category_name }}
                    <br>
                        @if ($item->kubun)
                        / {{ $item->kubun_id }}：
                        {{ $item->kubun->kubun_name }}
                        @endif
                    @else
                    @endif
                </td>

                {{-- 価格 --}}
                <td id="name" class="align-middle">
                    {{ number_format($item->price) }}
                </td>

                {{-- 状態 --}}
                <td id="price" class="align-middle">


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
        <a href="{{ route('home') }}" class="btn btn-light mr-3">
            {{ __('Return') }}
        </a>
    </div>

</div>

@endsection
