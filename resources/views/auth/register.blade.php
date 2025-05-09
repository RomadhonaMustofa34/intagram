<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #6c63ff, #a084e8);
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      background-color: #fff;
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      transition: all 0.3s ease;
    }

    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      font-size: 14px;
      color: #555;
      margin-bottom: 6px;
      display: block;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 8px;
      transition: 0.2s;
    }

    input:focus {
      border-color: #6c63ff;
      outline: none;
      box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2);
    }

    button {
      width: 100%;
      padding: 12px;
      background: #6c63ff;
      color: #fff;
      font-weight: 600;
      font-size: 15px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background: #554ed6;
    }

    p {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
      color: #666;
    }

    a {
      color: #6c63ff;
      text-decoration: none;
      font-weight: 500;
    }

    a:hover {
      text-decoration: underline;
    }

    .alert {
      background-color: #f8d7da;
      color: #721c24;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 5px;
      font-size: 14px;
    }

    .alert ul {
      margin: 0;
      padding-left: 20px;
    }

    .alert ul li {
      list-style-type: disc;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Register</h1>
    
    <!-- Error Handling -->
    @if ($errors->any())
      <div class="alert">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    
    <form action="{{ route('register.post') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="name">Name</label>
        <input placeholder="Masukkan nama anda" type="text" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input placeholder="Masukkan email anda" type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input placeholder="Masukkan password anda" type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input placeholder="Konfirmasi password anda" type="password" id="password_confirmation" name="password_confirmation" required>
      </div>
      <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
  </div>
</body>
</html>
