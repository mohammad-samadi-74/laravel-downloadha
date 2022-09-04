@component('mail::message')
<div class="container rtl" id="2fa_active_code">
<h2 class="bg-secondary">کد تایید احراز هویت شما :</h2>
<div><code class="bg-light">{{$code}}</code></div><br>
@component('mail::button',['url'=>route('home')])
برگشت به صفحه اصلی سایت
@endcomponent
</div>
@endcomponent
