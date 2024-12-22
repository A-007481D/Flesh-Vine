<?php  
require_once '../config/dbconfig.php';

session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] != 2) {
    header("Location: ../views/login.php");
    exit();
}

// header("Cache-Control: no-cache, must-revalidate");
// header("Pragma: no-cache");

$UserID = isset($_SESSION['UserID']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menuID = isset($_POST['MenuID']) ? (int)$_POST['MenuID'] : 0;
    $bookingDate = isset($_POST['BookingDate']) ? mysqli_real_escape_string($DBconnect, $_POST['BookingDate']) : '';
    $numberOfPeople = isset($_POST['NumberOfPeople']) ? (int)$_POST['NumberOfPeople'] : 0;

    if ($UserID <= 0 || $menuID <= 0 || empty($bookingDate) || $numberOfPeople <= 0) {
        echo "Error: input data. Please try again.";
        exit();
    }

    $menuCheckQuery = "SELECT MenuID FROM menus WHERE MenuID = $menuID";
    $menuCheckResult = mysqli_query($DBconnect, $menuCheckQuery);

    // if (mysqli_num_rows($menuCheckResult) === 0) {
    //     echo "Error: The selected menu does not exist.";
    //     exit();
    // }

    $sql = "INSERT INTO bookings (UserID, MenuID, BookingDate, NumberOfPeople, Status) 
            VALUES ($UserID, $menuID, '$bookingDate', $numberOfPeople, 'Pending')";

    if (mysqli_query($DBconnect, $sql)) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Booking Successful',
                text: 'Your booking has been added successfully!',
            }).then(() => {
                window.location.href = '../success_page.php';
            });
        </script>";
        exit();
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Database Error',
                text: '" . mysqli_error($DBconnect) . "'
            });
        </script>";
    }
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Invalid Request',
            text: 'Please submit the form correctly!'
        });
    </script>";
}
?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Merienda:wght@300..900&family=Poppins:wght@500&family=Sansita+Swashed:wght@300..900&display=swap"
        rel="stylesheet">
    <style>
        @layer utilities {
            .font-merienda {
                font-family: 'Merienda', cursive;
            }
        }

        html {
            scroll-behavior: smooth;
        }
    </style>

    <title>Flesh & Vine</title>
</head>

<body class="text-white bg-[url('../img/background.jpg')] bg-cover bg-fixed ">
    <header id="header" class="fixed top-0 flex bg-gray-700 bg-opacity-50 w-full z-50 items-center justify-around h-[10vh]">
    <a href="home.php" class="logo">
        <img width="100rem" src="" alt="">Flesh & Vine
    </a>

    <ul class="flex flex-col p-2 md:p-0 mt-4 font-thin rounded-lg md:space-x-8 md:flex-row md:mt-0">
        <li><a class="hover:text-[#cca45e]" href="#">Home</a></li>
        <li><a class="hover:text-[#cca45e]" href="#menu">Menu</a></li>
        <li><a class="hover:text-[#cca45e]" href="#">Specials</a></li>
        <li><a class="hover:text-[#cca45e]" href="events.php">Events</a></li>
        <li><a class="hover:text-[#cca45e]" href="#">Chef</a></li>
        <li><a class="hover:text-[#cca45e]" href="#">Gallery</a></li>
        <li><a class="hover:text-[#cca45e]" href="#">Contact</a></li>
    </ul>

    <?php if (isset($_SESSION['email'])): ?>
        <div id="profile-header" class="flex items-center justify-between space-x-4">
            <span class="text-white font-medium">
                Welcome, 
                <?php
                $email = $_SESSION['email'];
                $fetchName = mysqli_query($DBconnect, "SELECT * FROM users WHERE users.Email = '$email'");
                if ($row = mysqli_fetch_array($fetchName)) {
                    echo $row['FirstName'] . ' ' . $row['LastName'];
                }
                ?>
            </span>
            <a href="../views/client/dashboard.php">
                <button 
                    class="text-white bg-transparent hover:bg-blue-500 border-solid border-2 border-blue-500 focus:ring-2 focus:outline-none focus:ring-blue-500 font-medium rounded-full text-sm px-4 py-2 text-center">
                    Profile
                </button>
            </a>
            <a href="../auth/logout.php">
                <button id="logout-btn" 
                    class="text-white bg-transparent hover:bg-red-500 border-solid border-2 border-red-500 focus:ring-2 focus:outline-none focus:ring-red-500 font-medium rounded-full text-sm px-4 py-2 text-center">
                    Logout
                </button>
            </a>
        </div>
    <?php else: ?>
        <a href="../views/login.php" id="sign-in-btn" class="sm:flex">
            <button type="button" 
                class="text-white bg-transparent hover:bg-[#cca45e] border-solid border-2 border-[#cca45e] focus:ring-2 focus:outline-none focus:ring-[#cca45e] font-medium rounded-full text-sm px-4 py-2 text-center">
                Sign In
            </button>
        </a>
    <?php endif; ?>
