<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[#E8DDD0] flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md border border-[#BFC3B1]">

        <h1 class="text-3xl font-bold text-center mb-6 text-[#2B221D]">
            Masuk
        </h1>

        <form action="#" method="POST">

            <div class="mb-4">
                <label class="block mb-2 font-medium text-[#2B221D]">
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    placeholder="Masukkan username"
                    class="w-full border border-[#BFC3B1] rounded-lg px-4 py-2 text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B] focus:border-[#B86E4B]">
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-medium text-[#2B221D]">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    class="w-full border border-[#BFC3B1] rounded-lg px-4 py-2 text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B] focus:border-[#B86E4B]">
            </div>

            <button
                type="submit"
                class="w-full bg-[#5B4636] text-white py-2 rounded-lg hover:bg-[#4A392C] transition duration-300">
                Masuk
            </button>

            <div>
                <p class="text-center mt-4 text-[#5B4636]">
                    Belum punya akun?
                    <a href="register.html"
                       class="font-semibold text-[#B86E4B] hover:underline">
                        Daftar
                    </a>
                </p>
            </div>

        </form>

    </div>

</body>
</html>