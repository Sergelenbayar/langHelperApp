<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Kanji</title>
  <style>
    *{
      padding: 0;
      margin: 0;
      box-sizing: border-box;
    }
    .header{
      width: 100%;
      height: 70px;
      /* background-color:rgb(248, 187, 187); */
      background-color:cadetblue;
    }
    .maincontent{
      width: 100%;
      padding: 50px 100px;
    }
    .maincontent>div{
        display: inline-block;
    }
    .myform{
      width: 420px;
      margin: 10px 20px;
    }
    .myform:nth-child(odd){
      background-color: rgba(95, 158, 160, 0.623);
    }
    form .inputItem{
      margin: 10px;
    }
    input[type=text],input[type=select],input[type=number],.submitButton, form select{
      width: 400px;
      height: 30px;
      font-size: 1.2em;
    }
    form .inputItem>span{
      display: block;
    }
    .submitButton{
      background-color:lightcoral;
      color: white;
      border:0px;
    }
    .addCategory{
        padding: 2px 10px;
        border: none;
        color: steelblue;
    }
    .pagination li{
        display: inline;
        padding: 2px 10px;
        font-size: 1.2em;
        border-radius: 4px;
        border: 1px solid grey;
    }
    .pagination li a{
        text-decoration: none;
        color: black;
    }
    .pagination>.active{
        background-color: cadetblue;
    }
    .registerCategoryScreen{
      display: none;
      position: absolute;
      left: calc(50% - 250px);
      top: calc(50% - 100px);
      width: 500px;
      height: 200px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0px 5px 15px grey;
    }
    #registerCategory button{
      background-color:lightcoral;
      border-radius: 8px;
      border:none;
      margin: 8px;
      padding: 8px;
      color: white;
    }
    /* .toNextPage{
        width: 200px;
        height: 700px;
        margin: 10px auto;
        background-color: cornflowerblue;
    } */
  </style>
</head>
<body>
  <div class="header"></div>
  <div id="registerCategory" class="registerCategoryScreen">
    <button onclick="getElementById('registerCategory').style.display='none'">close</button>
    <div class="form">
      <form action="categories" method="post">
        @csrf
        <div class="inputItem">
          <span>Category нэр:</span>
          <input type="text" name="categoryName">
          <input type="hidden" name="pageNumber" value="{{$kanjis->currentPage()}}">
          <button type="submit">Нэмэх</button>
        </div>
      </form>
    </div>
  </div>
  <div class="maincontent">
    <div class="translator">
    </div>
    {{$kanjis->links()}}
    <br>
    <hr>
    @foreach ($kanjis as $kanji)
    <div class="myform">
    <form action="kanjis/{{$kanji->id}}" method="POST">
        @csrf
            @method('PUT')
          {{-- <div class="inputItem">
            <span>Канз ID:</span>
            <input type="text" name="kanjiid">
          </div> --}}
          <div class="inputItem">
            <span>Канз үсэг:</span>
            <input type="text" name="kanji" value="{{$kanji->kanji}}" disabled>
          </div>
          <div class="inputItem">
            <span>Утга(en):</span>
            <input type="text" name="meaningEng" value="{{$kanji->meaningEng}}" disabled>
          </div>
          <div class="inputItem">
            <span>Утга(mon):</span>
            <input type="text" name="meaningMon" value="{{$kanji->meaningMon}}">
          </div>
          <div class="inputItem">
            <span>Дуудлага(он):</span>
            <input type="text" name="readingOn" value="{{$kanji->readingOn}}">
          </div>
          <div class="inputItem">
            <span>Дуудлага(күн):</span>
            <input type="text" name="readingKun" value="{{$kanji->readingKun}}">
          </div>
          {{-- <div class="inputItem">
            <span>Зурлагын тоо:</span>
            <input type="number" name="strokes" value="{{$kanji->strokes}}" disabled>
          </div> --}} 
          <div class="inputItem">
            <span>JLPT түвшин:</span>
            <input type="number" name="jlptLevel" value="{{$kanji->jlptLevel}}">
          </div>
          <div class="inputItem">
            <span>Ангилал:</span>
          <select name="categoryId" value="{{$kanji->category == null ? "" : $kanji->category->categoryName}}">
              @foreach ($categories as $category)
                @if ($category->id==$kanji->categoryId)
                  <option value="{{$category->id}}" selected>{{$category->categoryName}}</option>
                @else
                  <option value="{{$category->id}}">{{$category->categoryName}}</option>
                @endif
              @endforeach
            </select>
            <input type="button" value="категори нэмэх" class="addCategory" onclick="getElementById('registerCategory').style.display='block'">
          </div>
          <div class="inputItem">
            <span>WK Утга(en):</span>
            <input type="text" name="wkMeaningEng" value="{{$kanji->wkMeaningEng}}" disabled>
          </div>
          <div class="inputItem">
            <span>Radical-ууд:</span>
            <input type="text" name="wkRadicals" value="{{$kanji->wkRadicals}}" disabled>
          </div>
          <div class="inputItem">
              <button type="submit" class="submitButton">Хадгалах</button>
          </div>
        <input type="hidden" name="pageNumber" value="{{$kanjis->currentPage()}}">
        </form>
      </div>
    @endforeach
  </div>
</body>
</html>