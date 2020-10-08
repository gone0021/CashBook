<div id='glayLayer'></div>
<div id="nomalModal">
    <form action="" method="post">
        <div class="input mb-2">
            <div>
                <label for="cashOut">支払</label>
                <input type="radio" name="debit_credit" id="cashOut" value="2" class="mr-3" checked>
                <label for="cashIn">収入</label>
                <input type="radio" name="debit_credit" id="cashIn" value="1">
            </div>

            <div class="nomalAsset">
                <label for="nomalAssetCategory">資産区分：</label>
                <select name="tag" id="nomalAssetCategory" class="mr-3">
                    <option value="1">現金</option>
                    <option value="2">普通預金</option>
                    <option value="3">クレジットカード</option>
                </select>

                <label for="nomalAssetkubun">小区分：</label>
                <select name="tag" id="nomalAssetkubun" class="mr-3">
                    <option value="">aaa</option>
                    <option value="">bbb</option>
                </select>
            </div><br>

            <div class="nomalCost">
                <label for="nomalCostCategory">支出区分：</label>
                <select name="tag" id="nomalCostCategory" class="mr-3">
                    <option value="">aaa</option>
                    <option value="">bbb</option>
                </select>

                <label for="nomalCostKubun">小区分：</label>
                <select name="tag" id="nomalCostKubun" class="mr-3">
                    <option value="">aaa</option>
                    <option value="">bbb</option>
                </select>
            </div>

            <div class="nomalModal">
                <label for="nomalPrice" class="mr-2">価格：</label>
                <input type="text" name="price" id="nomalPrice" value="" required>
            </div>
        </div>

        <input type="submit" name="" id="" value="new">

    </form>
</div>
