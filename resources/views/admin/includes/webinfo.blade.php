<form method="post" action="{{ route('updatewebinfo') }}" enctype="multipart/form-data">
    <div class="form-group">
        <h5 class="">Announcement</h5>
        <textarea name="update" class="form-control" rows="2">{{ \App\Models\Setting::getValue('newupdate') }}</textarea>
    </div>
    <div class="form-group">
        <h5 class="">Website Name</h5>
        <input type="text" name="site_name" class="form-control"
            value="{{ \App\Models\Setting::getValue('site_name') }}" required>
    </div>
    <div class="form-group">
        <h5 class="">Website Description</h5>
        <textarea name="description" class="form-control" rows="4">{{ \App\Models\Setting::getValue('description') }}</textarea>
    </div>
    <div class="form-group">
        <h5 class="">Live chat widget Code</h5>
        <textarea name="tawk_to" class="form-control" rows="4">{{ \App\Models\Setting::getValue('tawk_to') }}</textarea>
    </div>
    <div class="form-group">
        <h5 class="">Website Title</h5>
        <input type="text" name="site_title" class="form-control"
            value="{{ \App\Models\Setting::getValue('site_title') }}" required>
    </div>
    <div class="form-group">
        <h5 class="">Website Keywords</h5>
        <input type="text" name="keywords" class="form-control"
            value="{{ \App\Models\Setting::getValue('keywords') }}" required>
    </div>
    <div class="form-group">
        <h5 class="">Website Url (https://monetamarkets.net)</h5>
        <input type="text" placeholder="https://monetamarkets.net" name="site_address" class="form-control"
            value="{{ \App\Models\Setting::getValue('site_address') }}" required>
    </div>
    <div class="form-group">
        <h5 class="">Site Logo (Recommended size; max width, 200px and max height 100px.)</h5>
        <input name="logo" class="form-control" type="file">
        <img src="{{ asset('front/img/group-logo.png') }}">
    </div>
    <div class="form-group">
        <h5 class="">Site Favicon (Recommended type: png, size: max width, 32px and max height 32px.)</h5>
        <input name="favicon" class="form-control" type="file">
        <img src="{{ asset('front/favicon.png') }}">
    </div>

    <input type="submit" class="px-5 btn btn-primary btn-lg" value="Update">
    <input type="hidden" name="id" value="1">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
