@if($errors->any())
<div class="not-valid-block mt-8">
    <ul class="list-disc py-4 px-6">
   @foreach ($errors->all() as $error)
        <li class="leading-tight mb-3 last:mb-0">{{ $error }}</li>
    @endforeach
    </ul>
</div>
@endif