
<style>
@import url("https://fonts.googleapis.com/css2?family=Roboto:wght@100,300;400;500&display=swap");
* {
  margin: 0;
  padding: 0;
  color: #5d5d5d;
  box-sizing: border-box;
  font-family: "Roboto", sans-serif;
  word-wrap : break-word
}

body {
  background-color: purple;
 
}

.main {
  max-width: 800px;
  margin: 2rem auto;
}

.card-outer-box {
  background-color: #f1f1f1;
}
.btn {

    display: inline-block;
    font-weight: 400;
    color: #212529;
    text-align: center;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-color: transparent;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    background-color: #0069d9;
    border-color: #0062cc;
    color: #fff;
}
.text-center{text-align: center;}
.card-inner-box {
  display: flex;
  justify-content: space-between;
  background-color: #fff;
  padding: 2rem;
}

.card-profile {
  text-align: center;
  width: 40%;
}
.card-profile img {
  width: 100%;
  border-radius: 50%;
}
.card-profile h3 {
  margin-top: 1rem;
  font-size: 1.6rem;
}
.card-profile p {
  font-weight: 300;
  font-size: 1.1rem;
  color: #777;
}
body{direction: rtl;}
.card-content {
  min-width: 65%;
  background-color: #f1f1f1;
  padding: 2rem;
  margin-right: 2rem;
}
.card-content ul {
  list-style-type: none;
}
.card-content ul li {
  padding: 0.4rem;
  font-size: 1.2rem;
  color: #777;
}
.card-content p {
  color: #777;
  font-size: 1.2rem;
}
.card-content .icon {
  font-size: 1.1rem;
  padding-top: 0.3rem;
  height: 36px;
  position: relative;
  top: 8px;
  left: 5px;
  margin-right: 1rem;
}
#id-card1{width:    85.6mm !important; height: 53.98mm !important;}
</style>
<div >
 
    <main class="main">
   <div  class="card-outer-box">
     <div id="id-card" class="card-inner-box">
       <div class="card-profile id-card__mugshot" >
         @if(file_exists("storage/".$emp->image))
                                        <img style="max-width: 150px;max-height:150px;"  id="id-card-mugshot" src="{{asset('storage/'.$emp->image)}}" alt="...">
                                        @else
                                        <img style="max-width: 150px;max-height:150px;"  id="id-card-mugshot" src="{{asset('img/avatar.png')}}" alt="...">

                                        @endif
       </div>
       <div class="card-content">
         <ul>
           <li><strong> الاسم: </strong>{{$emp->name}}</li>
           <li><strong>الرقم الوظيفي: </strong>{{$emp->job_no}}</li>
           <li><strong>المسمى الوظيفي: </strong>{{$emp->job->title}}</li>
      
           <li><strong>البريد الالكتروني: </strong>{{$emp->email}}</li>
         </ul>
       </div>
     </div>
   </div>
 </main>

</div>

<div class="text-center">
<button class="btn btn-primary" id="download-button">تحميل البطاقة</button>
@if($doc && file_exists("storage/".$doc->name))
<br>
<br>
<a style="text-decoration: none;" class="btn btn-primary" href="{{asset('storage/'.$doc->name)}}">تحميل الوثيقة</a>
@endif
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.19.0/js/md5.min.js" integrity="sha512-8pbzenDolL1l5OPSsoURCx9TEdMFTaeFipASVrMYKhuYtly+k3tcsQYliOEKTmuB1t7yuzAiVo+yd7SJz+ijFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="{{asset('js/pdf/es6-promise.min.js?')}}" ></script>
<script src="{{asset('js/pdf/jspdf.umd.js?')}}" ></script>
<script src="{{asset('js/pdf/html2canvas.min.js?')}}" ></script>
<script src="{{ asset('js/pdf/html2pdf.js?2') }}"></script>
<script>
const downloadCharacterSheet = () => {
  
  const node = document.getElementById('id-card');
  
  html2canvas(node).then(canvas => {
    var link = document.createElement('a');
    link.download = 'card_<?=$emp->job_no?>.png';
    link.href = canvas.toDataURL()
    link.click();
});
    return 0;
    var element = document.getElementById('id-card');
var opt = {
  margin:       1,
  filename:     'myfile.pdf',
  image:        { type: 'jpeg',width:'85.6mm',height:'53.98mm' , quality: 0.98 },
  html2canvas:  { scale: 2 },
  jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
};
html2pdf().set(opt).from(element.innerHTML).save();
  
};



document.getElementById('download-button').addEventListener('click', downloadCharacterSheet);


</script>
