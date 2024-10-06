<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $global_setting['app_name'] }} - {{$data->title}}</title>
    <meta name="description" content="{{ $data->meta_description }}">
    <meta name="keywords" content="{{ $data->meta_keywords }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/logo/' . $global_setting['app_favicon']) }}" type="image/x-icon">

    <!-- Google Fonts & Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM9zY5mFLFMRfmxwH5DPCOMvLG5O/vq9PYStk58" crossorigin="anonymous">

    <style>
        body {
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .card img {
            object-fit: cover;
            height: 300px;
            width: 100%;
        }

        .card-body {
            background-color: #fff;
            padding: 30px;
        }

        .group-header {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #495057;
        }

        .list-group {
            margin-bottom: 20px;
        }

        .list-group-item {
            border: none;
            padding: 10px 15px;
            background-color: #e9ecef;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .list-group-item strong {
            font-weight: 600;
        }

        .list-group-item i {
            margin-right: 8px;
            color: #007bff;
        }

        .badge {
            padding: 5px 10px;
            font-size: 14px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
<section class="container py-5">
    <div class="card border-0 shadow-lg">
        <!-- Gambar Armada -->
        <img src="{{ asset('storage/project/' . $data->image) }}" class="img-fluid" alt="{{$data->slug}}">

        <!-- Spesifikasi Armada -->
        <div class="card-body">
            <h3 class="card-title text-center mb-4">{{ $data->title }}</h3>

            <!-- Informasi Umum -->
            <div class="group-header">Informasi Umum</div>
            <ul class="list-group">
                <li class="list-group-item"><i class="fas fa-barcode"></i> <strong>Link Project:</strong> <a href="{{ $data->link }}" >{{ $data->link }}</a></li>
            </ul>

            <!-- Deskripsi Armada -->
            <div class="group-header">Deskripsi</div>
            <div class="card-text mb-4">{!! $data->content !!}</div>
        </div>
    </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
