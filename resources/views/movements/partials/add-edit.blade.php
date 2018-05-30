{{--@dump($errors)--}}
<div class="form-group">
    <label for="inputMovementCategory">Movement Category</label>
    <select name="category" class="form-control" id="inputMovementCategory" value="{{ old('category', $movement->movement_category_id) }}">
        <option disabled selected> -- select an option -- </option>
        <option value="1">Food</option>
        <option value="2">Clothes</option>
        <option value="3">Services</option>
        <option value="4">Electricity</option>
        <option value="5">Phone</option>
        <option value="6">Fuel</option>
        <option value="7">Insurance</option>
        <option value="8">Entertainment</option>
        <option value="9">Culture</option>
        <option value="10">Trips</option>
        <option value="11">Mortgage payment</option>
        <option value="12">Salary</option>
        <option value="13">Bonus</option>
        <option value="14">Royalties</option>
        <option value="15">Interests</option>
        <option value="16">Gifts</option>
        <option value="17">Dividends</option>
        <option value="18">Product sales</option>
    </select>
    @if ($errors->has('category'))
        <em>{{ $errors->first('category') }}</em>
    @endif
</div>

<div class="form-group">
    <label for="inputMovementType">Movement Type</label>
    <input type="text" class="form-control" name="type" autocomplete="on" id="inputMovementType" placeholder="Type" value="{{ old('type', $movement->value ) }}"/>
    @if ($errors->has('type'))
        <em>{{ $errors->first('type') }}</em>
    @endif
</div>


<div class="form-group">
    <label for="inputMovementDate">Movement Date</label>
    <input type="text" class="form-control" name="date" id="inputMovementDate" placeholder="YYYY/DD/MM" data-fv-date-format="YYYY/DD/MM" value="{{ old('date', $movement->date ) }}"/>
    @if ($errors->has('date'))
        <em>{{ $errors->first('date') }}</em>
    @endif
</div>
<div class="form-group">
    <label for="inputMovementStartBalance">Start Balance</label>
    <input type="text" class="form-control" name="startBalance" id="inputMovementStartBalance" placeholder="Start Balance" value="{{ old('startBalance', $movement->start_balance ) }}"/>
    @if ($errors->has('startBalance'))
        <em>{{ $errors->first('startBalance') }}</em>
    @endif
</div>
<div class="form-group">
    <label for="inputMovementValue">Movement Value</label>
    <input type="text" class="form-control" name="value" id="inputMovementValue" placeholder="Value" value="{{ old('value', $movement->value ) }}"/>
    @if ($errors->has('value'))
        <em>{{ $errors->first('value') }}</em>
    @endif
</div>
<div class="form-group">
    <label for="inputMovementDescription">Description</label>
    <input type="text" class="form-control" name="comment" id="inputMovementDescription" placeholder="Enter text here..." style="height:75px" value="{{ old('comment', $movement->description ) }}"/>
    @if ($errors->has('comment'))
        <em>{{ $errors->first('comment') }}</em>
    @endif
</div>



