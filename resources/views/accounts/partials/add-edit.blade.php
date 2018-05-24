{{--@dump($errors)--}}
<div class="form-group">
    <label for="inputAccountType">Account Type</label>
    <input type="text" class="form-control" name="type" id="inputAccountType" placeholder="Type" value="{{ old('type', $account->account_type_id) }}"/>
    @if ($errors->has('type'))
        <em>{{ $errors->first('type') }}</em>
    @endif
</div>
<div class="form-group">
    <label for="inputData">Date</label>
    <input type="text" class="form-control" name="date" id="inputData" placeholder="Data de Criacao" value="{{ old('date', $account->created_at ) }}"/>
    @if ($errors->has('data'))
        <em>{{ $errors->first('data') }}</em>
    @endif
</div>
<div class="form-group">
    <label for="inputCode">Code</label>
    <input type="text" class="form-control" name="code" id="inputCode" placeholder="Code" value="{{ old('code', $account->code ) }}"/>
    @if ($errors->has('code'))
        <em>{{ $errors->first('code') }}</em>
    @endif
</div>
<div class="form-group">
    <label for="inputBalance">Balance</label>
    <input type="text" class="form-control" name="balance" id="inputBalance" placeholder="Start Balance" value="{{ old('balance', $account->start_balance ) }}"/>
    @if ($errors->has('balance'))
        <em>{{ $errors->first('balance') }}</em>
    @endif
</div>