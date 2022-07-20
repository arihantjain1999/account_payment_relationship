@extends('layouts.app')
@section('content')
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href=" {{ route('accounts.index') }} ">Account Details </a> </li>
            <li class="breadcrumb-item acti ve" aria-current="page">Campaign</li>
            {{-- <li class="breadcrumb-item active" aria-current="page">Subject Data</li>s --}}
        </ol>
    </nav>
    <h1>Compose Emaill</h1>
    <div id="example"></div>
    <button class="onclick btn btn-success my-1">mail</button>
</div>

<script>
    var editor = new FroalaEditor('#example');
    $(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click' , '.onclick' , function(){
            console.log($('.fr-element').html());
            var body = $('.fr-element').html();
            $.ajax({
                url: '/mail',
                type: 'POST' , 
                data: {
                    body: body, 
                },
                success: function(data){
                    console.log(data);
                },
            });
        });
    });
</script>
@endsection