
    <input type="hidden" name="user_id" value="{{$user->id}}"/>
    <div class="form-group">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Name</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name"
                       value="{{ old( 'name', $user->name) }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                @endif
            </div>
        </div>


        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email"
                       value="{{ old( 'email', $user->email) }}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
            <label for="phone" class="col-md-4 control-label">Phone Number</label>

            <div class="col-md-6">
                <input id="phone" type="text" class="form-control" name="phone"
                       value="{{ old( 'phone', $user->phone) }}"  min="9">

                @if ($errors->has('phone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group ">
            <label for="profile_photo" class="col-md-4 control-label">Profile Photo</label>
            <div class="col-md-6">
                <input type="file" name="profile_photo" accept="image/*">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            </div>
        </div>
    </div>

