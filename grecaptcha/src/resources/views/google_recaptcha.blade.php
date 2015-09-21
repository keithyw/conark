<div class="form-group">
    <div class="col-sm-4 col-sm-offset-2">
        <div class="g-recaptcha" data-sitekey="{{ Config::get('grecaptcha.google_recaptcha.key') }}"></div>
        @if ($errors->has('g-recaptcha-response'))
            <p class="bg-danger">
                {{ $errors->first('g-recaptcha-response') }}
            </p>
        @endif
    </div>
 </div>
