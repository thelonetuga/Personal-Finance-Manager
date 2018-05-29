{{--@dump($errors)--}}
<div class="form-group">
    <label for="inputMovementCategory">Movement Category</label>
    <select name="category" class="form-control" id="inputMovementCategory" value="{{ old('category', $movement->movement_category_id) }}">
        <option disabled selected> -- select an option -- </option>
        <option value="1">Food</option>
        <option value="2" {{ $movement->is_selected(old('category', strval($movement->movement_category_id)), '2') }}>Clothes</option>
        <option value="3" {{ $movement->is_selected(old('category', strval($movement->movement_category_id)), '3') }}>Services</option>
        <option value="4" {{ $movement->is_selected(old('category', strval($movement->movement_category_id)), '4') }}>Electricity</option>
        <option value="5" {{ $movement->is_selected(old('category', strval($movement->movement_category_id)), '5') }}>Phone</option>
        <option value="6" {{ $movement->is_selected(old('category', strval($movement->movement_category_id)), '6') }}>Fuel</option>
        <option value="7" {{ $movement->is_selected(old('category', strval($movement->movement_category_id)), '7') }}>Insurance</option>
        <option value="8" {{ $movement->is_selected(old('category', strval($movement->movement_category_id)), '8') }}>Entertainment</option>
        <option value="9" {{ $movement->is_selected(old('category', strval($movement->movement_category_id)), '9') }}>Culture</option>
        <option value="10" {{ $movement->is_selected(old('category', strval($movement->movement_category_id)), '10') }}>Trips</option>
        <option value="11" {{ $movement->is_selected(old('category', strval($movement->movement_category_id)), '11') }}>Mortgage payment</option>
        <option value="12" {{ $movement->is_selected(old('category', strval($movement->movement_category_id)), '12') }}>Salary</option>
        <option value="13" {{ $movement->is_selected(old('category', strval($movement->movement_category_id)), '13') }}>Bonus</option>
        <option value="14" {{ $movement->is_selected(old('category', strval($movement->movement_category_id)), '14') }}>Royalties</option>
        <option value="15" {{ $movement->is_selected(old('category', strval($movement->movement_category_id)), '15') }}>Interests</option>
        <option value="16" {{ $movement->is_selected(old('category', strval($movement->movement_category_id)), '16') }}>Gifts</option>
        <option value="17" {{ $movement->is_selected(old('category', strval($movement->movement_category_id)), '17') }}>Dividends</option>
        <option value="18" {{ $movement->is_selected(old('category', strval($movement->movement_category_id)), '18') }}>Product sales</option>
    </select>
    @if ($errors->has('category'))
        <em>{{ $errors->first('category') }}</em>
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
    <label for="inputMovementValue">Movement Value</label>
    <input type="text" class="form-control" name="value" id="inputMovementValue" placeholder="Value" value="{{ old('value', $movement->value ) }}"/>
    @if ($errors->has('value'))
        <em>{{ $errors->first('value') }}</em>
    @endif
</div>
<div class="form-group">
    <label for="inputMovementDescription">Description</label>
    <br>
    <textarea rows="5" cols="100" name="comment" id="inputMovementDescription" placeholder="Enter text here..."
              form="usrform" value="{{ old('value', $movement->description ) }}"></textarea>
    @if ($errors->has('comment'))
        <em>{{ $errors->first('comment') }}</em>
    @endif
</div>


