<!DOCTYPE html>
<html>

<head>
    <title>اشعار الموظفين بتاكيد معلومات البطاقة</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.16/sweetalert2.min.css" integrity="sha512-NvuRGlPf6cHpxQqBGnPe7fPoACpyrjhlSNeXVUY7BZAj1nNhuNpRBq3osC4yr2vswUEuHq2HtCsY2vfLNCndYA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>
    <section class="bg-light">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 mb-4 mb-sm-5">
                    <div class="card card-style1 border-0">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form class="g-3" method="POST" action="{{route('send_noify')}}">
                            @csrf
                            <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-10">
                                <p>اشعار الموظفين بتاكيد معلومات البطاقة</p>

                                <div class="form-group row">
                                    <label class="col-md-4 col-lg-3 form-label">ارسال الاشعار الى </label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="send_to[]" required multiple>
                                            <option value="all"> الى كل الموظفين الذين لم يتم تاكيد بيناتهم
                                            </option>

                                            @foreach($employees as $v)
                                            <option value="{{$v->id}}"> {{ $v->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <br>
                                <div class="form-group row">
                                    <label class="col-md-4 col-lg-3 form-label">نص الاشعار </label>
                                    <div class="col-md-8">
                                        <textarea rows="6" name="message" class="form-control" required>الرجاء تاكيد معلومات البطاقة من خلال الرابط  الحالي</textarea>
                                    </div>

                                </div>






                                <br>
                                <div class="form-group row">
                                <label class="col-md-4 col-lg-3 "></label>

                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">ارسال</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>



        </div>
        </div>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.16/sweetalert2.min.js" integrity="sha512-4aFcnPgoxsyUPgn8gNinplVIEoeBizjYPTpmOaUbC3VZQCsRnduAOch9v0Pn30yTeoWq1rIZByAE4/Gg79VPEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function(){
    $("select").select2({"dir":"rtl"});
    });
</script>
<?php if(isset($msg) && $msg){ ?>
<script>
    $(document).ready(function(){
Swal.fire({
  icon: 'نجاح',
  title: 'تم ارسال الاشعار بنجاح',
  timer: 3000
});
});
</script>
<?php } ?>

</body>

</html>