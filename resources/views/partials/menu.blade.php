<div class="pull-right">
    Welcome <strong>{{Auth::user()->name}}</strong>
    <form action="/logout" method="post" class="inline">
        {{csrf_field()}}
        <button class="btn btn-default btn-xs">Logout</button>
    </form>
</div>
