<?php require_once './process.php' ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Client Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <div class="flex h-screen">

    <aside class="w-64 bg-white shadow-md h-full">
        <a href="../home.php">
          <div class="p-6 text-[#cca45e] font-bold text-xl">Flesh & Vine</div>
        </a>
      
      <ul class="space-y-2 px-4 mt-6">
        <a class="text-gray-700 hover:text-green-600 cursor-pointer pb-5" href="../home.php">
            <li class="text-gray-700 hover:text-[#cca45e] cursor-pointer">🏠 Home</li>
        </a>
        <a class="text-gray-700 hover:text-green-600 cursor-pointer" href="">
            <li class="text-green-600 font-bold">🍴 My Reservations</li>
        </a>
        <a class="text-gray-700 hover:text-green-600 cursor-pointer" href="">
            <li class="text-gray-700 hover:text-green-600 cursor-pointer">📜 Booking History</li>
        </a>
      </ul>
      <div class="p-4 border-t border-gray-700 mt-[26rem]">
        <a href="../../auth/logout.php">
            <button class="w-full px-4 py-2 bg-opacity-70 bg-[#cca45e] rounded hover:bg-[#cca45e]">Logout</button>
        </a>
      </div>
    </aside>

    <main class="flex-1 px-6 py-4 overflow-y-auto bg-gray-50">
      <header class="mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Client Dashboard</h1>
      </header>

      <section class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
          <h2 class="text-xl font-semibold text-gray-700">Upcoming Reservation</h2>
          <p class="text-2xl font-bold text-[#cca45e]">
            <?php echo $next_reservation ? $next_reservation['BookingDate'] : "No Upcoming Reservations"; ?>
          </p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
          <h2 class="text-xl font-semibold text-gray-700">Total Reservations</h2>
          <p class="text-4xl font-bold text-green-600">
            <?= $total_reservations; ?>
          </p>
        </div>
      </section>

      <section class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">My Reservations</h2>
        <table class="w-full text-left border-collapse">
          <thead>
            <tr>
              <th class="p-2 border-b">Booking ID</th>
              <th class="p-2 border-b">Menu</th>
              <th class="p-2 border-b">Date</th>
              <th class="p-2 border-b">People</th>
              <th class="p-2 border-b">Status</th>
              <th class="p-2 border-b">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $client_id = $_SESSION['UserID']; 
            $query = "
              SELECT 
                bookings.BookingID, 
                menus.MenuName, 
                bookings.BookingDate, 
                bookings.NumberOfPeople, 
                bookings.Status 
              FROM 
                bookings 
              INNER JOIN 
                menus ON bookings.MenuID = menus.MenuID 
              WHERE 
                bookings.UserID = '$client_id'
              ORDER BY 
                bookings.BookingDate ASC;
            ";
            $result =mysqli_query($DBconnect,$query);

            while ($row = mysqli_fetch_assoc($result)):
            ?>
              <tr>
                <td class="p-2 border-b"><?= $row['BookingID']; ?></td>
                <td class="p-2 border-b"><?= $row['MenuName']; ?></td>
                <td class="p-2 border-b"><?= $row['BookingDate']; ?></td>
                <td class="p-2 border-b"><?= $row['NumberOfPeople']; ?></td>
                <td class="p-2 border-b"><?= $row['Status']; ?></td>
                <td class="p-2 border-b">
                  <form action="update_reservation.php" method="POST" class="inline-block">
                    <input type="hidden" name="booking_id" value="<?= $row['BookingID']; ?>">
                    <button type="submit" name="action" value="cancel" class="px-4 py-1 bg-red-500 text-white rounded">Cancel</button>
                  </form>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </section>

      <section class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Booking History</h2>
        <table class="w-full text-left border-collapse">
          <thead>
            <tr>
              <th class="p-2 border-b">Booking ID</th>
              <th class="p-2 border-b">Menu</th>
              <th class="p-2 border-b">Date</th>
              <th class="p-2 border-b">People</th>
              <th class="p-2 border-b">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query_history = "
              SELECT 
                bookings.BookingID, 
                menus.MenuName, 
                bookings.BookingDate, 
                bookings.NumberOfPeople, 
                bookings.Status 
              FROM 
                bookings 
              INNER JOIN 
                menus ON bookings.MenuID = menus.Menuid 
              WHERE 
                bookings.UserID = '$client_id' AND bookings.BookingDate < NOW()
              ORDER BY 
                bookings.BookingDate DESC;
            ";
            $history_result = mysqli_query($DBconnect,$query);
            while ($row = mysqli_fetch_assoc($history_result)):
            ?>
              <tr>
                <td class="p-2 border-b"><?= $row['BookingID']; ?></td>
                <td class="p-2 border-b"><?= $row['MenuName']; ?></td>
                <td class="p-2 border-b"><?= $row['BookingDate']; ?></td>
                <td class="p-2 border-b"><?= $row['NumberOfPeople']; ?></td>
                <td class="p-2 border-b"><?= $row['Status']; ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </section>

    </main>
  </div>

</body>
</html>
