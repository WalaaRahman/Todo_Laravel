<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



      {{  session()->get('Message')  }}  

  
  <div class="container">
  <div class="card p-5 m-3">
<form  action="{{ url('/task')  }}"   method="post"   enctype ="multipart/form-data">
@csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" name="title" class="form-control"  aria-describedby="emailHelp" >
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Description</label>
    <input type="text" name="description" class="form-control"  aria-describedby="emailHelp" >
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Started At</label>
    <input type="date" name="start_date" class="form-control"  >
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">End At</label>
    <input type="date" name="end_date" class="form-control" >
  </div>

  <div class="form-group">
        <label for="exampleInputEmail1">Image </label>
        <input type="file" name="image">
    </div>

  
  <button type="submit" class="btn btn-primary">Add</button>
</form>
</div>
</div>
</body>
</html>