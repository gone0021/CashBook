@extends('layouts.cardapp')
@section('card')
<div class="card-header">
    <span class="mr-5">{{ __(' Cash Book')}}</span>
    <span class="totalPrice font-weight-bold">支出合計：{{ number_format($totalPrice) }}</span>

</div>

<div class="card-body">
    <div class="top">
        @if (isset($_GET['calendar']))
        {{-- カレンダーリンクから --}}
        <p class="calendarLink font-weight-bold ml-3">
            @if(isset($_GET['year']))
                {{ $_GET['year'] }}
            @endif
            <span>年</span>
            @if(isset($_GET['month']))
            {{ $_GET['month'] }}
            @endif
            <span>月</span>
            @if(isset($_GET['day']))
            {{ $_GET['day'] }}
            @endif
            <span class="mr-5">日</span>
        </p>
        @else
        {{-- 家計簿リンクから --}}
        <form action="{{ route('items/index') }}" method="get" class="yearMonth mb-3 mr-4">
            <select name="year" id="year" class="form-control">
                @for ($i=2010; $i<=$thisYear; $i++)
                    @if ($getYear == $i)
                        <option value="{{ $getYear }}" selected>{{ $getYear }}</option>
                    @else
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endif
                @endfor
            </select>
            <span>年</span>

            <select name="month" id="month" class="form-control">
                @for ($i=1; $i<=12; $i++)
                    @if ($getMonth == $i)
                    <option value="{{ $getMonth }}" selected>{{ $getMonth }}</option>
                    @else
                    <option value="{{ $i }}">{{ $i }}</option>
                    @endif
                @endfor
            </select>
            <span class="mr-3">月</span>
            <input type="submit" name="" id="" value="表示" class="btn btn-light mr-3">
        </form>
        @endif
    </div>

    <span class="totalPrice font-weight-bold mr-5">支出：{{ number_format($expense_sum) }}</span>
    <span class="totalPrice font-weight-bold">支入：{{ number_format($income_sum) }}</span>

    <table class="table" id="tb-item">
        {{-- 表示タイトル --}}
        <thead>
            <tr>
                <th class="bookNo">{{ __('No.') }}</th>
                <th class="date">{{ __('Date')}}</th>
                <th class="debit">{{ __('Debit') }}</th>
                <th class="credit">{{ __('Credit')}}</th>
                <th class="price">{{ __('Price')}}</th>
                <th class="ecit">{{ __('Edit')}}</th>
            </tr>
        </thead>

        {{-- 表示内容 --}}
        <tbody>
            @foreach ($groupByItems as $k => $val)
            <tr>
                <td class="bookNo" class=" ">
                    {{ $val->book_no }}
                </td>

                {{-- 日付 --}}
                <td class="date" class="align-middle">
                    {{ date('m月d日', strtotime($val->date)) }}
                </td>

                {{-- 借方 --}}
                <td class="debit" class="align-middle">
                @php
                    $d_flg = 0;
                @endphp
                    @foreach ($items as $item)
                    @if ($item->debit_credit == 1)
                        @if ($item->book_no == $val->book_no)
                            {{-- categoryの数をチェック --}}
                            @foreach ($countDebit as $cd)
                                {{-- cateogryが複数ある場合 --}}
                                @if ($cd == $item->book_no)
                                    -：諸口
                                    @php
                                        $d_flg = 1;
                                        break;
                                    @endphp
                                @endif
                            @endforeach
                            {{-- cateogryが複数ある場合は上記処理で終了 --}}
                            @if ($d_flg == 1)
                            @break
                            {{-- cateogryが一つの場合 --}}
                            @else
                            {{ $item->category_id }}：
                            {{ $item->category->category_name }}
                            @endif
                        @endif
                    @endif
                    @endforeach
                </td>

                {{-- 貸方 --}}
                <td class="credit" class="align-middle">
                    @php
                    $c_flg = 0;
                @endphp
                    @foreach ($items as $item)
                    @if ($item->debit_credit == 2)
                        @if ($item->book_no == $val->book_no)
                            {{-- categoryの数をチェック --}}
                            @foreach ($countCredit as $cc)
                                {{-- cateogryが複数ある場合 --}}
                                @if ($cc == $item->book_no)
                                    -：諸口
                                    @php
                                        $c_flg = 1;
                                        break;
                                    @endphp
                                @endif
                            @endforeach
                            {{-- cateogryが複数ある場合は上記処理で終了 --}}
                            @if ($c_flg == 1)
                            @break
                            {{-- cateogryが一つの場合 --}}
                            @else
                            {{ $item->category_id }}：
                              {{ $item->category->category_name }}
                          @endif
                        @endif
                    @endif
                    @endforeach
                </td>

                {{-- 価格 --}}
                <td class="price" class="align-middle">
                    {{ number_format($val->price) }}
                </td>

                {{-- 詳細ボタン --}}
                <td class="edit" class="align-middle">
                    <button type="button" name="edit" value="{{$val->book_no}}" class="btn btn-info itemDetailAccount">{{ __('Detail') }}</button>

                    @php
                        if ($d_flg == 0 && $c_flg == 0) {
                            echo ' <button type="button" name="edit" value="' . $val->book_no . '" class="btn btn-info itemDetailNomal"> Detail2 </button>';
                        }
                    @endphp
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if (isset($_GET['calendar']))
        <div>
            {{ $groupByItems->appends(['year'=>$getYear, 'month'=>$getMonth, 'day'=>$_GET['day'], 'calendar'=>1 ])->links() }}
        </div>
    @else
        <div>
            {{ $groupByItems->appends(['year'=>$getYear, 'month'=>$getMonth])->links() }}
        </div>
    @endif

    @if (isset($_GET['calendar']))
        <div class="col-md-10">
            <button id="" onClick="history.back()" class="btn btn-light">{{ __('Return')}}</button>
      </div>

    @else
    <div class="col-md-10">
        <a href="{{ route('home') }}" class="btn btn-light mr-3">
            {{ __('Return') }}
        </a>
    </div>
    @endif
</div>

<div class='glayLayer'></div>
@component ('components.detail_account')
@slot('items',$items)
@endcomponent

@component ('components.detail_nomal')
@slot('items',$items)
@endcomponent

@component ('components.input_msg')
@endcomponent

@endsection
