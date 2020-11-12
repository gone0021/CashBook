@extends('layouts.cardapp')
@section('card')
<div class="card-header">
    {{ __(' Cash Book')}}
</div>

<div class="card-body">
    {{-- 年月の選択 --}}
    <form action="{{ route('items/index') }}" method="get" class="yearMonth mb-3 mr-4">
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
                    <span class="bookNo">{{ __('No.') }}</span>
                </th>

                <th>
                    <span class="date">{{ __('Date')}}</span>
                </th>

                <th>
                    <span class="debit">{{ __('Debit') }}</span>
                </th>

                <th>
                    <span class="credit">{{ __('Credit')}}</span>
                </th>

                <th>
                    <span class="price">{{ __('Price')}}</span>
                </th>

                <th>
                    <span class="ecit">{{ __('Edit')}}</span>
                </th>
            </tr>
        </thead>

        {{-- 表示内容 --}}
        <tbody>
            @foreach ($bookNo as $k => $count)
            <tr>
                <td class="bookNo" class=" ">
                    {{ $count->book_no }}
                </td>

                {{-- 日付 --}}
                <td class="date" class="align-middle">
                    {{ date('m月d日', strtotime($count->date)) }}
                </td>

                {{-- 借方 --}}
                <td class="debit" class="align-middle">
                @php
                    $d_flg = 0;
                @endphp
                    @foreach ($items as $item)
                    @if ($item->debit_credit == 1)
                        @if ($item->book_no == $count->book_no)
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
                        @if ($item->book_no == $count->book_no)
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
                    {{ number_format($count->price) }}
                </td>

                {{-- 詳細 --}}
                <td class="edit" class="align-middle">
                    <button type="button" name="edit" value="{{$count->book_no}}" class="btn btn-info itemDetail">{{ __('Detail') }}</button>
                {{-- <form action="{{ route('items/show') }}">
                        <input type="hidden" name="book_no" value="{{$count->book_no}}">
                        <input type="submit" name="" id="" class="btn btn-info itemDetail" value="{{ __('Detail') }}">
                    </form> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    <div>
        {{ $bookNo->appends(['year'=>$getYear, 'month'=>$getMonth])->links() }}
    </div>

    <div class="col-md-10">
        <a href="{{ route('home') }}" class="btn btn-light mr-3">
            {{ __('Return') }}
        </a>
    </div>

</div>

<div class='glayLayer'></div>
@component ('components.detail_modal')
@slot('items',$items)

@endcomponent
@endsection
