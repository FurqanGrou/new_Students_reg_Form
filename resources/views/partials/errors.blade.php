

<style>
    .errors_div{
        display: none;
    }
</style>


@if($errors->any())

    <div class="alert alert-danger mt-5 text-center" style="width: 70%;margin: auto; font-family: Cairo;">

        <h4 class="font-weight-bold">{{ __('Missing info') }}</h4>
        @foreach($errors->all() as $error)
            <p class="mb-0 font-weight-bold" style="color: #504b4b; font-size: 15px;"> {{ $error }}</p>
        @endforeach

    </div>

@endif

<div class="alert alert-danger errors_div">
    <ul class="errors_ul"></ul>
</div>
