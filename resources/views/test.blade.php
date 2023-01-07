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
</style>
<div >
 
    <main class="main">
   <div class="card-outer-box">
     <div id="id-card" class="card-inner-box">
       <div class="card-profile id-card__mugshot">
         <img src="{{asset('img/avater.jpg')}}" id="id-card-mugshot" alt="profile photo" />
       </div>
       <div class="card-content">
         <ul>
           <li><strong> الاسم: </strong>عرفات مطهر</li>
           <li><strong>الرقم الوظيفي: </strong>22656623</li>
           <li><strong>المسمى الوظيفي: </strong>مبرمج</li>
      
           <li><strong>البريد الالكتروني: </strong>steve@fedc.com</li>
         </ul>
       </div>
     </div>
   </div>
 </main>

</div>

<div id="id-form">
  <div class="id-form">
    <div class="id-form__row id-form__row--inline">
      <div class="id-form__label">Name</div>
      <div class="id-form__input">
        <input type="text" id="name" placeholder="Name">
      </div>
    </div>
    <div class="id-form__row id-form__row--inline">
      <div class="id-form__label">Date of Birth</div>
      <div class="id-form__input">
        <input type="text" id="date-of-birth" placeholder="Date of Birth">
      </div>
    </div>
    <div></div>
    <div class="id-form__row id-form__row--inline">
      <div class="id-form__label">Gender</div>
      <div class="id-form__input">
        <select id="gender">
          <option value="M">Male</option>
          <option value="F">Female</option>
        </select>
      </div>
    </div>
    <div class="id-form__row id-form__row--inline">
      <div class="id-form__label">Height</div>
      <div class="id-form__input">
        <input type="text" id="height" placeholder="Height">
      </div>
    </div>
    <div></div>
    <div class="id-form__row id-form__row--inline">
      <div class="id-form__label">Mugshot</div>
      <div class="id-form__input">
        <input type="file" id="mugshot" accept="image/*">
      </div>
    </div>
    <div class="id-form__row id-form__row--inline">
      <div class="id-form__label">Weight</div>
      <div class="id-form__input">
        <input type="text" id="weight" placeholder="Weight">
      </div>
    </div>
  </div>
</div>

<button id="download-button">Download</button>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.19.0/js/md5.min.js" integrity="sha512-8pbzenDolL1l5OPSsoURCx9TEdMFTaeFipASVrMYKhuYtly+k3tcsQYliOEKTmuB1t7yuzAiVo+yd7SJz+ijFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    
const downloadCharacterSheet = () => {
  
  const node = document.getElementById('id-card');
  
  html2canvas(node).then(canvas => {
    // document.body.appendChild(canvas)
    // var img    = canvas.toDataURL("image/png");
    // document.write('<img src="'+img+'"/>');
    var link = document.createElement('a');
    link.download = 'filename.png';
    link.href = canvas.toDataURL()
    link.click();
  });
  
};

const bindInputToElement = (inputEl, elementEl) => {
  inputEl.addEventListener('change', () => {
    elementEl.textContent = inputEl.value;
  });
}

document
  .getElementById('download-button')
  .addEventListener('click', downloadCharacterSheet);

document
  .querySelector('.id-card__subject-id')
  .textContent = md5('something').slice(0, 8);

// Bind name
const nameEl = document.getElementById('name');
bindInputToElement(
  nameEl,
  document.getElementById('id-card-name')
);
nameEl
  .addEventListener('change', () => {
    document
      .querySelector('.id-card__subject-id')
      .textContent = md5(nameEl.value).slice(0, 8);
  });






// Bind mugshot
document
    .getElementById('mugshot')
    .addEventListener('change', function() {
      if ( this.files && this.files[0] ) {
        var FR= new FileReader();
        FR.onload = function(e) {
           var img = document.getElementById('id-card-mugshot');
           img.src = e.target.result;
        };       
        FR.readAsDataURL( this.files[0] );
      }
    });
</script>