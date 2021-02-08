@extends('layouts.cardapp')
@section('card')

    <div class="card-header">
        <form action="{{ route('calendar/index') }}" method="get" class="float-left ml-3 yearMonth">
            <div class="top">
                {{-- 年月の選択 --}}
                <select name="year" id="year" class="form-control">
                    @for ($i=2010; $i<=$thisYear; $i++)
                        @if ($getYear==$i)
                            <option value="{{ $getYear }}" selected>
                        {{ $getYear }}</option>
                        @else
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endif
                    @endfor
                </select>
                <span>年</span>

                <select name="month" id="month" class="form-control">
                    @for ($i=1; $i<=12; $i++)
                        @if ($getMonth==$i)
                            <option value="{{ $getMonth }}" selected>{{ $i }}</option>
                        @else
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endif
                    @endfor
                </select>
                <span class="mr-3">月</span>
                <input type="submit" name="" id="" value="表示" class="btn btn-light mr-5">

                {{-- 支出計 --}}
                <span class="totalPrice font-weight-bold mr-5">支出：{{ number_format($expense_sum) }}</span>
                <span class="totalPrice font-weight-bold">支入：{{ number_format($income_sum) }}</span>
            </div>
        </form>
    </div>

<div class="card-body">
    <div class="flex-center position-ref">
        <div class="cldContent">
            <div class="cld mb-2">
                <a href="?year={{ $prevYear }}&month={{ $prevMonth }}" class="cld mr-2 arrow">&lt;</a>
                <span class="cld mr-2 title">{{ $displayYm }}</span>
                <a href="?year={{ $nextYear }}&month={{ $nextMonth }}" class="cld mr-4 arrow">&gt;</a>
                <a href="{{ route('calendar/index') }}" class="cld thisMonth"> &nbsp; 今月 </a>
            </div>

            <table class="table table-bordered">
                <tr>
                    @foreach ($titles as $v)
                    <th class="cld">{{$v}}</th>
                    @endforeach
                </tr>

                @foreach ($weeks as $week)
                    {!! $week !!}
                    @endforeach
            </table>
        </div>
    </div>
</div>

<div class="col-md-10">
    <a href="{{ route('home') }}" class="btn btn-light mb-3">
        {{ __('Return') }}
    </a>
</div>

@endsection
