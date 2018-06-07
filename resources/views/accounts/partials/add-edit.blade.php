{{--@dump($errors)--}}
<div class="form-group">
    <label for="account_type_id">Account Type</label>
    <select name="account_type_id" class="form-control"  id="account_type_id" placeholder="Type" value="{{ old('account_type_id', $account->account_type_id) }}">
        <option value= 1 >Bank Account</option>
        <option value= 2 >Pocket Money</option>
        <option value= 3 >Paypal Account</option>
        <option value= 4 >Credit Card</option>
        <option value= 5 >Meal Card</option>
    </select>
    @if ($errors->has('account_type_id'))
        <em>{{ $errors->first('account_type_id') }}</em>
    @endif
</div>
<div class="form-group">
    <label for="date">Date</label>
    <input type="text" class="form-control" name="date" id="date" placeholder="Data de Criacao" />
    @if ($errors->has('date'))
        <em>{{ $errors->first('date') }}</em>
    @endif
</div>
<div class="form-group">
    <label for="date">Code</label>
    <input type="text" class="form-control" name="code" id="code" placeholder="Code" value="{{ old('code', $account->code ) }}"/>
    @if ($errors->has('code'))
        <em>{{ $errors->first('code') }}</em>
    @endif
</div>
<div class="form-group">
    <label for="start_balance">Balance</label>
    <input type="text" class="form-control" name="start_balance" id="start_balance" placeholder="Start Balance" value="{{ old('start_balance', $account->start_balance ) }}"/>
    @if ($errors->has('start_balance'))
        <em>{{ $errors->first('start_balance') }}</em>
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