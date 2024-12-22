<?php require_once './process.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Client Side</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <div class="flex h-screen">

    <aside class="w-64 bg-white shadow-md h-full">
        <a href="../home.php"><div class="p-6 text-[#cca45e] font-bold text-xl">Flesh & Vine</div></a>
      
      <ul class="space-y-2 px-4 mt-6">
        <a class="text-gray-700 hover:text-green-600 cursor-pointer pb-5" href="../home.php">
            <li class="text-gray-700 hover:text-[#cca45e] cursor-pointer">🏠 Home</li>
        </a>

        <a class="text-gray-700 hover:text-green-600 cursor-pointer" href="">
            <li class="text-green-600 font-bold">📜 Reservations</li>
        </a>
    
        <a class="text-gray-700 hover:text-green-600 cursor-pointer" href="">
            <li class="text-gray-700 hover:text-green-600 cursor-pointer">🍴 Menus & Plates</li>
        </a>

        <a class="text-gray-700 hover:text-green-600 cursor-pointer" href="">
            <li class="text-gray-700 hover:text-green-600 cursor-pointer">📜 Order History</li>
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
    <h1 class="text-2xl font-bold text-gray-800">Chef Dashboard</h1>
  </header>

  <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-xl font-semibold text-gray-700">Pending Requests</h2>
      <p class="text-4xl font-bold text-[#cca45e]"><?= $pending_requests; ?></p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-xl font-semibold text-gray-700">Approved for Today</h2>
      <p class="text-4xl font-bold text-green-600"><?= $approved_today; ?></p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-xl font-semibold text-gray-700">Approved for Tomorrow</h2>
      <p class="text-4xl font-bold text-blue-500"><?= $approved_tomorrow; ?></p>
    </div>
  </section>

  <section class="mb-6 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold text-gray-700">Next Client</h2>
    <?php if ($next_client): ?>
        <p class="mt-4 text-gray-600">
            <strong>Name:</strong> <?= $next_client['FirstName']; ?><br>
            <strong>Reservation Time:</strong> <?= $next_client['BookingDate']; ?>
        </p>
    <?php else: ?>
        <p class="text-gray-500">No upcoming bookings.</p>
    <?php endif; ?>
</section>


  <section class="mb-6 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold text-gray-700">Total Registered users</h2>
    <p class="text-4xl font-bold text-gray-800"><?= $total_users; ?></p>
  </section>

  <section class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Manage Bookings</h2>
    <table class="w-full text-left border-collapse">
        <thead>
            <tr>
                <th class="p-2 border-b">Booking ID</th>
                <th class="p-2 border-b">Client</th>
                <th class="p-2 border-b">Menu</th>
                <th class="p-2 border-b">Booking Date</th>
                <th class="p-2 border-b">People</th>
                <th class="p-2 border-b">Status</th>
                <th class="p-2 border-b">Booked At</th>
                <th class="p-2 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "
                SELECT 
                    bookings.BookingID AS BookingID,
                    users.FirstName AS FirstName,
                    menus.MenuName AS MenuName,
                    bookings.BookingDate,
                    bookings.NumberOfPeople,
                    bookings.Status AS Status,
                    bookings.CreatedAt
                FROM 
                    bookings
                INNER JOIN 
                    users ON bookings.UserID = users.UserID
                INNER JOIN 
                    menus ON bookings.MenuID = menus.MenuID
                ORDER BY 
                    bookings.BookingDate ASC;
            ";
            $result = mysqli_query($DBconnect, $query);
            while ($row = mysqli_fetch_assoc($result)):
            ?>
                <tr>
                    <td class="p-2 border-b"><?= $row['BookingID']; ?></td>
                    <td class="p-2 border-b"><?= $row['FirstName']; ?></td>
                    <td class="p-2 border-b"><?= $row['MenuName']; ?></td>
                    <td class="p-2 border-b"><?= $row['BookingDate']; ?></td>
                    <td class="p-2 border-b"><?= $row['NumberOfPeople']; ?></td>
                    <td class="p-2 border-b"><?= $row['Status']; ?></td>
                    <td class="p-2 border-b"><?= $row['CreatedAt']; ?></td>
                    <td class="p-2 border-b">
                        <form action="../../update_reservation.php" method="POST" class="inline-block">
                            <input type="hidden" name="booking_id" value="<?= $row['BookingID']; ?>">
                            <button type="submit" name="action" value="approve" class="px-4 py-1 bg-green-500 text-white rounded">Approve</button>
                        </form>
                        <form action="../../update_reservation.php" method="POST" class="inline-block ml-2">
                            <input type="hidden" name="booking_id" value="<?= $row['BookingID']; ?>">
                            <button type="submit" name="action" value="reject" class="px-4 py-1 bg-red-500 text-white rounded">Reject</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</section>


</main>

    </main>

    <!-- <aside class="w-64 bg-white shadow-md p-4">
      <h2 class="text-lg font-bold mb-4">Reviewers</h2>
      <ul class="space-y-4">
        <li class="text-gray-700">
          <span class="font-bold">Theresa Webb</span>
          <p class="text-sm text-gray-500">"Delicious Mongolian beef..."</p>
        </li>
        <li class="text-gray-700">
          <span class="font-bold">Cameron</span>
          <p class="text-sm text-gray-500">"Loved the mushroom burger!"</p>
        </li>
      </ul>
    </aside> -->

  </div>

</body>
</html>
