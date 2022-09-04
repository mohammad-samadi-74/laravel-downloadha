<div class="form-group mt-4 mx-5 ">
    <div class="g-recaptcha  @error('g-recaptcha-response') is-invalid @enderror"
         data-sitekey="{{env('GOOGLE_RECAPTCHA_SITE_KEY')}}"></div>
    <br/>
    @error('g-recaptcha-response')
    <span class="invalid-feedback" role="alert">
        <strong class="text-right">{{ $message }}</strong>
    </span>
    @enderror
</div>
