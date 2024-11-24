<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <form id="loginForm">
        <h2>Login</h2>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Login</button>
    </form>

    <script>
        apiUrl = "{{ env('API_URL') }}";
        const loginForm = document.getElementById('loginForm');
        loginForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            try {
                const response = await axios.post(`${apiUrl}/api/login`, {
                    email: email,
                    password: password
                });

                // Simpan token ke localStorage
                localStorage.setItem('token', response.data.token);
                localStorage.setItem('id', response.data.id);

                window.location.href = '/beranda';
            } catch (error) {
                alert('Login failed: ' + error.response.data.message);
            }
        });
    </script>
</body>
</html>
