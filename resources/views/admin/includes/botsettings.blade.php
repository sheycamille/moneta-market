<form method="post" action="{{route('updatebot')}}" enctype="multipart/form-data">
    <div class="form-group">
        <h5 class="">Bot Link</h5>
        <input type="text" name="bot_link" value="{{\App\Models\Setting::getValue('bot_link')}}" class="form-control">
    </div>
    <div class="form-group">
        <h5 class="">Telegram Token</h5>
        <input type="text" name="telegram_token" value="{{\App\Models\Setting::getValue('telegram_token')}}" class="form-control " >
    </div>
    <div class="form-group">
        <h5 class="">Bot group chat link</h5>
        <input type="text" name="bot_group_chat" value="{{\App\Models\Setting::getValue('bot_group_chat')}}" class="form-control">
    </div>

    <div class="form-group">
        <label for=""></label>
        <h5 class="">Bot channel link</h5>
        <input type="text" name="bot_channel" value="{{\App\Models\Setting::getValue('bot_channel')}}" class="form-control">
    </div>

    <div class="form-group">
        <div class="sign-u">
            <div class="sign-up1">
                <h4></h4>
                <h5 class="">Activate/Deactivate bot:</h5>
            </div>
            <div class="sign-up2">
            <label class="switch">
            <input type="checkbox" id="bot_activate" name="bot_activate" value="true">
            <span class="slider round"></span>
            </label>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
<input type="submit" class="px-5 btn btn-primary btn-lg" value="Save">
<input type="hidden" name="id" value="1">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
