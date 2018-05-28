{{--@dump($errors)--}}
<div class="form-group">
    <label for="inputMovementType">Movement Type</label>
    <br>
    <select name="type" class="form-control" id="inputMovementType" value="{{ old('type', $movement->type) }}">
        <option value="expense">Expense</option>
        <option value="revenue">Revenue</option>
    </select>
    @if ($errors->has('type'))
        <em>{{ $errors->first('type') }}</em>
    @endif
</div>
<div class="form-group">
    <label for="inputMovementCategory">Movement Category</label>
    <input type="text" class="form-control" name="category" id="inputMovementCategory" placeholder="Category" value="{{ old('category', $movement->movement_category_id) }}"/>
    @if ($errors->has('category'))
        <em>{{ $errors->first('category') }}</em>
    @endif
</div>
<div class="form-group">
    <label for="inputMovementDate">Movement Date</label>
    <input type="date" class="form-control" name="date" id="inputMovementDate" placeholder="Date" value="{{ old('date', $movement->date ) }}"/>
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


