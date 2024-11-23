@extends('sidebar.index_sidebar')
@section('contentForYou')

<div class="parent" style="display: grid;
grid-template-columns: repeat(6, 1fr);
grid-template-rows: repeat(4, 1fr);
grid-column-gap: 0px;
grid-row-gap: 0px;">
    <div class="div1" style="grid-area: 1 / 1 / 5 / 3;"> TESTE DIV 1 </div>
    <div class="div2" style="grid-area: 1 / 3 / 3 / 5;"> TESTE DIV 2 </div>
    <div class="div3" style="grid-area: 1 / 5 / 3 / 7;"> TESTE DIV 3 </div>
    <div class="div4" style= "grid-area: 3 / 3 / 5 / 7;"> TESTE DIV 4 </div>
</div>

</div>
@endsection
