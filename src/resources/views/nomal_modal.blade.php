@extends('layouts.app')
@section('modal')
@parent

<div id='glayLayer'></div>
<div id="nomalModal">
    <form action="./" method="post" id="mForm">

        <div class="mForm">
            <label for="mTitle" class="mr-2">タイトル</label>
            <input type="text" name="title" id="mTitle" value=""
                required>
        </div>

        <div class="mForm">
            <label for="mStart" class="mr-2">開始日時</label>
            <input type="date" name="start" id="mStart" value=""
                required>
            <input type="time" name="start_time" id="mStartTime"
                value="" required>
        </div>

        <div class="mForm">
            <label for="mEnd" class="mr-2">終了日時</label>
            <input type="date" name="end" id="mEnd" value=""
                required>
            <input type="time" name="end_time" id="mEndTime"
                value="" required>
        </div>

        <div class="mForm">
            <label for="mTag" class="mr-2">タグ</label>
            <select name="tag" id="mTag">
                <option value="">aaa</option>
                <option value="">bbb</option>
            </select>
        </div>

        <div class="mForm">
            <label for="mMemo" class="mr-2">メモ</label>
            <textarea name="memo" id="mMemo" cols="30" rows="3">
                aaa
        </textarea>
        </div>

    </form>
</div>

@endsection
