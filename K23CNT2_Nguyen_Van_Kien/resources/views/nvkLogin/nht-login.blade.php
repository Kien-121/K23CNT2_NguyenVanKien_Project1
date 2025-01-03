<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
      body {
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
        background: linear-gradient(#141e30, #243b55);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        overflow: hidden;
      }

      .wrap {
        width: 400px;
        padding: 40px;
        background: rgba(0, 0, 0, 0.8);
        border-radius: 10px;
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.6);
        box-sizing: border-box;
      }

      .wrap h1 {
        text-transform: uppercase;
        color: #fff;
        text-align: center;
        margin-bottom: 30px;
        font-size: 28px;
        letter-spacing: 2px;
      }

      .wrap .user-box {
        position: relative;
        margin-bottom: 30px;
      }

      .wrap input {
        width: 100%;
        padding: 12px 0;
        font-size: 16px;
        color: #fff;
        border: none;
        border-bottom: 1px solid #fff;
        outline: none;
        background: transparent;
        transition: 0.3s;
      }

      .wrap .user-box label {
        position: absolute;
        top: 0;
        left: 0;
        padding: 12px 0;
        font-size: 16px;
        color: #fff;
        pointer-events: none;
        transition: 0.3s;
      }

      .wrap .user-box input:focus ~ label,
      .wrap .user-box input:valid ~ label {
        top: -22px;
        left: 0;
        color: aqua;
        font-size: 12px;
      }

      .wrap .login {
        width: 100%;
        padding: 14px 20px;
        color: #fff;
        font-size: 16px;
        text-transform: uppercase;
        background: #243b55;
        border: none;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 20px;
        border-radius: 5px;
      }

      .wrap .login:hover {
        background: aqua;
        color: #fff;
        box-shadow: 0 0 10px aqua, 0 0 20px aqua, 0 0 30px aqua;
      }

      .wrap a {
        display: block;
        text-align: center;
        margin-top: 20px;
        text-decoration: none;
        color: rgb(132, 255, 255);
        transition: 0.3s;
      }

      .wrap a:hover {
        text-decoration: underline;
        color: #fff;
      }

      .wrap .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #fff;
        margin-top: 10px;
      }

      .wrap .remember {
        display: flex;
        align-items: center;
      }

      .wrap .remember input {
        margin-right: 8px;
      }

      .wrap .forget {
        text-decoration: none;
        color: rgb(132, 255, 255);
        margin-left: 10px;
      }

      .wrap .forget:hover {
        color: #fff;
        text-decoration: underline;
      }

      .wrap .next {
        display: inline-block;
        color: #fff;
        text-decoration: none;
        margin-top: 20px;
        text-align: center;
      }

      .wrap .next:hover {
        text-decoration: underline;
        color: aqua;
      }

      /* Styling for error messages */
      .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
      }

      /* Hide the 'Forgot password?' link and 'Go Back' button when "Remember me" is checked */
      .hidden-when-remembered {
        display: block;
      }

      .hidden-when-remembered.hidden {
        display: none;
      }
    </style>
</head>
<body>

    <div class="wrap">
        <h1>Login</h1>
        <form action="{{ route('admins.nhtloginSubmit') }}" method="POST">
            @csrf

            <div class="user-box">
                <input type="text" name="nhtTaiKhoan" id="nhtTaiKhoan" value="{{ old('nhtTaiKhoan') }}" />
                <label for="nhtTaiKhoan">Username</label>
                @error('nhtTaiKhoan')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="user-box">
                <input type="password" name="nhtMatKhau" id="nhtMatKhau" />
                <label for="nhtMatKhau">Password</label>
                @error('nhtMatKhau')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me and Forget Password -->
            <div class="remember-forgot">
                <div class="remember">
                    <input type="checkbox" id="remember" name="remember" onclick="toggleForgetPassword()" />
                    <label for="remember">Remember me</label>
                </div>
            </div>

            <input type="submit" value="Login" class="login" />

        </form>

        <a href="#" class="next hidden-when-remembered" id="goBackLink">Go Back</a>
    </div>

    <script>
      // JavaScript function to handle "Remember me" functionality and show/hide elements
      function toggleForgetPassword() {
        const isChecked = document.getElementById('remember').checked;
        
        // Hide 'Forgot password?' and 'Go Back' if "Remember me" is checked
        const forgetPasswordLink = document.getElementById('forgotPasswordLink');
        const goBackLink = document.getElementById('goBackLink');
        
        if (isChecked) {
          forgetPasswordLink.classList.add('hidden');
          goBackLink.classList.add('hidden');
        } else {
          forgetPasswordLink.classList.remove('hidden');
          goBackLink.classList.remove('hidden');
        }
        
        // If "Remember me" is checked, store credentials in cookies
        if (isChecked) {
          const username = document.getElementById('nhtTaiKhoan').value;
          const password = document.getElementById('nhtMatKhau').value;
          document.cookie = `nhtTaiKhoan=${username}; path=/; max-age=31536000`; // 1 year
          document.cookie = `nhtMatKhau=${password}; path=/; max-age=31536000`; // 1 year
        } else {
          // Remove cookies when "Remember me" is unchecked
          document.cookie = 'nhtTaiKhoan=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC';
          document.cookie = 'nhtMatKhau=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC';
        }
      }
      
      // Auto-fill credentials if "Remember me" cookies are available
      window.onload = function() {
        const cookies = document.cookie.split(';');
        let username = '';
        let password = '';
        cookies.forEach(cookie => {
          if (cookie.trim().startsWith('nhtTaiKhoan=')) {
            username = cookie.trim().split('=')[1];
          }
          if (cookie.trim().startsWith('nhtMatKhau=')) {
            password = cookie.trim().split('=')[1];
          }
        });

        if (username && password) {
          document.getElementById('nhtTaiKhoan').value = username;
          document.getElementById('nhtMatKhau').value = password;
          document.getElementById('remember').checked = true;
          toggleForgetPassword();
        }
      };
    </script>

</body>
</html>