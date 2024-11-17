<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
    :root {
        --color1: #243642;
        --color2: #387478;
        --color3: #74b09c;
        --color4: #E2F1E7;
    }

    /* .hidden {
        display: none;
    }

    .navbar {
        transition: top 0.3s ease-in-out;
    } */

    #search {
        /* Safari */
        position: sticky;
        top: 0px;
    }
</style>

<body class="bg-[#F8F9FA]">
    <!-- Header -->
    <nav class="navbar bg-teal-700 p-2 flex items-center justify-between top-0 left-0 right-0 z-10">
        <!-- Nama Aplikasi -->
        <div class="text-white text-xl font-bold">EasySupply</div>

        <!-- Bagian Profil -->
        <div class="relative">
            <button id="profileButton" class="focus:outline-none">
                <img src="https://via.placeholder.com/40" alt="Profile"
                    class="w-10 h-10 rounded-full border-2 border-white">
            </button>
            <!-- Dropdown Menu -->
            <div id="profileMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-30">
                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Profile</a>
                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Settings</a>
                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Search & Partner Info -->
    <div id="search"
        class="mb-5 px-6 py-2 bg-white flex justify-between shadow items-center top-16 left-0 right-0 z-20">
        <input type="text" placeholder="Mau Belanja apa hari ini?" class="p-2 border border-gray-300 rounded w-full">
    </div>

    <div class="mt-5">
        @yield('content')
    </div>

    <!-- Chat Button -->
    <div id="keranjang"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Fungsi AJAX untuk menambahkan ke keranjang
        function addToCart(id, quantity) {
            $.ajax({
                url: `{{ route('addToCart') }}`, // Sesuaikan dengan route Laravel
                method: 'POST',
                data: {
                    id: id,
                    quantity: quantity,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);
                    if (response.totalPesanan !== undefined) {
                        // Menampilkan elemen keranjang
                        const element = `
                            <div class="fixed bottom-0 left-0 right-0 flex justify-center bg-white z-20">
                                <button class="bg-green-500 text-white py-2 px-6 my-2 mx-4 w-full rounded shadow-lg">
                                    Keranjang | ${response.totalPesanan} Pesanan
                                </button>
                            </div>
                        `;
                        document.getElementById('keranjang').innerHTML = element;
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // // Menangani search saat scroll
        // let prevScrollPos = window.pageYOffset;
        // const search = document.getElementById('search');

        // window.addEventListener('scroll', function () {
        //     const currentScrollPos = window.pageYOffset;
        //     if (prevScrollPos > currentScrollPos) {
        //         // Scroll ke atas, tampilkan search
        //         search.style.top = "";
        //     } else {
        //         // Scroll ke bawah, sembunyikan search
        //         search.style.top = "-100px";
        //     }
        //     prevScrollPos = currentScrollPos;
        // });

        // Toggle Profile Dropdown
        const profileButton = document.getElementById('profileButton');
        const profileMenu = document.getElementById('profileMenu');

        profileButton.addEventListener('click', (e) => {
            e.stopPropagation(); // Mencegah event bubbling
            profileMenu.classList.toggle('hidden');
        });

        // Klik di luar dropdown untuk menutup
        window.addEventListener('click', (e) => {
            if (!profileButton.contains(e.target) && !profileMenu.contains(e.target)) {
                profileMenu.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
