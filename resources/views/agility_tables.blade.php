<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Agility Tables</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
  
  <nav class="navbar navbar-light bg-light">
    <p class="navbar-brand" href="#">Agility Tables</p>
    <form class="form-inline" method="POST" action="/">
      @csrf
      <input class="form-control mr-sm-2" type="search" name="nome" placeholder="nome" aria-label="Search">
      <input class="form-control mr-sm-2" type="search" name="email" placeholder="email" aria-label="Search">
      <input class="form-control mr-sm-2" type="search" name="empresa" placeholder="empresa" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </nav>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col"> Id   </th>
        <th scope="col"> Nome </th>
        <th scope="col"> Email </th>
        <th scope="col"> Empresa </th>
        <th scope="col"> Status </th>
      </tr>
    </thead>
    <tbody>
    
    @foreach ($content as $key => $data)
      @if ($has_agility_customer or $data['customer'] == 'Agility')
        <tr class="table-success">
      @else
        <tr>
      @endif
        <th> {{ $key }} </th>
        <th scope="row"> {{ $data["name"] }} </th>
        <td> {{ $data["email"] }} </td>
        <td> {{ $data["customer"] }} </td>
        <td> {{ $data["status"] }} </td>
      </tr>
    @endforeach
   
    </tbody>
  </table>    

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
