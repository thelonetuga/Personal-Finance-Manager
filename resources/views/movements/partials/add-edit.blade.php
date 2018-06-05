{{--@dump($errors)--}}
<div class="form-group">
    <label for="movement_category_id">Movement Category</label>
    <select name="movement_category_id" class="form-control" id="movement_category_id">
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
    @if ($errors->has('movement_category_id'))
        <em>{{ $errors->first('movement_category_id') }}</em>
    @endif
</div>

<div class="form-group">
    <label for="date">Movement Date</label>
    <input type="text" class="form-control" name="date" id="date" placeholder="YYYY/DD/MM" data-fv-date-format="YYYY/DD/MM" value="{{ old('date', $movement->date ) }}"/>
    @if ($errors->has('date'))
        <em>{{ $errors->first('date') }}</em>
    @endif
</div>
<div class="form-group">
    <label for="value">Movement Value</label>
    <input type="text" class="form-control" name="value" id="value" placeholder="Value" value="{{ old('value', $movement->value ) }}"/>
    @if ($errors->has('value'))
        <em>{{ $errors->first('value') }}</em>
    @endif
</div>
<div class="form-group">
    <label for="description">Description</label>
    <br>
    <textarea rows="2" cols="156" name="description" id="description" placeholder="Enter text here..."></textarea>
    @if ($errors->has('description'))
        <em>{{ $errors->first('description') }}</em>
    @endif
</div>
<div class="form-group">
    <div>
        <label for="document_file">Document</label>
        <br>
        <div class="form-control">
            <input type="file" name="document_file">
        </div>
    </div>
    <div class="form-group">
        <label for="documentDescription">Document description</label>
        <br>
        <textarea rows="2" cols="156" name="documentDescription" id="documentDescription" placeholder="Enter text here..."></textarea>
        @if ($errors->has('documentDescription'))
            <em>{{ $errors->first('documentDescription') }}</em>
        @endif
    </div>
</div>



