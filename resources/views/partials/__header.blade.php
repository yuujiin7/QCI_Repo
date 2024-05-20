<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title !== "" ? $title : 'SR System'}}</title>
    @vite('resources/css/app.css')
     

    <script src="//unpkg.com/alpinejs" defer></script>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <!-- <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.tailwindcss.js"></script>
    <script src="https://cdn.tailwindcss.com"></script> -->
    <script src="{{asset('js/main.js')}}"></script>

    
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.tailwindcss.css"> -->
    
    
</head>
<body class="bg-gray-600 min-h-screen pt-12 pb-6 px-2">
    <x-messages/>
    