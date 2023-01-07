<!DOCTYPE html>
<html>

<head>
    <title>تاكيد معلومات البطاقة</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
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
                        <form class="g-3" method="POST" action="{{route('confrim_info')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$emp->id}}" />
                            <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                                <p>الرجاء تاكيد معلومات البطاقة الشخصية ورفع الصورة الشخصية ووثيقة الاثبات الجواز/البطاقة الشخصية</p>
                                <div class="row align-items-center">
                                    <div class="col-lg-3 mb-4 mb-lg-0 text-center">
                                        @if(file_exists("./storage/".$emp->image))
                                        <img style="max-width:200px;" src="{{asset('storage/'.$emp->image)}}" alt="...">
                                        @else
                                        <img width="200" height="120" src="{{asset('img/avatar.png')}}" alt="...">

                                        @endif
                                        @if($emp->status==0)
                                        <input type="file" name="image" class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-md-6 px-xl-10">

                                        <ul class="list-unstyled mb-1-9 text-right">
                                            <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">الاسم:</span> {{$emp->name}}</li>
                                            <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">الرقم الوظيفي:</span> {{$emp->job_no}}</li>
                                            <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2  font-weight-600">المسمى الوظيفي:</span> {{$emp->job->title}}</li>

                                        </ul>

                                    </div>

                                </div>
                                @if($emp->status!=1)
                                <div class="row mt-2">
                                 
                                    <div class="col-md-12 my-2">
                                    <hr>
                                    رفع الوثيقة
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <div class="form-group row">
                                            <label class="col-md-4 col-lg-3 form-label">نوع الوثيقة</label>
                                            <div class="col-md-4">
                                                <select class="form-control" name="type_id" required>
                                                    @foreach($doc_types as $t)
                                                    <option value="{{$t->id}}"> {{ $t->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md">
                                                <input type="file" name="doc" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                              


                            @else
                            <div class="alert alert-success text-center">
                                تم تاكيد المعلومات بنجاح
                            </div>
                            @endif

                            @if($emp->status!=1)
                            <div class="col-12 text-right ">
                                <div class="form-check form-check-inline">

                                    <input required name="confirm" value="1" class="form-check-input" type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">
                                        اوكد ان جميع المعلومات والوثائق التي تم رفعها صحيحه
                                    </label>
                                </div>
                            </div>
                            @endif
                   
                    @if($emp->status!=1)
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">ارسال</button>
                    </div>
                    @endif
                    </div>
                    </div>
                    </form>
               
            </div>
        </div>



        </div>
        </div>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

</body>

</html>