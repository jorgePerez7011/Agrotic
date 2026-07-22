@extends('layouts.app')

@section('content')

<style id="" media="all">
  * {
      -webkit-box-sizing: border-box;
      box-sizing: border-box
  }

  body {
      padding: 0;
      margin: 0;
      background-color: blue; 
  }

  #notfound {
      position: relative;
      height: 100vh;
      background-color: #fff;
      overflow: hidden;
  }

  #notfound .notfound {
      position: absolute;
      left: 50%;
      top: 50%;
      -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
      z-index: 1;
      text-align: center; 
  }

  #notfound .title {
      font-size: 24px;
      font-weight: bold;
      color: #000; 
      margin-bottom: 20px; 
  }

  #notfound .notfound-image {
      background-image: url('https://64.media.tumblr.com/0e7b2450131b182080e172cf40330042/8d4b6cd7ecc9c492-73/s1280x1920/6254c286354538c4fa921b8e58b8aced0fa67a69.gifv');
      background-size: contain; 
      background-repeat: no-repeat;
      background-position: center;
      padding: 250px; 
      border-radius: 10px;
      
  }

  .btn-home {
      background-color: #add8e6; 
      color: #000;
      font-weight: bold; 
      border: 2px solid #000; 
      padding: 10px 20px;
      border-radius: 5px; 
      text-decoration: none; 
      transition: background-color 0.3s, color 0.3s; 
  }

  .btn-home:hover {
      background-color: #b0e0e6; 
      color: #000; 
  }
</style>

<div id="notfound">
    <div class="notfound">
        <div class="title">Estamos trabajando en este apartado, visitanos luego</div> 
        <div class="notfound-image"></div> 
        <a href="{{ secure_url('/home') }}" class="btn-home">Ir a Inicio</a> 
    </div>
</div>

@endsection
