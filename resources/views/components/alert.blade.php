<div>
    {{$slot}}
    @if(session()->has('message'))

    <div class="success alertMsg" style="background-color: #edf9f0;
    color: #287d3c; text-align:center;">
        <strong>Success!</strong> {{session()->get('message')}}
    </div>
    
    @elseif(session()->has('error'))
    
    <div class="error alertMsg" style="background-color: #feefef;
    color: #da1414; text-align:center;">
        <strong>Error!</strong> {{session()->get('error')}}
    </div>
    
    @endif
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->

    @if($errors->any())

        @foreach($errors->all() as $error )

        <div class="error alertMsg" style="background-color: #feefef;
        color: #da1414; text-align:center;">
            <strong>Error!</strong> {{$error}}
        </div>

        @endforeach  

    @endif
</div>
<!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
