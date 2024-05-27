<?php 
$mail = '';
if(isset($_SESSION['umail'])){
  $mail = $_SESSION['umail'];
}

if(isset($conn)){
  $roomRates = getRoomRates($conn);
  $standardRate = $roomRates['standard'];
  $deluxRate = $roomRates['deluxe'];
  $suiteRate = $roomRates['suite'];
}

function getRoomRates($conn) {
  $rateQuery = "SELECT room_type, rate FROM room";
  $rateResult = mysqli_query($conn, $rateQuery);

  // Check for errors
  if (!$rateResult) {
    echo 'Error: ' . mysqli_error($conn);
    return array(); // Return an empty array as a default
  }

  $roomRates = array();
  while ($rateRow = mysqli_fetch_assoc($rateResult)) {
    $roomRates[$rateRow['room_type']] = $rateRow['rate'];
  }

  return $roomRates;
}
?>


<div class="container-no-margin col-xxl-8 px-4 py-5 bg-primary">

  <div class="card bg-warning mt-4">
    <img src="https://images.pexels.com/photos/164595/pexels-photo-164595.jpeg" class="card-img-top" alt="...">
    <div class="card-body">
      <div class="text-section">
        <h5 class="card-title fw-bold">Standard Room</h5>
        <p class="card-text">Our Standard Room Package offers a comfortable and affordable stay, perfect for travelers looking for a cozy space with essential amenities. Features include:<br>
          - Queen or Twin Bed Options <br>
          - Ensuite Bathroom with Basic Toiletries<br>
          - Complimentary Wi-Fi<br>
          - Flat-Screen TV with Cable Channels<br>
          - Coffee/Tea Making Facilities<br>
        </p>
      </div>
      <div class="cta-section">
        <div><?php echo 'Rs.' . number_format($standardRate, 2); ?></div>
        <a href="<?php echo siteurl;?>user/book.php?room_type=<?php echo "Standard";?>&email=<?php echo $mail?>" class="btn btn-dark">Book Now</a>
      </div>
    </div>
  </div>

  <div class="card bg-info mt-4">
    <img src="https://images.pexels.com/photos/164595/pexels-photo-164595.jpeg" class="card-img-top" alt="...">
    <div class="card-body">
      <div class="text-section">
        <h5 class="card-title fw-bold text-white">Delux Room</h5>
        <p class="card-text text-white">Elevate your stay with our Deluxe Room Package, designed for those seeking a touch of luxury and sophistication. Indulge in spacious accommodations with modern furnishings and upgraded amenities. Features include:<br>
          - King or Queen Bed Options<br>
          - Stylishly Furnished Living Area<br>
          - Premium Toiletries and Bathrobe<br>
          - High-Speed Wi-Fi<br>
          - Smart TV with Streaming Services<br>
          - In-Room Minibar<br>
        </p>
      </div>
      <div class="cta-section">
        <div class="text-white"><?php echo 'Rs.' . number_format($deluxRate, 2); ?></div>
        <a href="<?php echo siteurl;?>user/book.php?room_type=<?php echo "Deluxe";?>&email=<?php echo $mail?>" class="btn btn-dark">Book Now</a>
      </div>
    </div>
  </div>

  <div class="card bg-success mt-4">
    <img src="https://images.pexels.com/photos/164595/pexels-photo-164595.jpeg" class="card-img-top" alt="...">
    <div class="card-body">
      <div class="text-section">
        <h5 class="card-title fw-bold">Suite Room</h5>
        <p class="card-text">Experience unparalleled luxury with our Suite Package, designed for discerning travelers who appreciate the finer things in life. Features include:<br>
          - King Bed with Plush Bedding<br>
          - Separate Living and Dining Areas<br>
          - Jacuzzi or Spa Bath<br>
          - Exclusive Concierge Service<br>
          - Private Balcony with Panoramic Views<br>
          - Complimentary Breakfast and Evening Cocktails<br>
        </p>
      </div>
      <div class="cta-section">
        <div class="text-white"><?php echo 'Rs.' . number_format($suiteRate, 2); ?></div>
        <a href="<?php echo siteurl;?>user/book.php?room_type=<?php echo "Suite";?>&email=<?php echo $mail?>" class="btn btn-dark">Book Now</a>
      </div>
    </div>
  </div>

</div>