</header>



    <section id="home" class="pt-20 px-36 h-[109vh] text-white flex flex-col justify-center">
        <h1 class="font-merienda font-bold text-start mb-6 text-6xl">Savor Every <span
                class="text-[#cca45e]">Bite.</span> <br> Discover Culinary Perfection.</h1>
        <div class="">
            <button
                class="bg-transparent hover:bg-[#cca45e] border-solid border-2 border-[#cca45e] text-xl mb-1 rounded-full py-1 px-4">OUR
                <a href="#menu">MENU</a>
            </button>
            
            <button
                class="bg-transparent hover:bg-[#cca45e] border-solid border-2 border-[#cca45e] text-xl mb-1 rounded-full py-1 px-4">
                <a href="#reservation">BOOK NOW</a>
            </button>
            <div class="flex items-center justify-center pt-28">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 animate-bounce text-center" fill="none"
                    viewBox="0 0 20 20" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </div>

        </div>
    </section>
<section id="menu" class="pt-20 px-36 bg-[#0d0c0a] opacity-80">
    <div class="flex flex-col">
        <p class="font-normal text-gray-200">MENU</p>
        <hr class="w-28 mt-2 border-2">
    </div>
    <h3 class="mt-2 text-3xl font-semibold text-[#cca45e]">Check Our Tasty Menu</h3>
    <div id="menu-header" class="flex bg-opacity-50 w-full z-50 items-center justify-around h-[10vh]">
        <ul class="flex flex-col p-2 md:p-0 mt-4 font-thin rounded-lg md:space-x-8 md:flex-row md:mt-0">
            <li><a href="#" class="hover:text-[#cca45e] hover:border-b border-[#cca45e] hover:border-b-2 font-normal text-2xl">All</a></li>
            <li><a href="#" class="hover:text-[#cca45e] hover:border-b border-[#cca45e] hover:border-b-2 font-normal text-2xl">Starters</a></li>
            <li><a href="#" class="hover:text-[#cca45e] hover:border-b border-[#cca45e] hover:border-b-2 font-normal text-2xl">Salads</a></li>
            <li><a href="#" class="hover:text-[#cca45e] hover:border-b border-[#cca45e] hover:border-b-2 font-normal text-2xl">Specialty</a></li>
        </ul>
    </div>

    <div class="container grid grid-cols-3 gap-2 mt-14">
        <div class="card w-[22rem] h-[20rem] flex flex-col">
            <a href="#" class="bg-white p-2 rounded-lg border shadow-lg hover:scale-[1.01] duration-300 h-full flex flex-col">
                <div class="h-[17rem] w-full overflow-hidden rounded">
                    <img src="../img/1.jpg" alt="Place Image" class="w-full h-full object-cover">
                </div>
                <h2 class="text-lg font-medium text-black mt-2 flex-grow">Place Name</h2>
                <p class="text-black font-thin mt-2">
                    Location
                    <span class="text-black font-medium float-right p-1 hover:scale-110">$115</span>
                </p>
            </a>
        </div>
        <div class="card w-[22rem] h-[20rem] flex flex-col">
            <a href="#" class="bg-white p-2 rounded-lg border shadow-lg hover:scale-[1.01] duration-300 h-full flex flex-col">
                <div class="h-[17rem] w-full overflow-hidden rounded">
                    <img src="../img/3.jpg" alt="Place Image" class="w-full h-full object-cover">
                </div>
                <h2 class="text-lg font-medium text-black mt-2 flex-grow">Place Name</h2>
                <p class="text-black font-thin mt-2">
                    Location
                    <span class="text-black font-medium float-right p-1 hover:scale-110">$115</span>
                </p>
            </a>
        </div>
        <div class="card w-[22rem] h-[20rem] flex flex-col">
            <a href="#" class="bg-white p-2 rounded-lg border shadow-lg hover:scale-[1.01] duration-300 h-full flex flex-col">
                <div class="h-[17rem] w-full overflow-hidden rounded">
                    <img src="../img/2.jpg" alt="Place Image" class="w-full h-full object-cover">
                </div>
                <h2 class="text-lg font-medium text-black mt-2 flex-grow">Place Name</h2>
                <p class="text-black font-thin mt-2">
                    Location
                    <span class="text-black font-medium float-right p-1 hover:scale-110">$115</span>
                </p>
            </a>
        </div>
        <div class="card w-[22rem] h-[20rem] flex flex-col">
            <a href="#" class="bg-white p-2 rounded-lg border shadow-lg hover:scale-[1.01] duration-300 h-full flex flex-col">
                <div class="h-[17rem] w-full overflow-hidden rounded">
                    <img src="../img/3.jpg" alt="Place Image" class="w-full h-full object-cover">
                </div>
                <h2 class="text-lg font-medium text-black mt-2 flex-grow">Place Name</h2>
                <p class="text-black font-thin mt-2">
                    Location
                    <span class="text-black font-medium float-right p-1 hover:scale-110">$115</span>
                </p>
            </a>
        </div>
        <div class="card w-[22rem] h-[20rem] flex flex-col">
            <a href="#" class="bg-white p-2 rounded-lg border shadow-lg hover:scale-[1.01] duration-300 h-full flex flex-col">
                <div class="h-[17rem] w-full overflow-hidden rounded">
                    <img src="../img/4.jpg" alt="Place Image" class="w-full h-full object-cover">
                </div>
                <h2 class="text-lg font-medium text-black mt-2 flex-grow">Place Name</h2>
                <p class="text-black font-thin mt-2">
                    Location
                    <span class="text-black font-medium float-right p-1 hover:scale-110">$115</span>
                </p>
            </a>
        </div>
        <div class="card w-[22rem] h-[20rem] flex flex-col">
            <a href="#" class="bg-white p-2 rounded-lg border shadow-lg hover:scale-[1.01] duration-300 h-full flex flex-col">
                <div class="h-[17rem] w-full overflow-hidden rounded">
                    <img src="../img/5.jpg" alt="Place Image" class="w-full h-full object-cover">
                </div>
                <h2 class="text-lg font-medium text-black mt-2 flex-grow">Place Name</h2>
                <p class="text-black font-thin mt-2">
                    Location
                    <span class="text-black font-medium float-right p-1 hover:scale-110">$115</span>
                </p>
            </a>
        </div>
        <div class="card w-[22rem] h-[20rem] flex flex-col">
            <a href="#" class="bg-white p-2 rounded-lg border shadow-lg hover:scale-[1.01] duration-300 h-full flex flex-col">
                <div class="h-[17rem] w-full overflow-hidden rounded">
                    <img src="../img/6.jpg" alt="Place Image" class="w-full h-full object-cover">
                </div>
                <h2 class="text-lg font-medium text-black mt-2 flex-grow">Place Name</h2>
                <p class="text-black font-thin mt-2">
                    Location
                    <span class="text-black font-medium float-right p-1 hover:scale-110">$115</span>
                </p>
            </a>
        </div>
        <div class="card w-[22rem] h-[20rem] flex flex-col">
            <a href="#" class="bg-white p-2 rounded-lg border shadow-lg hover:scale-[1.01] duration-300 h-full flex flex-col">
                <div class="h-[17rem] w-full overflow-hidden rounded">
                    <img src="../img/7.jpg" alt="Place Image" class="w-full h-full object-cover">
                </div>
                <h2 class="text-lg font-medium text-black mt-2 flex-grow">Place Name</h2>
                <p class="text-black font-thin mt-2">
                    Location
                    <span class="text-black font-medium float-right p-1 hover:scale-110">$115</span>
                </p>
            </a>
        </div>
        <div class="card w-[22rem] h-[20rem] flex flex-col">
            <a href="#" class="bg-white p-2 rounded-lg border shadow-lg hover:scale-[1.01] duration-300 h-full flex flex-col">
                <div class="h-[17rem] w-full overflow-hidden rounded">
                    <img src="../img/8.jpg" alt="Place Image" class="w-full h-full object-cover">
                </div>
                <h2 class="text-lg font-medium text-black mt-2 flex-grow">Place Name</h2>
                <p class="text-black font-thin mt-2">
                    Location
                    <span class="text-black font-medium float-right p-1 hover:scale-110">$115</span>
                </p>
            </a>
        </div>
        
        
    </div>
