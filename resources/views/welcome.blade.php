<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rockwell</title>
    <link
        href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css"
        rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap"
        rel="stylesheet"
    />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: poppins;
        }
        body {
            background-color: #f2f4ff;
        }
        .container {
            width: 400px;
            background-color: #fff;
            margin: 150px auto;
            border-radius: 11px;
            padding: 40px 50px;
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        }
        /* top-header */
        .top-header h3 {
            text-align: center;
            color: #495d76;
        }
        .top-header p {
            color: #cecfd3;
            font-size: 13px;
            text-align: center;
            margin-top: 5px;
        }
        /* top-header */
        /* form */
        .user input,
        .pass input {
            width: 100%;
            height: 35px;
            border: none;
            border: 1px solid #e6e6e6;
            border-radius: 6px;
            outline: none;
            padding: 0 40px;
        }
        ::placeholder {
            color: #9ca5b4;
            font-size: 12px;
        }
        .user i,
        .pass i {
            position: relative;
            top: 31px;
            right: -10px;
            color: #3981ed;
        }
        /* form */
        /* button */
        .btn {
            display: flex;
            justify-content: center;
            margin-top: 25px;
            margin-bottom: 25px;
        }
        .btn button {
            width: 100%;
            border: none;
            height: 35px;
            background-color: #277ffd;
            color: #fff;
            border-radius: 6px;
            cursor: pointer;
        }
        /* button */
        p.last {
            text-align: center;
            position: relative;
            bottom: 120px;
            font-size: 12px;
        }

        span{
            font-size: 12px;
            color: red;
            margin-top: 7px;
            display: block;
        }
        img{
            width: 80%;
            margin: auto;
        }
        .top-header{
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="top-header">
        <img src="https://files.rockwell.com.mx/storage/logo.svg" alt="">
        <p>Ahora puedes restablecer tu contraseña de acceso</p>
    </div>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">



        <div class="user">
            <i class="bx bxs-user-circle"></i>

            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Correo Electrónico" required autofocus>
            @error('email')
            <span role="alert">{{ $message }}</span>
            @enderror
        </div>


        <div class="user">
            <i class="bx bxs-lock-alt"></i>
            <input id="password" type="password" name="password" required placeholder="Contraseña" autocomplete="new-password">
            @error('password')
            <span role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="pass">
            <i class="bx bxs-lock-alt"></i>
            <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirmar Contraseña" required>
            @error('password_confirmation')
            <span role="alert">{{ $message }}</span>
            @enderror
        </div>

        @if(session('status'))
            <p>{{ session('status') }}</p>
        @endif

        <div class="btn" type="submit">
            <button>Restablecer Contraseña</button>
        </div>
    </form>


</div>

</body>
</html>