</section>

<section id="reservation" class="pt-20 px-36 bg-[#0d0c0a] opacity-80">
    <div class="text-start mb-10">
        <h2 class="text-4xl font-semibold text-[#cca45e]">Reservation</h2>
        <p class="text-gray-300 mt-4">Book a cooking session with the exquisite chef for a memorable dining experience.</p>
    </div>
    <form action="<?= $_SERVER["PHP_SELF"]?>" method="post">
        <div id="booking" class="z-10 mx-auto bg-[#0f0b08] bg-opacity-30 shadow-lg rounded-lg w-[80%]">
            <div class="grid grid-cols-3 gap-6 px-6 py-4">
              
                <div class="flex flex-col">
                    <label class="text-white text-sm font-medium mb-2">Full Name</label>
                    <input
                        name="FullName"
                        class="p-3 bg-[#0f0b08] border border-[#cca45e] rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-[#cca45e]"
                        type="text" placeholder="Name & Last Name" required>
                </div>

                <div class="flex flex-col">
                    <label class="text-white text-sm font-medium mb-2">Email</label>
                    <input name="BookerEmail"
                        class="bg-[#0f0b08] p-3 border border-[#cca45e] rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-[#cca45e]"
                        type="email" placeholder="email@mail.com" required>
                </div>

                <div class="flex flex-col">
                    <label class="text-white text-sm font-medium mb-2">Phone</label>
                    <input name="BookerPhone"
                        class="bg-[#0f0b08] p-3 border border-[#cca45e] rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-[#cca45e]"
                        type="number" placeholder="+212 65645588" required>
                </div>

                <div class="flex flex-col">
                    <label class="text-white text-sm font-medium mb-2"># of People</label>
                    <select name="NumberOfPeople"
                        class="bg-[#0f0b08] p-3 border border-[#cca45e] rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-[#cca45e]">
                        <option value="1">1 Person</option>
                        <option value="2">2 People</option>
                        <option value="3">3 People</option>
                        <option value="4">4 People</option>
                        <option value="5">5 People</option>
                        <option value="6">6 People</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label class="text-white text-sm font-medium mb-2">Date</label>
                    <input name="BookingDate"
                        class="bg-[#0f0b08] p-3 border border-[#cca45e] rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-[#cca45e]"
                        type="datetime-local" required>
                </div>

                <div class="flex flex-col">
                    <label class="text-white text-sm font-medium mb-2">Menu</label>
                    <select name="MenuID"
                        class="bg-[#0f0b08] p-3 border border-[#cca45e] rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-[#cca45e]">
                        <?php
                        $menuQuery = "SELECT MenuID, MenuName FROM menus";
                        $menuResult = mysqli_query($DBconnect, $menuQuery);
                        while ($menu = mysqli_fetch_assoc($menuResult)) {
                            echo "<option value='{$menu['MenuID']}'>{$menu['MenuName']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="flex justify-end px-6 pb-4">
                <button
                    class="w-[20%] bg-transparent hover:bg-[#cca45e] border-solid border-2 border-[#cca45e] text-[#cca45e] hover:text-white py-3 rounded-md text-sm font-medium transition-all">
                    Book
                </button>
            </div>
        </div>
    </form>
</section>
<!--  -->

<footer class="bg-[#0d0c0a] px-6 md:px-20 py-8 border-t border-[#38342b]">
    <div class="mx-auto grid grid-cols-2 md:grid-cols-4 gap-8 text-gray-400 text-lg ">
        <div class="flex  ">
            <a href="">
                <img src="" class="h-24 w-full" alt="F&V Logo">
            </a>
        </div>
        <div class=" md:mt-8 md:ml-2 pt-8 md:pt-0">
            <h3 class="text-slate-50 font-bold text-[20px] md:text-[22px] mb-4"></h3> <hr class="p-2 w-12">
            <p class="text-white hover:text-[#cca45e] text-[20px] mb-4"><a href="#"></a></p>
            <p class="text-white hover:text-[#cca45e] text-[18px]"><a href="#"></a></p>
        </div>
        <div class="md:mt-8 pl-5 md:pl-0 md:ml-5">
            <h3 class="text-slate-50 font-bold text-[20px] md:text-[22px] mb-4">Useful Links</h3> <hr class="p-2 w-12">
            <p class="text-white hover:text-[#cca45e] text-[20px] mb-4"><a href="">Menus</a></p>
            <p class="text-white hover:text-[#cca45e] text-[20px] mb-4"><a href="">Book a reservation</a></p>
        </div>
        <div class=" md:mt-8 ">
            <h3 class="text-slate-50 font-bold text-[20px] md:text-[22px] mb-4">Serivces</h3> <hr class="p-2 w-12">
            <p class="text-white hover:text-[#cca45e] mb-4"><a href="#">Private Dining Experiences</a></p>
            <p class="text-white hover:text-[#cca45e] text-[20px]"><a href="#">Cooking Masterclasses</a></p>
        </div>
    </div>
    <div id="socials-icons" class="flex justify-center gap-6 mt-8">
        <a href="#"><img src="../img/Facebook.png" alt="Facebook" class="h-6 w-6 md:h-12 md:w-12"></a>
        <a href="#"><img src="../img/Instagram.png" alt="Instagram" class="h-6 w-6 md:h-12 md:w-12"></a>
        <a href="#"><img src="../img/Twitch.png" alt="Twitert" class="h-6 w-6 md:h-12 md:w-12"></a>
        <a href="#"><img src="../img/Discord.png" alt="Discord" class="h-6 w-6 md:h-12 md:w-12"></a>
    </div>
    <div class="flex justify-center mt-6 p-5 border-t border-[#38342b]">
        <h3 class="text-white font-normal text-[13px] md:text-sm text-center">© 2024 Abdelmalek. All rights
            reserved | Flesh & Vine
        </h3>
    </div>
</footer>







</body>

</html>